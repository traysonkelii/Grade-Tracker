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

//routes for the student view
Route::get('/student/{student_id}', 'StudentController@landing')->name('student');
Route::post('/student/{student_id}', 'StudentController@landing')->name('teacher-student');

//routes for practice
Route::get('/practice', 'ContentsController@home')->name('practice');

//routes for the repertoires
Route::get('/repertoire/{student_id}', 'RepertoireController@index')->name('repertoire');
Route::get('/repertoire/{student_id}/{repertiore_id}/submit', 'RepertoireController@submit')->name('rep_submit');
Route::post('/repertoire/{student_id}/{repertiore_id}/approve', 'RepertoireController@approve')->name('rep_approved');
Route::post('/repertoire/{student_id}/{repertiore_id}/reject', 'RepertoireController@reject')->name('rep_reject');
Route::get('/repertoire/filter/{student_id}/{type}', 'RepertoireController@filter')->name('rep_filter');
