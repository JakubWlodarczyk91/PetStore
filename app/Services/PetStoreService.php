<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PetStoreService
{
    /**
     * @param Response $response
     * @return array
     */
    private function returnResponse(Response $response): array
    {
        if (!$response->successful()) {
            $message = match ($response->status()) {
                400 => 'Invalid ID supplied',
                404 => 'Pet not found',
                405 => 'Invalid input',
                500 => 'Internal Server Error',
                default => 'Something went wrong',
            };

            return [
                'status' => $response->status(),
                'message' => $message
            ];
        }

        return $response->json();
    }

    /**
     * @param string $petId
     * @return array
     */
    public function get(string $petId): array
    {
        $response = Http::petStore()->get("pet/{$petId}");

        return $this->returnResponse($response);
    }

    /**
     * @param string $petId
     * @return array
     */
    public function delete(string $petId): array
    {
        $response = Http::petStore()->delete("pet/{$petId}");

        return $this->returnResponse($response);
    }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $response = Http::petStore()->post("pet", $data);

        return $this->returnResponse($response);
    }

    /**
     * @param string $petId
     * @param array $data
     * @return array
     */
    public function update(string $petId, array $data): array
    {
        $response = Http::petStore()->asForm()->post("pet/{$petId}", $data);

        return $this->returnResponse($response);
    }
}
