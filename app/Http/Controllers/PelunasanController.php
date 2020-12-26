<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PelunasanController extends Controller
{
    public function index()
    {
        $data['pelunasan'] = DB::table('pelunasan')
                            ->join('pesanan', 'pesanan.id', '=', 'pelunasan.pesanan_id')
                            ->join('pelanggan', 'pelanggan.id', '=', 'pesanan.pelanggan_id')
                            ->join('users', 'users.id', '=', 'pesanan.user_id')
                            ->select([
                                'pesanan.id',
                                'pesanan.kode as kode_pesanan',
                                'pelanggan.nama as nama_pelanggan',
                                'pelunasan.*',
                                'users.nama as nama_user',
                            ])
                            ->latest()
                            ->get();

        return view('pelunasan.index',$data);
    }

    public function tambah()
    {
        $data['pesanan'] = DB::table('pesanan')
            ->join('pelanggan', 'pelanggan.id', '=', 'pesanan.pelanggan_id')
            ->leftJoin('pelunasan', 'pesanan.id', '=', 'pelunasan.pesanan_id')
            ->whereNull('pelunasan.pesanan_id')
            ->select([
                'pesanan.id',
                'pesanan.kode',
                'pesanan.total_harga',
                'pesanan.uang_muka',
                'pelanggan.nama as nama_pelanggan'
            ])
            ->latest('pesanan.id')
            ->get();
        $data['kode'] = $this->_kodePelunasan();
        $data['tanggal'] = date('d-m-Y');

        return view('pelunasan.tambah',$data);
    }

    public function tambahProcces(Request $request)
    {
        $request->validate([
            "kode" => 'required|string|unique:pelunasan,kode',
            "pesanan" => 'required|numeric',
            "tgl_pelunasan" => 'required',
            "pembayaran" => 'required|numeric',
            "keterangan" => 'required|string',
            "file" => 'image|mimes:jpeg,png,jpg',
        ]);

        $foto = null;
        if($request->file('file')){
            $file = $request->file('file');
            $foto = $file->getClientOriginalName();
            $file->move('photo',$foto);
        }

        DB::table('pelunasan')->insert([
            'kode' => $request->kode,
            'pesanan_id' => $request->pesanan,
            'tgl_pelunasan' => date('Y-m-d', strtotime($request->tgl_pelunasan)),
            'pembayaran' => $request->pembayaran,
            'keterangan' => $request->keterangan,
            'photo' => $foto,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('pelunasan.index')->with('status', 'Data Berhasil Di Tambahkan');
    }

    public function hapus($id)
    {
        DB::table('pelunasan')->where('id', $id)->delete();

        return redirect()->route('pelunasan.index')->with('status', 'Data Berhasil Di Hapus');
    }

    public function cetak($id)
    {
        $data['pelunasan'] = DB::table('pelunasan')
                                ->join('pesanan','pesanan.id','pelunasan.pesanan_id')
                                ->join('pelanggan', 'pelanggan.id', '=', 'pesanan.pelanggan_id')
                                ->where('pelunasan.id', $id)
                                ->select([
                                    'pelanggan.nama as nama_pelanggan',
                                    'pelanggan.alamat as alamat_pelanggan',
                                    'pesanan.kode as kode_pesanan',
                                    'pesanan.tgl_pesanan',
                                    'pesanan.tgl_jadi',
                                    'pesanan.total_harga',
                                    'pesanan.uang_muka',
                                    'pelunasan.*'
                                ])
                                ->first();

        return view('pelunasan.cetak', $data);
    }

    private function _kodePelunasan()
    {
        $kode = DB::table('pelunasan')->max('kode');
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = "PL";
        return $huruf . sprintf("%03s", $urutan);

    }
}
