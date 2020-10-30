<?php


namespace Database\Factories;


use App\Models\BrewMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrewMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BrewMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'method'  => $this->faker->words( 2 , true),
        ];
    }
}
