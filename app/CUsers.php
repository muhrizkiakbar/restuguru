<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CUsers extends Model 
{

    protected $table = 'Users';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}