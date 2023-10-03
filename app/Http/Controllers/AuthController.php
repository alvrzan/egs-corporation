<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Redirect ke Google untuk login Oauth
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback setelah login Oauth dari Google
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Cek apakah email pengguna sudah terdaftar dalam aplikasi
        $existingUser = User::where('email', $googleUser->email)->first();

        if ($existingUser) {
            // Jika pengguna sudah terdaftar, otentikasi
            Auth::login($existingUser);
        } else {
            // Jika pengguna belum terdaftar, tambahkan sebagai pengguna baru
            $newUser = new User();
            $newUser->username = $googleUser->name;
            $newUser->email = $googleUser->email;
            $newUser->password = ''; // Atur password sementara
            $newUser->first_name = $googleUser->user['given_name'];
            $newUser->last_name = $googleUser->user['family_name'];
            $newUser->avatar = $googleUser->avatar;
            $newUser->save();

            Auth::login($newUser);
        }

        // Setelah login atau registrasi, arahkan pengguna sesuai dengan peran
        if (Auth::user()->role->name === 'admin') {
            return redirect()->route('dashboard');
        } elseif (Auth::user()->role->name === 'user') {
            return redirect()->route('dashboard');
        }
    }




    // Tampilkan halaman login manual
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login manual
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where(function ($query) use ($credentials) {
            $query->where('email', $credentials['email'])
                ->orWhere('username', $credentials['email']);
        })->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Jika autentikasi berhasil, alihkan ke halaman yang diinginkan
            Auth::login($user);

            // Setelah login, arahkan pengguna sesuai dengan peran
            if (Auth::user()->role->name === 'admin') {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->role->name === 'user') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // Jika autentikasi gagal, tampilkan pesan error
        return back()->withErrors([
            'login' => 'Invalid credentials',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Mengarahkan ke halaman utama atau halaman lain yang sesuai
    }


    // Tampilkan halaman registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone_number' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
        ], [
            'password' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character (@$!%*?&).',
        ]);

        // Tambahkan pesan log untuk memeriksa data yang akan disimpan
        \Illuminate\Support\Facades\Log::info('Data yang akan disimpan:', $request->all());

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'phone_number' => $request->input('phone_number'),
            'country' => $request->input('country'),
            'password' => bcrypt($request->input('password')),
        ]);

        Auth::login($user);

        return redirect('/');
    }


    // Tambahkan method purchaseProduct di AuthController
    public function purchase(Request $request)
    {
        // Pastikan pengguna yang sudah masuk
        if (Auth::check()) {
            return view('pages.user');
        } else {
            // Jika pengguna belum masuk, alihkan mereka ke halaman login
            return redirect(route('login'))->with('status', 'Anda harus masuk untuk melakukan pembelian.');
        }
    }

    public function dashboard()
    {
        // Periksa peran pengguna setelah login
        if (Auth::user()->role->name === 'admin') {
            return view('dashboard.admin'); // Gantilah dengan tampilan admin yang sesuai
        } elseif (Auth::user()->role->name === 'user') {
            return view('dashboard.user'); // Gantilah dengan tampilan user yang sesuai
        } else {
            // Jika pengguna memiliki peran lain, atur tindakan sesuai kebutuhan Anda
            // Misalnya, arahkan ke tampilan default atau tampilkan pesan kesalahan
            return view('default.dashboard'); // Gantilah dengan tampilan default yang sesuai
        }
    }
}
