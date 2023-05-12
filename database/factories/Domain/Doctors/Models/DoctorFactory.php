<?php

namespace Database\Factories\Domain\Doctors\Models;

use App\Domain\Doctors\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    protected $model = Doctor::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName.' '.$this->faker->lastName,
            'specialization' => $this->faker->realText(20),
        ];
    }
}
