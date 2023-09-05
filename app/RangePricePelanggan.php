<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RangePricePelanggan extends Model 
{

    protected $table = 'RangePricePelanggans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function specialpricepelanggan()
    {
        return $this->belongsTo('App\CSpecialprices')->withTrashed();
    }
}
