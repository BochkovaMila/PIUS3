<?php

namespace App\Http\ApiV1\Modules\Doctors\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class DoctorResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'specialization' => $this->specialization,
        ];
    }
}
