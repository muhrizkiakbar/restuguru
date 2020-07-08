<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CProduks extends Model 
{

    protected $table = 'Produks';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function sub_penjualans()
    {
        return $this->hasMany('App\CSub_Tpenjualans', 'produk_id', 'id');
    }


}