<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CSub_Tpenjualans extends Model 
{

    protected $table = 'Sub_Tpenjualans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function penjualan()
    {
        return $this->belongsTo('App\CTransaksi_Penjualans');
    }

    public function produk()
    {
        return $this->belongsTo('App\CProduks');
    }

}
