<?php

namespace App\Http\ApiV1\Modules\Appointments\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class PatchAppointmentRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
        ];
    }
}
