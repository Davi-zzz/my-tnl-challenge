<?php

namespace Database\Factories;

use App\Models\Dishe;
use Illuminate\Database\Eloquent\Factories\Factory;


class DisheFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dishe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\pt_BR\Restaurant($faker));
        return [
            //
            'name' => $faker->foodName,
            'description' => 'a delicious dish!', 
            'category' => rand(0, 7),
            'menu_id' => null,
            'type' => rand(0,6),
            'status' => 0
        ];
    }
}
