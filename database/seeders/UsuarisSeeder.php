<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuaris')->insert([
            ['nombreUsuario' => 'Miguel', 'contrasenya' => 'Contrasena1234_', 'correo' => 'miguel@gmail.com', 'ciutat' => 'Barcelona'],
            ['nombreUsuario' => 'Frank', 'contrasenya' => 'Contrasena1234_', 'correo' => 'frank@gmail.com', 'ciutat' => 'Madrid'],
            ['nombreUsuario' => 'Hector', 'contrasenya' => 'Contrasena1234_', 'correo' => 'hector@gmail.com', 'ciutat' => 'Lloret'],
        ]);
        
    }
}
