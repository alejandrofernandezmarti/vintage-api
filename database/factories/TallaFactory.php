<?php

namespace Database\Factories;

use App\Models\Talla;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Talla>
 */
class TallaFactory extends Factory
{
    protected $model = Talla::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'etiqueta' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
            'real' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
            //'real' => $this->faker->randomFloat(2, 60, 200), // Example range for real size
        ];
    }
}
