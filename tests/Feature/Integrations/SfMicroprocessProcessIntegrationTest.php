<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SfMicroprocessProcessRepositoryTest;

class SfMicroprocessProcessIntegrationTest extends SmartTestCase
{
    /**
     * @var SfMicroprocessProcessRepositoryTest
     */
    private $sfMicroprocessProcessRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->sfMicroprocessProcessRepositoryTest = app()->make(SfMicroprocessProcessRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $sfMicroprocessProcessRepositoryRequest = app()->call([$this->sfMicroprocessProcessRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-microprocess-process.store');

        $payload = (array)$sfMicroprocessProcessRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessProcess Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $sfMicroprocessProcessRepositoryRequest = app()->call([$this->sfMicroprocessProcessRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-microprocess-process.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$sfMicroprocessProcessRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessProcess Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-microprocess-process.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessProcess Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-microprocess-process.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessProcess Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.sf-microprocess-process.list');

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessProcess Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
