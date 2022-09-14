<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\EventMemberLikeRepositoryTest;

class EventMemberLikeIntegrationTest extends SmartTestCase
{
    /**
     * @var EventMemberLikeRepositoryTest
     */
    private $eventMemberLikeRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->eventMemberLikeRepositoryTest = app()->make(EventMemberLikeRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $eventMemberLikeRepositoryRequest = app()->call([$this->eventMemberLikeRepositoryTest, 'getDummy']);

        $route = route('lazy.event-member-like.store');

        $payload = (array)$eventMemberLikeRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('EventMemberLike Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $eventMemberLikeRepositoryRequest = app()->call([$this->eventMemberLikeRepositoryTest, 'getDummy']);

        $route = route('lazy.event-member-like.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$eventMemberLikeRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('EventMemberLike Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.event-member-like.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('EventMemberLike Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.event-member-like.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('EventMemberLike Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.event-member-like.list');

        $user = $this->secure();

        $this->sendToLog('EventMemberLike Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
