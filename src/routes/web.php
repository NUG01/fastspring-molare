<?php

use NUG01\Molare\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use NUG01\Molare\Http\Controllers\SubscriptionController\index;

Route::get('molare', SubscriptionController::class . '@index');
