<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\AdsOrderDetailRepositoryTest;

class AdsOrderDetailIntegrationTest extends SmartTestCase
{
    /**
     * @var AdsOrderDetailRepositoryTest
     */
    private $adsOrderDetailRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->adsOrderDetailRepositoryTest = app()->make(AdsOrderDetailRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $adsOrderDetailRepositoryRequest = app()->call([$this->adsOrderDetailRepositoryTest, 'getDummy']);

        $route = route('lazy.ads-order-detail.store');

        $payload = (array)$adsOrderDetailRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AdsOrderDetail Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $adsOrderDetailRepositoryRequest = app()->call([$this->adsOrderDetailRepositoryTest, 'getDummy']);

        $route = route('lazy.ads-order-detail.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$adsOrderDetailRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AdsOrderDetail Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.ads-order-detail.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AdsOrderDetail Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.ads-order-detail.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AdsOrderDetail Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.ads-order-detail.list');

        $user = $this->secure();

        $this->sendToLog('AdsOrderDetail Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
