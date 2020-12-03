<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AruskasController extends Controller
{
    public function index(Request $request){
        $post = $request->all();
        $data = $post;
            
        if($post){
            $data['aruskas'] = DB::table('aruskas')
            ->whereBetween('tanggal',[date('Y-m-d', strtotime(($post['awal']))), date('Y-m-d', strtotime(($post['akhir'])))])
            ->oldest()
            ->get();
        }

        return view('laporan.aruskas.index', $data);
    }

    public function print(Request $request){
        $post = $request->all();

        $data['aruskas'] = DB::table('aruskas')
            ->whereBetween('tanggal',[date('Y-m-d', strtotime(($post['awal']))), date('Y-m-d', strtotime(($post['akhir'])))])
            ->oldest()
            ->get();

        return view('laporan.aruskas.print', $data);
    }
}
