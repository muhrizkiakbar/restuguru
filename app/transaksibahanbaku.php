<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class transaksibahanbaku extends Model
{
    //
    protected $table = 'transaksibahanbakus';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
}
