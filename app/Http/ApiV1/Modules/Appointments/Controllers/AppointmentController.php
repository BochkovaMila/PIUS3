<?php

namespace App\Http\ApiV1\Modules\Appointments\Controllers;

use App\Domain\Appointments\Actions\CreateAppointmentAction;
use App\Domain\Appointments\Actions\DeleteAppointmentAction;
use App\Domain\Appointments\Actions\GetAllAppointmentsAction;
use App\Domain\Appointments\Actions\GetAppointmentAction;
use App\Domain\Appointments\Actions\PatchAppointmentAction;
use App\Domain\Appointments\Actions\ReplaceAppointmentAction;
use App\Http\ApiV1\Modules\Appointments\Requests\CreateAppointmentRequest;
use App\Http\ApiV1\Modules\Appointments\Requests\PatchAppointmentRequest;
use App\Http\ApiV1\Modules\Appointments\Requests\ReplaceAppointmentRequest;
use App\Http\ApiV1\Modules\Appointments\Resources\AppointmentResource;
use Illuminate\Http\Request;

class AppointmentController 
{
    public function getList(GetAllAppointmentsAction $action)
    {
        $appointments = $action->execute();
        return response()->json(["data" => $appointments]);
    }

    public function post(CreateAppointmentAction $action, CreateAppointmentRequest $request)
    {
        return new AppointmentResource($action->execute($request->validated()));
    }

    public function get(int $appointmentId, GetAppointmentAction $action)
    {
        return new AppointmentResource($action->execute($appointmentId));
    }

    public function patch(int $appointmentId, PatchAppointmentAction $action, PatchAppointmentRequest $request)
    {
        return new AppointmentResource($action->execute($appointmentId, $request->validated()));
    }

    public function put(int $appointmentId, ReplaceAppointmentAction $action, ReplaceAppointmentRequest $request)
    {
        return new AppointmentResource($action->execute($appointmentId, $request->validated()));
    }

    public function delete(int $appointmentId, DeleteAppointmentAction $action)
    {
        $action->execute($appointmentId);
        return new EmptyResource();
    }
}
