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

use Illuminate\Support\Facades\Route;

Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@loginPost')->name('login-post');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']] , function(){
    Route::get('/', 'HomeController@index')->name('index');

    Route::get('pelanggan', 'PelangganController@index')->name('pelanggan.index');
    Route::get('pelanggan/tambah', 'PelangganController@tambah')->name('pelanggan.tambah');
    Route::post('pelanggan', 'PelangganController@tambahProcess')->name('pelanggan.simpan');
    Route::get('pelanggan/ubah/{id}', 'PelangganController@ubah')->name('pelanggan.ubah');
    Route::post('pelanggan/ubah/{id}', 'PelangganController@update')->name('pelanggan.update');
    Route::delete('pelanggan/{id}', 'PelangganController@hapus')->name('pelanggan.hapus');
    
    Route::get('vendor', 'VendorController@index')->name('vendor.index');
    Route::get('vendor/tambah', 'VendorController@tambah')->name('vendor.tambah');
    Route::post('vendor', 'VendorController@tambahProcess')->name('vendor.simpan');
    Route::get('vendor/ubah/{id}', 'VendorController@ubah')->name('vendor.ubah');
    Route::post('vendor/ubah/{id}', 'VendorController@update')->name('vendor.update');
    Route::delete('vendor/{id}', 'VendorController@hapus')->name('vendor.hapus');
    
    Route::get('barang', 'BarangController@index')->name('barang.index');
    Route::get('barang/tambah', 'BarangController@tambah')->name('barang.tambah');
    Route::post('barang', 'BarangController@tambahProcess')->name('barang.simpan');
    Route::get('barang/ubah/{id}', 'BarangController@ubah')->name('barang.ubah');
    Route::post('barang/ubah/{id}', 'BarangController@update')->name('barang.update');
    Route::delete('barang/{id}', 'BarangController@hapus')->name('barang.hapus');
    
    Route::get('pesanan', 'PesananController@index')->name('pesanan.index');
    Route::get('pesanan/tambah', 'PesananController@tambah')->name('pesanan.tambah');
    Route::post('pesanan', 'PesananController@tambahProcess')->name('pesanan.simpan');
    Route::get('pesanan/ubah/{id}', 'PesananController@ubah')->name('pesanan.ubah');
    Route::post('pesanan/ubah/{id}', 'PesananController@update')->name('pesanan.update');
    Route::delete('pesanan/{id}', 'PesananController@hapus')->name('pesanan.hapus');
    Route::get('pesanan/cetak/{id}', 'PesananController@cetak')->name('pesanan.cetak');
    Route::get('pesanan/histori/{id}', 'PesananController@histori')->name('pesanan.histori');

    Route::get('pelunasan', 'PelunasanController@index')->name('pelunasan.index');
    Route::get('pelunasan/tambah', 'PelunasanController@tambah')->name('pelunasan.tambah');
    Route::post('pelunasan', 'PelunasanController@tambahProcces')->name('pelunasan.simpan');
    Route::delete('pelunasan/{id}', 'PelunasanController@hapus')->name('pelunasan.hapus');
    Route::get('pelunasan/cetak/{id}', 'PelunasanController@cetak')->name('pelunasan.cetak');
    
    Route::get('aruskas', 'AruskasController@index')->name('aruskas.index');
    Route::get('aruskas/tambah', 'AruskasController@tambah')->name('aruskas.tambah');
    Route::post('aruskas', 'AruskasController@tambahProcess')->name('aruskas.simpan');
    Route::get('aruskas/ubah/{id}', 'AruskasController@ubah')->name('aruskas.ubah');
    Route::post('aruskas/ubah/{id}', 'AruskasController@update')->name('aruskas.update');
    Route::delete('aruskas/{id}', 'AruskasController@hapus')->name('aruskas.hapus');
    Route::get('aruskas/detail', 'AruskasController@detail')->name('aruskas.detail');
    
    
    Route::get('user', 'UserController@index')->name('user.index');
    Route::get('user/tambah', 'UserController@tambah')->name('user.tambah');
    Route::post('user', 'UserController@tambahProcess')->name('user.simpan');
    Route::get('user/ubah/{id}', 'UserController@ubah')->name('user.ubah');
    Route::post('user/ubah/{id}', 'UserController@update')->name('user.update');
    Route::delete('user/{id}', 'UserController@hapus')->name('user.hapus');
    
    Route::group(array('prefix' => 'laporan'), function()
    {
        Route::get('/perpelanggan', 'Laporan\PerpelangganController@index')->name('laporan.perpelanggan.index');
        Route::get('/perpelanggan/print', 'Laporan\PerpelangganController@print')->name('laporan.perpelanggan.print');

        Route::get('/rangkuman', 'Laporan\RangkumanController@index')->name('laporan.rangkuman.index');
        Route::get('/rangkuman/print', 'Laporan\RangkumanController@print')->name('laporan.rangkuman.print');
        
        Route::get('/hutang-piutang', 'Laporan\HutangPiutangController@index')->name('laporan.hutang-piutang.index');
        Route::get('/hutang-piutang/print', 'Laporan\HutangPiutangController@print')->name('laporan.hutang-piutang.print');

        Route::get('/aruskas', 'Laporan\AruskasController@index')->name('laporan.aruskas.index');
        Route::get('/aruskas/print', 'Laporan\AruskasController@print')->name('laporan.aruskas.print');

        Route::get('/jurnal-penjualan', 'Laporan\JurnalPenjualanController@index')->name('laporan.jurnal-penjualan.index');
        Route::get('/jurnal-penjualan/print', 'Laporan\JurnalPenjualanController@print')->name('laporan.jurnal-penjualan.print');
    });
});