<?php

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Only the people you follow show up
Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');


Route::group(['prefix' => '/ideas', 'as' => 'ideas.', 'middleware' => ['auth']], function () {

    Route::get('/{idea}', [DashboardController::class, 'show'])->name('show')->withoutMiddleware('auth');

    Route::post('/', [DashboardController::class, 'store'])->name('store');

    // Route::group(['middleware' => ['auth']], function(){}) -> defining another route group inside the first one is another way of doing this.

    Route::get('/{idea}/edit', [DashboardController::class, 'edit'])->name('edit');

    Route::patch('/{idea}', [DashboardController::class, 'update'])->name('update');

    Route::delete('/{idea}', [DashboardController::class, 'destroy'])->name('destroy');

    // Comment route
    Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
});

// Route::resource('ideas', DashboardController::class)->except(['index', 'create', 'show'])->middleware('auth');



// Auth Routes
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store']);

// Log in / Logout
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/logout', [AuthController::class, 'logout']);




// Users routes
Route::group(['prefix' => '/users', 'as' => 'users.', 'middleware' => ['auth']], function () {
    Route::get('/{user}', [UserController::class, 'show'])->name('show')->withoutMiddleware('auth');

    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');

    Route::patch('/{user}', [UserController::class, 'update'])->name('update');

    //  FOLLOW ROUTES
    Route::post('/{user}/follow', [UserController::class, 'follow'])->name('follow');
    Route::post('/{user}/unfollow', [UserController::class, 'unfollow'])->name('unfollow');
});


// LIKING ROUTES
Route::post('ideas/{idea}/like', [LikeController::class, 'like'])->middleware('auth')->name('ideas.like');
Route::post('ideas/{idea}/unlike', [LikeController::class, 'unlike'])->middleware('auth')->name('ideas.unlike');

// ADMIN ROUTES
Route::get('/admin', [AdminDashboardController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');

// Other pages' routes
Route::get('/terms', function () {
    return view("pages/terms");
})->name('terms');
