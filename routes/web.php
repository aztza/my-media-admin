<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard',[ProfileController::class,"index"])->name("dashboard");
    //update
    Route::post('admin/update',[ProfileController::class,"updateAdminAccount"])->name("admin#update");
    //change password
    Route::get('changePass/page',[ProfileController::class,"changePasswordPage"])->name("admin#password");
    Route::post('change/password',[ProfileController::class,"changePassword"])->name("change#password");

    //adminlist
    Route::get('admin/list',[ListController::class,"index"])->name("admin#list");
    Route::get('admin/delete/{id}',[ListController::class,"deleteAdminAccount"])->name("admin#delete");
    Route::post('admin/list',[ListController::class,"adminListSearch"])->name("admin#search");

    //category
    Route::get('category',[CategoryController::class,"index"])->name("admin#category");
    Route::post('category/create',[CategoryController::class,"createCategory"])->name("create#category");
    Route::get('category/delete/{id}',[CategoryController::class,"deleteCategory"])->name("delete#category");
    Route::post('category/search',[CategoryController::class,"searchCategory"])->name("search#category");
    Route::get('category/updatePage/{id}',[CategoryController::class,"updatePageCategory"])->name("updatePage#category");
    Route::post('category/update/{id}',[CategoryController::class,"updateCategory"])->name("update#category");

    //post
    Route::get('post',[PostController::class,"index"])->name("admin#post");
    Route::post('create/post',[PostController::class,"createPost"])->name("create#post");
    Route::get('delete/post/{id}',[PostController::class,"deletePost"])->name("delete#post");
    Route::get('update/post/page/{id}',[PostController::class,"updatePostPage"])->name("updatePage#post");
    Route::post('update/post/{id}',[PostController::class,"updatePost"])->name("update#post");

    Route::get('trendPost',[TrendPostController::class,"index"])->name("admin#trandPost");
    Route::get('trendPost/detail/{id}',[TrendPostController::class,"trendPostDetail"])->name("trendPost#detail");
    });
