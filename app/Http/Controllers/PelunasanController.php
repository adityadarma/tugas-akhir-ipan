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
                                'pesanan.kode',
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
        
        return view('pelunasan.tambah',$data);
    }

    public function tambahProcces(Request $request)
    {
        $request->validate([
            "pesanan" => 'required|numeric',
            "tgl_pelunasan" => 'required',
            "pembayaran" => 'required|numeric',
            "keterangan" => 'required|string',
        ]);

        DB::table('pelunasan')->insert([
            'pesanan_id' => $request->pesanan,
            'tgl_pelunasan' => date('Y-m-d', strtotime($request->tgl_pelunasan)),
            'pembayaran' => $request->pembayaran,
            'keterangan' => $request->keterangan,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('pelunasan.index')->with('status', 'Data Berhasil Di Tambahkan');
    }

    public function delete($id)
    {
        DB::table('pelunasan')->where('id', $id)->delete();

        return redirect()->route('pelunasan.index')->with('status', 'Data Berhasil Di Hapus');
    }

    public function cetak($id)
    {
        $data['pelunasan'] = DB::table('pelunasan')->where('id', $id)->first();

        return view('pelunasan.dcetak',$data);
    }
}
