<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SecurityLevelRepositoryTest;

class SecurityLevelIntegrationTest extends SmartTestCase
{
    /**
     * @var SecurityLevelRepositoryTest
     */
    private $securityLevelRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->securityLevelRepositoryTest = app()->make(SecurityLevelRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $securityLevelRepositoryRequest = app()->call([$this->securityLevelRepositoryTest, 'getDummy']);

        $route = route('lazy.security-level.store');

        $payload = (array)$securityLevelRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SecurityLevel Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $securityLevelRepositoryRequest = app()->call([$this->securityLevelRepositoryTest, 'getDummy']);

        $route = route('lazy.security-level.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$securityLevelRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SecurityLevel Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.security-level.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SecurityLevel Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.security-level.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SecurityLevel Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.security-level.list');

        $user = $this->secure();

        $this->sendToLog('SecurityLevel Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
