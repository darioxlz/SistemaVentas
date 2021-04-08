<?php

namespace Database\Factories;

use App\Models\CV_Producto;
use App\Models\Producto;
use App\Models\Transaccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class CV_ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CV_Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $transacciones = Transaccion::all();
        $productos = Producto::all();

        return [
            'transaccion_id' => $transacciones->random()->transaccion_id,
            'producto_id' => $productos->random()->producto_id,
            'cantidad' => $this->faker->numberBetween(0, 2000),
            'precio' => $this->faker->randomFloat(3, 1, 50000000)
        ];
    }
}
