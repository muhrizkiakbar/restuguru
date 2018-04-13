<?php

namespace nsJenispelanggans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CJeniselanggans extends Model 
{

    protected $table = 'Jenispelanggans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}