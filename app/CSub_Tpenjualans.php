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

}