<?php

namespace App\CTransaksi_Penjualans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CTransaksi_Penjualans extends Model 
{

    protected $table = 'Transaksi_Penjualans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}