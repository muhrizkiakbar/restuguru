<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CSub_Tpenjualans;
use App\CProduks;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function piedata()
    {
        $thisyear = date('Y-m-d');
        $piechartdata=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')
                            ->select('Produks.nama_produk', DB::raw('count(Sub_Tpenjualans.produk_id) as jumlah'))
                            ->whereYear('Sub_Tpenjualans.created_at','=',$thisyear)
                            ->groupBy('Sub_Tpenjualans.produk_id')
                            ->orderBy('jumlah', 'desc')
                            ->limit(5)
                            ->get();
        $labelpie=array();
        $valuepie=array();
        $datapie=array();

        foreach($piechartdata as $key=>$piedata){
            array_push($labelpie,$piedata['nama_produk']);
            array_push($valuepie,$piedata['jumlah']);
        }

        $datapie['label']=$labelpie;
        $datapie['value']=$valuepie;
        return response()->json($datapie);
    }
    public function index()
    {
        //
        return view ('dashboards.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
