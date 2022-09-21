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

Route::prefix('panel')->group(function() {
    Route::post('/create-lesson-subject', 'MainController@create_lesson_subject')->name('create-lesson-subject');

    Route::delete('/delete-lesson-subject/{subject}', 'MainController@delete_lesson_subject')->name('delete.lesson.subject');

    Route::put('/update-lesson-subject/{subject}', 'MainController@update_lesson_subject')->name('update.lesson.subject');
});
