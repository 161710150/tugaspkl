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
    return view('welcome');
});
Route::resource('jenis','JenisBukuController');
Route::get('jsonjenisbuku','JenisBukuController@json');
Route::post('storejenisbuku','JenisBukuController@store')->name('storejenisbuku');
Route::get('ajaxdata/removejenisbuku', 'JenisBukuController@removedatajenisbuku')->name('ajaxdata.removejenisbuku');
Route::post('jenisbaru/{id}','JenisBukuController@update');
Route::get('jenis/getedit/{id}','JenisBukuController@edit');

Route::resource('buku','BukuController');
Route::get('jsonbuku','BukuController@json');
Route::get('bukuperpus','BukuController@index');
Route::post('storebuku','BukuController@store');
Route::get('editbuku/{id}','BukuController@edit');
Route::post('updatebuku/{id}','BukuController@update');
Route::get('deletebuku','BukuController@removedatabuku')->name('delete.buku');

Route::resource('anggota','AnggotaController');
Route::get('anggotaindex','AnggotaController@index');
Route::get('jsonanggota','AnggotaController@json');
Route::post('storeanggota','AnggotaController@store');
Route::get('editanggota/{id}','AnggotaController@edit');
Route::post('updateanggota/{id}','AnggotaController@update');
Route::get('deleteanggota','AnggotaController@removedataanggota')->name('delete.anggota');

Route::resource('pinjam','PinjamkmblController');
Route::get('jsonpinjam','PinjamkmblController@json');
Route::get('pinjamindex','PinjamkmblController@index');
Route::post('storepinjam','PinjamkmblController@store');
Route::get('editpinjam/{id}','PinjamkmblController@edit');
Route::post('updatepinjam/{id}','PinjamkmblController@update');

Route::get('myform/kbl/{id}',array('as'=>'myform.ajax','uses'=>'PinjamkmblController@getdataedit'));
Route::get('pengembalian','PinjamkmblController@index2')->name('pengembalian');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
