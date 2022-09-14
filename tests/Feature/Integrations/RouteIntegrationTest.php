<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\RouteRepositoryTest;

class RouteIntegrationTest extends SmartTestCase
{
    /**
     * @var RouteRepositoryTest
     */
    private $routeRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->routeRepositoryTest = app()->make(RouteRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $routeRepositoryRequest = app()->call([$this->routeRepositoryTest, 'getDummy']);

        $route = route('lazy.route.store');

        $payload = (array)$routeRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Route Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $routeRepositoryRequest = app()->call([$this->routeRepositoryTest, 'getDummy']);

        $route = route('lazy.route.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$routeRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Route Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.route.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Route Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.route.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Route Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.route.list');

        $user = $this->secure();

        $this->sendToLog('Route Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
