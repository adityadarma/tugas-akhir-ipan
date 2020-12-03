<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RangkumanController extends Controller
{
    public function index(Request $request){
        $post = $request->all();
        $data = $post;
            
        if($post){
            $data['pesanan'] = DB::table('pesanan')
            ->join('pelanggan','pelanggan.id','pesanan.pelanggan_id')
            ->join('barang','barang.id','pesanan.barang_id')
            ->whereBetween('pesanan.tgl_pesanan',[date('Y-m-d', strtotime(($post['awal']))), date('Y-m-d', strtotime(($post['akhir'])))])
            ->select('pelanggan.nama as nama_pelanggan','pesanan.*','barang.jenis')
            ->oldest('pesanan.id')
            ->get();
        }

        return view('laporan.rangkuman.index', $data);
    }

    public function print(Request $request){
        $post = $request->all();

        $data['pesanan'] = DB::table('pesanan')
            ->join('pelanggan','pelanggan.id','pesanan.pelanggan_id')
            ->join('barang','barang.id','pesanan.barang_id')
            ->whereBetween('pesanan.tgl_pesanan',[date('Y-m-d', strtotime(($post['awal']))), date('Y-m-d', strtotime(($post['akhir'])))])
            ->select('pelanggan.nama as nama_pelanggan','pesanan.*','barang.jenis')
            ->oldest('pesanan.id')
            ->get();

        return view('laporan.rangkuman.print', $data);
    }
}
