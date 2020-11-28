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
    Route::get('pelanggan', 'PelangganController@data')->name('pelanggan.index');
    Route::get('pelanggan/tambah', 'PelangganController@tambah')->name('pelanggan.tambah');
    Route::post('pelanggan', 'PelangganController@tambahProcess')->name('pelanggan.simpan');
    Route::get('pelanggan/ubah/{id}', 'PelangganController@ubah')->name('pelanggan.ubah');
    Route::post('pelanggan/ubah/{id}', 'PelangganController@update')->name('pelanggan.update');
    Route::delete('pelanggan/{id}', 'PelangganController@delete')->name('pelanggan.delete');
    
    Route::get('vendor', 'VendorController@data')->name('vendor.index');
    Route::get('vendor/tambah', 'VendorController@tambah')->name('vendor.tambah');
    Route::post('vendor', 'VendorController@tambahProcess')->name('vendor.simpan');
    Route::get('vendor/ubah/{id}', 'VendorController@ubah')->name('vendor.ubah');
    Route::post('vendor/ubah/{id}', 'VendorController@update')->name('vendor.update');
    Route::delete('vendor/{id}', 'VendorController@delete')->name('vendor.delete');
    
    Route::get('barang', 'BarangController@data')->name('barang.index');
    Route::get('barang/tambah', 'BarangController@tambah')->name('barang.tambah');
    Route::post('barang', 'BarangController@tambahProcess')->name('barang.simpan');
    Route::get('barang/ubah/{id}', 'BarangController@ubah')->name('barang.ubah');
    Route::post('barang/ubah/{id}', 'BarangController@update')->name('barang.update');
    Route::delete('barang/{id}', 'BarangController@delete')->name('barang.delete');
    
    Route::get('pesanan', 'PesananController@data')->name('pesanan.index');
    Route::get('pesanan/detail/{id}', 'PesananController@detail')->name('pesanan.detail');
    // Route::get('pesanan/tambah', 'PesananController@tambah');
    Route::get('pesanan/tambah/{ID_Pelanggan}', 'PesananController@tambah')->name('pesanan.index');
    Route::post('pesanan/posting', 'PesananController@tambahProcess')->name('pesanan.index');
    Route::get('pesanan/dcetak/{ID_PESANAN}', 'PesananController@detailcetak')->name('pesanan.index');
    Route::get('pesanan/cetak', 'PesananController@cetak')->name('pesanan.index');
    Route::get('pesanan/ubah/{ID_PESANAN}', 'PesananController@ubah')->name('pesanan.index');
    
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