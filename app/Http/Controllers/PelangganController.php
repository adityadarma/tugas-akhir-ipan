<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $data['pelanggan'] = DB::table('pelanggan')->whereNull('deleted_at')->get();

        return view('pelanggan.index', $data);
    }

    public function tambah()
    {
        $data['kode'] = $this->_kodePelanggan();

        return view('pelanggan.tambah', $data);
    }

    public function tambahProcess(Request $request)
    {
        $request->validate([
            "kode" => 'required|string|unique:pelanggan,kode',
            "nama" => 'required|string',
            "alamat" => 'required|string',
            "email" => 'required|string|email',
            "no_telp" => 'required|string',
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        DB::table('pelanggan')->insert([
            'kode' => $request->kode,
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
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        DB::table('pelanggan')->where('id', '=', $id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp
        ]);

        return redirect()->route('pelanggan.index')->with('status', 'Data Berhasil Di Perbaharui');
    }

    public function hapus($id)
    {
        DB::table('pelanggan')->where('id', $id)->update([
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

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
