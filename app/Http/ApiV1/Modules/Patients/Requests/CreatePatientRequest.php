<?php

namespace App\Http\ApiV1\Modules\Patients\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class CreatePatientRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'diagnosis' => 'required|string',
        ];
    }
}
