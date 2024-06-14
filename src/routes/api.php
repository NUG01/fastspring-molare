<?php

use App\Http\Controllers\FastSpringController;
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




Route::group(['controller' => FastSpringController::class], function () {
  Route::group(['prefix' => 'fastspring'], function () {
    Route::post('/account-created/webhook', 'accountCreatedWebhook')->name('fastspring.webhook.account-created');
  });
});
