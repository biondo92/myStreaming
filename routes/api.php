<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\LanguagesController;
use App\Http\Controllers\Api\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'api', 'prefix' => 'categories'], function ($router) {
    Route::get('/', [CategoriesController::class, 'index']);
    Route::get('/{id}', [CategoriesController::class, 'show']);
    Route::post('/add', [CategoriesController::class, 'store']);
    Route::put('/{id}', [CategoriesController::class, 'update']);
    Route::delete('/{id}', [CategoriesController::class, 'destroy']);   
});

Route::group(['middleware' => 'api', 'prefix' => 'languages'], function ($router) {
    Route::get('/', [LanguagesController::class, 'index']);
    Route::get('/{id}', [LanguagesController::class, 'show']);
    Route::post('/add', [LanguagesController::class, 'store']);
    Route::put('/{id}', [LanguagesController::class, 'update']);
    Route::delete('/{id}', [LanguagesController::class, 'destroy']);   
});

Route::group(['middleware' => 'api', 'prefix' => 'settings'], function ($router) {
    Route::get('/', [SettingsController::class, 'index']);
    Route::get('/{id}', [SettingsController::class, 'show']);
    Route::post('/add', [SettingsController::class, 'store']);
    Route::put('/{id}', [SettingsController::class, 'update']);
    Route::delete('/{id}', [SettingsController::class, 'destroy']);   
});