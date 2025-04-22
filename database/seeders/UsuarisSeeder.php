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
            ['nombreUsuario' => 'Miguel', 'contrasenya' => bcrypt('Contrasena1234_'), 'correo' => 'miguel@gmail.com', 'ciutat' => 'Barcelona'],
            ['nombreUsuario' => 'Frank', 'contrasenya' => bcrypt('Contrasena1234_'), 'correo' => 'frank@gmail.com', 'ciutat' => 'Madrid'],
            ['nombreUsuario' => 'Hector', 'contrasenya' => bcrypt('Contrasena1234_'), 'correo' => 'hector@gmail.com', 'ciutat' => 'Lloret'],
            ['nombreUsuario' => 'admin', 'contrasenya' => bcrypt('Admin1234_'), 'correo' => 'admin@admin.com', 'ciutat' => 'Barcelona'],
        ]);
        
    }
}
