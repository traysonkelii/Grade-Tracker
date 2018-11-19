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
Route::get('/student/{student_id}', 'StudentController@home')->name('student');
Route::post('/student/{student_id}', 'StudentController@home')->name('student');
Route::get('/student', 'StudentController@index');

//routes for practice
Route::get('/practice/{student_id}', 'PracticeController@home')->name('practice');
Route::post('/practice/add/{rep_stu_id}/{start}/{stop}', 'PracticeController@addPractice')->name('addPractice');
Route::get('/practice/editList/{student_id}/{rep_stu_id}/{val}', 'PracticeController@editList')->name('editPracticeList');

//routes for the repertoires
Route::get('/repertoire/{student_id}', 'RepertoireController@index')->name('repertoire');
Route::post('/repertoire/updateStatus/{student_id}/{repertoire_id}/{type}/{val}', 'RepertoireController@updateStatus')->name('updateStatus');
Route::post('/repertoire/update/{rep_stu_id}/{type}/{val}', 'RepertoireController@update')->name('repUpdate');
Route::get('/repertoire/read/{rep_stu_id}/{type}', 'RepertoireController@read')->name('repRead');
Route::post('/repertoire/createRep/{name}/{com_id}/{ins_id}/{gen_id}', 'RepertoireController@createRep')->name('something');
Route::post('/repertoire/createPivot/{stu_id}/{rep_id}', 'RepertoireController@createPivot')->name('repCreatePivot');
Route::get('/repertoire/readRepCheck/{id}/{com_id}/{ins_id}/{gen_id}', 'RepertoireController@readRepCheck')->name('repReadCheck');

//routes for the instruments
Route::get('/instrument/read/{id}/{column}/{val}', 'InstrumentController@read')->name('insRead');

//routes for the composers
Route::get('/composer/read/{id}/{column}/{val}', 'ComposerController@read')->name('comRead');
Route::post('/composer/create/{name}', 'ComposerController@create')->name('comCreate');

//routes for the genres
Route::get('/genre/read/{id}/{column}/{val}', 'RepertoireController@read')->name('genRead');


//routes for searching and autofill
Route::get('/autocomplete/composer', 'SearchController@comAutocomplete')->name('comAuto');
Route::get('/autocomplete/repertoire', 'SearchController@repAutocomplete')->name('repAuto');
Route::get('/autocomplete/genre', 'SearchController@genAutocomplete')->name('genAuto');
Route::get('/autocomplete/instrument', 'SearchController@insAutocomplete')->name('insAuto');
Route::get('/search/getAttribute/{table}/{wanted}/{col}/{value}', 'SearchController@getWantedAttribute')->name('getAttribute');