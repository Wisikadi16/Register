<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AmbulanceLocationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('ambulance')->group(function () {
    // Public / Authenticated Read Access
    Route::get('/{id}/location', [AmbulanceLocationController::class, 'show']);

    // Secured Update Access (Only Driver / Authenticated User)
    Route::middleware('auth:sanctum')->post('/{id}/location', [AmbulanceLocationController::class, 'update']);
});

Route::get('/ambulances/locations', [AmbulanceLocationController::class, 'all']);
