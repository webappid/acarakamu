<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\OrderStatusRepositoryTest;

class OrderStatusIntegrationTest extends SmartTestCase
{
    /**
     * @var OrderStatusRepositoryTest
     */
    private $orderStatusRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->orderStatusRepositoryTest = app()->make(OrderStatusRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $orderStatusRepositoryRequest = app()->call([$this->orderStatusRepositoryTest, 'getDummy']);

        $route = route('lazy.order-status.store');

        $payload = (array)$orderStatusRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('OrderStatus Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $orderStatusRepositoryRequest = app()->call([$this->orderStatusRepositoryTest, 'getDummy']);

        $route = route('lazy.order-status.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$orderStatusRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('OrderStatus Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.order-status.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('OrderStatus Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.order-status.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('OrderStatus Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.order-status.list');

        $user = $this->secure();

        $this->sendToLog('OrderStatus Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
