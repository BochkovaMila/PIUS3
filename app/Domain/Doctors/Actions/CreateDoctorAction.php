<?php

namespace App\Domain\Doctors\Actions;

use App\Domain\Doctors\Models\Doctor;

class CreateDoctorAction
{
    public function execute(array $fields): Doctor
    {
        return Doctor::create($fields);
    }
}
