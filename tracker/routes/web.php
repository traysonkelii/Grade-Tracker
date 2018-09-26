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
Route::get('/teacher', 'TeacherController@landing')->name('teacher');
Route::get('/practice', 'ContentsController@home')->name('practice');
Route::get('/student', 'StudentController@index')->name('all_students');
Route::get('/student/repertoire/{student_id}', 'StudentController@showRep')->name('student_rep');
