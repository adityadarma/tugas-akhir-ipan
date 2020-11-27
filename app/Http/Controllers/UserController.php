<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function data()
    {
        $user = DB::table('users')->get();
        return view('user.data',compact('user'));
    }
    public function cari(Request $request)
    {
        if ($request->has('cari')) {
            $pesanan = DB::table('pesanans')
            ->join('pelanggans','pelanggans.ID_PELANGGAN', '=', 'pesanans.ID_PELANGGAN')
            ->select('pelanggans.ID_PELANGGAN','pesanans.*')
            ->where('pesanans.ID_PELANGGAN','like',"%".$request->cari."%")
            ->orwhere('pesanans.ID_PESANAN','like',"%".$request->cari."%")
            ->get();
            return view('user.cari',['pesanan'=>$pesanan]);
        }else{
            $pesanan = DB::table('pesanans')
            ->join('pelanggans',
            'pelanggans.ID_PELANGGAN', '=', 'pesanans.ID_PELANGGAN')
            ->select(
                'pelanggans.ID_PELANGGAN',
                'pesanans.*'
            )
            ->get();
            return view('user.cari',compact('pesanan'));
        }
    }
}
