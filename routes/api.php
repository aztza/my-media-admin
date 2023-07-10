<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogsController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("user/login",[AuthController::class,"login"]);
Route::post("user/register",[AuthController::class,"register"]);

Route::get("/category",[AuthController::class,"category"])->middleware('auth:sanctum');
//post
Route::get("/allPosts",[PostController::class,"getAllPost"]);
Route::post("search/post",[PostController::class,"searchPost"]);
Route::post("post/details",[PostController::class,"postDetails"]);

//category
Route::get("/allCategory",[CategoryController::class,"getAllCategory"]);
Route::post("search/category",[CategoryController::class,"searchCategory"]);

//view count
Route::post("view/count",[ActionLogsController::class,"viewCount"]);
