<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;

Route::group(['middleware' => 'role:admin', 'prefix' => 'cms'], function () {

    Route::group(['controller' => MovieController::class, 'prefix' => 'movies', 'as' => 'movies.'], function () {
        Route::get('/managemovies', 'manage')->name('manage'); // Manage Movies
        Route::get('/create', 'create')->name('create'); // Show Movie Create Form
        Route::post('/store', 'store')->name('store'); // Store Movie Data
        Route::get('/{movie}/edit', 'edit')->name('edit'); // Show Movie Edit Form
        Route::put('/{movie}', 'update')->name('update'); // Update Movie
        Route::delete('/{movie}', 'destroy')->name('destroy'); // Delete Movie
        Route::get('/{movie}/actors', 'addEditActorsForm')->name('addEditActorsForm'); // Show Add/Edit Cast Form
        Route::post('/{movie}/actors', 'addEditActors')->name('addEditActors'); // Add/Edit Actors of Movies
        Route::get('/{movie}/categories', 'addEditCategoriesForm')->name('addEditCategoriesForm'); // Show Add/Edit Cast Form
        Route::post('/{movie}/categories', 'addEditCategories')->name('addEditCategories'); // Add/Edit Categories of Movies
    });

    Route::group(['controller' => CategoryController::class, 'prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/managecategories', 'manage')->name('manage'); // Manage Categories
        Route::get('/create', 'create')->name('create'); // Show Category Create Form 
        Route::post('/store', 'store')->name('store'); // Store Category Data 
        Route::get('/{category}/edit', 'edit')->name('edit'); // Show Category Edit Form
        Route::put('/{category}', 'update')->name('update'); // Update Category
        Route::delete('/{category}', 'destroy')->name('destroy'); // Delete Category
    });

    Route::group(['controller' => ActorController::class, 'prefix' => 'actors', 'as' => 'actors.'], function () {
        Route::get('/manageactors',  'manage')->name('manage'); // Manage Actors
        Route::get('/create',  'create')->name('create'); // Show Actor Create Form
        Route::post('/store',  'store')->name('store'); // Store Actor Data  
        Route::get('/{actor}/edit',  'edit')->name('edit'); // Show Actor Edit Form   
        Route::put('/{actor}',  'update')->name('update'); // Update Actor
        Route::delete('/{actor}',  'destroy')->name('destroy'); // Delete Actor
    });
});

Route::group(['controller' => MovieController::class, 'as' => 'movies.'], function () {
    Route::get('/', 'index')->name('all'); // All Listings
    Route::get('/movies/{movie}/rate', 'rate')->middleware('auth')->name('rate'); // Show Rate Form
    Route::post('/movies/{movie}/addRating', 'addRating')->middleware('auth')->name('addRating'); // Rate a Movie
    Route::get('/movies/{movie}', 'show')->name('show'); // Single Listing
});

Route::group(['controller' => UserController::class, 'as' => 'users.'], function () {
    Route::get('/register', 'create')->middleware('guest'); // Show Register/Create Form
    Route::post('/users', 'store'); // Create New User
    Route::get('/login', 'login')->name('login')->middleware('guest'); // Show Login Form
    Route::post('/logout', 'logout')->middleware('auth'); // Log User Out
    Route::post('/users/authenticate', 'authenticate'); // Login User
    Route::get('/users/forgotpasswordform', 'forgotPasswordForm'); // Show Forgot Password Form 
    Route::post('/users/forgotpassword', 'forgotPassword'); // Forgot Password Form
});

// No URL Found
Route::any('{url}', function () {
    return redirect('/');
})->where('url', '.*');
