<?php

namespace App\Domain\Appointments\Actions;

use App\Domain\Appointments\Models\Appointment;

class DeleteAppointmentAction
{
    public function execute(int $appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->delete();
    }
}
