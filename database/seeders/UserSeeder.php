<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear un nuevo usuario administrador
        User::create([
            'name' => 'Nombre del Usuario',
            'email' => 'robertoramirezmoreno@gmail.com',
            'password' => Hash::make('Adminpassword'),
            'admin' => true, // Marcar como administrador
        ]);
    }
}
