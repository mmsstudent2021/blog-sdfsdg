<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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

Route::controller(PageController::class)->group(function(){
    Route::get("/","index")->name("index");
    Route::get("/article-detail/{id}","show")->name("detail");
});

Auth::routes();

Route::middleware(['auth'])->prefix("dashboard")->group(function () {
    Route::resource("article", ArticleController::class);
    Route::resource("category", CategoryController::class)->middleware("can:viewAny," . Category::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user-list', [HomeController::class, 'users'])->name('users')->can('admin-only');
});
