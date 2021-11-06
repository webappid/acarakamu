<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\FontIconRepositoryTest;

class FontIconIntegrationTest extends SmartTestCase
{
    /**
     * @var FontIconRepositoryTest
     */
    private $fontIconRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->fontIconRepositoryTest = app()->make(FontIconRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $fontIconRepositoryRequest = app()->call([$this->fontIconRepositoryTest, 'getDummy']);

        $route = route('lazy.font-icon.store');

        $payload = (array)$fontIconRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('FontIcon Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $fontIconRepositoryRequest = app()->call([$this->fontIconRepositoryTest, 'getDummy']);

        $route = route('lazy.font-icon.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$fontIconRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('FontIcon Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.font-icon.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('FontIcon Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.font-icon.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('FontIcon Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.font-icon.list');

        $user = $this->secure();

        $this->sendToLog('FontIcon Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
