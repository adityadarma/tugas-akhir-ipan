<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PelunasanController extends Controller
{
    public function data()
    {
        $pelunasan = DB::table('pelunasan')->get();
        return view('pelunasan.data',compact('pelunasan'));
        //return $pelanggan->count();
    }
    public function tambah(Request $request)
    {
        if ($request->has('idpesan')) {
            $pesanan = DB::table('pesanans')
            ->join('pelanggans','pelanggans.ID_PELANGGAN', '=', 'pesanans.ID_PELANGGAN')
            ->select('pelanggans.ID_PELANGGAN','pesanans.*')
            ->where('pesanans.TGL_PESANAN','like',"%".$request->idpesan."%")->get();
            return view('pelunasan.tambah',['pesanan'=>$pesanan]);
        }else{
            $pesanan = DB::table('pesanans')
            ->join('pelanggans',
            'pelanggans.ID_PELANGGAN', '=', 'pesanans.ID_PELANGGAN')
            ->select(
                'pelanggans.ID_PELANGGAN',
                'pesanans.*'
            )
            ->get();
            return view('pelunasan.tambah',compact('pesanan'));
        }
    }
    public function tambahProcces($id)
    {

        $pesanans = DB::table('pesanans')
        ->join('pelanggans','pelanggans.ID_PELANGGAN','=','pesanans.ID_PELANGGAN')
        ->where('ID_PESANAN',$id)
        ->first();
        //kode
        $kode = DB::table('pelunasan')->max('ID_PELUNASAN');
        $kodeP = $kode;
        $urutan = (int) substr($kodeP, 3, 3);
        $urutan++;
        $huruf = "L";
        $kodeP = $huruf . sprintf("%03s", $urutan);
        return view('pelunasan.proses',compact('pesanans','kodeP'));
    }
    public function insert(Request $request){
        DB::table('pelunasan')->insert(
            [
                'ID_PELUNASAN'=>$request->ID_PELUNASAN,
                'ID_PESANAN'=>$request->ID_PESANAN,
                'ID_USER'=>$request->ID_USER,
                'ID_PELANGGAN'=>$request->ID_PELANGGAN,
                'NAMA'=>$request->NAMA,
                'TGL_PESAN'=>$request->TGL_PESAN,
                'TGL_PELUNASAN'=>$request->TGL_PELUNASAN,
                'PESANAN'=>$request->PESANAN,
                'JUMLAH'=>$request->JUMLAH,
                'DISKON'=>$request->DISKON,
                'HARGA_TOTAL'=>$request->HARGA_TOTAL,
                'KET'=>$request->KET
            ]
        );
        return redirect('pelunasan')->with('status', 'PAHAAMMM');
    }
    public function detail()
    {
        $pelunasan = DB::table('pelunasan')->get();
        //return $pelanggan;
        return view('pelunasan.detail',compact('pelunasan'));
        //return $pelanggan->count();
    }
    public function cetak()
    {
        $pelunasan = DB::table('pelunasan')->get();

        return view('pelunasan.dcetak',compact('pelunasan'));
    }
    public function detailcetak($ID_PELUNASAN)
    {
        $pelunasan = DB::table('pelunasan')->where ('ID_PELUNASAN',$ID_PELUNASAN)->get();

        return view('pelunasan.cetak',compact('pelunasan'));
    }

}
