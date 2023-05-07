<?php

namespace App\Domain\Doctors\Actions;

use App\Domain\Doctors\Models\Doctor;

class DeleteDoctorAction
{
    public function execute(int $doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $doctor->delete();
    }
}
