<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis_Pengeluaran;
use App\CSub_Tpenjualans;
use App\CProduks;
use App\CTransaksi_Penjualans;
use App\Transaksi_Pengeluaran;
use App\Angsuran;
use App\Angsuran_Pengeluarans;
use Illuminate\Support\Facades\Auth;

use DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $cabangId=Auth::user()->cabang_id;
        $jenispengeluaran = Jenis_Pengeluaran::all();
        $label_jenispengeluaran = array();
        $cvalue_jenispengeluaran = array();
        $tvalue_jenispengeluaran = array();
        $arrayjenispengeluaran = array();                                    
        foreach ($jenispengeluaran as $pengeluaran){
            $value_Cash = Transaksi_Pengeluaran::where('cabang_id',$cabangId)
                                            ->where('jenispengeluaran_id', $pengeluaran -> id)
                                            ->where('metode_pembayaran', 'Cash')
                                            ->whereBetween('tanggal_pengeluaran', [$request->startDate, $request->endDate])
                                            ->sum('pembayaran_pengeluaran');

            $value_Transfer = Transaksi_Pengeluaran::where('cabang_id',$cabangId)
                                            ->where('jenispengeluaran_id', $pengeluaran -> id)
                                            ->where('metode_pembayaran', 'Transfer')
                                            ->whereBetween('tanggal_pengeluaran', [$request->startDate, $request->endDate])
                                            ->sum('pembayaran_pengeluaran');
            array_push($label_jenispengeluaran, $pengeluaran->jenis_pengeluaran);
            array_push($cvalue_jenispengeluaran, $value_Cash);
            array_push($tvalue_jenispengeluaran, $value_Transfer);
        };
        array_push(
            $arrayjenispengeluaran,
            $label_jenispengeluaran,
            $cvalue_jenispengeluaran,
            $tvalue_jenispengeluaran
        );

        //Penjualan
        $Pembayaran_Penjualan=CTransaksi_Penjualans::where('cabang_id',$cabangId)
                                                ->whereBetween('tanggal', [$request->startDate, $request->endDate])
                                                ->sum('jumlah_pembayaran');

        //Menghutangi Pembeli
        $Piutang_Penjualan=CTransaksi_Penjualans::where('cabang_id',$cabangId)
                                                ->whereBetween('tanggal', [$request->startDate, $request->endDate])
                                                ->sum('sisa_tagihan');
        
        //Pengeluaran
        $Pembayaran_Pengeluaran=Transaksi_Pengeluaran::where('cabang_id',$cabangId)
                                                ->whereBetween('tanggal_pengeluaran', [$request->startDate, $request->endDate])
                                                ->sum('pembayaran_pengeluaran');

        //Berhutang untuk pengeluaran
        $Hutang_Pengeluaran=Transaksi_Pengeluaran::where('cabang_id',$cabangId)
                                                ->whereBetween('tanggal_pengeluaran', [$request->startDate, $request->endDate])
                                                ->sum('sisa_pengeluaran');

        //Total Yang Bayar Hutang pada tanggal xxxx - xxxx
        $Pencairan_Piutang=Angsuran::where('cabang_id',$cabangId)
                                    ->whereBetween('tanggal_angsuran', [$request->startDate, $request->endDate])
                                    ->sum('nominal_angsuran');

        //Total Perusahaan Membayar Hutang pada tanggal xxxx - xxxx
        $Pembayaran_Hutang=Angsuran_Pengeluarans::where('cabang_id',$cabangId)
                                    ->whereBetween('tanggal_angsuran', [$request->startDate, $request->endDate])
                                    ->sum('nominal_angsuran');

        //Detail
        //Penjualan yang tidak berhutang
        $c_Pembayaran_Penjualan=CTransaksi_Penjualans::where('cabang_id',$cabangId)
                                ->whereBetween('tanggal', [$request->startDate, $request->endDate])
                                ->where('Transaksi_Penjualans.metode_pembayaran', 'Cash')
                                ->sum('jumlah_pembayaran');
        // CTransaksi_Penjualans::leftJoin('Angsurans', 'Transaksi_Penjualans.id', '=', 'Angsurans.transaksipenjualan_id')
        //                                             ->select(DB::raw('jumlah_pembayaran - SUM( if (Angsurans.nominal_angsuran is not null,Angsurans.nominal_angsuran,0)) as total'))
        //                                             ->whereBetween('Transaksi_Penjualans.tanggal', [$request->startDate, $request->endDate])
        //                                             ->where('Transaksi_Penjualans.metode_pembayaran', 'Cash')
        //                                             ->where('Transaksi_Penjualans.cabang_id', $cabangId)
        //                                             ->groupBy('Transaksi_Penjualans.id')
        //                                             ->get();                                           

        $t_Pembayaran_Penjualan=CTransaksi_Penjualans::where('cabang_id',$cabangId)
                                ->whereBetween('tanggal', [$request->startDate, $request->endDate])
                                ->where('Transaksi_Penjualans.metode_pembayaran', 'Transfer')
                                ->sum('jumlah_pembayaran');
        // CTransaksi_Penjualans::leftJoin('Angsurans', 'Transaksi_Penjualans.id', '=', 'Angsurans.transaksipenjualan_id')
        //                                             ->select(DB::raw('jumlah_pembayaran - SUM( if (Angsurans.nominal_angsuran is not null,Angsurans.nominal_angsuran,0)) as total'))
        //                                             ->whereBetween('Transaksi_Penjualans.tanggal', [$request->startDate, $request->endDate])
        //                                             ->where('Transaksi_Penjualans.metode_pembayaran', 'Transfer')
        //                                             ->where('Transaksi_Penjualans.cabang_id', $cabangId)
        //                                             ->groupBy('Transaksi_Penjualans.id')
        //                                             ->get();

        //Pembeli Yang Bayar Hutang pada tanggal xxxx - xxxx by nota penjualan
        $c_Pencairan_Piutang=Angsuran::leftJoin('Transaksi_Penjualans', 'Transaksi_Penjualans.id','=', 'Angsurans.transaksipenjualan_id')
                                    ->where('Angsurans.cabang_id',$cabangId)
                                    ->where('Angsurans.metode_pembayaran', 'Cash')
                                    ->whereBetween('Transaksi_Penjualans.tanggal', [$request->startDate, $request->endDate])
                                    ->whereBetween('Angsurans.tanggal_angsuran', [$request->startDate, $request->endDate])
                                    ->sum('Angsurans.nominal_angsuran');

        $t_Pencairan_Piutang=Angsuran::leftJoin('Transaksi_Penjualans', 'Transaksi_Penjualans.id','=', 'Angsurans.transaksipenjualan_id')
                                    ->where('Angsurans.cabang_id',$cabangId)
                                    ->where('Angsurans.metode_pembayaran', 'Transfer')
                                    ->whereBetween('Transaksi_Penjualans.tanggal', [$request->startDate, $request->endDate])
                                    ->whereBetween('Angsurans.tanggal_angsuran', [$request->startDate, $request->endDate])
                                    ->sum('Angsurans.nominal_angsuran');

        //Pembeli Yang Bayar Hutang pada tanggal xxxx - xxxx
        $c_Pencairan_Piutang_Bukan_Nota =
          Angsuran::leftJoin('Transaksi_Penjualans', 'Transaksi_Penjualans.id','=', 'Angsurans.transaksipenjualan_id')
                    ->where('Angsurans.cabang_id',$cabangId)
                    ->where('Angsurans.metode_pembayaran', 'Cash')
                    ->whereNotBetween('Transaksi_Penjualans.tanggal', [$request->startDate, $request->endDate])
                    ->whereBetween('Angsurans.tanggal_angsuran', [$request->startDate, $request->endDate])
                    ->sum('Angsurans.nominal_angsuran');

        $t_Pencairan_Piutang_Bukan_Nota =
          Angsuran::leftJoin('Transaksi_Penjualans', 'Transaksi_Penjualans.id','=', 'Angsurans.transaksipenjualan_id')
                    ->where('Angsurans.cabang_id',$cabangId)
                    ->where('Angsurans.metode_pembayaran', 'Transfer')
                    ->whereNotBetween('Transaksi_Penjualans.tanggal', [$request->startDate, $request->endDate])
                    ->whereBetween('Angsurans.tanggal_angsuran', [$request->startDate, $request->endDate])
                    ->sum('Angsurans.nominal_angsuran');

        //Perusahaan Membayar Hutang pada tanggal xxxx - xxxx
        $c_Pembayaran_Hutang=Angsuran_Pengeluarans::where('cabang_id',$cabangId)
                                    ->where('metode_pembayaran', 'Cash')
                                    ->whereBetween('tanggal_angsuran', [$request->startDate, $request->endDate])
                                    ->sum('nominal_angsuran');

        $t_Pembayaran_Hutang=Angsuran_Pengeluarans::where('cabang_id',$cabangId)
                                    ->where('metode_pembayaran', 'Transfer')
                                    ->whereBetween('tanggal_angsuran', [$request->startDate, $request->endDate])
                                    ->sum('nominal_angsuran');

        //chart
        $monthText = array( 'Null', 'Januari', 'Februari', 'Maret',
                            'April', 'Mei', 'Juni', 'Juli',
                            'Agustus', 'September', 'Oktober',
                            'November', 'Desember');

        $monthLabel=array();
        $monthPemasukan=array();
        $monthPengeluaran=array();
        $monthPiutang=array();
        $monthHutang=array();
        $charttitle = null;

        $loopingDate = $request->startDate;
        if ( 
            (date('Y', strtotime($request->startDate)) == date('Y'))
            &&
            (date('Y', strtotime($request->endDate)) == date('Y'))
        ){
            for ($x = 1; $x <= date('n'); $x++) {
                $jumlahPemasukan=CTransaksi_Penjualans::whereMonth('tanggal',$x)
                                                    ->where('cabang_id',$cabangId)                                    
                                                    ->whereYear('tanggal',date('Y'))
                                                    ->sum('jumlah_pembayaran')/1000000;

                $jumlahPengeluaran=Transaksi_Pengeluaran::whereMonth('tanggal_pengeluaran',$x)
                                                    ->where('cabang_id',$cabangId)                                    
                                                    ->whereYear('tanggal_pengeluaran',date('Y'))
                                                    ->sum('pembayaran_pengeluaran')/1000000;

                $jumlahPiutang=CTransaksi_Penjualans::whereMonth('tanggal',$x)
                                                    ->where('cabang_id',$cabangId)                                    
                                                    ->whereYear('tanggal',date('Y'))
                                                    ->sum('sisa_tagihan')/1000000;

                $jumlahHutang=Transaksi_Pengeluaran::whereMonth('tanggal_pengeluaran',$x)
                                                    ->where('cabang_id',$cabangId)                                    
                                                    ->whereYear('tanggal_pengeluaran',date('Y'))
                                                    ->sum('sisa_pengeluaran')/1000000;

                array_push($monthLabel,$monthText[$x]);
                array_push($monthPemasukan,floatval(number_format($jumlahPemasukan,2,'.',' ')));
                array_push($monthPengeluaran,floatval(number_format($jumlahPengeluaran,2,'.',' ')));
                array_push($monthPiutang,floatval(number_format($jumlahPiutang,2,'.',' ')));
                array_push($monthHutang,floatval(number_format($jumlahHutang,2,'.',' ')));
            }
            $charttitle = date('Y');
        }else{
            while( strtotime($loopingDate) <= strtotime($request->endDate) ){

                $jumlahPemasukan=CTransaksi_Penjualans::whereMonth('tanggal',date('n', strtotime($loopingDate)))
                                                    ->where('cabang_id',$cabangId)                                    
                                                    ->whereYear('tanggal',$loopingDate)
                                                    ->sum('jumlah_pembayaran')/1000000;

                $jumlahPengeluaran=Transaksi_Pengeluaran::whereMonth('tanggal_pengeluaran',date('n', strtotime($loopingDate)))
                                                    ->where('cabang_id',$cabangId)                                    
                                                    ->whereYear('tanggal_pengeluaran',$loopingDate)
                                                    ->sum('pembayaran_pengeluaran')/1000000;

                $jumlahPiutang=CTransaksi_Penjualans::whereMonth('tanggal',date('n', strtotime($loopingDate)))
                                                    ->where('cabang_id',$cabangId)                                    
                                                    ->whereYear('tanggal',$loopingDate)
                                                    ->sum('sisa_tagihan')/1000000;

                $jumlahHutang=Transaksi_Pengeluaran::whereMonth('tanggal_pengeluaran',date('n', strtotime($loopingDate)))
                                                    ->where('cabang_id',$cabangId)                                    
                                                    ->whereYear('tanggal_pengeluaran',$loopingDate)
                                                    ->sum('sisa_pengeluaran')/1000000;
                                                    
                array_push($monthLabel,$monthText[date('n', strtotime($loopingDate))]);
                array_push($monthPemasukan,floatval(number_format($jumlahPemasukan,2,'.',' ')));
                array_push($monthPengeluaran,floatval(number_format($jumlahPengeluaran,2,'.',' ')));
                array_push($monthPiutang,floatval(number_format($jumlahPiutang,2,'.',' ')));
                array_push($monthHutang,floatval(number_format($jumlahHutang,2,'.',' ')));

                $loopingDate = date('Y/m/d',strtotime('+1month', strtotime($loopingDate)));
            };
            $charttitle = date('Y', strtotime($request->startDate)).' - '.date('Y', strtotime($request->endDate));
        }
        

        return response()->json([
            'jenispengeluaran'          => $arrayjenispengeluaran[0],
            'cvalue_jenispengeluaran'   => $arrayjenispengeluaran[1],
            'tvalue_jenispengeluaran'   => $arrayjenispengeluaran[2],
            'Pembayaran_Penjualan'      => $Pembayaran_Penjualan,
            'Piutang_Penjualan'         => $Piutang_Penjualan,
            'Pembayaran_Pengeluaran'    => $Pembayaran_Pengeluaran,
            'Hutang_Pengeluaran'        => $Hutang_Pengeluaran,
            'Pencairan_Piutang'         => $Pencairan_Piutang,
            'Pembayaran_Hutang'         => $Pembayaran_Hutang,
            'c_Pembayaran_Penjualan'    => $c_Pembayaran_Penjualan,
            't_Pembayaran_Penjualan'    => $t_Pembayaran_Penjualan,
            // 'c_Pembayaran_Penjualan'    => $c_Pembayaran_Penjualan->sum('total'),
            // 't_Pembayaran_Penjualan'    => $t_Pembayaran_Penjualan->sum('total'),
            'c_Pencairan_Piutang'       => $c_Pencairan_Piutang,
            't_Pencairan_Piutang'       => $t_Pencairan_Piutang,
            'c_Pencairan_Piutang_Bukan_Nota' => $c_Pencairan_Piutang_Bukan_Nota,
            't_Pencairan_Piutang_Bukan_Nota' => $t_Pencairan_Piutang_Bukan_Nota,
            'c_Pembayaran_Hutang'       => $c_Pembayaran_Hutang,
            't_Pembayaran_Hutang'       => $t_Pembayaran_Hutang,
            'charttitle'                => $charttitle,
            'datachartMonth'            => $monthLabel,
            'datachartPemasukan'        => $monthPemasukan,
            'datachartPengeluaran'      => $monthPengeluaran,
            'datachartPiutang'          => $monthPiutang,
            'datachartHutang'           => $monthHutang

        ]);
        
    }
    
    public function index()
    {
        //
        
        // return view ('laporans.laporan',['jenispengeluaran'=>$jenispengeluaran]);
        $userId=Auth::user()->id;
        $cabangId=Auth::user()->cabang_id;
        $data=array();
        $jenispengeluaran = Jenis_Pengeluaran::select('jenis_pengeluaran')
                                                ->get();
        

        array_push( $data,
                    $jenispengeluaran                  );
        // dd($data);
        return view ('laporans.laporan',['data'=>$data]);
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
