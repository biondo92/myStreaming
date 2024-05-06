<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\FilmsController;
use App\Http\Controllers\Api\LanguagesController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\RolesController;
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

Route::group(['middleware' => 'api', 'prefix' => 'cities'], function ($router) {
    Route::get('/', [CitiesController::class, 'index']);
    Route::get('/{id}', [CitiesController::class, 'show']);
    Route::post('/add', [CitiesController::class, 'store']);
    Route::put('/{id}', [CitiesController::class, 'update']);
    Route::delete('/{id}', [CitiesController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'roles'], function ($router) {
    Route::get('/', [RolesController::class, 'index']);
    Route::get('/{id}', [RolesController::class, 'show']);
    Route::post('/add', [RolesController::class, 'store']);
    Route::put('/{id}', [RolesController::class, 'update']);
    Route::delete('/{id}', [RolesController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'films'], function ($router) {
    Route::get('/', [FilmsController::class, 'index']);
    Route::get('/{id}', [FilmsController::class, 'show']);
    Route::post('/add', [FilmsController::class, 'store']);
    Route::put('/{id}', [FilmsController::class, 'update']);
    Route::delete('/{id}', [FilmsController::class, 'destroy']);
});
