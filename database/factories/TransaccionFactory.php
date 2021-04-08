<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Transaccion;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaccion::class;

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
            'cantidad_productos' => $this->faker->numberBetween(0, 2000),
            'monto_total' => $this->faker->randomFloat(3, 1, 50000000),
            'tipo' => $this->faker->randomElement(['COMPRA', 'VENTA']),
            'creado_por' => $usuarios->random()->usuario_id
        ];
    }
}
