<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CSpesialprices extends Model 
{

    protected $table = 'Spesialprices';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}