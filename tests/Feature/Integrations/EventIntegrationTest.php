<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\EventRepositoryTest;

class EventIntegrationTest extends SmartTestCase
{
    /**
     * @var EventRepositoryTest
     */
    private $eventRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->eventRepositoryTest = app()->make(EventRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $eventRepositoryRequest = app()->call([$this->eventRepositoryTest, 'getDummy']);

        $route = route('lazy.event.store');

        $payload = (array)$eventRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Event Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $eventRepositoryRequest = app()->call([$this->eventRepositoryTest, 'getDummy']);

        $route = route('lazy.event.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$eventRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Event Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.event.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Event Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.event.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Event Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.event.list');

        $user = $this->secure();

        $this->sendToLog('Event Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
