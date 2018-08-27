<?php

namespace App\Http\Controllers;
use App\CActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivityLogController extends Controller
{
    //
    public function index(Request $request)
    {

        $datas=CActivityLog::orderBy('id','desc')->paginate(50,
                            array('activity_log.*'));
        // dd(collect($data));

        $datas2=collect($datas->items())->groupBy(function($item) {
            // dd($item);
            return Carbon::parse($item->created_at)->format('Y-M-d');
        });;

        $datas->setCollection($datas2);

        if ($request->ajax()) {
            $view = view('log.datatimeline',compact('datas'))->render();
            return response()->json(['html'=>$view]);
        }
        // dd($data);
        return view('log.timeline',compact('datas'));
    }
    
}
