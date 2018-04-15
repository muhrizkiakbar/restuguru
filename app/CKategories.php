<?php

namespace App\CKategories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CKategories extends Model 
{

    protected $table = 'Kategories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}