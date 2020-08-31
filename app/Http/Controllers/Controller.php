<?php

namespace App\Http\Controllers;

use App\CActivityLog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mail;
use App\Mail\NotificationDeletedEmail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createlog($log,$category)
    {
        $table = new CActivityLog;
        $table->log = $log;
        $table->category = $category;
        $table->save();

        if ($category=="delete")
        {
            Mail::to('restugurupromosindo.adm@gmail.com')->queue(new NotificationDeletedEmail($log));
        }


        return true ;
    }
}
