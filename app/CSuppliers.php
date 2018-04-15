<?php

namespace App\CSuppliers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CSuppliers extends Model 
{

    protected $table = 'Suppliers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}