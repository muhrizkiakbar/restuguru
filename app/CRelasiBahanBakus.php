<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CRelasiBahanBakus extends Model
{

    protected $table = 'Produkbahanbakus';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function produk()
    {
        return $this->belongsTo('App\CProduks', 'id', 'produk_id')->withTrashed();
    }

    public function bahanbaku()
    {
        return $this->belongsTo('App\CBahanBakus', 'id', 'bahanbaku_id')->withTrashed();
    }
}
