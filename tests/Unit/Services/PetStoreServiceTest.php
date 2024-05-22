<?php

namespace Tests\Unit\Services;

use App\Services\PetStoreService;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PetStoreServiceTest extends TestCase
{
    protected PetStoreService $petStoreService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->petStoreService = new PetStoreService();
    }


    #[DataProvider('getProvider')]
    public function testGet($responseStatus, $responseBody, $expectedResult)
    {
        Http::fake(['pet/*' => Http::response($responseBody, $responseStatus)]);

        $result = $this->petStoreService->get('1');

        $this->assertEquals($expectedResult, $result);
    }

    public static function getProvider()
    {
        return [
            'successful get' => [200, ['id' => 1, 'name' => 'Fluffy'], ['id' => 1, 'name' => 'Fluffy']],
            'pet not found' => [404, null, ['status' => 404, 'message' => 'Pet not found']],
        ];
    }

    #[DataProvider('deleteProvider')]
    public function testDelete($responseStatus, $responseBody, $expectedResult)
    {
        Http::fake(['pet/*' => Http::response($responseBody, $responseStatus)]);

        $result = $this->petStoreService->delete('1');

        $this->assertEquals($expectedResult, $result);
    }

    public static function deleteProvider()
    {
        return [
            'successful delete' => [200, ['id' => 1, 'name' => 'Fluffy'], ['id' => 1, 'name' => 'Fluffy']],
            'server error' => [500, null, ['status' => 500, 'message' => 'Internal Server Error']],
        ];
    }

    #[DataProvider('createProvider')]
    public function testCreate($responseStatus, $responseBody, $expectedResult)
    {
        Http::fake(['pet' => Http::response($responseBody, $responseStatus)]);

        $result = $this->petStoreService->create(['name' => 'Fluffy']);

        $this->assertEquals($expectedResult, $result);
    }

    public static function createProvider()
    {
        return [
            'successful create' => [200, ['id' => 1, 'name' => 'Fluffy'], ['id' => 1, 'name' => 'Fluffy']],
            'invalid input' => [405, null, ['status' => 405, 'message' => 'Invalid input']],
        ];
    }

    #[DataProvider('updateProvider')]
    public function testUpdate($responseStatus, $responseBody, $expectedResult)
    {
        Http::fake(['pet/*' => Http::response($responseBody, $responseStatus)]);

        $result = $this->petStoreService->update('1', ['name' => 'Fluffy']);

        $this->assertEquals($expectedResult, $result);
    }

    public static function updateProvider()
    {
        return [
            'successful update' => [200, ['id' => 1, 'name' => 'Fluffy'], ['id' => 1, 'name' => 'Fluffy']],
            'default error' => [418, null, ['status' => 418, 'message' => 'Something went wrong']],
        ];
    }
}
