<?php

namespace Tests\Unit;

use App\Domain\Patients\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\patchJson;

uses(TestCase::class, RefreshDatabase::class);

it('get list of patients with ok response', function () {
    Patient::factory()->count(2)->create();
    $response = getJson('/api/v1/patients');
    $response->assertStatus(200)
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data', 2)
        );
});

it('get list of patients with not found response', function () {
    $response = getJson('/api/v1/fakepatients');
    $response->assertStatus(404);
});

it('get patient by id with ok response', function () {
    $patient = Patient::factory()->create();
    $response = getJson('/api/v1/fakepatients/' . $patient->id);
    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has(
                'data',
                fn ($json) => $json->where('id', $patient->id)
            ->where('name', $patient->name)
            ->where('diagnosis', $patient->diagnosis)
            ));
});

it('get patient by id with not found response', function () {
    $patient = Patient::factory()->create();
    $response = getJson('/api/v1/patients/' . $patient->id+100000);
    $response->assertStatus(404);
});

it('post patient with created response', function () {
    $patient = Patient::factory()->raw();
    $response = postJson('/api/v1/patients', $patient);
    $response->assertStatus(201)
    ->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->whereType('id', 'integer')
        ->where('name', $patient['name'])
        ->where('diagnosis', $patient['diagnosis'])
        ));
    $this->assertDatabaseHas('patients', $patient);
});

it('post patient with not found response', function () {
    $patient = Patient::factory()->raw();
    $response = postJson('/api/v1/fakepatients', $patient);
    $response->assertStatus(404);
});

it('post patient with bad unprocessable entity(seems like bad request) response', function () {
    $patient = Patient::factory()->raw();
    $patient['name'] = null;
    $response = postJson('/api/v1/patients', $patient);
    $response->assertStatus(422);
});

it('delete patient by id with ok response', function () {
    $patient = Patient::factory()->create();
    $response = deleteJson('/api/v1/patients/'. $patient->id);
    $response->assertStatus(200);
    $this->assertDatabaseMissing('patients', $patient->attributesToArray());
});

it('delete patient by id with not found response', function () {
    $patient = Patient::factory()->create();
    $response = deleteJson('/api/v1/fakepatients/'. $patient->id);
    $response->assertStatus(404);
});

it('put patient by id with ok response', function () {
    $patient = Patient::factory()->create();
    $putDoctor = Patient::factory()->raw();
    $response = putJson('/api/v1/patients/'. $patient->id, $putDoctor);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $patient->id)
            ->where('name', $putDoctor['name'])
            ->where('diagnosis', $putDoctor['diagnosis'])
        ));
    $this->assertDatabaseHas('patients', $putDoctor);
});

it('put patient by id with not found response', function () {
    $patient = Patient::factory()->create();
    $putDoctor = Patient::factory()->raw();
    $response = putJson('/api/v1/fakepatients/'. $patient->id, $putDoctor);
    $response->assertStatus(404);
});

it('put patient by id with bad request response', function () {
    $patient = Patient::factory()->create();
    $putDoctor = Patient::factory()->raw();
    $putDoctor['name'] = null;
    $response = putJson('/api/v1/patients/'. $patient->id, $putDoctor);
    $response->assertStatus(422);
});

it('patch patient by id with ok response', function () {
    $patient = Patient::factory()->create();
    $patchDoctor = Patient::factory()->raw();
    $response = patchJson('/api/v1/patient/'. $patient->id, $patchDoctor);
    $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has(
            'data',
            fn ($json) => $json->where('id', $patient->id)
            ->where('name', $patchDoctor['name'])
            ->where('diagnosis', $patchDoctor['diagnosis'])
        ));
    $this->assertDatabaseHas('patients', $patchDoctor);
});

it('patch patient by id with not found response', function () {
    $patient = Patient::factory()->create();
    $patchDoctor = Patient::factory()->raw();
    $response = putJson('/api/v1/fakepatients/'. $patient->id, $patchDoctor);
    $response->assertStatus(404);
});

it('patch patient by id with bad request response', function () {
    $patient = Patient::factory()->create();
    $patchDoctor = Patient::factory()->raw();
    $patchDoctor['name'] = null;
    $response = patchJson('/api/v1/patients/'. $patient->id, $patchDoctor);
    $response->assertStatus(422);
});
