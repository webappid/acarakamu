<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\OrderRepositoryTest;

class OrderIntegrationTest extends SmartTestCase
{
    /**
     * @var OrderRepositoryTest
     */
    private $orderRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->orderRepositoryTest = app()->make(OrderRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $orderRepositoryRequest = app()->call([$this->orderRepositoryTest, 'getDummy']);

        $route = route('lazy.order.store');

        $payload = (array)$orderRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Order Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $orderRepositoryRequest = app()->call([$this->orderRepositoryTest, 'getDummy']);

        $route = route('lazy.order.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$orderRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Order Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.order.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Order Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.order.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Order Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.order.list');

        $user = $this->secure();

        $this->sendToLog('Order Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
