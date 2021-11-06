<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SfUserResetPasswordHistRepositoryTest;

class SfUserResetPasswordHistIntegrationTest extends SmartTestCase
{
    /**
     * @var SfUserResetPasswordHistRepositoryTest
     */
    private $sfUserResetPasswordHistRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->sfUserResetPasswordHistRepositoryTest = app()->make(SfUserResetPasswordHistRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $sfUserResetPasswordHistRepositoryRequest = app()->call([$this->sfUserResetPasswordHistRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-user-reset-password-hist.store');

        $payload = (array)$sfUserResetPasswordHistRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfUserResetPasswordHist Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $sfUserResetPasswordHistRepositoryRequest = app()->call([$this->sfUserResetPasswordHistRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-user-reset-password-hist.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$sfUserResetPasswordHistRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfUserResetPasswordHist Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-user-reset-password-hist.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfUserResetPasswordHist Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-user-reset-password-hist.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfUserResetPasswordHist Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.sf-user-reset-password-hist.list');

        $user = $this->secure();

        $this->sendToLog('SfUserResetPasswordHist Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
