<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\FontIconTypeRepositoryTest;

class FontIconTypeIntegrationTest extends SmartTestCase
{
    /**
     * @var FontIconTypeRepositoryTest
     */
    private $fontIconTypeRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->fontIconTypeRepositoryTest = app()->make(FontIconTypeRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $fontIconTypeRepositoryRequest = app()->call([$this->fontIconTypeRepositoryTest, 'getDummy']);

        $route = route('lazy.font-icon-type.store');

        $payload = (array)$fontIconTypeRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('FontIconType Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $fontIconTypeRepositoryRequest = app()->call([$this->fontIconTypeRepositoryTest, 'getDummy']);

        $route = route('lazy.font-icon-type.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$fontIconTypeRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('FontIconType Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.font-icon-type.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('FontIconType Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.font-icon-type.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('FontIconType Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.font-icon-type.list');

        $user = $this->secure();

        $this->sendToLog('FontIconType Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
