<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\AppMenuRouteRepositoryTest;

class AppMenuRouteIntegrationTest extends SmartTestCase
{
    /**
     * @var AppMenuRouteRepositoryTest
     */
    private $appMenuRouteRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->appMenuRouteRepositoryTest = app()->make(AppMenuRouteRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $appMenuRouteRepositoryRequest = app()->call([$this->appMenuRouteRepositoryTest, 'getDummy']);

        $route = route('lazy.app-menu-route.store');

        $payload = (array)$appMenuRouteRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppMenuRoute Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $appMenuRouteRepositoryRequest = app()->call([$this->appMenuRouteRepositoryTest, 'getDummy']);

        $route = route('lazy.app-menu-route.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$appMenuRouteRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppMenuRoute Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.app-menu-route.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppMenuRoute Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.app-menu-route.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppMenuRoute Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.app-menu-route.list');

        $user = $this->secure();

        $this->sendToLog('AppMenuRoute Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
