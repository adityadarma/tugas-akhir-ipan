<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VendorController extends Controller
{
    public function data()
    {
        $vendor = DB::table('vendor')->get();
        //return $pelanggan;
        return view('vendor.data',compact('vendor'));
        //return $pelanggan->count();
    }
    public function tambah()
    {
        $kode = DB::table('vendor')->max('ID_VENDOR');
        $kodeP = $kode;
        $urutan = (int) substr($kodeP, 3, 3);
        $urutan++;
        $huruf = "V";
        $kodeP = $huruf . sprintf("%03s", $urutan);
        return view('vendor.tambah', compact('kodeP'));
        // return view('vendor.tambah');
    }

    public function tambahProcess(Request $request)
    {
        DB::table('vendor')->insert(
            [
            'ID_VENDOR' => $request->ID_VENDOR,
            'ID_USER' => $request->ID_USER,
            'NAMA_VENDOR' => $request->NANA_VENDOR,
             'ALAMAT_VENDOR' => $request->ALAMAT_VENDOR,
             'EMAIL_VENDOR' => $request->EMAIL_VENDOR,
             'NO_TELEPON' => $request->NO_TELEPON
            ]);
            return redirect('vendor')->with('status', 'Data Berhasil Di Tambahkan');
    }
    public function ubah($id)
    {
        $vendor = DB::table('vendor')->where('ID_VENDOR',$id)->first();
        return view('vendor.ubah',compact('vendor'));
    }
    public function update(Request $request,$id)
    {
        DB::table('vendor')->where('ID_VENDOR', '=', $id)->update
        ([
            'ID_VENDOR' => $request->ID_VENDOR,
            'ID_USER' => $request->ID_USER,
            'NAMA_VENDOR' => $request->NAMA_VENDOR,
             'ALAMAT_VENDOR' => $request->ALAMAT_VENDOR,
             'EMAIL_VENDOR' => $request->EMAIL_VENDOR,
             'NO_TELEPON' => $request->NO_TELEPON
        ]);
        return redirect('vendor')->with('status', 'PAHAAMMM');
    }
    public function delete($id)
    {
        DB::table('vendor')->where('ID_Vendor', $id)->delete();
        return redirect('vendor')->with('status', 'PAHAAMMM');
    }
}
