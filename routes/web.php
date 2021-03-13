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

Route::get('/', 'Frontend\IndexController@index')->name('frontend.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::prefix('dashboard')->middleware('auth')->name('dashboard.')->group(function () {
    Route::resource('cities', 'Backend\CityController');
    Route::resource('categories', 'Backend\CategoryController');
    Route::resource('chalets', 'Backend\ChaletController');
    Route::post('/delete-chalet-media/{media_id}', 'Backend\ChaletController@destroy_chalet_media')->name('chalet.media.destroy');

});


Route::get('/contact_us', 'Frontend\IndexController@contact')->name('chalet.frontend.contact');
Route::post('/contact_us', 'Frontend\IndexController@do_contact')->name('chalet.frontend.do_contact');
Route::get('/about_us', 'Frontend\IndexController@about')->name('chalet.frontend.about');
Route::get('/category/{id}','Frontend\IndexController@category')->name('chalet.frontend.categories.chalets');
Route::get('/city/{id}','Frontend\IndexController@city')->name('chalet.frontend.cities.chalets');
Route::get('/search','Frontend\IndexController@search')->name('chalet.frontend.search');
Route::get('/{post}', 'Frontend\IndexController@chalet_show')->name('chalet.frontend.show');
Route::post('/{post}', 'Frontend\IndexController@store_comment')->name('chalet.frontend.add_comment');


