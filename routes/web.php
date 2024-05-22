<?php

use App\Http\Controllers\PetStoreController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('get/{petId}', [PetStoreController::class, 'get']);
    Route::post('create', [PetStoreController::class, 'create']);
    Route::post('update/{petId}', [PetStoreController::class, 'update']);
    Route::delete('delete/{petId}', [PetStoreController::class, 'delete']);
});
