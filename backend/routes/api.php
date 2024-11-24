<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/forgot', [\App\Http\Controllers\Api\AuthController::class, 'forgot']);

Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::get('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/posts', [\App\Http\Controllers\Api\PostController::class, 'index'])->name('api.posts.index');
    Route::get('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'show'])->name('api.posts.show');
    Route::post('/posts', [\App\Http\Controllers\Api\PostController::class, 'store'])->name('api.posts.store');
    Route::patch('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'update'])->name('api.posts.update');
    Route::delete('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'delete'])->name('api.posts.delete');
});




