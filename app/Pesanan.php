<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    public function details(){
        return $this->hasMany('App\PesananDetail','pesanan_id','id');
    }

    public function total(){
        $total = 0;
        foreach ($this->details as $value) {
            $total += ($value->harga_barang + ($value->jumlah_warna * 10000)) * $value->jumlah_pesanan;
        }
        return $total;
    }
}
