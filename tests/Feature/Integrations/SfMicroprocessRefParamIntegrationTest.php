<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SfMicroprocessRefParamRepositoryTest;

class SfMicroprocessRefParamIntegrationTest extends SmartTestCase
{
    /**
     * @var SfMicroprocessRefParamRepositoryTest
     */
    private $sfMicroprocessRefParamRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->sfMicroprocessRefParamRepositoryTest = app()->make(SfMicroprocessRefParamRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $sfMicroprocessRefParamRepositoryRequest = app()->call([$this->sfMicroprocessRefParamRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-microprocess-ref-param.store');

        $payload = (array)$sfMicroprocessRefParamRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessRefParam Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $sfMicroprocessRefParamRepositoryRequest = app()->call([$this->sfMicroprocessRefParamRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-microprocess-ref-param.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$sfMicroprocessRefParamRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessRefParam Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-microprocess-ref-param.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessRefParam Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-microprocess-ref-param.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessRefParam Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.sf-microprocess-ref-param.list');

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessRefParam Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
