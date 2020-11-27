<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BarangController extends Controller
{
    public function data()
    {
        $barang = DB::table('barangs')->get();
        $stoks = DB::table('pesanans')->sum('JUMLAH_PESANAN');
        return view('barang.data',compact('barang','stoks'));
    }
    public function tambah()
    {
        $kode = DB::table('barangs')->max('ID_BARANG');
        $kodeP = $kode;
        $urutan = (int) substr($kodeP, 3, 3);
        $urutan++;
        $huruf = "B";
        $kodeP = $huruf . sprintf("%03s", $urutan);
        return view('barang.tambah', compact('kodeP'));
    }

    public function tambahProcess(Request $request)
    {
        DB::table('barangs')->insert(
            [
            'ID_BARANG' => $request->ID_BARANG,
            'ID_USER' => $request->ID_USER,
             'KODE_BARANG' => $request->KODE_BARANG,
             'NAMA_BARANG' => $request->NAMA_BARANG,
             'JENIS_BARANG' => $request->JENIS_BARANG,
             'SATUAN' => $request->SATUAN,
             'QTY' => $request->QTY,
             'HARGA_JUAL' => $request->HARGA_JUAL,
             'HARGA_BELI' => $request->HARGA_BELI,
             'HARGA_PERITEM' => $request->HARGA_PERITEM
            ]);
            return redirect()->back()->with('status', 'Data Berhasil Di Tambahkan');
    }
    public function ubah($id)
    {
        $barang = DB::table('barangs')->where('ID_BARANG',$id)->first();
        return view('barang.ubah',compact('barang'));
    }
    public function update(Request $request,$id)
    {
        DB::table('barangs')->where('ID_BARANG', '=', $id)->update
        ([
            'ID_BARANG' => $request->ID_BARANG,
            'ID_USER' => $request->ID_USER,
            'ID_PESANAN' => $request->ID_PESANAN,
             'KODE_BARANG' => $request->KODE_BARANG,
             'NAMA_BARANG' => $request->NAMA_BARANG,
             'JENIS_BARANG' => $request->JENIS_BARANG,
             'SATUAN' => $request->SATUAN,
             'QTY' => $request->QTY,
             'HARGA_JUAL' => $request->HARGA_JUAL,
             'HARGA_BELI' => $request->HARGA_BELI,
             'HARGA_PERITEM' => $request->HARGA_PERITEM
        ]);
        return redirect('barang')->with('status', 'PAHAAMMM');
    }
    public function delete($id)
    {
        DB::table('barangs')->where('ID_Barang', $id)->delete();
        return redirect('barang')->with('status', 'PAHAAMMM');
    }
}
