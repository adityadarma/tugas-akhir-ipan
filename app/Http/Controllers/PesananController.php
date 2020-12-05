<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['pesanan'] = DB::table('pesanan')
            ->join('pelanggan', 'pelanggan.id', '=', 'pesanan.pelanggan_id')
            ->join('barang', 'barang.id', '=', 'pesanan.barang_id')
            ->join('users', 'users.id', '=', 'pesanan.user_id')
            ->select([
                'pelanggan.nama as nama_pelanggan',
                'barang.jenis',
                'users.nama as nama_user',
                'pesanan.*'
            ])
            ->latest('pesanan.id')
            ->get();
        
        return view('pesanan.index',$data);
    }

    public function tambah()
    {
        $data['kode'] = $this->_kodePesanan();
        $data['barang'] = DB::table('barang')->get();
        $data['pelanggan'] = DB::table('pelanggan')->whereNull('deleted_at')->get();
        
        return view('pesanan.tambah',$data);
    }

    public function tambahProcess(Request $request)
    {
        $request->validate([
            "pelanggan" => 'required|numeric',
            "barang" => 'required|numeric',
            "kode" => 'required|string',
            "tgl_pesanan" => 'required',
            "tgl_jadi" => 'required',
            "ukuran" => 'required|string',
            "jumlah_pesanan" => 'required|numeric',
            "jumlah_warna" => 'required|numeric',
            "disc" => 'required|numeric',
            "total_harga" => 'required|numeric',
            "uang_muka" => 'required|numeric',
        ]);

        $barang = DB::table('barang')->find($request->barang);

        DB::table('pesanan')->insert([
            'pelanggan_id' => $request->pelanggan,
            'barang_id' => $request->barang,
            'kode' => $request->kode,
            'tgl_pesanan' => date('Y-m-d', strtotime($request->tgl_pesanan)),
            'tgl_jadi' => date('Y-m-d', strtotime($request->tgl_jadi)),
            'ukuran' => $request->ukuran,
            'harga_barang' => $barang->harga_jual,
            'jumlah_pesanan' => $request->jumlah_pesanan,
            'jumlah_warna' => $request->jumlah_warna,
            'disc' => $request->disc,
            'total_harga' => $request->total_harga,
            'uang_muka' => $request->uang_muka,
            'user_id' => auth()->user()->id
        ]);

        DB::table('barang')->where('id','=',$request->barang)->decrement('stok',$request->jumlah_pesanan);
            
        return redirect()->route('pesanan.index')->with('status', 'Data Berhasil Di Tambahkan');
    }

    public function ubah($id)
    {
        $pesanan = DB::table('pesanan')->where('id',$id)->first();
        $data['barang'] = DB::table('barang')->get();
        $data['pelanggan'] = DB::table('pelanggan')->where('id','=',$pesanan->pelanggan_id)->get();
        $data['pesanan'] = $pesanan;
        
        return view('pesanan.ubah',$data);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            "pelanggan" => 'required|numeric',
            "barang" => 'required|numeric',
            "tgl_pesanan" => 'required',
            "tgl_jadi" => 'required',
            "ukuran" => 'required|string',
            "jumlah_pesanan" => 'required|numeric',
            "jumlah_warna" => 'required|numeric',
            "disc" => 'required|numeric',
            "total_harga" => 'required|numeric',
            "uang_muka" => 'required|numeric',
        ]);
        try {
            $pesanan = DB::table('pesanan')->where('id', '=', $id)->first();
            
            DB::table('barang')
                    ->where('id','=',$pesanan->barang_id)
                    ->increment('stok',$pesanan->jumlah_pesanan);

            DB::table('pesanan')->where('id', '=', $id)->update([
                'pelanggan_id' => $request->pelanggan,
                'barang_id' => $request->barang,
                'tgl_pesanan' => date('Y-m-d', strtotime($request->tgl_pesanan)),
                'tgl_jadi' => date('Y-m-d', strtotime($request->tgl_jadi)),
                'ukuran' => $request->ukuran,
                'jumlah_pesanan' => $request->jumlah_pesanan,
                'jumlah_warna' => $request->jumlah_warna,
                'disc' => $request->disc,
                'total_harga' => $request->total_harga,
                'uang_muka' => $request->uang_muka,
                'user_id' => auth()->user()->id
            ]);
            DB::table('barang')->where('id','=',$request->barang)->decrement('stok',$request->jumlah_pesanan);
            
            return redirect()->route('pesanan.index')->with('status', 'Data Berhasil Di Perbaharui');
        } catch (\Throwable $th) {
            return redirect()->route('pesanan.ubah',['id' => $id])->with('error', 'Data Gagal Di Perbaharui');
        }
    }

    public function hapus($id)
    {
        DB::table('pesanan')->where('id', $id)->delete();

        return redirect()->route('pesanan.index')->with('status', 'Data Berhasil Di Hapus');
    }

    public function cetak($id)
    {
        $data['pesanan'] = DB::table('pesanan')
                            ->join('pelanggan', 'pelanggan.id', '=', 'pesanan.pelanggan_id')
                            ->join('barang', 'barang.id', '=', 'pesanan.barang_id')
                            ->where ('pesanan.id',$id)
                            ->select([
                                'pelanggan.nama as nama_pelanggan',
                                'pelanggan.alamat as alamat_pelanggan',
                                'barang.kode as kode_barang',
                                'barang.nama as nama_barang',
                                'barang.harga_jual as harga_barang',
                                'pesanan.*'
                            ])
                            ->first();

        return view('pesanan.cetak',$data);
    }

    private function _kodePesanan()
    {
        $kode = DB::table('pesanan')->max('kode');
        $kodeP = $kode;
        $urutan = (int) substr($kodeP, 3, 3);
        $urutan++;
        $huruf = "OD";
        return $huruf . sprintf("%03s", $urutan);
    }
}
