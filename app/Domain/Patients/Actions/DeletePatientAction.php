<?php

namespace App\Domain\Patients\Actions;

use App\Domain\Patients\Models\Doctors;

class DeletePatientAction
{
    public function execute(int $patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $patient->delete();
    }
}
