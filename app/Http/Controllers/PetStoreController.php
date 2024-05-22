<?php

namespace App\Http\Controllers;

use App\Services\PetStoreService;
use Illuminate\Http\Request;

class PetStoreController extends Controller
{
    /**
     * @param PetStoreService $petStoreService
     */
    public function __construct(private PetStoreService $petStoreService)
    {
    }

    /**
     * @param string $petId
     * @return array
     */
    public function get(string $petId)
    {
        return $this->petStoreService->get($petId);
    }

    /**
     * @param string $petId
     * @return array
     */
    public function delete(string $petId)
    {
        return $this->petStoreService->delete($petId);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        return $this->petStoreService->create($request->json()->all());
    }

    /**
     * @param string $petId
     * @param Request $request
     * @return array
     */
    public function update(string $petId, Request $request)
    {
        return $this->petStoreService->update($petId, $request->json()->all());
    }
}
