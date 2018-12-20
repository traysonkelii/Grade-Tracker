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
//[root]
Route::get('/', 'ContentsController@login')->name('login');

//autofill
Route::get('/autocomplete/composer', 'SearchController@comAutocomplete')->name('comAuto');
Route::get('/autocomplete/repertoire', 'SearchController@repAutocomplete')->name('repAuto');
Route::get('/autocomplete/genre', 'SearchController@genAutocomplete')->name('genAuto');
Route::get('/autocomplete/instrument', 'SearchController@insAutocomplete')->name('insAuto');

//composers
Route::get('/composer/read/{id}/{column}/{val}', 'ComposerController@read')->name('comRead');
Route::post('/composer/create/{name}', 'ComposerController@create')->name('comCreate');

//forms
Route::post('/form/createFormAttribute', 'FormBuilderController@createFormAttribute')->name('formCreateAttributes');
Route::post('/form/createForm', 'FormBuilderController@createForm')->name('formCreate');
Route::get('/form/view/{form_id}', 'FormBuilderController@viewForm')->name('formView');
Route::get('/form/getAttribute/{id}', 'FormBuilderController@getAttribute')->name('formGetAttribute');
Route::get('/form/student/{student_id}', 'FormBuilderController@studentFill')->name('formStudentFill');

//genre
Route::get('/genre/read/{id}/{column}/{val}', 'RepertoireController@read')->name('genRead');

//home
Route::post('/home', 'ContentsController@home')->name('home');

//instruments
Route::get('/instrument/read/{id}/{column}/{val}', 'InstrumentController@read')->name('insRead');

//jury
Route::get('/jury/form-builder', 'JuryController@formBuilder')->name('jury-form');
Route::get('/jury/assign', 'JuryController@formAssign')->name('jury-assign');

//landing
Route::post('/landing', 'ContentsController@landing')->name('getLanding');

//performance
Route::post('/performance/create', 'PerformanceController@addToPerformance')->name('performanceCreate');

//practice
Route::get('/practice/{student_id}', 'PracticeController@home')->name('practice');
Route::post('/practice/{student_id}', 'PracticeController@home')->name('practice');
Route::post('/practice/add/{rep_stu_id}/{start}/{stop}', 'PracticeController@addPractice')->name('addPractice');
Route::get('/practice/editList/{student_id}/{rep_stu_id}/{val}', 'PracticeController@editList')->name('editPracticeList');

//repertoires
Route::get('/repertoire/{student_id}', 'RepertoireController@index')->name('repertoire');
Route::post('/repertoire/updateStatus/{student_id}/{repertoire_id}/{type}/{val}', 'RepertoireController@updateStatus')->name('updateStatus');
Route::post('/repertoire/update/{rep_stu_id}/{type}/{val}', 'RepertoireController@update')->name('repUpdate');
Route::get('/repertoire/read/{rep_stu_id}/{type}', 'RepertoireController@read')->name('repRead');
Route::post('/repertoire/createRep/{name}/{com_id}/{ins_id}/{gen_id}', 'RepertoireController@createRep')->name('something');
Route::post('/repertoire/createPivot/{stu_id}/{rep_id}', 'RepertoireController@createPivot')->name('repCreatePivot');
Route::get('/repertoire/readRepCheck/{id}/{com_id}/{ins_id}/{gen_id}', 'RepertoireController@readRepCheck')->name('repReadCheck');
Route::post('/repertoire/deletePivotEntry/{id}', 'RepertoireController@deletePivotEntry')->name('deletePivotEntry');

//search
Route::get('/search/getAttribute/{table}/{wanted}/{col}/{value}', 'SearchController@getWantedAttribute')->name('getAttribute');
Route::get('/search/getRepId/{value}', 'SearchController@getRepertoireIds')->name('getRepIds');

//students
Route::post('/student/{student_id}', 'StudentController@home')->name('student');
Route::get('/student', 'StudentController@index');
Route::get('/student/department/{num}', 'StudentController@getStudentByDeptNum')->name('studentByDept');

//teachers
Route::get('/teacher', 'TeacherController@landing')->name('teacher');
Route::get('/teacher/all-students', 'StudentController@index')->name('all_students');
Route::get('/teacher/department/{num}', 'TeacherController@getTeacherByDeptNum')->name('teacherByDept');
Route::post('/teacher/filterCourse', 'TeacherController@filterCourse')->name('teacherFilterCourse');

