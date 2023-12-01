<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DataController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/in', function () {
    return view('pages/in');
});
// routes/web.php

Route::post('/out', [PredictController::class, 'res']);

Route::get('/user-profile', [AuthController::class, 'purchase'])->name('user.profile');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cart/count', [CartController::class, 'getCartItemCount'])->name('cart.count');






Route::post('/login', [AuthController::class, 'login']);


Route::get('/', function () {
    return view('pages/home');
})->name('home');


Route::get('/company', function () {
    return view('pages/company');
})->name('company');

Route::get('tes', function () {
    return view('pages/tes');
});

// Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/contact', function () {
    return view('pages/home');
})->name('contact');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route::get('/registe', [AuthController::class, 'index']);

// SSO registration
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

//Penggunaan API
Route::middleware('api')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::get('/products', [ProductController::class, 'home']);
    Route::get('products/{id}/details', [ProductController::class, 'show']);
    Route::post('products', [ProductController::class, 'store']);
    // Route::put('products/{id}', [ProductController::class, 'update']);
    Route::patch('products/{id}', [ProductController::class, 'update']);
    // Route::delete('products/{id}', [ProductController::class, 'destroy']);


    // Tambahkan rute untuk CartController API di bawah ini
    Route::get('cart', [CartController::class, 'index'])->name('shopping-cart');
    Route::post('cart/add-to-cart/{id}', [CartController::class, 'addToCart']);
    Route::patch('cart/update-quantity/{id}', [CartController::class, 'updateQuantity']);
    Route::delete('cart/remove-item/{id}', [CartController::class, 'remove'])->name('delete-cart');
});

Route::middleware('web')->group(function () {
    Route::get('/products', [ProductController::class, 'home'])->name('products');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('models.products.edit');
});

Route::middleware(['web', 'PreventBackAfterLogout'])->group(function () {
    // Rute-rute yang ingin Anda lindungi dari akses setelah logout
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/account', function () {
        return view('pages/home');
    })->name('dashboard.update');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
    // Tambahan rute lain yang ingin Anda lindungi di sini
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); // Merujuk ke rute "dashboard"
    Route::get('/account', function () {
        return view('pages/home');
    })->name('dashboard.update');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/add-to-cart/{productId}', [CartController::class, 'addToCart'])->name('add.product');
    Route::post('/create-transaction', [CartController::class, 'createTransaction'])->name('create-transaction');
});

Route::group(['prefix' => 'data'], function () {

    Route::get('/', function () {
        return view('admin/panel');
    })->name('data');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('admin/transactions', [TransactionController::class, 'index'])->name('trans.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

    Route::apiResource('products', ProductController::class);
    Route::apiResource('users', UserController::class);
});
