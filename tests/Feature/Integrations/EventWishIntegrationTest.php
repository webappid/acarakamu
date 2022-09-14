<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\EventWishRepositoryTest;

class EventWishIntegrationTest extends SmartTestCase
{
    /**
     * @var EventWishRepositoryTest
     */
    private $eventWishRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->eventWishRepositoryTest = app()->make(EventWishRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $eventWishRepositoryRequest = app()->call([$this->eventWishRepositoryTest, 'getDummy']);

        $route = route('lazy.event-wish.store');

        $payload = (array)$eventWishRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('EventWish Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $eventWishRepositoryRequest = app()->call([$this->eventWishRepositoryTest, 'getDummy']);

        $route = route('lazy.event-wish.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$eventWishRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('EventWish Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.event-wish.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('EventWish Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.event-wish.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('EventWish Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.event-wish.list');

        $user = $this->secure();

        $this->sendToLog('EventWish Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
