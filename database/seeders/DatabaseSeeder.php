<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\CV_Producto;
use App\Models\Producto;
use App\Models\Transaccion;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Usuario::factory()->create([
            'nombre' => 'John',
            'apellido' => 'Doe',
            'cedula' => '12345678',
            'correo' => 'admin@admin.com',
            'contrasena' => '12345678'
        ]);
        Usuario::factory()->count(9)->create();
        Cliente::factory()->count(20)->create();
        Producto::factory()->count(50)->create();
        Cuenta::factory()->count(20)->create();

//        Transaccion::factory()->count(20)->create();
//        CV_Producto::factory()->count(100)->create();
    }
}
