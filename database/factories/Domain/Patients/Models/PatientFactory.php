<?php

namespace Database\Factories\Domain\Patients\Models;

use App\Domain\Patients\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    protected $model = Patient::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName.' '.$this->faker->lastName,
            'diagnosis' => $this->faker->realText(50),
        ];
    }
}
