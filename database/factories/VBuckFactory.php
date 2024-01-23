<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Orders;
use App\Models\Users;
use App\Models\VBuck;

class VBuckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VBuck::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => Orders::factory(),
            'character_name' => $this->faker->word(),
            'amount' => $this->faker->word(),
            'const' => $this->faker->randomFloat(0, 0, 9999999999.),
            'delivered_at' => $this->faker->dateTime(),
            'delivered_by' => Users::factory(),
        ];
    }
}
