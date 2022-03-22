<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/', function () {
        return response()->json([
            'status' => 'success',
            'data' => 'Welcome to API'
        ], 200);
    });

    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/{id}', [BlogController::class, 'show']);
    Route::post('/blog/post', [BlogController::class, 'store']);
    Route::post('/blog/update/{id}', [BlogController::class, 'update']);
    Route::delete('/blog/delete/{id}', [BlogController::class, 'destroy']);
});
