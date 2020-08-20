<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CTransaksi_Penjualans extends Model 
{

    protected $table = 'Transaksi_Penjualans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function sub_penjualans()
    {
        return $this->hasMany('App\CSub_Tpenjualans', 'penjualan_id', 'id');
    }

    public function angsurans()
    {
      return $this->hasMany('App\Angsuran', 'penjualan_id', 'id');
    }

}
