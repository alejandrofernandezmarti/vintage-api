<?php

namespace Database\Factories;

use App\Models\Medida;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medida>
 */
class MedidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Medida::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'alto' => $this->faker->numberBetween(50, 200),
            'ancho' => $this->faker->numberBetween(50, 200),
            'manga' => $this->faker->numberBetween(30, 100),
        ];
    }
}
