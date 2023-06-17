<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AuthenticationController;

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::apiResource('stores', StoreController::class)
                ->parameters(['stores' => 'store'])
                ->only(['index', 'show']);
                
Route::group(['middleware' => ['auth:sanctum']], function () {
Route::get('profile', function (Request $request) { 
return auth()->user(); 
});
                

Route::apiResource('flowers', FlowerController::class);
Route::get('stores/{id}/flowers', [FlowerController::class, 'indexStore']);
Route::delete('stores/{id}/flowers', [StoreController::class, 'destroyStore']);


Route::post('/logout', [AuthenticationController::class, 'logout']);
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com '], 404);
});
