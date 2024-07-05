<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookmarkController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\LandingPageController;
use App\Http\Controllers\API\ProgressController;
use App\Http\Controllers\API\QuestionController;
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

//User Dashboard
Route::middleware('auth:sanctum')->prefix('/dashboard')->group(function (Request $request) {
    Route::resource('/bookmarks', BookmarkController::class);
    Route::resource('/progress', ProgressController::class);
})->name('dashboard.');


//Admin Dashboard


// Landing page
Route::get('/', [LandingPageController::class, 'home'])->name('home');
Route::get('/categories', [LandingPageController::class, 'categories'])->name('categories');

// Authentication
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::get('/auth-check', [AuthController::class, 'checkAuth'])->name('api.auth-check');
Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

Route::get('/get-subcategories/{categoryId}', [CategoryController::class, 'getSubCategories']);
