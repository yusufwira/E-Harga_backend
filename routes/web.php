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



Route::resource('pengumuman','PengumumanController');
Route::post('pengumuman/update','PengumumanController@update');

Route::group(['middleware' => 'jwt.auth',], function ($router) {

	Route::resource('user','UserController');
	Route::post('user/update','UserController@update');
	Route::post('user/delete','UserController@destroy');
	Route::post('user/showdetail','UserController@showDetail');

    Route::resource('ssh','SshController');
	Route::post('ssh/update','SshController@update');
	Route::post('ssh/delete','SshController@destroy');
	Route::post('ssh/count','SshController@showCount');
	Route::post('ssh/search','SshController@search');

	Route::resource('sbu','SbuController');
	Route::post('sbu/update','SbuController@update');
	Route::post('sbu/delete','SbuController@destroy');
	Route::post('sbu/count','SbuController@showCount');
	Route::post('sbu/search','SbuController@search');

	Route::resource('hspk','HspkController');
	Route::post('hspk/update','HspkController@update');
	Route::post('hspk/delete','HspkController@destroy');
	Route::post('hspk/ssh','HspkController@storessh');
	Route::post('hspk/sbu','HspkController@storesbu');
	Route::post('hspk/harga','HspkController@updateHarga');
	Route::post('hspk/count','HspkController@showCount');
	Route::post('hspk/limit','HspkController@indexlimit');
	Route::post('hspk/search','HspkController@search');


	Route::resource('asb','AsbController');
	Route::post('asb/update','AsbController@update');
	Route::post('asb/delete','AsbController@destroy');
	Route::post('asb/ssh','AsbController@storessh');
	Route::post('asb/hspk','AsbController@storehspk');
	Route::post('asb/harga','AsbController@updateHarga');
	Route::post('asb/count','AsbController@showCount');
	Route::post('asb/search','AsbController@search');
   
	Route::resource('usulan','UsulanController');
	Route::post('usulan/jumlah','UsulanController@showCount');
	Route::get('suratUsulan','UsulanController@indexSurat');
	Route::get('usersusulan','UsulanController@suratPerUsers');
	Route::get('downloadSuratUsulan','UsulanController@downloadFileUsulan');
	Route::post('usulan/update','UsulanController@update');
	Route::post('usulan/delete','UsulanController@destroy');

	Route::resource('usulanbaru','UsulanBaruController');
	Route::post('usulanbaru/update','UsulanBaruController@update');
	Route::post('usulanbaru/delete','UsulanBaruController@destroy');
	Route::post('usulanbaru/count','UsulanBaruController@showCount');
	Route::post('usulanbaru/updatestatus','UsulanBaruController@updateStatus');
	Route::get('usulanbarupenyusun/','UsulanBaruController@indexPenyusun');
	Route::post('usulanbarupenyusun/count','UsulanBaruController@showCountPenyusun');

	Route::resource('notif','NotifController');
	Route::post('notif/tampil','NotifController@tampilkan');

});




