<?php

namespace Database\Factories;

use App\Models\Compra;
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
            'metodo_pago' => $this->faker->randomElement(['tarjeta', 'paypal', 'contrarrembolso']),
            'direccion' => $this->faker->address,
            'estado' => $this->faker->randomElement(['pendiente', 'completado', 'cancelado']),
            'email' => $user->email,
            'id_user' => $user->id,
        ];
    }
}
