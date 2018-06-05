<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table="roles";

    public function user(){
        return $this->hasMany(User::class);
    }
}