<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function lapel(){
        return view('lapelanggan.lapel');
    }
    public function laprang(){
        return view('larangkuman.laprang');
    }
    public function cetaklaprang(Request $request, $tglawal, $tglakhir){
        ($request->has('tglawal','tglakhir'));
        $pelanggan = DB::table('pelanggans')->get();
        $pesanan = DB::table('pesanans')
        ->whereBetween('TGL_PESANAN',[$tglawal, $tglakhir])
        ->get();
        return view('larangkuman.cetak',compact('pesanan','pelanggan'));
    }
    // public function cetaklaprang(Request $request, $tglawal, $tglakhir){
    //     ($request->has('tglawal','tglakhir'));
    //     $pesanan = DB::table('pesanans')->whereBetween('TGL_PESANAN',[$tglawal, $tglakhir])->get();
    //     return view('larangkuman.cetak',compact('pesanan'));
    // }
}
