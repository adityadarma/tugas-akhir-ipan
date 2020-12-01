<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BarangController extends Controller
{
    public function index()
    {
        $data['barang'] = DB::table('barang')->get();
        
        return view('barang.index',$data);
    }
    public function tambah()
    {
        $data['kode'] = $this->_kodeBarang();

        return view('barang.tambah', $data);
    }

    public function tambahProcess(Request $request)
    {
        $request->validate([
            "kode" => 'required|string|unique:barang,kode',
            "nama" => 'required|string',
            "jenis" => 'required|string',
            "satuan" => 'required|string',
            "stok" => 'required|numeric',
            "harga_jual" => 'required|numeric',
            "harga_beli" => 'required|numeric',
            "harga_peritem" => 'required|numeric',
        ]);
        
        DB::table('barang')->insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'harga_peritem' => $request->harga_peritem,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('barang.index')->with('status', 'Data Berhasil Di Tambahkan');
    }
    public function ubah($id)
    {
        $data['barang'] = DB::table('barang')->where('id',$id)->first();

        return view('barang.ubah',$data);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            "nama" => 'required|string',
            "jenis" => 'required|string',
            "satuan" => 'required|string',
            "stok" => 'required|numeric',
            "harga_jual" => 'required|numeric',
            "harga_beli" => 'required|numeric',
            "harga_peritem" => 'required|numeric',
        ]);
        
        DB::table('barang')->where('id', '=', $id)->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'harga_peritem' => $request->harga_peritem,
            'user_id' => auth()->user()->id
        ]);
        
        return redirect()->route('barang.index')->with('status', 'Data Berhasil Di Perbaharui');
    }

    public function delete($id)
    {
        DB::table('barang')->where('id', $id)->delete();

        return redirect()->route('barang.index')->with('status', 'Data Berhasil Di Hapus');
    }

    private function _kodeBarang()
    {
        $kode = DB::table('barang')->max('kode');
        $kodeP = $kode;
        $urutan = (int) substr($kodeP, 3, 3);
        $urutan++;
        $huruf = "B";
        return $huruf . sprintf("%03s", $urutan);
    }
}
