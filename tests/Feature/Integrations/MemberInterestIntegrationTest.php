<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\MemberInterestRepositoryTest;

class MemberInterestIntegrationTest extends SmartTestCase
{
    /**
     * @var MemberInterestRepositoryTest
     */
    private $memberInterestRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->memberInterestRepositoryTest = app()->make(MemberInterestRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $memberInterestRepositoryRequest = app()->call([$this->memberInterestRepositoryTest, 'getDummy']);

        $route = route('lazy.member-interest.store');

        $payload = (array)$memberInterestRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('MemberInterest Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $memberInterestRepositoryRequest = app()->call([$this->memberInterestRepositoryTest, 'getDummy']);

        $route = route('lazy.member-interest.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$memberInterestRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('MemberInterest Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.member-interest.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('MemberInterest Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.member-interest.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('MemberInterest Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.member-interest.list');

        $user = $this->secure();

        $this->sendToLog('MemberInterest Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
