<?php

namespace App\Http\ApiV1\Modules\Patients\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class PatientResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'diagnosis' => $this->diagnosis,
        ];
    }
}
