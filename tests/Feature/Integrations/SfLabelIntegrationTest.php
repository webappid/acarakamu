<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SfLabelRepositoryTest;

class SfLabelIntegrationTest extends SmartTestCase
{
    /**
     * @var SfLabelRepositoryTest
     */
    private $sfLabelRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->sfLabelRepositoryTest = app()->make(SfLabelRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $sfLabelRepositoryRequest = app()->call([$this->sfLabelRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-label.store');

        $payload = (array)$sfLabelRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfLabel Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $sfLabelRepositoryRequest = app()->call([$this->sfLabelRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-label.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$sfLabelRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfLabel Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-label.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfLabel Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-label.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfLabel Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.sf-label.list');

        $user = $this->secure();

        $this->sendToLog('SfLabel Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
