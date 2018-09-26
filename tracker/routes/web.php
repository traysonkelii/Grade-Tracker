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

Route::get('/', 'ContentsController@home')->name('home');

//routes for the teacher view
Route::get('/teacher', 'TeacherController@landing')->name('teacher');
Route::get('/teacher/all-students', 'StudentController@index')->name('all_students');
Route::get('/teacher/student-repertoires/{student_id}', 'StudentController@showRep')->name('student_repertoire');

//routes for the student view
Route::get('/student', 'StudentController@landing')->name('student');

Route::get('/practice', 'ContentsController@home')->name('practice');

