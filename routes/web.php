<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return redirect()->route('activities.index');
});

Route::resource('activities', ActivityController::class);

Route::resource('categories', CategoryController::class);
