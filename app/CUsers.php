<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CUsers extends Model 
{
    // use Notifiable;
    protected $table = 'Users';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function roles(){
        return $this->belongsTo(Role::class)->withTrashed();
    }

    public function cabangs(){
        return $this->belongsTo(CCabangs::class)->withTrashed();
    }
}
