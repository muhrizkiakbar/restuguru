<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CPelanggans extends Model 
{

    protected $table = 'Pelanggans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}