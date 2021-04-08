<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class CuentaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cuenta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $clientes = Cliente::all();
        $usuarios = Usuario::all();

        return [
            'cliente_id' => $clientes->random()->cliente_id,
            'tipo' => $this->faker->randomElement(['CPC', 'CPP']),
            'descripcion' => $this->faker->text(20),
            'monto' => $this->faker->randomFloat(3, 1, 50000000),
            'estado' => $this->faker->randomElement(['PENDIENTE', 'PAGADO']),
            'creado_por' => $usuarios->random()->usuario_id
        ];
    }
}
