<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\AppRoleMenuRepositoryTest;

class AppRoleMenuIntegrationTest extends SmartTestCase
{
    /**
     * @var AppRoleMenuRepositoryTest
     */
    private $appRoleMenuRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->appRoleMenuRepositoryTest = app()->make(AppRoleMenuRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $appRoleMenuRepositoryRequest = app()->call([$this->appRoleMenuRepositoryTest, 'getDummy']);

        $route = route('lazy.app-role-menu.store');

        $payload = (array)$appRoleMenuRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppRoleMenu Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $appRoleMenuRepositoryRequest = app()->call([$this->appRoleMenuRepositoryTest, 'getDummy']);

        $route = route('lazy.app-role-menu.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$appRoleMenuRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppRoleMenu Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.app-role-menu.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppRoleMenu Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.app-role-menu.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppRoleMenu Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.app-role-menu.list');

        $user = $this->secure();

        $this->sendToLog('AppRoleMenu Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
