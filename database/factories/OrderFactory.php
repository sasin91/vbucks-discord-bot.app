<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Users;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'customer_id' => Users::factory(),
            'status' => $this->faker->word(),
            'status_reason' => $this->faker->word(),
            'total_cost' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
