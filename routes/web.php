<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\Author\PostController as AuthorPostController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Author\SettingsController as AuthorSettingsController;



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

Route::get('/',[HomeController::class , 'index'])->name('home');

Route::post('subscriber',[SubscriberController::class,'store'])->name('subscriber.store');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth' ,'admin','verified']], function(){
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('tag', TagController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);

    Route::get('pending/post',[PostController::class, 'pending'])->name('post.pending');
    Route::put('/post/{id}/approve',[PostController::class, 'approval'])->name('post.approve');

    Route::get('subscriber',[AdminSubscriberController::class,'index'])->name('subscriber.index');
    Route::delete('subscriber/{id}',[AdminSubscriberController::class,'destroy'])->name('subscriber.destroy');

    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('update-profile', [SettingsController::class, 'updateProfile'])->name('update.profile');
    Route::put('update-password', [SettingsController::class, 'updatePassword'])->name('update.password');

});

Route::group(['prefix' => 'author', 'as' => 'author.', 'middleware' => ['auth','author','verified']], function(){
    Route::get('dashboard', [AuthorDashboardController::class, 'index'])->name('dashboard');
    Route::resource('post', AuthorPostController::class);

    Route::get('settings', [AuthorSettingsController::class, 'index'])->name('settings.index');
    Route::put('update-profile', [AuthorSettingsController::class, 'updateProfile'])->name('update.profile');
    Route::put('update-password', [AuthorSettingsController::class, 'updatePassword'])->name('update.password');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
