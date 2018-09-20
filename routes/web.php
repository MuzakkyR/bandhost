<?php

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

Route::get('/', 'IndexController@index');


Auth::routes();

Route::get('/after/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/after/user', 'ProfilController@index')->name('profil');
Route::put('/after/user/refresh', 'ProfilController@update');

Route::get('/after/domain', 'DomainController@index')->name('domain');
Route::get('/after/domain/refresh', 'DomainController@refresh');

Route::get('/after/hosting', 'HostingController@index')->name('hosting');
Route::get('/after/hosting/refresh', 'HostingController@refresh');
Route::get('/after/hosting/{hostingID}', 'HostingController@single');

Route::get('/after/article', 'ArticleController@index')->name('article');
Route::get('/after/article/create', 'ArticleController@create');
Route::post('/after/article', 'ArticleController@store');
Route::get('/after/article/{id}/edit','ArticleController@edit');
Route::put('/after/article/{id}', 'ArticleController@update');
Route::delete('/after/article/{id}', 'ArticleController@destroy');

Route::get('/after/access', 'AccessController@index')->name('access');
Route::get('/after/access/refresh', 'AccessController@refresh');

Route::get('/blog/{slug}','IndexController@show');
Route::get('/notfound', function(){
    return "404 Not Found";
})->name('notfound');