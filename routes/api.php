<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'namespace' => 'App\Http\Controllers\API',
], function (): void {
    Route::post('auth/login', 'AuthController@login')->name('auth.login');

    Route::middleware(['auth:sanctum', 'ability:admin'])->group(function (): void {
        Route::post('auth/logout', 'AuthController@logout')->name('auth.logout');
    });
});

Route::group([
    'as' => 'client.',
    'prefix' => 'client',
    'namespace' => 'App\Http\Controllers\API\Client',
], function (): void {
    Route::post('auth/login', 'AuthController@login')->name('auth.login');

    Route::middleware(['auth:sanctum', 'ability:client'])->group(function (): void {
        Route::post('auth/logout', 'AuthController@logout')->name('auth.logout');
    });
});
