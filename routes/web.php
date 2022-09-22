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
        return redirect()->route('redirect.to.dashboard');
    }

    return view('auth.login');
})->name('login');

Route::get('/redirect-to-dashboard', function() {
    if(auth()->user()->type == 'admin') {
        return redirect()->route('home');
    } else {
        return redirect()->route('users.dashboard');
    }
})->middleware('auth')->name('redirect.to.dashboard');

Route::get('/', 'MainController@home')->name('home');

Route::prefix('panel')->group(function() {
    Route::post('/create-lesson-subject', 'MainController@create_lesson_subject')->name('create-lesson-subject');

    Route::delete('/delete-lesson-subject/{subject}', 'MainController@delete_lesson_subject')->name('delete.lesson.subject');

    Route::put('/update-lesson-subject/{subject}', 'MainController@update_lesson_subject')->name('update.lesson.subject');

    Route::get('/students', 'MainController@students')->name('dashboard.students');

    Route::get('/show-works/{student}', 'MainController@show_works')->name('show.works');

    Route::get('/add-student-work/{student}', 'MainController@add_student_work')->name('add.student.work');

    Route::post('/insert-student-work/{student}', 'MainController@insert_student_work')->name('insert.student.work');

    Route::get('/add-student', 'MainController@add_student')->name('add.student');

    Route::post('/insert-student', 'MainController@insert_student')->name('insert.student');

    Route::get('/upload-student-image-form/{student}', 'MainController@upload_student_image_form')->name('upload.student.image.form');

    Route::post('/upload-student-image-post/{student}', 'MainController@upload_student_image_post')->name('upload.student.image.post');

    Route::get('/edit-student/{student}', 'MainController@edit_student')->name('edit.student');

    Route::put('/update-student/{student}', 'MainController@update_student')->name('update.student');
});

Route::prefix('users')->group(function() {
    Route::get('/dashboard', 'UsersDashboardController@dashboard')->name('users.dashboard');
});
