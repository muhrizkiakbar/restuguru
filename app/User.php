<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
// use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    // use SoftDeletes;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='Users';
    
    protected $fillable = [
        'nama','username','password','Telepon','Alamat','cabang_id','user_id','gaji',
    ];

    

    // public function roles(){
    //     return $this->belongsTo(Role::class);
    // }

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function cabangs(){
        return $this->belongsTo(CCabangs::class,'cabang_id');
    }
}
