<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\AppSettingRepositoryTest;

class AppSettingIntegrationTest extends SmartTestCase
{
    /**
     * @var AppSettingRepositoryTest
     */
    private $appSettingRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->appSettingRepositoryTest = app()->make(AppSettingRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $appSettingRepositoryRequest = app()->call([$this->appSettingRepositoryTest, 'getDummy']);

        $route = route('lazy.app-setting.store');

        $payload = (array)$appSettingRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppSetting Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $appSettingRepositoryRequest = app()->call([$this->appSettingRepositoryTest, 'getDummy']);

        $route = route('lazy.app-setting.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$appSettingRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('AppSetting Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.app-setting.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppSetting Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.app-setting.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('AppSetting Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.app-setting.list');

        $user = $this->secure();

        $this->sendToLog('AppSetting Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
