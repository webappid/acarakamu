<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\ProvincesRefRepositoryTest;

class ProvincesRefIntegrationTest extends SmartTestCase
{
    /**
     * @var ProvincesRefRepositoryTest
     */
    private $provincesRefRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->provincesRefRepositoryTest = app()->make(ProvincesRefRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $provincesRefRepositoryRequest = app()->call([$this->provincesRefRepositoryTest, 'getDummy']);

        $route = route('lazy.provinces-ref.store');

        $payload = (array)$provincesRefRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('ProvincesRef Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $provincesRefRepositoryRequest = app()->call([$this->provincesRefRepositoryTest, 'getDummy']);

        $route = route('lazy.provinces-ref.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$provincesRefRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('ProvincesRef Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.provinces-ref.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('ProvincesRef Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.provinces-ref.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('ProvincesRef Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.provinces-ref.list');

        $user = $this->secure();

        $this->sendToLog('ProvincesRef Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
