<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CSub_Tpenjualans;
use App\CProduks;
use App\CTransaksi_Penjualans;
use App\Transaksi_Pengeluaran;
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

    public function linedata()
    {
        $monthText = array( 'Null', 'Januari', 'Februari', 'Maret',
                            'April', 'Mei', 'Juni', 'Juli',
                            'Agustus', 'September', 'Oktober',
                            'November', 'Desember');

        $monthLabel=array();
        $monthValue=array();
        $dataline=array();
        
        for ($x = 1; $x <= date('n'); $x++) {
            $jumlahPemasukan=CTransaksi_Penjualans::whereMonth('tanggal',$x)
                                                ->whereYear('tanggal',date('Y'))
                                                ->sum('jumlah_pembayaran');
            array_push($monthLabel,$monthText[$x]);
            array_push($monthValue,$jumlahPemasukan);
        }
        
        $dataline['label']=$monthLabel;
        $dataline['value']=$monthValue;
        return response()->json($dataline);
    }

    public function index()
    {
        //
        $data=array();
        $jumlahTransaksi=CTransaksi_Penjualans::whereDate('tanggal',date('Y-m-d'))
                                                ->count();
        $jumlahMasukan=CTransaksi_Penjualans::whereDate('tanggal',date('Y-m-d'))
                                                ->sum('jumlah_pembayaran');
        $jumlahPengeluaran=Transaksi_Pengeluaran::whereDate('tanggal_pengeluaran',date('Y-m-d'))
                                                ->sum('pembayaran_pengeluaran');
        $pendapatanBersih = $jumlahMasukan-$jumlahPengeluaran;
        array_push($data,$jumlahTransaksi,$jumlahMasukan,$jumlahPengeluaran,$pendapatanBersih);
                                                // ->count() AS count;
                                                // ->get();
        // dd($data);
        return view ('dashboards.dashboard',['data'=>$data]);
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
