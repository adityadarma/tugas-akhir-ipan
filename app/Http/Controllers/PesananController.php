<?php

namespace App\Http\Controllers;

use App\Pesanan;
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
        $data['pesanan'] = Pesanan::with(['details'])->join('pelanggan', 'pelanggan.id', '=', 'pesanan.pelanggan_id')
            ->join('users', 'users.id', '=', 'pesanan.user_id')
            ->select([
                'pelanggan.nama as nama_pelanggan',
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
        $data['tanggal'] = date('d-m-Y');
        
        return view('pesanan.tambah',$data);
    }

    public function tambahProcess(Request $request)
    {
        $request->validate([
            "pelanggan" => 'required|numeric',
            "kode" => 'required|string',
            "tgl_pesanan" => 'required',
            "tgl_jadi" => 'required',
            "barang.*" => 'required|array',
            "barang.*" => 'required|numeric',
            "jumlah_pesanan.*" => 'required|array',
            "jumlah_pesanan.*" => 'required|numeric',
            "jumlah_warna.*" => 'required|array',
            "jumlah_warna.*" => 'required|numeric',
            "total.*" => 'required|array',
            "total.*" => 'required|numeric',
            "disc" => 'required|numeric',
            "total_harga" => 'required|numeric',
            "uang_muka" => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $pasanan = DB::table('pesanan')->insertGetId([
                'pelanggan_id' => $request->pelanggan,
                'kode' => $request->kode,
                'tgl_pesanan' => date('Y-m-d', strtotime($request->tgl_pesanan)),
                'tgl_jadi' => date('Y-m-d', strtotime($request->tgl_jadi)),
                'disc' => $request->disc,
                'total_harga' => $request->total_harga,
                'uang_muka' => $request->uang_muka,
                'user_id' => auth()->user()->id
            ]);
    
            foreach ($request->barang as $key => $value) {
                $barang = DB::table('barang')->find($value);
    
                DB::table('pesanan_detail')->insert([
                    'pesanan_id' => $pasanan,
                    'barang_id' => $value,
                    'harga_barang' => $barang->harga_jual,
                    'jumlah_pesanan' => $request->jumlah_pesanan[$key],
                    'jumlah_warna' => $request->jumlah_warna[$key],
                ]);
    
                DB::table('barang')
                ->where('id','=',$value)
                ->decrement('stok',$request->jumlah_pesanan[$key]);
            }

            DB::commit();
            return redirect()->route('pesanan.index')->with('status', 'Data Berhasil Di Tambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back();
        }
    }

    public function ubah($id)
    {
        $pesanan = Pesanan::where('id',$id)->first();
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

    public function histori($id)
    {
        $data['pelanggan'] = DB::table('pelanggan')->find($id);
        $data['pesanan'] = DB::table('pesanan')
                            ->join('pelanggan', 'pelanggan.id', '=', 'pesanan.pelanggan_id')
                            ->join('barang', 'barang.id', '=', 'pesanan.barang_id')
                            ->where ('pelanggan.id',$id)
                            ->select([
                                'barang.nama as nama_barang',
                                'barang.harga_jual as harga_barang',
                                'pesanan.*'
                            ])
                            ->get();
                            
        return view('pesanan.histori',$data);
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
