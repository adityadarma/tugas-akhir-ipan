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

/*use Illuminate\Routing\Route;*/
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@loginPost')->name('login-post');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']] , function(){
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('pelanggan', 'pelangganController@data')->name('pelanggan.index');
    Route::get('pelanggan/tambah', 'pelangganController@tambah')->name('pelanggan.tambah');
    Route::post('pelanggan', 'pelangganController@tambahProcess')->name('pelanggan.save');
    Route::get('pelanggan/ubah/{id}', 'pelangganController@ubah')->name('pelanggan.edit');
    Route::post('pelanggan/ubah/{id}', 'pelangganController@update')->name('pelanggan.update');
    Route::delete('pelanggan/{id}', 'pelangganController@delete')->name('pelanggan.delete');
    
    
    Route::get('vendor', 'VendorController@data')->name('home');
    Route::get('vendor/tambah', 'VendorController@tambah')->name('home');
    Route::post('vendor', 'VendorController@tambahProcess')->name('home');
    Route::get('vendor/ubah/{id}', 'VendorController@ubah')->name('home');
    Route::post('vendor/ubah/{id}', 'VendorController@update')->name('home');
    Route::delete('vendor/{id}', 'VendorController@delete');
    
    Route::get('barang', 'BarangController@data');
    Route::get('barang/tambah', 'BarangController@tambah');
    Route::post('barang', 'BarangController@tambahProcess');
    Route::get('barang/ubah/{id}', 'BarangController@ubah');
    Route::post('barang/ubah/{id}', 'BarangController@update');
    Route::delete('barang/{id}', 'BarangController@delete');
    
    Route::get('pesanan', 'PesananController@data');
    Route::get('pesanan/detail/{id}', 'PesananController@detail');
    // Route::get('pesanan/tambah', 'PesananController@tambah');
    Route::get('pesanan/tambah/{ID_Pelanggan}', 'PesananController@tambah');
    Route::post('pesanan/posting', 'PesananController@tambahProcess');
    Route::get('pesanan/dcetak/{ID_PESANAN}', 'PesananController@detailcetak');
    Route::get('pesanan/cetak', 'PesananController@cetak');
    Route::get('pesanan/ubah/{ID_PESANAN}', 'PesananController@ubah');
    
    Route::get('aruskas', 'AruskasController@data');
    Route::get('aruskas/tambah', 'AruskasController@tambah');
    Route::post('aruskas', 'AruskasController@tambahProcess');
    Route::get('aruskas/detail', 'AruskasController@detail');
    Route::get('aruskas/ubah/{id}', 'AruskasController@ubah');
    Route::post('aruskas/ubah/{id}', 'AruskasController@update');
    
    Route::get('pelunasan', 'PelunasanController@data');
    Route::get('pelunasan/tambah', 'PelunasanController@tambah');
    Route::get('pelunasan/proses/{id}', 'PelunasanController@tambahProcces');
    Route::post('pelunasan', 'PelunasanController@insert');
    Route::get('pelunasan/detail', 'PelunasanController@detail');
    Route::get('pelunasan/dcetak/{ID_PELUNASAN}', 'PelunasanController@detailcetak');
    Route::get('pelunasan/cetak', 'PelunasanController@cetak');
    
    
    Route::get('user', 'UserController@data');
    Route::get('user/cari', 'UserController@cari');
    
    Route::group(array('prefix' => 'larangkuman'), function()
    {
        Route::get('/lapel', 'LaporanController@lapel');
        Route::get('/laprang', 'LaporanController@laprang');
        Route::get('/cetak/{tglawal}/{tglakhir}', 'LaporanController@cetaklapel');
        Route::get('/cetak/{tglawal}/{tglakhir}', 'LaporanController@cetaklaprang');
    });
});