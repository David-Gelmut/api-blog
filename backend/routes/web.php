<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Admin\AuthController::class, 'login']);
Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
Route::post('login_process', [\App\Http\Controllers\Admin\AuthController::class, 'login_process'])->name('login_process');

Route::group(['middleware'=>'auth'],function () {
    Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    Route::resource('users',\App\Http\Controllers\Admin\UserController::class);
    Route::resource('categories',\App\Http\Controllers\Admin\CategoryController::class);
    Route::get('comments/{comment}',[\App\Http\Controllers\Admin\CommentController::class,'edit'])->name('comments.edit');
    Route::put('comments/{comment}',[\App\Http\Controllers\Admin\CommentController::class,'update'])->name('comments.update');
    Route::delete('comments/{comment}',[\App\Http\Controllers\Admin\CommentController::class,'destroy'])->name('comments.delete');
});


