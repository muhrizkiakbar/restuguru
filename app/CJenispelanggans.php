<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CJenispelanggans extends Model 
{

    protected $table = 'Jenispelanggans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
