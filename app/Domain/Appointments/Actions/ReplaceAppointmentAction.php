<?php

namespace App\Domain\Appointments\Actions;

use App\Domain\Appointments\Models\Appointment;

class ReplaceAppointmentAction
{
    public function execute(int $appointmentId, array $fields): Appointment
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->update($fields);
        return $appointment;
    }
}
