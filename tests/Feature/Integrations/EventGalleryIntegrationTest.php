<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\EventGalleryRepositoryTest;

class EventGalleryIntegrationTest extends SmartTestCase
{
    /**
     * @var EventGalleryRepositoryTest
     */
    private $eventGalleryRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->eventGalleryRepositoryTest = app()->make(EventGalleryRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $eventGalleryRepositoryRequest = app()->call([$this->eventGalleryRepositoryTest, 'getDummy']);

        $route = route('lazy.event-gallery.store');

        $payload = (array)$eventGalleryRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('EventGallery Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $eventGalleryRepositoryRequest = app()->call([$this->eventGalleryRepositoryTest, 'getDummy']);

        $route = route('lazy.event-gallery.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$eventGalleryRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('EventGallery Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.event-gallery.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('EventGallery Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.event-gallery.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('EventGallery Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.event-gallery.list');

        $user = $this->secure();

        $this->sendToLog('EventGallery Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
