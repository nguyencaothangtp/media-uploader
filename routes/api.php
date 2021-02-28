<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::get('providers', [ProviderController::class, 'list']);
    Route::get('media', [MediaController::class, 'list']);

    Route::post('upload/image', [UploadController::class, 'image']);
    Route::post('upload/video', [UploadController::class, 'video']);
});
