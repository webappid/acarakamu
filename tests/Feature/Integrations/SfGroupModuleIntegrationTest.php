<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SfGroupModuleRepositoryTest;

class SfGroupModuleIntegrationTest extends SmartTestCase
{
    /**
     * @var SfGroupModuleRepositoryTest
     */
    private $sfGroupModuleRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->sfGroupModuleRepositoryTest = app()->make(SfGroupModuleRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $sfGroupModuleRepositoryRequest = app()->call([$this->sfGroupModuleRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-group-module.store');

        $payload = (array)$sfGroupModuleRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfGroupModule Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $sfGroupModuleRepositoryRequest = app()->call([$this->sfGroupModuleRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-group-module.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$sfGroupModuleRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfGroupModule Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-group-module.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfGroupModule Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-group-module.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfGroupModule Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.sf-group-module.list');

        $user = $this->secure();

        $this->sendToLog('SfGroupModule Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
