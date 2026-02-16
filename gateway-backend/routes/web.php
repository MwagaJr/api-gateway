<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiGatewayController;
use App\Http\Controllers\CollectionController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/gateway', [ApiGatewayController::class, 'index'])->name('gateway.index');
// Route::post('/gateway/send', [ApiGatewayController::class, 'send'])->name('gateway.send');
// Route::post('/gateway/save', [ApiGatewayController::class, 'saveRequest'])->name('gateway.save');

Route::post('/collection/create', [CollectionController::class, 'create'])
    ->name('collection.create');

Route::post('/collections/save', [CollectionController::class, 'save']);
Route::get('/collections', [CollectionController::class, 'index']);

