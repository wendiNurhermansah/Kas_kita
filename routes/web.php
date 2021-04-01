<?php

use Illuminate\Support\Facades\Route;


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
// Route::get('/print', function () {
//     return view('layouts.print');
// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {



    Route::get('/', 'HomeeController@index');
    Route::get('/dashboard', 'HomeeController@index')->name('dashboard');

    Route::prefix('MasterRole')->namespace('masterRole')->name('MasterRole.')->group(function(){
    //role
        Route::get('addpermission/{id}', 'RoleController@permission')->name('role.addpermission');
        Route::post('storePermission', 'RoleController@storePermission')->name('storePermissions');

        Route::post('role/api', 'RoleController@api')->name('role.api');
        Route::get('getPermission/{id}', 'RoleController@getPermission')->name('getPermissions');
        Route::delete('destroyPermission/{name}', 'RoleController@destroyPermission')->name('destroyPermission');
        Route::resource('role', 'RoleController');


    //permissions
        Route::resource('permissions', 'PermissionsController');
        Route::post('permissions/api', 'PermissionsController@api')->name('permissions.api');

        //pengguna
        Route::resource('pengguna', 'PenggunaController');
        Route::post('pengguna/api', 'PenggunaController@api')->name('pengguna.api');
        Route::get('{id}/editPassword', 'PenggunaController@editPassword')->name('editPassword');
        Route::post('{id}/updatePassword', 'PenggunaController@updatePassword')->name('updatePassword');
    });

    Route::prefix('Data')->namespace('data')->name('Data.')->group(function(){
        // anggota
        Route::resource('anggota', 'AnggotaController');
        Route::post('anggota/api', 'AnggotaController@api')->name('anggota.api');

        // kas masuk
        Route::resource('kasMasuk', 'KasmasukController');
        Route::post('kasMasuk/api', 'KasmasukController@api')->name('kasMasuk.api');

        //kas Keluar
        Route::resource('kasKeluar', 'KaskeluarController');
        Route::post('kasKeluar/api', 'KaskeluarController@api')->name('kasKeluar.api');
        Route::get('tambahKasKeluar', 'KaskeluarController@tambahKasKeluar')->name('kasKeluar.tambahKasKeluar');
    });

    Route::prefix('Laporan')->namespace('laporan')->name('Laporan.')->group(function(){
        // laporan Masuk
        Route::get('Laporan/Masuk', 'LaporanController@Masuk')->name('Masuk');
        Route::get('cetakPDF', 'LaporanController@cetakPDF')->name('cetakPDF');

        // laporan Keluar
        Route::get('Laporan/Keluar', 'LaporanController@Keluar')->name('Keluar');
        Route::get('printPDF', 'LaporanController@printPDF')->name('printPDF');

        // Laporan Rekafitulasi
        Route::get('Laporan/Rekafitulasi', 'LaporanController@Rekaf')->name('Rekafitulasi');
        Route::get('cetakRekaf', 'LaporanController@cetakRekaf')->name('cetakRekaf');

    });

});






