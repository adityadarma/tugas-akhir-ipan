<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function data()
    {
        $pesanan = DB::table('pesanans')
            ->join('pelanggans',
            'pelanggans.ID_PELANGGAN', '=', 'pesanans.ID_PELANGGAN')
            ->select(
                'pelanggans.ID_PELANGGAN',
                'pesanans.*'
            )
            ->get();
            // $pesanan = DB::table('pesanans')
            // ->join('pelanggan',
            // 'pelanggan.ID_Pelunasan', '=', 'pesanans.ID_Pelunasan')
            // ->select(
            //     'pelanggan.ID_Pelunasan',
            //     'pesanans.*'
            // )
            // ->get();
        return view('pesanan.data',compact('pesanan'));
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
    public function tambah($ID_PELANGGAN)
    {
        $user = Auth::user();;
        $barang = DB::table('barangs')->get();
        $pelanggan = DB::table('pesanans');
        $kode = DB::table('pesanans')->max('ID_PESANAN');
        $kodeP = $kode;
        $urutan = (int) substr($kodeP, 3, 3);
        $urutan++;
        $huruf = "OD";
        $kodeP = $huruf . sprintf("%03s", $urutan);
        return view('pesanan.tambah',compact('barang','ID_PELANGGAN','kodeP','user'));
    }
    public function tambahProcess(Request $request)
    {
        DB::table('pesanans')->insert(
            [
            'ID_PESANAN' => $request->ID_Pesanan,
            'ID_PELANGGAN' => $request->ID_Pelanggan,
            'ID_USER' => $request->ID_User,
            'ID_BARANG' => $request->barang,
             'TGL_PESANAN' => $request->Tgl_pesanan,
             'TGL_JADI' => $request->Tgl_jadi,
             'JENIS_PESANAN' => $request->Jenis_pesanan,
             'UKURAN' => $request->Ukuran,
             'JUMLAH_PESANAN' => $request->Jumlah_pesanan,
             'JENIS_KAIN' => $request->Jenis_kain,
             'JUMLAH_WARNA' => $request->Jumlah_warna,
             'DISC' => $request->Disc,
             'TOTAL_HARGA' => $request->Total_harga,
             'UANG_MUKA' => $request->Uang_muka,
             'PEMBAYARAN' => $request->Pembayaran
            ]);
            return redirect('pesanan')->with('status', 'PAHAAMMM');
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
    public function ubah($ID_PESANAN)
    {
        $pesanan = DB::table('pesanans')->where('ID_PESANAN',$ID_PESANAN)->first();
        $barang = DB::table('barangs')->get();
        // dd($pesanan->JENIS_PESANAN);
        return view('pesanan.ubah',compact('pesanan','barang'));
    }
    public function update(Request $request,$id){
        DB::table('pesanans')->where('ID_PESANAN', '=', $id)->update
        ([
            'ID_PESANAN' => $request->ID_Pesanan,
            'ID_PELANGGAN' => $request->ID_Pelanggan,
            'ID_USER' => $request->ID_User,
            'ID_BARANG' => $request->barang,
             'TGL_PESANAN' => $request->Tgl_pesanan,
             'TGL_JADI' => $request->Tgl_jadi,
             'JENIS_PESANAN' => $request->Jenis_pesanan,
             'UKURAN' => $request->Ukuran,
             'JUMLAH_PESANAN' => $request->Jumlah_pesanan,
             'JENIS_KAIN' => $request->Jenis_kain,
             'JUMLAH_WARNA' => $request->Jumlah_warna,
             'DISC' => $request->Disc,
             'TOTAL_HARGA' => $request->Total_harga,
             'UANG_MUKA' => $request->Uang_muka,
             'PEMBAYARAN' => $request->Pembayaran
        ]);
        return redirect('pesanan')->with('status', 'PAHAAMMM');
    }
}
