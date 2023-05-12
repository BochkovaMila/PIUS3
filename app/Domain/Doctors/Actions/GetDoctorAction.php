<?php

namespace App\Domain\Doctors\Actions;

use App\Domain\Doctors\Models\Doctor;

class GetDoctorAction
{
    public function execute(int $doctorId): Doctor
    {
        return Doctor::findOrFail($doctorId);
    }
}
