<?php

namespace App\Domain\Doctors\Actions;

use App\Domain\Doctors\Models\Doctor;

class GetAllDoctorsAction
{
    public function execute(): array
    {
        return Doctor::all()->toArray();
    }
}
