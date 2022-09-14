<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\EventStatusRefRepositoryTest;

class EventStatusRefIntegrationTest extends SmartTestCase
{
    /**
     * @var EventStatusRefRepositoryTest
     */
    private $eventStatusRefRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->eventStatusRefRepositoryTest = app()->make(EventStatusRefRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $eventStatusRefRepositoryRequest = app()->call([$this->eventStatusRefRepositoryTest, 'getDummy']);

        $route = route('lazy.event-status-ref.store');

        $payload = (array)$eventStatusRefRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('EventStatusRef Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $eventStatusRefRepositoryRequest = app()->call([$this->eventStatusRefRepositoryTest, 'getDummy']);

        $route = route('lazy.event-status-ref.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$eventStatusRefRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('EventStatusRef Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.event-status-ref.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('EventStatusRef Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.event-status-ref.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('EventStatusRef Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.event-status-ref.list');

        $user = $this->secure();

        $this->sendToLog('EventStatusRef Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
