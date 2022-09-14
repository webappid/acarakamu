<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\ImageRepositoryTest;

class ImageIntegrationTest extends SmartTestCase
{
    /**
     * @var ImageRepositoryTest
     */
    private $imageRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->imageRepositoryTest = app()->make(ImageRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $imageRepositoryRequest = app()->call([$this->imageRepositoryTest, 'getDummy']);

        $route = route('lazy.image.store');

        $payload = (array)$imageRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Image Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $imageRepositoryRequest = app()->call([$this->imageRepositoryTest, 'getDummy']);

        $route = route('lazy.image.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$imageRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Image Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.image.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Image Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.image.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Image Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.image.list');

        $user = $this->secure();

        $this->sendToLog('Image Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
