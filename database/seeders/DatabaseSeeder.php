<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Appointments\Models\Appointment;
use App\Domain\Doctors\Models\Doctor;
use App\Domain\Patients\Models\Patient;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Appointment::factory()->count(20)->create();
        Doctor::factory()->count(100)->create();
        Patient::factory()->count(100)->create();
    }
}
