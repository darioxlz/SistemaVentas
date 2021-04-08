<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usuarios = Usuario::all();

        return [
            'nombre' => $this->faker->name,
            'tipo_documento' => $this->faker->randomElement(['CEDULA', 'RIF']),
            'documento' => $this->faker->randomNumber(8),
            'telefono' => $this->faker->phoneNumber,
            'correo' => $this->faker->email,
            'descripcion' => $this->faker->text(20),
            'creado_por' => $usuarios->random()->usuario_id
        ];
    }
}
