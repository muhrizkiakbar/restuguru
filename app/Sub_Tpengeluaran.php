<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sub_Tpengeluaran extends Model 
{

    protected $table = 'Sub_Tpengeluarans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}