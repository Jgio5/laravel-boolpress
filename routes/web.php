<?php

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

Route::get('/', 'HomeController@index' )->name('guest-homepage'); //auth

Route::prefix('categories')
    ->group(function () {
        Route::get('/', 'CategoryController@index')->name('categories.index');
        Route::get('/{slug}', 'CategoryController@show')->name('categories.show'); 
});

Route::prefix('posts')
    ->group(function () {
        Route::get('/', 'PostController@index')->name('posts.index');
        Route::get('/{slug}', 'PostController@show')->name('posts.show'); 
});

Auth::routes();

// localhost:8000/admin
Route::prefix('admin')
    ->namespace('Admin')   //indica la cartella dove andare a pescare
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('admin-homepage'); //admin
        Route::get('/profile', 'HomeController@profile')->name('admin-profile');
        Route::post('/profile/generate-token', 'HomeController@generateToken')->name('admin.generate_token');
        Route::resource('/posts', PostController::class)->names([
            'index' => 'admin.posts.index',
            'create' => 'admin.posts.create',
            'destroy' => 'admin.posts.destroy',
            'update' => 'admin.posts.update',
            'show' => 'admin.posts.show',
            'edit' => 'admin.posts.edit',
            'store' => 'admin.posts.store'
        ]);
});

// Route::get('/admin', 'HomeController@index')->name('admin-homepage')->middleware('auth');
