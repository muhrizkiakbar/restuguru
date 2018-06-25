<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenis_Pengeluaran extends Model 
{

    protected $table = 'Jenis_Pengeluaran';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}