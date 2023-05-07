<?php

namespace App\Domain\Patients\Actions;

use App\Domain\Patients\Models\Patient;

class ReplacePatientAction
{
    public function execute(int $patientId, array $fields): Patient
    {
        $patient = Patient::findOrFail($patientId);
        $patient->update($fields);
        return $patient;
    }
}
