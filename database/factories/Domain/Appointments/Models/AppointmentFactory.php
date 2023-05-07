<?php

namespace Database\Factories\Domain\Appointments\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Doctors\Models\Doctor;
use App\Domain\Patients\Models\Patient;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'doctor_id' => Doctor::factory(),
            'patient_id' => Patient::factory(),
        ];
    }
}
