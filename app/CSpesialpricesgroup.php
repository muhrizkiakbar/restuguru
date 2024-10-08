<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CSpesialpricesgroup extends Model 
{

    protected $table = 'Spesialpricesgroups';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function range_prices()
    {
        return $this->hasMany('App\RangePriceGroup', 'special_price_group_id', 'id');
    }

}
