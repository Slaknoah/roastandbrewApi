<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->company,
            'roaster'       => 1,
            'subscription'  => 0,
            'description'   => $this->faker->text( 300 ),
            'website'       => $this->faker->url,
            'address'       => $this->faker->streetAddress,
            'country'       => $this->faker->countryCode,
            'city'          => $this->faker->city,
            'state'         => $this->faker->city,
            'zip'           => $this->faker->postcode,
            'facebook_url'  => $this->faker->url,
            'twitter_url'   => $this->faker->url,
            'instagram_url' => $this->faker->url,
            'header_image_url'    => 'http://lorempixel.com/1200/600/food/' . random_int(1,10),
            'logo_url'      => 'http://lorempixel.com/200/200/food/' . random_int(1,10),
        ];
    }
}
