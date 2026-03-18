<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/postadd', [PostController::class, 'store']);
    Route::post('/post/{post}', [PostController::class, 'update']);
    Route::post('/comment/{post}', [CommentController::class, 'store']);
    Route::get("/postUser/{post}", [PostController::class, "show"]);
});
Route::post("/register", [UserController::class, "register"]);
Route::get("/post/{post}", [PostController::class, "show"]);
Route::get("/posts", [PostController::class, "getPosts"]);
Route::get("/userPage/{user}", [PostController::class, "postUser"]);
