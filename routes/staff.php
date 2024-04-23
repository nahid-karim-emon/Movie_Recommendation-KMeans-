<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Staff\UserController;
use App\Http\Controllers\Staff\CastController;
use App\Http\Controllers\Staff\HomeController;
use App\Http\Controllers\Staff\EmailController;
use App\Http\Controllers\Staff\GenreController;
use App\Http\Controllers\Staff\MovieController;
use App\Http\Controllers\Staff\DirectorController;
use App\Http\Controllers\Staff\LanguageController;
use App\Http\Controllers\Staff\ProductionCompanyController;
use App\Http\Controllers\Staff\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Staff\CountryController;

//Staff Routes
Route::namespace('Staff')->prefix('staff')->name('staff.')->group(function () {
    Route::namespace('Auth')->middleware('guest:staff')->group(function () {
        //Login Route
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    });
    Route::middleware('staff')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});
Route::middleware('staff')->prefix('staff')->name('staff.')->group(function () {
    // Email Crud
    Route::get('email/{id}/delete', [EmailController::class, 'destroy']);
    Route::resource('email', EmailController::class);
    //Profile
    Route::get('/profile', [HomeController::class, 'view'])->name('profile.view');
    Route::get('/profile/edit', [HomeController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [HomeController::class, 'update'])->name('profile.update');
    //Suport Ticekts View And Reply
    Route::get('support', [SupportController::class, 'staffIndex'])->name('support.index');
    Route::get('support/{id}', [SupportController::class, 'staffAdmin'])->name('support.show');
    Route::get('support/{id}/reply', [SupportController::class, 'staffReply'])->name('support.reply');
    Route::put('support/{id}', [SupportController::class, 'staffReplyUpdate'])->name('support.replyUpdate');
    // User Routes
    Route::get('user/{id}/delete', [UserController::class, 'destroy']);
    Route::resource('user', UserController::class);
    // Cast Crud
    Route::get('cast/{id}/delete', [CastController::class, 'destroy']);
    Route::resource('cast', CastController::class);
    // Genre Crud
    Route::get('genre/{id}/delete', [GenreController::class, 'destroy']);
    Route::resource('genre', GenreController::class);
    // Language Crud
    Route::get('language/{id}/delete', [LanguageController::class, 'destroy']);
    Route::resource('language', LanguageController::class);
    // Country Crud
    Route::get('country/{id}/delete', [CountryController::class, 'destroy']);
    Route::resource('country', CountryController::class);
    // Production Company Crud
    Route::get('pcompany/{id}/delete', [ProductionCompanyController::class, 'destroy']);
    Route::resource('pcompany', ProductionCompanyController::class);
    // Director Crud
    Route::get('director/{id}/delete', [DirectorController::class, 'destroy']);
    Route::resource('director', DirectorController::class);
    // Movie Crud
    Route::get('movie/{id}/delete', [MovieController::class, 'destroy']);
    Route::resource('movie', MovieController::class);
    //Movie Rating Update
    Route::get('movie/{id}/rating', [MovieController::class, 'rating'])->name('movie.rating');
    Route::put('movie/rating/{id}', [MovieController::class, 'ratingUpdate'])->name('movie.ratingUpdate');
});
