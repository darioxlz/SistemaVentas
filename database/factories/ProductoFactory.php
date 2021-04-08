<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usuarios = Usuario::all();

        return [
            'descripcion' => $this->faker->text(20),
            'stock' => $this->faker->numberBetween(0, 2000),
            'precio' => $this->faker->randomFloat(3, 1, 50000000),
            'creado_por' => $usuarios->random()->usuario_id
        ];
    }
}
