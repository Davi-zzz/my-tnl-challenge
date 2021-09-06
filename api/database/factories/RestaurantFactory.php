<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name,
            'cnpj' => $this->faker->cnpj,
            'phone' => $this->faker->cellPhoneNumber,
            'address'  => $this->faker->streetAddress,
            'zip_code'  => $this->faker->postcode,
            'location'  => 'BRAZIL',
            'state' => $this->faker->state,
            'status' => true
        ];
    }
}
