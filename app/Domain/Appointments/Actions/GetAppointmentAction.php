<?php

namespace App\Domain\Appointments\Actions;

use App\Domain\Appointments\Models\Appointment;

class GetAppointmentAction
{
    public function execute(int $appointmentId): Appointment
    {
        return Appointment::findOrFail($appointmentId);
    }
}
