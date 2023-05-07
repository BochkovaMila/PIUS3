<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Doctors\Models\Doctor;
use App\Domain\Patients\Models\Patient;
use App\Domain\Appointments\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppointmentFactory()
        ->count(20)
        ->has(Doctor::factory()->count(100), 'doctors')
        ->has(Patient::factory()->count(100), 'patients')
        ->create();
    }
}
