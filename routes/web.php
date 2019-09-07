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
Route::get('/', 'Auth\LoginController@coachLoginForm');
Route::get('/login', 'Auth\LoginController@coachLoginForm');
Route::get('/coach-login', 'Auth\LoginController@coachLoginForm');

Route::get('/admin', 'Auth\LoginController@adminLoginForm');
Route::get('/admin-login', 'Auth\LoginController@adminLoginForm');

Route::post('/login',  'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');



Route::group(['middleware' => ['auth','auth.admin']], function(){

  Route::get('/admin/home', 'Admin\HomeController@index');

  Route::get('/admin/kelola-hubungan', 'Admin\CoachTraineeController@index');
  Route::get('/admin/kelola-hubungan/destroy/{id}', 'Admin\CoachTraineeController@destroyTrainee');
  Route::post('/admin/kelola-hubungan/trainee/get', 'Admin\CoachTraineeController@getTrainee');
  Route::post('/admin/kelola-hubungan/update/{id}', 'Admin\CoachTraineeController@update');

  Route::get('/admin/kelola-jadwal', 'Admin\ScheduleController@index');
  Route::get('/admin/kelola-jadwal/reminder-otomatis/{nik}', 'Admin\ScheduleController@reminderAutomatic');
  Route::post('/admin/kelola-jadwal/reminder-manual', 'Admin\ScheduleController@reminderManual');

  Route::get('/admin/performa', 'Admin\PerformaController@index');
  Route::get('/admin/performa/export', 'Admin\PerformaController@export');

  Route::get('/admin/kelola-slider', 'Admin\SliderController@index');
  Route::post('admin/kelola-slider/update/{id}', 'Admin\SliderController@update');

  Route::get('/admin/bapak-asuh', 'Admin\UserController@indexCoach');
  Route::post('/admin/bapak-asuh/store', 'Admin\UserController@storeCoach');
  Route::get('/admin/bapak-asuh/destroy/{nik}', 'Admin\UserController@destroyCoach');

  Route::get('/admin/anak-asuh', 'Admin\UserController@indexTrainee');
  Route::post('/admin/anak-asuh/store', 'Admin\UserController@storeTrainee');
  Route::get('/admin/anak-asuh/destroy/{nik}', 'Admin\UserController@destroyTrainee');
});



Route::group(['middleware' => ['auth','auth.user']], function () {
  Route::get('/coach', function () { return view('coach.home'); });

  Route::get('/coach-schedule', 'Coach\ScheduleController@index');
  Route::post('/coach-schedule/store', 'Coach\ScheduleController@store');
  Route::post('/coach-schedule/destroy/{id}', 'Coach\ScheduleController@destroy');
  Route::post('/coach-schedule/filter', 'Coach\ScheduleController@filter');

  Route::get('/coach-status', 'Coach\CoachTraineeController@index');
  Route::post('/coach-status/upload', 'Coach\CoachTraineeController@upload');
  Route::post('/coach-status/filter', 'Coach\CoachTraineeController@filter');

  Route::get('/coach-performa', 'Coach\PerformaController@index');

});
