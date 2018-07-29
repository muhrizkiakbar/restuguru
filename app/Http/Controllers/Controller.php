<?php

namespace App\Http\Controllers;

use App\CActivityLog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createlog($log,$category)
    {
        $table = new CActivityLog;
        $table->log = $log;
        $table->category = $category;
        return $table->save();
    }
}
