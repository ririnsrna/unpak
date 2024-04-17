<?php

use App\Models\Suratmasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;

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
    return view('welcome');
});

// AKHIRNYA

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('suratmasuk/ekspor', [SuratMasukController::class, 'ekspor'])->name('suratmasuk.ekspor');
    Route::get('suratkeluar/ekspor', [SuratKeluarController::class, 'ekspor'])->name('suratkeluar.ekspor');
    Route::get('disposisi/ekspor', [DisposisiController::class, 'ekspor'])->name('disposisi.ekspor');
    // Detail
    Route::get('/detail/{id}', 'App\Http\Controllers\SuratkeluarController@Detail');
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);

    // Masuk
    Route::get('suratmasuk', ['as' => 'pages.suratmasuk', 'uses' => 'App\Http\Controllers\SuratMasukController@index']);
    Route::get('/detailmasuk/{id}', 'App\Http\Controllers\SuratMasukController@Detail');
    Route::get('/deletemasuk/{no_surat}', 'App\Http\Controllers\SuratMasukController@destroy');
    Route::get('/updatemasuk/{no_surat}', 'App\Http\Controllers\SuratMasukController@edit');
    Route::put('/updatepostmasuk/{id}', 'App\Http\Controllers\SuratMasukController@update');
    Route::get('suratmasuk/create', ['as' => 'suratmasuk.create', 'uses' => 'App\Http\Controllers\SuratMasukController@create']);
    Route::put('suratmasuk/save', ['as' => 'suratmasuk.save', 'uses' => 'App\Http\Controllers\SuratMasukController@save']);
    // Keluar
    Route::get('suratkeluar', ['as' => 'pages.suratkeluar', 'uses' => 'App\Http\Controllers\SuratKeluarController@index']);
    Route::get('/detailkeluar/{id}', 'App\Http\Controllers\SuratKeluarController@Detail');
    Route::get('/deletekeluar/{id}', 'App\Http\Controllers\SuratKeluarController@destroy');

    Route::get('/cetak_data/{id}', 'App\Http\Controllers\SuratKeluarController@cetak');

    Route::get('/updatekeluar/{id}', 'App\Http\Controllers\SuratKeluarController@edit');
    Route::put('/updatepostkeluar/{id}', 'App\Http\Controllers\SuratKeluarController@update');
    Route::get('suratkeluar/create', ['as' => 'suratkeluar.create', 'uses' => 'App\Http\Controllers\SuratKeluarController@create']);
    Route::put('suratkeluar/save', ['as' => 'suratkeluar.save', 'uses' => 'App\Http\Controllers\SuratKeluarController@save']);
    // Disposisi Masuk
    Route::get('disposisi', ['as' => 'pages.disposisi', 'uses' => 'App\Http\Controllers\DisposisiController@index']);
    Route::get('/deletedisposisi/{id}', 'App\Http\Controllers\DisposisiController@destroy');
    Route::get('/disposisimasuk/{id}', 'App\Http\Controllers\SuratMasukController@editDisposisi')->name('disposisi.create');
    Route::put('/disposisipostmasuk/{id}', 'App\Http\Controllers\SuratMasukController@updateDisposisi');
    Route::get('disposisi/{id}/edit', [DisposisiController::class, 'edit'])->name('disposisi.edit');
    Route::get('disposisi/{id}', [DisposisiController::class, 'show'])->name('disposisi.show');
    Route::put('disposisi/{id}', [DisposisiController::class, 'update'])->name('disposisi.update');
    // Batas

    // Batas
    Route::get('profile', [UserController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});
