<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CPermissions extends Model
{

    protected $table = 'permissions';
    public $timestamps = true;

    protected $editable = ['name', 'urlindex'];
}
