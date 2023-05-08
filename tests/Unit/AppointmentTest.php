<?php

namespace Tests\Unit;

use App\Domain\Appointments\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\patchJson;

uses(TestCase::class, RefreshDatabase::class);

it('get list of appointments with ok response', function () {
    appointment::factory()->count(2)->create();
    $response = getJson('/api/v1/appointments');
    $response->assertStatus(200)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data', 2)
        );
});

it('get list of appointments with not found response', function () {
    $response = getJson('/api/v1/fakeAppointments');
    $response->assertStatus(404);
});

it('get appointment by id with ok response', function () {
    $appointment = appointment::factory()->create();
    $response = getJson('/api/v1/bAppointments/' . $appointment->id);
    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has(
                'data',
                fn ($json) => $json->where('id', $appointment->id)
            ->where('doctor_id', $appointment->doctor_id)
            ->where('patient_id', $appointment->patient_id)
            ));
});

it('get appointment by id with not found response', function () {
    $appointment = appointment::factory()->create();
    $response = getJson('/api/v1/appointments/' . $appointment->id+100000);
    $response->assertStatus(404);
});

it('post appointment with created response', function () {
    $appointment = appointment::factory()->raw();
    $response = postJson('/api/v1/appointments', $appointment);
    $response->assertStatus(201)
    ->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->whereType('id', 'integer')
        ->where('doctor_id', $appointment['doctor_id'])
        ->where('patient_id', $appointment['patient_id'])
        ));
    $this->assertDatabaseHas('appointments', $appointment);
});

it('post appointment with not found response', function () {
    $appointment = appointment::factory()->raw();
    $response = postJson('/api/v1/fakeAppointments', $appointment);
    $response->assertStatus(404);
});

it('post appointment with bad unprocessable entity(seems like bad request) response', function () {
    $appointment = appointment::factory()->raw();
    $appointment['doctor_id'] = null;
    $response = postJson('/api/v1/appointments', $appointment);
    $response->assertStatus(422);
});

it('delete appointment by id with ok response', function () {
    $appointment = appointment::factory()->create();
    $response = deleteJson('/api/v1/appointments/'. $appointment->id);
    $response->assertStatus(200);
    $this->assertDatabaseMissing('appointments', $appointment->attributesToArray());
});

it('delete appointment by id with not found response', function () {
    $appointment = appointment::factory()->create();
    $response = deleteJson('/api/v1/fakeAppointments/'. $appointment->id);
    $response->assertStatus(404);
});

it('put appointment by id with ok response', function () {
    $appointment = appointment::factory()->create();
    $putAppointment = appointment::factory()->raw();
    $response = putJson('/api/v1/appointments/'. $appointment->id, $putAppointment);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $appointment->id)
            ->where('doctor_id', $putAppointment['doctor_id'])
            ->where('patient_id', $putAppointment['patient_id'])
        ));
    $this->assertDatabaseHas('appointments', $putAppointment);
});

it('put appointment by id with not found response', function () {
    $appointment = appointment::factory()->create();
    $putAppointment = appointment::factory()->raw();
    $response = putJson('/api/v1/fakeAppointments/'. $appointment->id, $putAppointment);
    $response->assertStatus(404);
});

it('put appointment by id with bad request response', function () {
    $appointment = appointment::factory()->create();
    $putAppointment = appointment::factory()->raw();
    $putAppointment['doctor_id'] = null;
    $response = putJson('/api/v1/appointments/'. $appointment->id, $putAppointment);
    $response->assertStatus(422);
});

it('patch appointment by id with ok response', function () {
    $appointment = appointment::factory()->create();
    $patchAppointment = appointment::factory()->raw();
    $response = patchJson('/api/v1/appointment/'. $buyer->id, $patchAppointment);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $appointment->id)
            ->where('doctor_id', $patchAppointment['doctor_id'])
            ->where('patient_id', $patchAppointment['patient_id'])
        ));
    $this->assertDatabaseHas('appointments', $patchAppointment);
});

it('patch appointment by id with not found response', function () {
    $appointment = appointment::factory()->create();
    $patchAppointment = appointment::factory()->raw();
    $response = putJson('/api/v1/fakeAppointments/'. $appointment->id, $patchAppointment);
    $response->assertStatus(404);
});

it('patch appointment by id with bad request response', function () {
    $appointment = appointment::factory()->create();
    $patchAppointment = appointment::factory()->raw();
    $patchAppointment['doctor_id'] = null;
    $response = patchJson('/api/v1/appointments/'. $appointment->id, $patchAppointment);
    $response->assertStatus(422);
});
