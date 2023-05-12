<?php

namespace App\Domain\Patients\Actions;

use App\Domain\Patients\Models\Patient;

class GetPatientAction
{
    public function execute(int $patientId): Patient
    {
        return Patient::findOrFail($patientId);
    }
}
