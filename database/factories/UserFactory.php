<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // Ganti 'name' menjadi 'username'
            'username' => fake()->userName(),
            // Hapus 'email' dan 'email_verified_at' jika tabel Anda tidak memilikinya
            // 'email' => fake()->unique()->safeEmail(),

            // Default password
            'password' => Hash::make('password'),

            // Tambahkan hak_akses default (misal 1 untuk admin)
            'hak_akses' => 1,

            // Hapus remember token jika tidak dipakai, atau biarkan saja
            'remember_token' => Str::random(10),
        ];
    }
}
