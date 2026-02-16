<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiGatewayController;
use App\Http\Controllers\SampleApiController;



Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working'
    ]);
});

Route::post('/gateway/send', [ApiGatewayController::class, 'send'])->name('gateway.send');
Route::post('/gateway/save', [ApiGatewayController::class, 'saveRequest'])->name('gateway.save');

Route::prefix('sample')->group(function () {
    Route::get('/ping', [SampleApiController::class, 'ping']);
    Route::post('/echo', [SampleApiController::class, 'echo']);
    Route::get('/secure', [SampleApiController::class, 'secure']);
    Route::get('/error', [SampleApiController::class, 'error']);
});
