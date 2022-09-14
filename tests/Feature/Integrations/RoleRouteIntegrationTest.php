<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\RoleRouteRepositoryTest;

class RoleRouteIntegrationTest extends SmartTestCase
{
    /**
     * @var RoleRouteRepositoryTest
     */
    private $roleRouteRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->roleRouteRepositoryTest = app()->make(RoleRouteRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $roleRouteRepositoryRequest = app()->call([$this->roleRouteRepositoryTest, 'getDummy']);

        $route = route('lazy.role-route.store');

        $payload = (array)$roleRouteRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('RoleRoute Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $roleRouteRepositoryRequest = app()->call([$this->roleRouteRepositoryTest, 'getDummy']);

        $route = route('lazy.role-route.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$roleRouteRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('RoleRoute Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.role-route.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('RoleRoute Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.role-route.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('RoleRoute Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.role-route.list');

        $user = $this->secure();

        $this->sendToLog('RoleRoute Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
