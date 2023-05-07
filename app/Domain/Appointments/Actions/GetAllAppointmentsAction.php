<?php

namespace App\Domain\Appointments\Actions;

use App\Domain\Appointments\Models\Appointment;

class GetAllAppointmentsAction
{
    public function execute(): array
    {
        return Appointment::all()->toArray();
    }
}
