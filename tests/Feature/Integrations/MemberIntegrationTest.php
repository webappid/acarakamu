<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\MemberRepositoryTest;

class MemberIntegrationTest extends SmartTestCase
{
    /**
     * @var MemberRepositoryTest
     */
    private $memberRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->memberRepositoryTest = app()->make(MemberRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $memberRepositoryRequest = app()->call([$this->memberRepositoryTest, 'getDummy']);

        $route = route('lazy.member.store');

        $payload = (array)$memberRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Member Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $memberRepositoryRequest = app()->call([$this->memberRepositoryTest, 'getDummy']);

        $route = route('lazy.member.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$memberRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('Member Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.member.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Member Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.member.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('Member Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.member.list');

        $user = $this->secure();

        $this->sendToLog('Member Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
