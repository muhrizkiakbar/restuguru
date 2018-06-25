<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Angsuran_Pengeluarans extends Model 
{

    protected $table = 'Angsuran_Pengeluarans';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}