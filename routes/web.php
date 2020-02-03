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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

///
/*
Note you ran into trouble here because like in React Router, the route tries to match from the top down - therefore if /p/{post} is before /p/create, it'll match /p/{post} and you'll get a 404 when it can't find post_id == 'create'.
*/
///

///
/*
Note also that partly in the name of good practice and partly in the name of LARAVEL IS EXPECTING IT THIS WAY SO IT'LL BREAK IF YOU DON'T, you need to follow the HTTP verb convention outlined here:
-- can't find it! But it's mentioned several times in the tut video here:
https://www.youtube.com/watch?v=ImtZ5yENzgE
It's basically the convention for naming routes depending on the HTTP method and the resource. So for exammple, viewing a post is GET /post/{id} - editing a post is GET /post/{id}/edit - etc.
*/
///

Route::get('/p/create', 'PostsController@create');
Route::get('/p/{post}', 'PostsController@show');
Route::post('/p', 'PostsController@store');


Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

