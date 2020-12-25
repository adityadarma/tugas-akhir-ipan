<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Pesanan;
use Illuminate\Http\Request;

class HutangPiutangController extends Controller
{
    public function index(Request $request){
        $post = $request->all();
        $data = $post;
            
        if($post){
            $data['pesanan'] = Pesanan::leftJoin('pelunasan','pelunasan.pesanan_id','=','pesanan.id')
            ->join('pelanggan','pelanggan.id','=','pesanan.pelanggan_id')
            ->whereBetween('pesanan.tgl_pesanan',[date('Y-m-d', strtotime(($post['awal']))), date('Y-m-d', strtotime(($post['akhir'])))])
            ->select('pelanggan.nama as nama_pelanggan','pesanan.*','pelunasan.pembayaran','pelunasan.keterangan','pelunasan.tgl_pelunasan')
            ->oldest('pesanan.id')
            ->get();
        }

        return view('laporan.hutang-piutang.index', $data);
    }

    public function print(Request $request){
        $post = $request->all();

        $data['pesanan'] = Pesanan::leftJoin('pelunasan','pelunasan.pesanan_id','=','pesanan.id')
            ->join('pelanggan','pelanggan.id','=','pesanan.pelanggan_id')
            ->whereBetween('pesanan.tgl_pesanan',[date('Y-m-d', strtotime(($post['awal']))), date('Y-m-d', strtotime(($post['akhir'])))])
            ->select('pelanggan.nama as nama_pelanggan','pesanan.*','pelunasan.pembayaran','pelunasan.keterangan','pelunasan.tgl_pelunasan')
            ->oldest('pesanan.id')
            ->get();

        return view('laporan.hutang-piutang.print', $data);
    }
}
