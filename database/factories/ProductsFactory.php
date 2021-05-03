<?php

namespace Database\Factories;


use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => 'aaaa',
            'product_type' => random_int(0, 1),
            'customer_type' => random_int(0, 1),
            'transportation_fee' => random_int(1000, 100000),
            'funds' => random_int(1000, 100000),
            'interest' => random_int(1000, 100000),
            'image' => 'demo',
            'name_fb_customer' => $this->faker->name,
        ];
    }
}
