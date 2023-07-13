<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
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
    Route::get("/article-detail/{slug}","show")->name("detail");
    Route::get("/category/{slug}","categorized")->name("categorized");
    Route::get("mail-test",'mailTest')->name("mailTest");
    Route::get("validate-test",'validateTest')->name("validateTest");
    Route::post("validate-check",'validateCheck')->name("validateCheck");
});
Route::resource("comment",CommentController::class)->only(["store","update","destroy"])->middleware("auth");

Auth::routes(["verify" => true]);

Route::middleware(['auth'])->prefix("dashboard")->group(function () {
    Route::resource("article", ArticleController::class);
    Route::delete("force-delete/{id}",[ArticleController::class,"forceDelete"])->name("article.forceDelete");
    Route::resource("photo", PhotoController::class);
    Route::resource("category", CategoryController::class)->middleware("can:viewAny," . Category::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user-list', [HomeController::class, 'users'])->name('users')->can('admin-only');
});
