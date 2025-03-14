<?php

use App\Models\Weight;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\RecommendationController2;
use App\Http\Controllers\RecommendationController3;
use App\Http\Controllers\RecommendationController4;

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

Route::get('/', [MovieController::class, 'home'])->name('root');
Route::get('/about', function () {
    return view('pages.about');
})->name('root.about');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('root.contact');
Route::resource('movie', MovieController::class);


//User Routes
// Route::get('user', [ProfileController::class, 'index'])->middleware(['auth'])->middleware(['auth', 'verified'])->name('user.dashboard');
Route::get('user', [ProfileController::class, 'index'])->middleware(['auth'])->name('user.dashboard');
Route::get('watch-movies', [ProfileController::class, 'view1'])->middleware(['auth'])->name('user.watch');
Route::get('recommendationDet', [RecommendationController3::class, 'recommendationDetails'])->name('user.recommendationDetails');
Route::get('/recommendations/{filter}', [RecommendationController3::class, 'view10'])->name('user.recommendations.show');
Route::get('/weights', [WeightController::class, 'index'])->middleware(['auth'])->name('weights.index');
Route::post('/weights/{id}', [WeightController::class, 'update'])->middleware(['auth'])->name('weights.update');
Route::get('/recommendationHyb/regenerate', [RecommendationController3::class, 'regenerate'])->name('recommendations.regenerate');
// })->->name('dashboard');

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Support Routes
    Route::get('support/{id}/delete', [SupportController::class, 'destroy'])->name('support.destroy');
    Route::resource('support', SupportController::class);
    //Interest Routes
    // Route::get('/profile/interests', [ProfileController::class, 'interest'])->name('movie.interests');
    Route::get('/profile/interests', [ProfileController::class, 'interest'])->name('interest.add');
    Route::get('/profile/interestedit/{id}', [ProfileController::class, 'editinterest'])->name('interest.edit');
    Route::put('/profile/interestedit/{id}', [ProfileController::class, 'editUpdate'])->name('interest.editUpdate');
    Route::get('/profile/interesteditRating/{id}', [ProfileController::class, 'editinterestrating'])->name('interest.rating');
    Route::put('/profile/interesteditRating/{id}', [ProfileController::class, 'ratingUpdate'])->name('interest.ratingUpdate');
    Route::post('/profile/intereststore', [ProfileController::class, 'intereststore'])->name('interest.store');

    //Recommendation Routes
    Route::get('recommendation/', [RecommendationController::class, 'index'])->name('recommendation.view');
    Route::get('recommendationM/', [RecommendationController2::class, 'index'])->name('recommendation.viewm');
    Route::get('recommendationKE/', [RecommendationController3::class, 'index'])->name('recommendation.view3');
    Route::get('recommendationKE2/', [RecommendationController3::class, 'index4'])->name('recommendation.view5');
    Route::get('recommendationKM/', [RecommendationController4::class, 'index'])->name('recommendation.view4');
    Route::get('recommendationKM2/', [RecommendationController4::class, 'index2'])->name('recommendation.view6');
    Route::get('recommendationDem/', [RecommendationController4::class, 'index3'])->name('recommendation.view7');
    Route::get('recommendationCol/', [RecommendationController4::class, 'index4'])->name('recommendation.view8');
    Route::get('recommendationHyb/', [RecommendationController3::class, 'hybridRecommendations'])->name('recommendation.view9');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/staff.php';
