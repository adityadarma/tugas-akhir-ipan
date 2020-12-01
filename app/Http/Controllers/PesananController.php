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
        
        return view('pesanan.data',$data);
    }

    public function tambah()
    {
        $data['kode'] = $this->_kodePesanan();
        $data['barang'] = DB::table('barang')->get();
        $data['pelanggan'] = DB::table('pelanggan')->get();
        
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

        DB::table('pesanan')->insert([
            'pelanggan_id' => $request->pelanggan,
            'barang_id' => $request->barang,
            'kode' => $request->kode,
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
            'uang_muka' => $request->uang_muka
        ]);
        
        return redirect()->route('pesanan.index')->with('status', 'Data Berhasil Di Perbaharui');
    }

    public function delete($id)
    {
        DB::table('pesanan')->where('id', $id)->delete();

        return redirect()->route('pesanan.index')->with('status', 'Data Berhasil Di Hapus');
    }

    public function cetak()
    {
        $pesanan = DB::table('pesanans')->get();

        return view('pesanan.dcetak',compact('pesanan'));
    }
    public function detailcetak($ID_PESANAN)
    {
        $pesanan = DB::table('pesanans')->where ('ID_PESANAN',$ID_PESANAN)->get();

        return view('pesanan.cetak',compact('pesanan'));
    }

    public function detail($ID_PELANGGAN)
    {
        $pelanggan = DB::table('pelanggans')->where('ID_PELANGGAN', $ID_PELANGGAN)->first();
        $pesanan = DB::table('pesanans')->where ('ID_PELANGGAN',$ID_PELANGGAN)->get();
        Log::info('Inputan: '.$ID_PELANGGAN);
        //return $pelanggan;
        return view('pesanan.detail',compact('pesanan', 'pelanggan'));
        //return $pelanggan->count();
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
