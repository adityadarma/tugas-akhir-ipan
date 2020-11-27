<?php

namespace App\Http\Controllers;

use App\pelanggan;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class pelangganController extends Controller
{
    public function data()
    {
        $pelanggan = DB::table('pelanggans')->get();
        return view('pelanggan.data',compact('pelanggan'));
    }

    public function detail($id)
    {
        $pelanggan = DB::table('pelanggans')->where('ID_PELANGGAN', '=', $id)->first();

        return view('pelanggan.detail', compact('pelanggans'));
    }

    public function tambah()
    {
        $pelanggan = DB::table('pelanggans');
        $kode = DB::table('pelanggans')->max('ID_PELANGGAN');
        $kodeP = $kode;
        $urutan = (int) substr($kodeP, 3, 3);
        $urutan++;
        $huruf = "P";
        $kodeP = $huruf . sprintf("%03s", $urutan);
        return view('pelanggan.tambah',compact('pelanggan','kodeP'));
    }

    public function tambahProcess(Request $request)
    {
        $request->validate([
            "ID_PELANGGAN" => 'unique:pelanggans,ID_PELANGGAN',
            //"ID_User" => 'unique:pelanggan,ID_User',
            "ID_PELUNASAN" => 'unique:pelanggans,ID_PELUNASAN',
        ]);

        DB::table('pelanggans')->insert(
            [
            'ID_PELANGGAN' => $request->ID_PELANGGAN,
            'ID_USER' => $request->ID_USER,
            // 'ID_PELUNASAN' => $request->ID_PELUNASAN,
            'NAMA_PELANGGAN' => $request->NAMA_PELANGGAN,
             'ALAMAT_PELANGGAN' => $request->ALAMAT_PELANGGAN,
             'EMAIL_PELANGGAN' => $request->EMAIL_PELANGGAN,
             'NO_TELP' => $request->NO_TELP
            ]);

            //  $barang = DB::table('tbbarang')->get();

            return redirect('pelanggan')->with('status', 'Data Berhasil Di Tambahkan');
    }
    public function ubah($id)
    {
        $pelanggan = DB::table('pelanggans')->where('ID_Pelanggan',$id)->first();
        return view('pelanggan.ubah',compact('pelanggan'));
    }
    public function update(Request $request,$id)
    {
        DB::table('pelanggans')->where('ID_PELANGGAN', '=', $id)->update
        ([
            'ID_PELANGGAN' => $request->ID_PELANGGAN,
            'ID_USER' => $request->ID_USER,
            // 'ID_Pelunasan' => $request->ID_Pelunasan,
            'NAMA_PELANGGAN' => $request->NAMA_PELANGGAN,
             'ALAMAT_PELANGGAN' => $request->ALAMAT_PELANGGAN,
             'EMAIL_PELANGGAN' => $request->EMAIL_PELANGGAN,
             'NO_TELP' => $request->NO_TELP
        ]);
        return redirect('pelanggan')->with('status', 'PAHAAMMM');
    }
    public function delete($id)
    {
        DB::table('pelanggans')->where('ID_Pelanggan', $id)->delete();
        return redirect('pelanggan')->with('status', 'PAHAAMMM');
    }
}
