<?php

namespace Database\Factories;

use App\Models\Compra;
use App\Models\ProductoCompra;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compra>
 */
class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Compra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = \App\Models\User::inRandomOrder()->first();
        return [
            'fecha' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['pagado','enviado','cancelado','entregado']),
            'email' => $user->email,
            'importe' => $this->faker->randomFloat(2, 200, 1200),
            'direccion' => $this->faker->address,
            'ciudad' => $this->faker->city,
            'provincia' => $this->faker->state,
            'codPostal' => $this->faker->randomNumber(5),
            'telefono' => $this->faker->randomNumber(9),
            'nombre' => $this->faker->name,
            'id_user' => $user->id,
        ];
    }
}
