<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\EventHistoryRepositoryTest;

class EventHistoryIntegrationTest extends SmartTestCase
{
    /**
     * @var EventHistoryRepositoryTest
     */
    private $eventHistoryRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->eventHistoryRepositoryTest = app()->make(EventHistoryRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $eventHistoryRepositoryRequest = app()->call([$this->eventHistoryRepositoryTest, 'getDummy']);

        $route = route('lazy.event-history.store');

        $payload = (array)$eventHistoryRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('EventHistory Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $eventHistoryRepositoryRequest = app()->call([$this->eventHistoryRepositoryTest, 'getDummy']);

        $route = route('lazy.event-history.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$eventHistoryRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('EventHistory Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.event-history.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('EventHistory Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.event-history.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('EventHistory Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.event-history.list');

        $user = $this->secure();

        $this->sendToLog('EventHistory Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
