<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Pesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PerpelangganController extends Controller
{
    public function index(Request $request){
        $post = $request->all();
        $data = $post;
            
        if($post){
            $data['pelanggan'] = Pesanan::join('pelanggan','pelanggan.id','pesanan.pelanggan_id')
            ->whereBetween('pesanan.tgl_pesanan',[date('Y-m-d', strtotime(($post['awal']))), date('Y-m-d', strtotime(($post['akhir'])))])
            ->select('pelanggan.nama as nama_pelanggan','pelanggan.kode as kode_pelanggan','pesanan.*')
            ->get()
            ->groupBy('nama_pelanggan');
        }

        return view('laporan.perpelanggan.index', $data);
    }

    public function print(Request $request){
        $post = $request->all();

        $data['pelanggan'] = Pesanan::join('pelanggan','pelanggan.id','pesanan.pelanggan_id')
            ->whereBetween('pesanan.tgl_pesanan',[date('Y-m-d', strtotime(($post['awal']))), date('Y-m-d', strtotime(($post['akhir'])))])
            ->select('pelanggan.nama as nama_pelanggan','pelanggan.kode as kode_pelanggan','pesanan.*')
            ->get()
            ->groupBy('nama_pelanggan');

        return view('laporan.perpelanggan.print', $data);
    }
}
