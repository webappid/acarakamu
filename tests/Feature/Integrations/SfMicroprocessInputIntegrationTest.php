<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SfMicroprocessInputRepositoryTest;

class SfMicroprocessInputIntegrationTest extends SmartTestCase
{
    /**
     * @var SfMicroprocessInputRepositoryTest
     */
    private $sfMicroprocessInputRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->sfMicroprocessInputRepositoryTest = app()->make(SfMicroprocessInputRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $sfMicroprocessInputRepositoryRequest = app()->call([$this->sfMicroprocessInputRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-microprocess-input.store');

        $payload = (array)$sfMicroprocessInputRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessInput Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $sfMicroprocessInputRepositoryRequest = app()->call([$this->sfMicroprocessInputRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-microprocess-input.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$sfMicroprocessInputRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessInput Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-microprocess-input.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessInput Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-microprocess-input.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessInput Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.sf-microprocess-input.list');

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessInput Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
