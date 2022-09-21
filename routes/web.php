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

Auth::routes();

Route::get('/login', function() {
    if(auth()->check()) {
        return redirect()->route('home');
    }

    return view('auth.login');
})->name('login');

Route::get('/', 'MainController@home')->name('home');

Route::post('/create-lesson-subject', 'MainController@create_lesson_subject')->name('create-lesson-subject');
