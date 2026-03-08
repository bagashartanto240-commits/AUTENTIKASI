<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name',
        'username',
        'nim',
        'email',
        'password',
        'tempat_lahir',
        'tanggal_lahir',
        'avatar', // Tambahkan ini jika ingin menyimpan nama file di database
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut agar data lebih mudah diolah.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date', // Mengubah string tanggal dari DB menjadi objek Carbon otomatis
        ];
    }
}