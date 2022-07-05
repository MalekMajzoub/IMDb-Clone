<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;

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

Route::group(['middleware' => 'role:admin', 'prefix' => 'cms'], function () {
    // _______ CMS MOVIES ________
    Route::group(['controller' => MovieController::class, 'prefix' => 'movies', 'as' => 'movies.'], function () {
        // Manage Movies
        Route::get('/managemovies', 'manage')->name('manage');

        // Show Movie Create Form
        Route::get('/create', 'create')->name('create');

        // Store Movie Data
        Route::post('/store', 'store')->name('store');

        // Show Movie Edit Form
        Route::get('/{movie}/edit', 'edit')->name('edit');

        // Update Movie
        Route::put('/{movie}', 'update')->name('update');

        // Delete Movie
        Route::delete('/{movie}', 'destroy')->name('destroy');

        // Show Add/Edit Cast Form
        Route::get('/{movie}/actors', 'addEditActorsForm')->name('addEditActorsForm');

        // Add/Edit Actors of Movies
        Route::post('/{movie}/actors', 'addEditActors')->name('addEditActors');

        // Show Add/Edit Cast Form
        Route::get('/{movie}/categories', 'addEditCategoriesForm')->name('addEditCategoriesForm');

        // Add/Edit Categories of Movies
        Route::post('/{movie}/categories', 'addEditCategories')->name('addEditCategories');
    });

    Route::group(['controller' => CategoryController::class, 'prefix' => 'categories', 'as' => 'categories.'], function () {
        // Manage Categories
        Route::get('/managecategories', 'manage')->name('manage');

        // Show Category Create Form
        Route::get('/create', 'create')->name('create');

        // Store Category Data
        Route::post('/store', 'store')->name('store');

        // Show Category Edit Form
        Route::get('/{category}/edit', 'edit')->name('edit');

        // Update Category
        Route::put('/{category}', 'update')->name('update');

        // Delete Category
        Route::delete('/{category}', 'destroy')->name('destroy');
    });

    Route::group(['controller' => ActorController::class, 'prefix' => 'actors', 'as' => 'actors.'], function () {
        // Manage Actors
        Route::get('/manageactors',  'manage')->name('manage');

        // Show Actor Create Form
        Route::get('/create',  'create')->name('create');

        // Store Actor Data
        Route::post('/store',  'store')->name('store');

        // Show Actor Edit Form
        Route::get('/{actor}/edit',  'edit')->name('edit');

        // Update Actor
        Route::put('/{actor}',  'update')->name('update');

        // Delete Actor
        Route::delete('/{actor}',  'destroy')->name('destroy');
    });
});

Route::group(['controller' => MovieController::class], function () {
    // All Listings
    Route::get('/', 'index');

    // Show Rate Form
    Route::get('/movies/{movie}/rate', 'rate')->middleware('auth');

    // Rate a Movie
    Route::post('/movies/{movie}/addRating', 'addRating')->middleware('auth');

    // Single Listing
    Route::get('/movies/{movie}', 'show');
});

Route::group(['controller' => UserController::class], function () {
    // Show Register/Create Form
    Route::get('/register', 'create')->middleware('guest');

    // Create New User
    Route::post('/users', 'store');

    // Show Login Form
    Route::get('/login', 'login')->name('login')->middleware('guest');

    // Log User Out
    Route::post('/logout', 'logout')->middleware('auth');

    // Login User
    Route::post('/users/authenticate', 'authenticate');

    // Shwo Forgot Password Form
    Route::get('/users/forgotpasswordform', 'forgotPasswordForm');

    // Forgot Password Form
    Route::post('/users/forgotpassword', 'forgotPassword');
});

// No URL Found
Route::any('{url}', function () {
    return redirect('/');
})->where('url', '.*');
