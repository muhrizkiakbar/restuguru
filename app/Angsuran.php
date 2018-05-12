<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Angsuran extends Model 
{

    protected $table = 'Angsurans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}