<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CActivityLog extends Model
{

    protected $table = 'activity_log';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
