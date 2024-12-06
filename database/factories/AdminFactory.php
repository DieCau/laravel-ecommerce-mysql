<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Definir la estructura de los datos fakes para el modelo Admin
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generar datos fakes para el modelo Admin
        return [
            'name' => 'admin',
            'email'=> 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ];
    }
}
