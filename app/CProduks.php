<?php

namespace nsProduks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CProduks extends Model 
{

    protected $table = 'Produks';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}