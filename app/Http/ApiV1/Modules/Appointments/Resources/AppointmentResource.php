<?php

namespace App\Http\ApiV1\Modules\Appointments\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class AppointmentResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'doctor_id' => $this->doctor_id,
            'patient_id' => $this->patient_id,
        ];
    }
}
