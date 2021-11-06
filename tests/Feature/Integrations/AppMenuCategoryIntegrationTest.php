<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\AppMenuCategoryRepositoryTest;

class AppMenuCategoryIntegrationTest extends SmartTestCase
{
    /**
     * @var AppMenuCategoryRepositoryTest
     */
    private $appMenuCategoryRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->appMenuCategoryRepositoryTest = app()->make(AppMenuCategoryRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $appMenuCategoryRepositoryRequest = app()->call([$this->appMenuCategoryRepositoryTest, 'getDummy']);

        $route = route('lazy.app-menu-category.store');

        $payload = (array)$appMenuCategoryRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppMenuCategory Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $appMenuCategoryRepositoryRequest = app()->call([$this->appMenuCategoryRepositoryTest, 'getDummy']);

        $route = route('lazy.app-menu-category.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$appMenuCategoryRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppMenuCategory Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.app-menu-category.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppMenuCategory Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.app-menu-category.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppMenuCategory Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.app-menu-category.list');

        $user = $this->secure();

        $this->sendToLog('AppMenuCategory Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
