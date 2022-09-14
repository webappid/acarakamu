<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\RolePermissionRepositoryTest;

class RolePermissionIntegrationTest extends SmartTestCase
{
    /**
     * @var RolePermissionRepositoryTest
     */
    private $rolePermissionRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->rolePermissionRepositoryTest = app()->make(RolePermissionRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $rolePermissionRepositoryRequest = app()->call([$this->rolePermissionRepositoryTest, 'getDummy']);

        $route = route('lazy.role-permission.store');

        $payload = (array)$rolePermissionRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('RolePermission Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $rolePermissionRepositoryRequest = app()->call([$this->rolePermissionRepositoryTest, 'getDummy']);

        $route = route('lazy.role-permission.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$rolePermissionRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('RolePermission Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.role-permission.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('RolePermission Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.role-permission.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('RolePermission Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.role-permission.list');

        $user = $this->secure();

        $this->sendToLog('RolePermission Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
