<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

//User related Routes
Route::get('/', [UserController::class,"homecontent"])->name('login');
Route::post('/register',[UserController::class, "register"]);
Route::post('/login',[UserController::class, "login"]);
Route::post('/logout',[UserController::class, "logout"]);

// Blog Related Routes
Route::get('/create-post', [PostController::class,'ShowPostForm'])->name('create-post')->middleware('mustbelogin');
Route::post('/create-post', [PostController::class,'SaveNewPost'])->middleware('mustbelogin');
Route::get('/post/{post}', [PostController::class,'viewSinglePost'])->name('view-post')->middleware('mustbelogin');


