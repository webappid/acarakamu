<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\CityRefRepositoryTest;

class CityRefIntegrationTest extends SmartTestCase
{
    /**
     * @var CityRefRepositoryTest
     */
    private $cityRefRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->cityRefRepositoryTest = app()->make(CityRefRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $cityRefRepositoryRequest = app()->call([$this->cityRefRepositoryTest, 'getDummy']);

        $route = route('lazy.city-ref.store');

        $payload = (array)$cityRefRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('CityRef Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $cityRefRepositoryRequest = app()->call([$this->cityRefRepositoryTest, 'getDummy']);

        $route = route('lazy.city-ref.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$cityRefRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('CityRef Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.city-ref.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('CityRef Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.city-ref.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('CityRef Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.city-ref.list');

        $user = $this->secure();

        $this->sendToLog('CityRef Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
