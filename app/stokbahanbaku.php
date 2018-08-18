<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class stokbahanbaku extends Model
{
    //
    protected $table = 'stokbahanbakus';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
