<?php

namespace App\Domain\Doctors\Actions;

use App\Domain\Doctors\Models\Doctor;

class ReplaceDoctorAction
{
    public function execute(int $doctorId, array $fields): Doctor
    {
        $doctor = Doctor::findOrFail($doctorId);
        $doctor->update($fields);
        return $doctor;
    }
}
