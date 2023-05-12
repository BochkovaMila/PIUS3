<?php

namespace App\Domain\Patients\Actions;

use App\Domain\Patients\Models\Patient;

class GetAllPatientsAction
{
    public function execute(): array
    {
        return Patient::all()->toArray();
    }
}
