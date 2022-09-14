<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\MigrationRepositoryTest;

class MigrationIntegrationTest extends SmartTestCase
{
    /**
     * @var MigrationRepositoryTest
     */
    private $migrationRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->migrationRepositoryTest = app()->make(MigrationRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $migrationRepositoryRequest = app()->call([$this->migrationRepositoryTest, 'getDummy']);

        $route = route('lazy.migration.store');

        $payload = (array)$migrationRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Migration Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $migrationRepositoryRequest = app()->call([$this->migrationRepositoryTest, 'getDummy']);

        $route = route('lazy.migration.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$migrationRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Migration Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.migration.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Migration Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.migration.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Migration Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.migration.list');

        $user = $this->secure();

        $this->sendToLog('Migration Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
