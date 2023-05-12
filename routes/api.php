<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\ApiV1\Modules\Doctors\Controllers\DoctorController;
use App\Http\ApiV1\Modules\Patients\Controllers\PatientController;
use App\Http\ApiV1\Modules\Appointments\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/v1/doctors", [DoctorController::class, 'getList']);
Route::post("/v1/doctors", [DoctorController::class, 'post']);
Route::get("/v1/doctors/{id}", [DoctorController::class, 'get']);
Route::put("/v1/doctors/{id}", [DoctorController::class, 'put']);
Route::patch("/v1/doctors/{id}", [DoctorController::class, 'patch']);
Route::delete("/v1/doctors/{id}", [DoctorController::class, 'delete']);

Route::get("/v1/patients", [PatientController::class, 'getList']);
Route::post("/v1/patients", [PatientController::class, 'post']);
Route::get("/v1/patients/{id}", [PatientController::class, 'get']);
Route::put("/v1/patients/{id}", [PatientController::class, 'put']);
Route::patch("/v1/patients/{id}", [PatientController::class, 'patch']);
Route::delete("/v1/patients/{id}", [PatientController::class, 'delete']);

Route::get("/v1/appointments", [AppointmentController::class, 'getList']);
Route::post("/v1/appointments", [AppointmentController::class, 'post']);
Route::get("/v1/appointments/{id}", [AppointmentController::class, 'get']);
Route::put("/v1/appointments/{id}", [AppointmentController::class, 'put']);
Route::patch("/v1/appointments/{id}", [AppointmentController::class, 'patch']);
Route::delete("/v1/appointments/{id}", [AppointmentController::class, 'delete']);
