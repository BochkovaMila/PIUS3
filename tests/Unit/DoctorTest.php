<?php

namespace Tests\Unit;

use App\Domain\Doctors\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\patchJson;

uses(TestCase::class, RefreshDatabase::class);

it('get list of doctors with ok response', function () {
    Doctor::factory()->count(2)->create();
    $response = getJson('/api/v1/doctors');
    $response->assertStatus(200)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data', 2)
        );
});

it('get list of doctors with not found response', function () {
    $response = getJson('/api/v1/fakedoctors');
    $response->assertStatus(404);
});

it('get doctor by id with ok response', function () {
    $doctor = Doctor::factory()->create();
    $response = getJson('/api/v1/bdoctors/' . $doctor->id);
    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has(
                'data',
                fn ($json) => $json->where('id', $doctor->id)
            ->where('name', $doctor->name)
            ->where('specialization', $doctor->specialization)
            ));
});

it('get doctor by id with not found response', function () {
    $doctor = Doctor::factory()->create();
    $response = getJson('/api/v1/doctors/' . $doctor->id+100000);
    $response->assertStatus(404);
});

it('post doctor with created response', function () {
    $doctor = Doctor::factory()->raw();
    $response = postJson('/api/v1/doctors', $doctor);
    $response->assertStatus(201)
    ->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->whereType('id', 'integer')
        ->where('name', $doctor['name'])
        ->where('specialization', $doctor['specialization'])
        ));
    $this->assertDatabaseHas('doctors', $doctor);
});

it('post doctor with not found response', function () {
    $doctor = Doctor::factory()->raw();
    $response = postJson('/api/v1/fakedoctors', $doctor);
    $response->assertStatus(404);
});

it('post doctor with bad unprocessable entity(seems like bad request) response', function () {
    $doctor = Doctor::factory()->raw();
    $doctor['name'] = null;
    $response = postJson('/api/v1/doctors', $doctor);
    $response->assertStatus(422);
});

it('delete doctor by id with ok response', function () {
    $doctor = Doctor::factory()->create();
    $response = deleteJson('/api/v1/doctors/'. $doctor->id);
    $response->assertStatus(200);
    $this->assertDatabaseMissing('doctors', $doctor->attributesToArray());
});

it('delete doctor by id with not found response', function () {
    $doctor = Doctor::factory()->create();
    $response = deleteJson('/api/v1/fakedoctors/'. $doctor->id);
    $response->assertStatus(404);
});

it('put doctor by id with ok response', function () {
    $doctor = Doctor::factory()->create();
    $putDoctor = Doctor::factory()->raw();
    $response = putJson('/api/v1/doctors/'. $doctor->id, $putDoctor);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $doctor->id)
            ->where('name', $putDoctor['name'])
            ->where('specialization', $putDoctor['specialization'])
        ));
    $this->assertDatabaseHas('doctors', $putDoctor);
});

it('put doctor by id with not found response', function () {
    $doctor = Doctor::factory()->create();
    $putDoctor = Doctor::factory()->raw();
    $response = putJson('/api/v1/fakedoctors/'. $doctor->id, $putDoctor);
    $response->assertStatus(404);
});

it('put doctor by id with bad request response', function () {
    $doctor = Doctor::factory()->create();
    $putDoctor = Doctor::factory()->raw();
    $putDoctor['name'] = null;
    $response = putJson('/api/v1/doctors/'. $doctor->id, $putDoctor);
    $response->assertStatus(422);
});

it('patch doctor by id with ok response', function () {
    $doctor = Doctor::factory()->create();
    $patchDoctor = Doctor::factory()->raw();
    $response = patchJson('/api/v1/doctor/'. $buyer->id, $patchDoctor);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $doctor->id)
            ->where('name', $patchDoctor['name'])
            ->where('specialization', $patchDoctor['specialization'])
        ));
    $this->assertDatabaseHas('doctors', $patchDoctor);
});

it('patch doctor by id with not found response', function () {
    $doctor = Doctor::factory()->create();
    $patchDoctor = Doctor::factory()->raw();
    $response = putJson('/api/v1/fakedoctors/'. $doctor->id, $patchDoctor);
    $response->assertStatus(404);
});

it('patch doctor by id with bad request response', function () {
    $doctor = Doctor::factory()->create();
    $patchDoctor = Doctor::factory()->raw();
    $patchDoctor['name'] = null;
    $response = patchJson('/api/v1/doctors/'. $doctor->id, $patchDoctor);
    $response->assertStatus(422);
});
