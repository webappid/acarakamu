<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\OrderHistoryStatusRepositoryTest;

class OrderHistoryStatusIntegrationTest extends SmartTestCase
{
    /**
     * @var OrderHistoryStatusRepositoryTest
     */
    private $orderHistoryStatusRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->orderHistoryStatusRepositoryTest = app()->make(OrderHistoryStatusRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $orderHistoryStatusRepositoryRequest = app()->call([$this->orderHistoryStatusRepositoryTest, 'getDummy']);

        $route = route('lazy.order-history-status.store');

        $payload = (array)$orderHistoryStatusRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('OrderHistoryStatus Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $orderHistoryStatusRepositoryRequest = app()->call([$this->orderHistoryStatusRepositoryTest, 'getDummy']);

        $route = route('lazy.order-history-status.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$orderHistoryStatusRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('OrderHistoryStatus Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.order-history-status.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('OrderHistoryStatus Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.order-history-status.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('OrderHistoryStatus Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.order-history-status.list');

        $user = $this->secure();

        $this->sendToLog('OrderHistoryStatus Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
