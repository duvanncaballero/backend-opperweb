<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
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
Route::group(['prefix' => 'post'], function () {
    Route::get('list', [PostController::class, 'index']);
    Route::get('show/{id}', [PostController::class, 'show']);
    Route::post('create', [PostController::class, 'store']);
    Route::put('update', [PostController::class, 'update']);
    Route::delete('delete/{id}', [PostController::class, 'destroy']);
});

Route::group(['prefix' => 'category'], function () {
    Route::get('list', [CategoryController::class, 'index']);
    Route::get('show/{id}', [CategoryController::class, 'show']);
    Route::post('create', [CategoryController::class, 'store']);
    Route::put('update', [CategoryController::class, 'update']);
    Route::delete('delete/{id}', [CategoryController::class, 'destroy']);
});

Route::group(['prefix' => 'comment'], function () {
    Route::get('list', [CommentController::class, 'index']);
    Route::get('show/{id}', [CommentController::class, 'show']);
    Route::post('create', [CommentController::class, 'store']);
    Route::put('update', [CommentController::class, 'update']);
    Route::delete('delete/{id}', [CommentController::class, 'destroy']);
});