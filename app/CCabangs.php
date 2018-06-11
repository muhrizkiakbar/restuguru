<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CCabangs extends Model 
{

    protected $table = 'Cabangs';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function users(){
        return $this->hasMany(User::class);
    }
}