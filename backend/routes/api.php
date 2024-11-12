<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::middleware('auth_api')->group(function (){
    Route::get('/posts', [\App\Http\Controllers\Api\PostController::class, 'index'])->name('api.posts.index');
    Route::get('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'show'])->name('api.posts.show');
    Route::post('/posts', [\App\Http\Controllers\Api\PostController::class, 'store'])->name('api.posts.store');
    Route::patch('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'update'])->name('api.posts.update');
    Route::delete('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'delete'])->name('api.posts.delete');
});


