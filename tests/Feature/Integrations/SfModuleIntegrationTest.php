<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SfModuleRepositoryTest;

class SfModuleIntegrationTest extends SmartTestCase
{
    /**
     * @var SfModuleRepositoryTest
     */
    private $sfModuleRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->sfModuleRepositoryTest = app()->make(SfModuleRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $sfModuleRepositoryRequest = app()->call([$this->sfModuleRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-module.store');

        $payload = (array)$sfModuleRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfModule Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $sfModuleRepositoryRequest = app()->call([$this->sfModuleRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-module.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$sfModuleRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfModule Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-module.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfModule Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-module.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfModule Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.sf-module.list');

        $user = $this->secure();

        $this->sendToLog('SfModule Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
