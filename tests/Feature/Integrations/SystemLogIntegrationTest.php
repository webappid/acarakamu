<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SystemLogRepositoryTest;

class SystemLogIntegrationTest extends SmartTestCase
{
    /**
     * @var SystemLogRepositoryTest
     */
    private $systemLogRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->systemLogRepositoryTest = app()->make(SystemLogRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $systemLogRepositoryRequest = app()->call([$this->systemLogRepositoryTest, 'getDummy']);

        $route = route('lazy.system-log.store');

        $payload = (array)$systemLogRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SystemLog Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $systemLogRepositoryRequest = app()->call([$this->systemLogRepositoryTest, 'getDummy']);

        $route = route('lazy.system-log.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$systemLogRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SystemLog Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.system-log.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SystemLog Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.system-log.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SystemLog Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.system-log.list');

        $user = $this->secure();

        $this->sendToLog('SystemLog Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
