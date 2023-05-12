<?php

namespace App\Domain\Doctors\Actions;

use App\Domain\Doctors\Models\Doctor;

class PatchDoctorAction
{
    public function execute(int $doctorId, array $fields): Doctor
    {
        $doctor = Doctor::findOrFail($doctorId);
        $doctor->update($fields);
        return $doctor;
    }
}
