<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
        $name = 'ไข่ไก่ เบอร์ '.$this->faker->unique()->numberBetween(0,2);
        return [
            'name' => $name,
            'slug' => Str::slug($name.$this->faker->numberBetween(100000,900000)),
            'image' => 'images/products/1628199715.jpg',
            'des' => 'ไข่ไก่ มัทนาฟาร์ม',
            'sku' => $this->faker->numberBetween(100000,900000),
            'retail_price' => $this->faker->numberBetween(90,120),
            'wholesale_price' => $this->faker->numberBetween(50,110),
            'catagory_id' => 1,
            'branch_id' => 1,
            'qty' => 10,
            'unit' => 'แผง',
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}
