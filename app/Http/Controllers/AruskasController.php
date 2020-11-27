<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AruskasController extends Controller
{
    public function data()
    {
        $aruskas = DB::table('aruskas')->get();
        //return $pelanggan;
        return view('aruskas.data',compact('aruskas'));
        //return $pelanggan->count();
    }
    public function tambah()
    {
        $kode = DB::table('aruskas')->max('ID_TRANSAKSI');
        $kodeP = $kode;
        $urutan = (int) substr($kodeP, 3, 3);
        $urutan++;
        $huruf = "AK";
        $kodeP = $huruf . sprintf("%03s", $urutan);
        return view('aruskas.tambah', compact('kodeP'));
        // return view('aruskas.tambah');
    }
    public function tambahProcess(Request $request)
    {
        DB::table('aruskas')->insert(
            [
            'ID_Transaksi' => $request->ID_Transaksi,
            'ID_User' => $request->ID_User,
            'Tanggal' => $request->Tanggal,
             'Keterangan' => $request->Keterangan,
             'Status' => $request->Status,
             'Jenis_transaksi' => $request->Jenis_transaksi,
             'Jumlah_tunai' => $request->Jumlah_tunai
            ]);
            return redirect('aruskas')->with('status', 'Data Berhasil Di Tambahkan');
    }
    public function detail()
    {
        $aruskas = DB::table('aruskas')->get();
        //return $pelanggan;
        return view('aruskas.detail',compact('aruskas'));
        //return $pelanggan->count();
    }
    public function ubah($id)
    {
        $aruskas = DB::table('aruskas')->where('ID_Transaksi',$id)->first();
        return view('aruskas.ubah',compact('aruskas'));
    }
    public function update(Request $request,$id)
    {
        DB::table('aruskas')->where('ID_TRANSAKSI', '=', $id)->update
        ([
            'ID_Transaksi' => $request->ID_TRANSAKSI,
            'ID_User' => $request->ID_USER,
            'Tanggal' => $request->TANGGAL,
             'Keterangan' => $request->KETERANGAN,
             'Status' => $request->STATUS,
             'Jenis_transaksi' => $request->JENIS_TRANSAKI,
             'Jumlah_tunai' => $request->JUMLAH_TUNAI
        ]);
        return redirect('aruskas')->with('status', 'PAHAAMMM');
    }
}
