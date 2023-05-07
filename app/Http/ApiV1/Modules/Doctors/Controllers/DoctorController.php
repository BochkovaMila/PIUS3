<?php

namespace App\Http\ApiV1\Modules\Doctors\Controllers;

use App\Domain\Doctors\Actions\CreateDoctorAction;
use App\Domain\Doctors\Actions\DeleteDoctorAction;
use App\Domain\Doctors\Actions\GetAllDoctorAction;
use App\Domain\Doctors\Actions\GetDoctorAction;
use App\Domain\Doctors\Actions\PatchDoctorAction;
use App\Domain\Doctors\Actions\ReplaceDoctorAction;
use App\Http\ApiV1\Modules\Doctors\Requests\CreateDoctorRequest;
use App\Http\ApiV1\Modules\Doctors\Requests\PatchDoctorRequest;
use App\Http\ApiV1\Modules\Doctors\Requests\ReplaceDoctorRequest;
use App\Http\ApiV1\Modules\Doctors\Resources\DoctorResource;
use Illuminate\Http\Request;

class DoctorController 
{
    public function getList(GetAllDoctorsAction $action)
    {
        $doctors = $action->execute();
        return response()->json(["data" => $doctors]);
    }

    public function post(CreateDoctorAction $action, CreateDoctorRequest $request)
    {
        return new DoctorResource($action->execute($request->validated()));
    }

    public function get(int $doctorId, GetDoctorAction $action)
    {
        return new DoctorResource($action->execute($doctorId));
    }

    public function patch(int $doctorId, PatchDoctorAction $action, PatchDoctorRequest $request)
    {
        return new DoctorResource($action->execute($doctorId, $request->validated()));
    }

    public function put(int $doctorId, ReplaceDoctorAction $action, ReplaceDoctorRequest $request)
    {
        return new DoctorResource($action->execute($doctorId, $request->validated()));
    }

    public function delete(int $doctorId, DeleteDoctorAction $action)
    {
        $action->execute($doctorId);
        return new EmptyResource();
    }
}
