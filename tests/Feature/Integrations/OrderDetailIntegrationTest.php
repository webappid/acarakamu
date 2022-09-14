<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\OrderDetailRepositoryTest;

class OrderDetailIntegrationTest extends SmartTestCase
{
    /**
     * @var OrderDetailRepositoryTest
     */
    private $orderDetailRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->orderDetailRepositoryTest = app()->make(OrderDetailRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $orderDetailRepositoryRequest = app()->call([$this->orderDetailRepositoryTest, 'getDummy']);

        $route = route('lazy.order-detail.store');

        $payload = (array)$orderDetailRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('OrderDetail Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $orderDetailRepositoryRequest = app()->call([$this->orderDetailRepositoryTest, 'getDummy']);

        $route = route('lazy.order-detail.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$orderDetailRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('OrderDetail Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.order-detail.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('OrderDetail Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.order-detail.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('OrderDetail Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.order-detail.list');

        $user = $this->secure();

        $this->sendToLog('OrderDetail Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
