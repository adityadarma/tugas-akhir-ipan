<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    protected $table = 'pesanan_detail';

    public function barang(){
        return $this->hasOne('App\Barang','id','barang_id');
    }
}
