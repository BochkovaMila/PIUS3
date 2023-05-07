<?php

namespace App\Http\ApiV1\Modules\Patients\Controllers;

use App\Domain\Patients\Actions\CreatePatientsAction;
use App\Domain\Patients\Actions\DeletePatientsAction;
use App\Domain\Patients\Actions\GetAllPatientsAction;
use App\Domain\Patients\Actions\GetPatientsAction;
use App\Domain\Patients\Actions\PatchPatientsAction;
use App\Domain\Patients\Actions\ReplacePatientsAction;
use App\Http\ApiV1\Modules\Patients\Requests\CreatePatientsRequest;
use App\Http\ApiV1\Modules\Patients\Requests\PatchPatientsRequest;
use App\Http\ApiV1\Modules\Patients\Requests\ReplacePatientsRequest;
use App\Http\ApiV1\Modules\Patients\Resources\PatientsResource;
use Illuminate\Http\Request;

class PatientController 
{
    public function getList(GetAllPatientsAction $action)
    {
        $patients = $action->execute();
        return response()->json(["data" => $patients]);
    }

    public function post(CreatePatientAction $action, CreatePatientRequest $request)
    {
        return new PatientResource($action->execute($request->validated()));
    }

    public function get(int $patientId, GetPatientAction $action)
    {
        return new PatientResource($action->execute($patientId));
    }

    public function patch(int $patientId, PatchPatientAction $action, PatchPatientRequest $request)
    {
        return new PatientResource($action->execute($patientId, $request->validated()));
    }

    public function put(int $patientId, ReplacePatientAction $action, ReplacePatientRequest $request)
    {
        return new PatientResource($action->execute($patientId, $request->validated()));
    }

    public function delete(int $patientId, DeletePatientAction $action)
    {
        $action->execute($patientId);
        return new EmptyResource();
    }
}
