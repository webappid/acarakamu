<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\AdsEventRepositoryTest;

class AdsEventIntegrationTest extends SmartTestCase
{
    /**
     * @var AdsEventRepositoryTest
     */
    private $adsEventRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->adsEventRepositoryTest = app()->make(AdsEventRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $adsEventRepositoryRequest = app()->call([$this->adsEventRepositoryTest, 'getDummy']);

        $route = route('lazy.ads-event.store');

        $payload = (array)$adsEventRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AdsEvent Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $adsEventRepositoryRequest = app()->call([$this->adsEventRepositoryTest, 'getDummy']);

        $route = route('lazy.ads-event.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$adsEventRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AdsEvent Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.ads-event.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AdsEvent Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.ads-event.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AdsEvent Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.ads-event.list');

        $user = $this->secure();

        $this->sendToLog('AdsEvent Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
