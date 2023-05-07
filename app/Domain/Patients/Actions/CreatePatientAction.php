<?php

namespace App\Domain\Patients\Actions;

use App\Domain\Patients\Models\Doctor;

class CreatePatientAction
{
    public function execute(array $fields): Patient
    {
        return Patient::create($fields);
    }
}
