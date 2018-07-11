<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('roadworks', 'RoadworkController')
    ->except('create', 'edit');

Route::prefix('roadworks/{roadwork}')->group(function() {

    Route::resource('markers', 'MarkerController')
        ->except('create', 'edit');

    Route::prefix('markers/{marker}')->group(function() {
        Route::resource('photos', 'PhotoController')
            ->except('create', 'edit');
    });
    
});
