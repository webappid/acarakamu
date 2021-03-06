<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\AppMenuRepositoryTest;

class AppMenuIntegrationTest extends SmartTestCase
{
    /**
     * @var AppMenuRepositoryTest
     */
    private $appMenuRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->appMenuRepositoryTest = app()->make(AppMenuRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $appMenuRepositoryRequest = app()->call([$this->appMenuRepositoryTest, 'getDummy']);

        $route = route('lazy.app-menu.store');

        $payload = (array)$appMenuRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppMenu Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $appMenuRepositoryRequest = app()->call([$this->appMenuRepositoryTest, 'getDummy']);

        $route = route('lazy.app-menu.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$appMenuRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppMenu Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.app-menu.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppMenu Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.app-menu.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppMenu Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.app-menu.list');

        $user = $this->secure();

        $this->sendToLog('AppMenu Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
