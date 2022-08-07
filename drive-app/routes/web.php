<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [InfoController::class, 'index']);


// User Routes
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);
Route::get('/register', [UserController::class, 'register']);
Route::post('/users/store', [UserController::class, 'store']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/login', [UserController::class, 'login']);
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Docs Route
Route::resource('docs', DocController::class);

// Bookmark Route
Route::resource('bookmarks', BookmarkController::class);

// Report Route
Route::get('/report', [ReportController::class, 'create']);
Route::post('/report', [ReportController::class, 'store']);
Route::delete('/report/{report}', [ReportController::class, 'destroy']);
Route::get('/report/reports', [ReportController::class, 'index']);
