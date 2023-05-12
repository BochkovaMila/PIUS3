<?php

namespace App\Domain\Appointments\Actions;

use App\Domain\Appointments\Models\Appointment;

class CreateAppointmentAction
{
    public function execute(array $fields): Appointment
    {
        return Appointment::create($fields);
    }
}
