<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\AppMenuCategoryMenuRepositoryTest;

class AppMenuCategoryMenuIntegrationTest extends SmartTestCase
{
    /**
     * @var AppMenuCategoryMenuRepositoryTest
     */
    private $appMenuCategoryMenuRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->appMenuCategoryMenuRepositoryTest = app()->make(AppMenuCategoryMenuRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $appMenuCategoryMenuRepositoryRequest = app()->call([$this->appMenuCategoryMenuRepositoryTest, 'getDummy']);

        $route = route('lazy.app-menu-category-menu.store');

        $payload = (array)$appMenuCategoryMenuRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppMenuCategoryMenu Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $appMenuCategoryMenuRepositoryRequest = app()->call([$this->appMenuCategoryMenuRepositoryTest, 'getDummy']);

        $route = route('lazy.app-menu-category-menu.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$appMenuCategoryMenuRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppMenuCategoryMenu Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.app-menu-category-menu.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppMenuCategoryMenu Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.app-menu-category-menu.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppMenuCategoryMenu Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.app-menu-category-menu.list');

        $user = $this->secure();

        $this->sendToLog('AppMenuCategoryMenu Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
