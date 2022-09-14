<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\AdsOrderRepositoryTest;

class AdsOrderIntegrationTest extends SmartTestCase
{
    /**
     * @var AdsOrderRepositoryTest
     */
    private $adsOrderRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->adsOrderRepositoryTest = app()->make(AdsOrderRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $adsOrderRepositoryRequest = app()->call([$this->adsOrderRepositoryTest, 'getDummy']);

        $route = route('lazy.ads-order.store');

        $payload = (array)$adsOrderRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AdsOrder Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $adsOrderRepositoryRequest = app()->call([$this->adsOrderRepositoryTest, 'getDummy']);

        $route = route('lazy.ads-order.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$adsOrderRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AdsOrder Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.ads-order.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AdsOrder Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.ads-order.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AdsOrder Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.ads-order.list');

        $user = $this->secure();

        $this->sendToLog('AdsOrder Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
