<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SfMicroprocessRefProcessRepositoryTest;

class SfMicroprocessRefProcessIntegrationTest extends SmartTestCase
{
    /**
     * @var SfMicroprocessRefProcessRepositoryTest
     */
    private $sfMicroprocessRefProcessRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->sfMicroprocessRefProcessRepositoryTest = app()->make(SfMicroprocessRefProcessRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $sfMicroprocessRefProcessRepositoryRequest = app()->call([$this->sfMicroprocessRefProcessRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-microprocess-ref-process.store');

        $payload = (array)$sfMicroprocessRefProcessRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessRefProcess Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $sfMicroprocessRefProcessRepositoryRequest = app()->call([$this->sfMicroprocessRefProcessRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-microprocess-ref-process.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$sfMicroprocessRefProcessRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessRefProcess Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-microprocess-ref-process.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessRefProcess Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-microprocess-ref-process.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessRefProcess Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.sf-microprocess-ref-process.list');

        $user = $this->secure();

        $this->sendToLog('SfMicroprocessRefProcess Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
