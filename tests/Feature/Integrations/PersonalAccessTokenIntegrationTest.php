<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\PersonalAccessTokenRepositoryTest;

class PersonalAccessTokenIntegrationTest extends SmartTestCase
{
    /**
     * @var PersonalAccessTokenRepositoryTest
     */
    private $personalAccessTokenRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->personalAccessTokenRepositoryTest = app()->make(PersonalAccessTokenRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $personalAccessTokenRepositoryRequest = app()->call([$this->personalAccessTokenRepositoryTest, 'getDummy']);

        $route = route('lazy.personal-access-token.store');

        $payload = (array)$personalAccessTokenRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('PersonalAccessToken Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $personalAccessTokenRepositoryRequest = app()->call([$this->personalAccessTokenRepositoryTest, 'getDummy']);

        $route = route('lazy.personal-access-token.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$personalAccessTokenRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('PersonalAccessToken Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.personal-access-token.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('PersonalAccessToken Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.personal-access-token.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('PersonalAccessToken Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.personal-access-token.list');

        $user = $this->secure();

        $this->sendToLog('PersonalAccessToken Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
