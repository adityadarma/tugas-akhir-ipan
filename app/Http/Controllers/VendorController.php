<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VendorController extends Controller
{
    public function index()
    {
        $data['vendor'] = DB::table('vendor')->get();
        
        return view('vendor.index',$data);
    }

    public function tambah()
    {
        $data['kode'] = $this->_kodeVendor();

        return view('vendor.tambah', $data);
    }

    public function tambahProcess(Request $request)
    {
        $request->validate([
            "kode" => 'required|string|unique:vendor,kode',
            "nama" => 'required|string',
            "alamat" => 'required|string',
            "email" => 'required|string|email',
            "no_telp" => 'required|string',
        ]);

        DB::table('vendor')->insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp
        ]);
        
        return redirect()->route('vendor.index')->with('status', 'Data Berhasil Di Tambahkan');
    }

    public function ubah($id)
    {
        $data['vendor'] = DB::table('vendor')->where('id',$id)->first();

        return view('vendor.ubah', $data);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            "nama" => 'required|string',
            "alamat" => 'required|string',
            "email" => 'required|string|email',
            "no_telp" => 'required|string',
        ]);

        DB::table('vendor')->where('id', '=', $id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp
        ]);

        return redirect()->route('vendor.index')->with('status', 'Data Berhasil Di Perbaharui');
    }
    
    public function hapus($id)
    {
        DB::table('vendor')->where('id', $id)->delete();

        return redirect()->route('vendor.index')->with('status', 'Data Berhasil Di Hapus');
    }

    private function _kodeVendor()
    {
        $kode = DB::table('vendor')->max('kode');
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = "V";
        return $huruf . sprintf("%03s", $urutan);
    }
}
