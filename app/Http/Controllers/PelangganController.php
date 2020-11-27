<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function data()
    {
        $data['pelanggan'] = DB::table('pelanggan')->get();

        return view('pelanggan.data', $data);
    }

    public function tambah()
    {
        return view('pelanggan.tambah');
    }

    public function tambahProcess(Request $request)
    {
        $request->validate([
            "nama" => 'required|string',
            "alamat" => 'required|string',
            "email" => 'required|string|email',
            "no_telp" => 'required|string',
        ]);

        DB::table('pelanggan')->insert([
            'kode' => $this->_kodePelanggan(),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp
        ]);

        return redirect()->route('pelanggan.index')->with('status', 'Data Berhasil Di Tambahkan');
    }

    public function ubah($id)
    {
        $data['pelanggan'] = DB::table('pelanggan')->where('id',$id)->first();

        return view('pelanggan.ubah',$data);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            "nama" => 'required|string',
            "alamat" => 'required|string',
            "email" => 'required|string|email',
            "no_telp" => 'required|string',
        ]);

        DB::table('pelanggan')->where('id', '=', $id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp
        ]);

        return redirect()->route('pelanggan.index')->with('status', 'Data Berhasil Di Perbaharui');
    }

    public function delete($id)
    {
        DB::table('pelanggan')->where('id', $id)->delete();

        return redirect()->route('pelanggan.index')->with('status', 'Data Berhasil Di Hapus');
    }

    private function _kodePelanggan()
    {
        $kode = DB::table('pelanggan')->max('kode');
        $kodeP = $kode;
        $urutan = (int) substr($kodeP, 3, 3);
        $urutan++;
        $huruf = "P";
        return $huruf . sprintf("%03s", $urutan);
    }
}