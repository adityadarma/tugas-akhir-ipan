<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AruskasController extends Controller
{
    public function index()
    {
        $data['aruskas'] = DB::table('aruskas')->latest('id')->get();

        return view('aruskas.index',$data);
    }

    public function tambah()
    {
        $data['kode'] = $this->_kodeArusKas();

        return view('aruskas.tambah', $data);
    }

    public function tambahProcess(Request $request)
    {
        $request->validate([
            "kode" => 'required|string|unique:aruskas,kode',
            "tanggal" => 'required',
            "keterangan" => 'required|string',
            "status" => 'required|numeric',
            "jenis_transaksi" => 'required|numeric',
            "nominal" => 'required|numeric',
        ]);

        DB::table('aruskas')->insert([
            'kode' => $request->kode,
            'tanggal' => date('Y-m-d', strtotime($request->tanggal)),
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'jenis_transaksi' => $request->jenis_transaksi,
            'nominal' => $request->nominal,
            'user_id' => auth()->user()->id
        ]);
            
        return redirect()->route('aruskas.index')->with('status', 'Data Berhasil Di Tambahkan');
    }

    public function ubah($id)
    {
        $data['aruskas'] = DB::table('aruskas')->where('id',$id)->first();

        return view('aruskas.ubah',$data);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            "tanggal" => 'required',
            "keterangan" => 'required|string',
            "status" => 'required|numeric',
            "jenis_transaksi" => 'required|numeric',
            "nominal" => 'required|numeric',
        ]);

        DB::table('aruskas')->where('id', '=', $id)->update([
            'tanggal' => date('Y-m-d', strtotime($request->tanggal)),
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'jenis_transaksi' => $request->jenis_transaksi,
            'nominal' => $request->nominal,
            'user_id' => auth()->user()->id
        ]);
            
        return redirect()->route('aruskas.index')->with('status', 'Data Berhasil Di Perbaharui');
    }

    public function hapus($id)
    {
        DB::table('aruskas')->where('id', $id)->delete();

        return redirect()->route('aruskas.index')->with('status', 'Data Berhasil Di Hapus');
    }

    public function print()
    {
        $data['aruskas'] = DB::table('aruskas')->latest('id')->get();

        return view('aruskas.detail',$data);
    }

    private function _kodeArusKas()
    {
        $kode = DB::table('aruskas')->max('kode');
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = "AK";
        return $huruf . sprintf("%03s", $urutan);
    }
}
