<?php

namespace Tests\Feature\Integrations;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SmartTestCase;
use Tests\Unit\Repositories\SfMenuLanguageRepositoryTest;

class SfMenuLanguageIntegrationTest extends SmartTestCase
{
    /**
     * @var SfMenuLanguageRepositoryTest
     */
    private $sfMenuLanguageRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->sfMenuLanguageRepositoryTest = app()->make(SfMenuLanguageRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $sfMenuLanguageRepositoryRequest = app()->call([$this->sfMenuLanguageRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-menu-language.store');

        $payload = (array)$sfMenuLanguageRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMenuLanguage Store', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);

        return $jsonResponse;
    }

    public function testUpdate()
    {
        $result = $this->testStore();

        $sfMenuLanguageRepositoryRequest = app()->call([$this->sfMenuLanguageRepositoryTest, 'getDummy']);

        $route = route('lazy.sf-menu-language.update', [$result->data->UNI_COLUMN]);

        $payload = (array)$sfMenuLanguageRepositoryRequest;

        $user = $this->secure();

        $this->sendToLog('SfMenuLanguage Update', $route, $payload);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->post($route, $payload);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testGetByUNI_COLUMN_CAMEL()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-menu-language.detail', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMenuLanguage Detail', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }

    public function testDelete()
    {
        $result = $this->testStore();

        $route = route('lazy.sf-menu-language.delete', [$result->data->UNI_COLUMN]);

        $user = $this->secure();

        $this->sendToLog('SfMenuLanguage Delete', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(201, $jsonResponse->code);
    }

    public function testList()
    {
        $this->testStore();

        $route = route('lazy.sf-menu-language.list');

        $user = $this->secure();

        $this->sendToLog('SfMenuLanguage Index', $route, []);

        $response = $this->actingAs($user)->withHeaders(['Accept' => 'application/json'])->get($route);

        $this->resultLog($response->getContent());

        $jsonResponse = json_decode($response->getContent());

        self::assertEquals(200, $jsonResponse->code);
    }
}
