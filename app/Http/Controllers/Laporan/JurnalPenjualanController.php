<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Jurnal;
use Illuminate\Http\Request;

class JurnalPenjualanController extends Controller
{
    public function index(Request $request){
        $post = $request->all();
        $data = $post;
            
        if($post){
            $data['pesanan'] = Jurnal::whereBetween('tanggal',[date('Y-m-d', strtotime(($post['awal']))), date('Y-m-d', strtotime(($post['akhir'])))])
            ->oldest()
            ->get();
        }

        return view('laporan.jurnal-penjualan.index', $data);
    }

    public function print(Request $request){
        $post = $request->all();

        $data['pesanan'] = Jurnal::whereBetween('tanggal',[date('Y-m-d', strtotime(($post['awal']))), date('Y-m-d', strtotime(($post['akhir'])))])
            ->oldest()
            ->get();

        return view('laporan.jurnal-penjualan.print', $data);
    }
}
