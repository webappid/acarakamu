<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\UserActivityRepositoryTest;

class UserActivityIntegrationTest extends SmartTestCase
{
    /**
     * @var UserActivityRepositoryTest
     */
    private $userActivityRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->userActivityRepositoryTest = app()->make(UserActivityRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $userActivityRepositoryRequest = app()->call([$this->userActivityRepositoryTest, 'getDummy']);

        $route = route('lazy.user-activity.store');

        $payload = (array)$userActivityRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('UserActivity Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $userActivityRepositoryRequest = app()->call([$this->userActivityRepositoryTest, 'getDummy']);

        $route = route('lazy.user-activity.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$userActivityRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('UserActivity Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.user-activity.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('UserActivity Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.user-activity.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('UserActivity Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.user-activity.list');

        $user = $this->secure();

        $this->sendToLog('UserActivity Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
