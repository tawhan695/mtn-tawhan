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
        $name = 'ไข่ไก่ เบอร์ '.$this->faker->unique()->numberBetween(0,5);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'des' => 'ไข่ไก่ มัทนาฟาร์ม',
            'legular_price' => $this->faker->numberBetween(100,200),
            'catagory_id' => 1,
            'branch_id' => 1,
            'unit' => 'แผง',
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}
