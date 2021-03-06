<?php

namespace App\Http\Controllers;

use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['pesanan'] = DB::table('pesanan')->count();
        $data['pelunasan'] = DB::table('pelunasan')->count();
        $data['pelanggan'] = DB::table('pelanggan')->whereNull('deleted_at')->count();
        $data['pesanans'] = Pesanan::join('pelanggan', 'pelanggan.id', '=', 'pesanan.pelanggan_id')
            ->leftJoin('pelunasan', 'pesanan.id', '=', 'pelunasan.pesanan_id')
            ->whereNull('pelunasan.pesanan_id')
            ->select([
                'pesanan.*',
                'pelanggan.nama as nama_pelanggan'
            ])
            ->latest('pesanan.id')
            ->get();

        return view('home', $data);
    }
}
