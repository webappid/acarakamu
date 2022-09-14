<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\CategoryRefRepositoryTest;

class CategoryRefIntegrationTest extends SmartTestCase
{
    /**
     * @var CategoryRefRepositoryTest
     */
    private $categoryRefRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->categoryRefRepositoryTest = app()->make(CategoryRefRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $categoryRefRepositoryRequest = app()->call([$this->categoryRefRepositoryTest, 'getDummy']);

        $route = route('lazy.category-ref.store');

        $payload = (array)$categoryRefRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('CategoryRef Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $categoryRefRepositoryRequest = app()->call([$this->categoryRefRepositoryTest, 'getDummy']);

        $route = route('lazy.category-ref.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$categoryRefRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('CategoryRef Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.category-ref.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('CategoryRef Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.category-ref.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('CategoryRef Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.category-ref.list');

        $user = $this->secure();

        $this->sendToLog('CategoryRef Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
