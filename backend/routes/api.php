<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/comments/{post}',[\App\Http\Controllers\Api\CommentController::class,'index']);
Route::post('/comments/{id}',[\App\Http\Controllers\Api\CommentController::class,'store']);

Route::get('/categories',[\App\Http\Controllers\Api\CategoryController::class,'index']);
Route::get('/users',[\App\Http\Controllers\Api\UserController::class,'index']);

Route::get('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/forgot', [\App\Http\Controllers\Api\AuthController::class, 'forgot']);

Route::get('/posts', [\App\Http\Controllers\Api\PostController::class, 'index']);
Route::get('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'show']);
Route::patch('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'update']);
Route::post('/posts', [\App\Http\Controllers\Api\PostController::class, 'store']);
Route::delete('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'delete']);

Route::post('/contact',[\App\Http\Controllers\Api\ContactController::class,'contact']);

//Route::group(['middleware'=>'auth:sanctum'],function (){
//});





