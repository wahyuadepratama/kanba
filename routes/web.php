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
    return view('admin.home');
});
Route::get('/kelola-hubungan', function () {
    return view('admin.kelola_hubungan');
});
Route::get('/kelola-jadwal', function () {
    return view('admin.kelola_jadwal');
});
Route::get('/performa', function () {
    return view('admin.performa');
});
Route::get('/kelola-slider', function () {
    return view('admin.kelola_slider');
});
Route::get('/bapak-asuh', function () {
    return view('admin.bapak_asuh');
});
Route::get('/anak-asuh', function () {
    return view('admin.data_anak_asuh');
});
Route::get('/coach', function () {
    return view('coach.home');
});
Route::get('/coach-schedule', function () {
    return view('coach.buat_jadwal');
});
Route::get('/coach-status', function () {
    return view('coach.status');
});
Route::get('/coach-performa', function () {
    return view('coach.performa');
});

Route::get('/admin-login', function () {
    return view('admin.login');
});
Route::get('/coach-login', function () {
    return view('coach.login');
});

// Route::get('/login', function () { return redirect('/login/user/'); });
// Route::post('/login',  'Auth\LoginController@login')->name('login');
// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

