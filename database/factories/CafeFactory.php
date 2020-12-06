<?php

namespace Database\Factories;

use App\Models\Cafe;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CafeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cafe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'location_name'  => $this->faker->company,
            'address'        => $this->faker->address,
            'city'           => $this->faker->city,
            'state'          => $this->faker->city,
            'country'        => $this->faker->countryCode,
            'zip'            => $this->faker->postcode,
            'tea'            => random_int( 0, 1),
            'matcha'         => random_int( 0, 1),
            'description'    => $this->faker->text,
            'primary_image_url'  => 'https://via.placeholder.com/500x500/?' . mt_rand()
        ];
    }
}
