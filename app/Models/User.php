<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Properti ini akan digunakan untuk validasi.
     */
    protected $rules = [
        'profile_picture' => 'nullable|image|mimes:jpeg,png|max:2048', // Gambar JPEG atau PNG, maksimal 2MB
        'username' => [
            'required',
            'string',
            'max:255',
        ],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
        ],
        'phone_number' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
    ];

    protected $attributes = [
        'role_id' => 2
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'phone_number',
        'country',
        'password',
        'avatar',
        'role_id', // Kolom ini digunakan untuk menyimpan ID peran pengguna
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Fungsi untuk melakukan validasi.
     */
    public function validate(array $data)
    {
        return Validator::make($data, $this->rules);
    }

    /**
     * Relasi pengguna ke peran (role).
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
