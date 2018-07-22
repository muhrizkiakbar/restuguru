<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CBahanBakus extends Model
{

    protected $table = 'bahanbakus';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
