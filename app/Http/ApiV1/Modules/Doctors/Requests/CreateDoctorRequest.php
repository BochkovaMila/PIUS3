<?php

namespace App\Http\ApiV1\Modules\Doctors\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class CreateDoctorRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'specialization' => 'required|string',
        ];
    }
}
