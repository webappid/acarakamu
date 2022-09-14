<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\FailedJobRepositoryTest;

class FailedJobIntegrationTest extends SmartTestCase
{
    /**
     * @var FailedJobRepositoryTest
     */
    private $failedJobRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->failedJobRepositoryTest = app()->make(FailedJobRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $failedJobRepositoryRequest = app()->call([$this->failedJobRepositoryTest, 'getDummy']);

        $route = route('lazy.failed-job.store');

        $payload = (array)$failedJobRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('FailedJob Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $failedJobRepositoryRequest = app()->call([$this->failedJobRepositoryTest, 'getDummy']);

        $route = route('lazy.failed-job.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$failedJobRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('FailedJob Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.failed-job.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('FailedJob Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.failed-job.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('FailedJob Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.failed-job.list');

        $user = $this->secure();

        $this->sendToLog('FailedJob Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
