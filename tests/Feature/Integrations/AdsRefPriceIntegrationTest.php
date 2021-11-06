<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\AdsRefPriceRepositoryTest;

class AdsRefPriceIntegrationTest extends SmartTestCase
{
    /**
     * @var AdsRefPriceRepositoryTest
     */
    private $adsRefPriceRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->adsRefPriceRepositoryTest = app()->make(AdsRefPriceRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $adsRefPriceRepositoryRequest = app()->call([$this->adsRefPriceRepositoryTest, 'getDummy']);

        $route = route('lazy.ads-ref-price.store');

        $payload = (array)$adsRefPriceRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AdsRefPrice Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $adsRefPriceRepositoryRequest = app()->call([$this->adsRefPriceRepositoryTest, 'getDummy']);

        $route = route('lazy.ads-ref-price.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$adsRefPriceRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AdsRefPrice Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.ads-ref-price.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AdsRefPrice Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.ads-ref-price.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AdsRefPrice Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.ads-ref-price.list');

        $user = $this->secure();

        $this->sendToLog('AdsRefPrice Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
