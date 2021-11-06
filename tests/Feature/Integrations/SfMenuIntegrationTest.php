<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SfMenuRepositoryTest;

class SfMenuIntegrationTest extends SmartTestCase
{
    /**
     * @var SfMenuRepositoryTest
     */
    private $sfMenuRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->sfMenuRepositoryTest = app()->make(SfMenuRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $sfMenuRepositoryRequest = app()->call([$this->sfMenuRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-menu.store');

        $payload = (array)$sfMenuRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMenu Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $sfMenuRepositoryRequest = app()->call([$this->sfMenuRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-menu.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$sfMenuRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMenu Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-menu.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMenu Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-menu.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMenu Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.sf-menu.list');

        $user = $this->secure();

        $this->sendToLog('SfMenu Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
