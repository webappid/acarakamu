<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\PermissionRepositoryTest;

class PermissionIntegrationTest extends SmartTestCase
{
    /**
     * @var PermissionRepositoryTest
     */
    private $permissionRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->permissionRepositoryTest = app()->make(PermissionRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $permissionRepositoryRequest = app()->call([$this->permissionRepositoryTest, 'getDummy']);

        $route = route('lazy.permission.store');

        $payload = (array)$permissionRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Permission Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $permissionRepositoryRequest = app()->call([$this->permissionRepositoryTest, 'getDummy']);

        $route = route('lazy.permission.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$permissionRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Permission Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.permission.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Permission Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.permission.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Permission Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.permission.list');

        $user = $this->secure();

        $this->sendToLog('Permission Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
