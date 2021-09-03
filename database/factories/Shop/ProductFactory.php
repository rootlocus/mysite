<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => (string) Str::uuid(),
            'category_id' => Category::all()->random()->id,
            'name' => $this->faker->name,
            'slug' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 10, 30),
            'description' => $this->faker->paragraph(2),
            'image' => null,
        ];
    }
}
