<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function cabang(){
        return $this->belongsTo(CCabangs::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
