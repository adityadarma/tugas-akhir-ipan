<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    public function details(){
        return $this->hasMany('App\PesananDetail','pesanan_id','id');
    }
}
