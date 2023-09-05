<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RangePriceGroup extends Model 
{

    protected $table = 'RangePriceGroups';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function specialpricepelanggan()
    {
        return $this->belongsTo('App\CSpesialpricesgroup')->withTrashed();
    }
}
