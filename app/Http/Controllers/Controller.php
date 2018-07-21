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

    public function createlog($log)
    {
        $table = new CActivityLog;
        $table->log = $log;

        if ($table->save()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
    public function updatelog($id, $log)
    {
        $table = CActivityLog::where('id','=',$id)
                        ->first();
        $table->log = $log;

        if ($table->save()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
    public function deletelog($id)
    {
        $table = CActivityLog::where('id','=',$id)
                        ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
    public function login(Request $request)
    {
    }
    public function logout(Request $request)
    {
    }
}
