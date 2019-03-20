<?php

namespace App\Http\Controllers;
use App\CKategories;
use App\CProduks;
use App\CCabangs;
use App\Angsuran;
use App\CSpesialprices;
use App\CSpesialpricesgroup;
use App\CPelanggans;
use App\CSub_Tpenjualans;
use App\CTransaksi_Penjualans;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\TransaksiPenjualan\AngsuranPenjualan\AngsuranPenjualanReport;
use App\Exports\TransaksiPenjualan\AngsuranPenjualan\DataPiutangReport;
use Excel;

class AngsuranPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date=date('d-m-Y');

        if ($request->tanggal==""){
            $request->tanggal=$date;
        }
        else
        {
            $request->tanggal=date('d-m-Y',strtotime($request->tanggal));
        }

        if ($request->pembayaran=="semua"){
            $pembayaran="";
        }
        else
        {
            $pembayaran=$request->pembayaran;
        }
        // dd($request->periode);
        if ($request->periode=="hari"){
            // dd($request->periode);
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereDay('Transaksi_Penjualans.tanggal','=',$request->tanggal)
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>','0')
                                        ->orderBy('created_at','desc')
                                        ->paginate(50);
        }
        elseif ($request->periode=="semua"){
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                        
                                        ->orderBy('Transaksi_Penjualans.created_at','desc')
                                        ->paginate(50);
        }
        elseif ($request->periode=="bulan"){
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)  
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                              
                                        ->orderBy('created_at','desc')
                                        ->paginate(50);
        }
        elseif ($request->periode=="tahun")
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)  
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                              
                                        ->orderBy('created_at','desc')
                                        ->paginate(50);
        }
        else
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        // ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')                                           
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                                         
                                        ->orderBy('created_at','desc')
                                        ->paginate(50);
        }
        
        if (($request->submitpelanggan == "export"))
        {
          return (new DataPiutangReport)->proses($request->tanggal,$request->periode,$request->pembayaran,$request->nonota,$request->namapelanggan)->download('laporandatapiutang.xls');
          
          
          
        }
        else
        {
        return view('transaksis.piutang.piutanglist',['date'=>$date,'datas'=>$datas,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
    
        }
    }

    public function angsuranlist(Request $request){
        $date=date('d-m-Y');

        if ($request->tanggal==""){
            $request->tanggal=$date;
        }
        else
        {
            $request->tanggal=date('d-m-Y',strtotime($request->tanggal));
        }

        if ($request->pembayaran=="semua"){
            $pembayaran="";
        }
        else
        {
            $pembayaran=$request->pembayaran;
        }
        // dd($request->periode);
        if ($request->periode=="hari"){
            // dd("as");
            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga'
                                    ,'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan')
                            ->where('Angsurans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->where('Angsurans.tanggal_angsuran','like','%'.date('Y-m-d',strtotime($request->tanggal)).'%')
                            ->orderBy('Transaksi_Penjualans.created_at','asc')
                            ->paginate(50);

           
        }
        elseif ($request->periode=="semua"){
            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga'
                                    ,'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan')
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Angsurans.cabang_id','=',Auth::user()->cabangs->id) 
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->orderBy('Transaksi_Penjualans.created_at','asc')
                            ->paginate(50);

            
        }
        elseif ($request->periode=="bulan"){
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];

            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga'
                                    ,'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan')
                            ->where('Angsurans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereMonth('Angsurans.tanggal_angsuran','=',$bulan)
                            ->whereYear('Angsurans.tanggal_angsuran','=',$tahun)
                            ->orderBy('Transaksi_Penjualans.created_at','asc')
                            ->paginate(50);

        }
        elseif ($request->periode=="tahun")
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];

            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga'
                                    ,'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan')
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Angsurans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereYear('Angsurans.tanggal_angsuran','=',$tahun)
                            ->orderBy('Transaksi_Penjualans.created_at','asc')
                            ->paginate(50);

         
        }
        else
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];

            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga'
                                    ,'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan')
                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                           
                            ->orderBy('Transaksi_Penjualans.created_at','asc')
                            ->paginate(50);

        }


        if (($request->submitpelanggan == "export"))
        {
          return (new AngsuranPenjualanReport)->proses($request->tanggal,$request->periode,$request->pembayaran,$request->nonota,$request->namapelanggan)->download('laporanangsuranpenjualan.xls');
          
        }
        else
        {
        
        
          return view('transaksis.piutang.angsuranlist',['date'=>$date,'datas'=>$datas,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
        }
    }

    public function angsurandeleted(Request $request)
    {
        $date=date('d-m-Y');
        if ($request->tanggal==""){
            $request->tanggal=$date;
        }

        if ($request->periode=="hari"){
            
                            
            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga',
                            'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan',
                            'Cabangs.Nama_Cabang','Users.username')
                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$request->pembayaran.'%')
                            ->where('Angsurans.tanggal_angsuran','=',$request->tanggal)
                            // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')
                            ->orderBy('Angsurans.created_at','desc')
                            ->onlyTrashed()
                            ->paginate(50);
        }
        elseif ($request->periode=="semua"){
            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga',
                            'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan',
                            'Cabangs.Nama_Cabang','Users.username')
                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$request->pembayaran.'%')
                            // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')
                            ->orderBy('Angsurans.created_at','desc')
                            ->onlyTrashed()
                            ->paginate(50);
        }
        elseif ($request->periode=="bulan"){
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga',
                            'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan',
                            'Cabangs.Nama_Cabang','Users.username')
                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$request->pembayaran.'%')
                            ->whereMonth('Angsurans.tanggal_angsuran','=',$bulan)
                            ->whereYear('Angsurans.tanggal_angsuran','=',$tahun)
                            // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')
                            ->orderBy('Angsurans.created_at','desc')
                            ->onlyTrashed()
                            ->paginate(50);
        }
        elseif ($request->periode=="tahun")
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];

            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga',
                            'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan',
                            'Cabangs.Nama_Cabang','Users.username')
                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$request->pembayaran.'%')
                            ->whereYear('Angsurans.tanggal_angsuran','=',$tahun)
                            // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')
                            ->orderBy('Angsurans.created_at','desc')
                            ->onlyTrashed()
                            ->paginate(50);

        }
        else
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];

            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga',
                            'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan',
                            'Cabangs.Nama_Cabang','Users.username')
                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                            // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')
                            ->orderBy('Angsurans.created_at','desc')
                            ->onlyTrashed()
                            ->paginate(50);

            // $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
            //                             ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
            //                             ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
            //                             ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
            //                             ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)   
            //                             // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                                         
            //                             ->orderBy('created_at','desc')
            //                             ->onlyTrashed()
            //                             ->paginate(50);
        }
        
        // dd($request->periode);
        return view('transaksis.piutang.piutangdeleted',['date'=>$date,'datas'=>$datas,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
    }

    public function showangsuran(Request $request){
        $request->id=decrypt($request->id);
        // dd($request->id);
        $showsubtransaksis=Angsuran::leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->select('Angsurans.*','Cabangs.Nama_Cabang','Users.username')
                            ->where('Angsurans.transaksipenjualan_id','=',$request->id)
                            // ->withTrashed()
                            ->get();
        $transaksi=[];
        foreach ($showsubtransaksis as $key => $value){
            $sub=[];
            $sub['id']=$value->id;
            $sub['id3']=encrypt($value->id);
            $sub['id2']=encrypt($request->id);
            $sub['tanggal_angsuran']=date("d-m-Y",strtotime($value->tanggal_angsuran)).' '.date("H:i:s",strtotime($value->created_at));
            $sub['nominal_angsuran']=$value->nominal_angsuran;
            $sub['metode_pembayaran']=$value->metode_pembayaran;
            $sub['transaksipenjualan_id']=$value->transaksipenjualan_id;
            $sub['Nama_Cabang']=$value->Nama_Cabang;
            $sub['username']=$value->username;
            array_push($transaksi,$sub);
        }                            
        return $transaksi;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     //pelanggan harus didaftarkan apabila behutang yg nominal nya banyak
     public function daftartagih(Request $request){
         $hariini=date('Y-m-d');

        $data=[];

        $pelanggans=CTransaksi_Penjualans::where('sisa_tagihan','>','0')
                    ->select('nama_pelanggan','pelanggan_id','hp_pelanggan')
                    ->groupBy('nama_pelanggan','pelanggan_id','hp_pelanggan')
                    ->get();
        foreach ($pelanggans as $key=>$pelanggan)
        {
            $data['pelanggan']=$pelanggan->nama_pelanggan;
            $data['hp_pelanggan']=$pelanggan->hp_pelanggan;

            $totaltagihan=CTransaksi_Penjualans::where('sisa_tagihan','>','0')
                    ->where('nama_pelanggan','=',$pelanggan->nama_pelanggan)
                    ->where('hp_pelanggan','=',$pelanggan->hp_pelanggan)
                    ->orWhere('pelanggan_id','=',$pelanggan->pelanggan_id)
                    // ->where('Transaksi_Penjualans.tanggal','<',strtotime("+".'Pelanggans.tempo_pelanggan'." days",strtotime($hariini)))
                    // ->select('Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.pelanggan_id','Transaksi_Penjualans.hp_pelanggan')
                    // ->groupBy('Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.pelanggan_id')
                    ->sum('Transaksi_Penjualans.total_harga');
            $data['totaltagihan']=$totaltagihan;

            if ($pelanggan->pelanggan_id=="")
            {
                $pelangganid=null;
                $alamat=null;
                $tempo="0";
            }
            else
            {
                
            }

        }
     } 


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
        $idtrans=decrypt($request->json('idtrans'));
        $date=date('Y-m-d');
        // dd($idtrans);
        $table=new Angsuran;
        $table->tanggal_angsuran=$date;
        $table->nominal_angsuran=$request->json('nominal');
        $table->user_id=Auth::user()->id;
        $table->cabang_id=Auth::user()->cabangs->id;
        $table->transaksipenjualan_id=$idtrans;
        $table->metode_pembayaran=$request->json('metode');
 
        $transaksi=CTransaksi_Penjualans::where('id','=',$idtrans)
                            ->first();

        $sisa=$transaksi->sisa_tagihan - $request->json('nominal');
        $jumlahpembayaran=$transaksi->jumlah_pembayaran + $request->json('nominal');

        $transaksi->sisa_tagihan=$sisa;
        $transaksi->jumlah_pembayaran=$jumlahpembayaran;
        $transaksi->save();
        
        $table->sisa_angsuran=$sisa;
        if ($table->save())
        {
            $isi=Auth::user()->username." telah menambah angsuran penjualan dengan No. Angsuran ".$table->id." pada No. Transaksi Penjualan ".$idtrans." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"add");
            return "{\"msg\":\"success\"}";
        }
        else
        {
            return "{\"msg\":\"failed\"}";            
        }
    }

    public function storeall(Request $request)
    {
        $sisaangsuran=$request->json('nominalangsuran');
        $status=false;
        foreach ($request->json('idtrans') as $key=>$idtran)
        {
            $idtrans=decrypt($idtran);
            $date=date('Y-m-d');
            // dd($idtrans);
    
            $transaksi=CTransaksi_Penjualans::where('id','=',$idtrans)
                                ->first();

            if ($transaksi->sisa_tagihan >= $sisaangsuran)
            {
                $sisa=$transaksi->sisa_tagihan - $sisaangsuran;
                $sisa2=$sisaangsuran;
                $sisaangsuran=0;
            }
            else
            {
                // $sisa=$sisaangsuran-$transaksi->sisa_tagihan;
                $sisa=0;
                $sisa2=$transaksi->sisa_tagihan;
                $sisaangsuran=$sisaangsuran-$transaksi->sisa_tagihan;
            }
            $jumlahpembayaran=$transaksi->jumlah_pembayaran + $sisa2;

            $transaksi->sisa_tagihan=$sisa;
            $transaksi->jumlah_pembayaran=$jumlahpembayaran;
            $transaksi->save();
            
            


            $table=new Angsuran;
            $table->tanggal_angsuran=$date;
            $table->nominal_angsuran=$sisa2;
            $table->user_id=Auth::user()->id;
            $table->cabang_id=Auth::user()->cabangs->id;
            $table->transaksipenjualan_id=$idtrans;
            $table->metode_pembayaran=$request->json('pembayaran');

            $table->sisa_angsuran=$sisa;
            if ($table->save())
            {
                $isi=Auth::user()->username." telah menambah angsuran penjualan dengan No. Angsuran ".$table->id." pada No. Transaksi Penjualan ".$idtrans." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
                $save=$this->createlog($isi,"add");
                $status=true;
                
            }
            else
            {
                $status=false;
                
            }
        }
        //
        if ($status){
            return "{\"msg\":\"success\"}";
        }
        else
        {
            return "{\"msg\":\"failed\"}";
        }
        
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
    public function destroy(Request $request)
    {
        //
        $idtrans=($request->json('idtrans'));
        // dd($idtrans);
        $tableangsuran=Angsuran::where('id','=',$idtrans)
                        ->first();
            // dd($tableangsuran->transaksipenjualan_id);
            $transaksi=CTransaksi_Penjualans::where('id','=',$tableangsuran->transaksipenjualan_id)
            ->first();

            $sisa=$transaksi->sisa_tagihan + $tableangsuran->nominal_angsuran;
            $jumlahpembayaran=$transaksi->jumlah_pembayaran - $tableangsuran->nominal_angsuran;

            $transaksi->sisa_tagihan=$sisa;
            $transaksi->jumlah_pembayaran=$jumlahpembayaran;
            $transaksi->save();

        if ($tableangsuran->delete())
        {
            $isi=Auth::user()->username." telah menghapus angsuran penjualan dengan No. Angsuran ".$tableangsuran->id." pada No. Transaksi Penjualan ".$idtrans." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"delete");
            return "{\"msg\":\"success\"}";
        }
        else
        {
            return "{\"msg\":\"failed\"}";            
        }
    }
    
    public function reportdetail($id)
    {
        $id=decrypt($id);

        $data=Angsuran::where('id','=',$id)->withTrashed()->first();
        // dd($id);
        $transaksi=CTransaksi_Penjualans::leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                    ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                    ->leftJoin('role_user','role_user.user_id','=','Users.id')
                    ->leftJoin('roles','role_user.role_id','=','roles.id')                    
                    ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                    ->leftJoin('Jenispelanggans','Pelanggans.jenispelanggan_id','=','Jenispelanggans.id')
                    ->select('Transaksi_Penjualans.*','Cabangs.Kode_Cabang','Cabangs.Nama_Cabang',
                            'Cabangs.No_Telepon','Cabangs.Email','Cabangs.Alamat','Cabangs.Jenis_Cabang',
                            'Users.nama','Jenispelanggans.jenis_pelanggan','roles.display_name')
                    ->withTrashed()
                    ->where('Transaksi_Penjualans.id','=',$data->transaksipenjualan_id)->first();
        $subtransaksis=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')
                        ->select('Sub_Tpenjualans.*','Produks.nama_produk')
                        ->where('penjualan_id','=',$data->transaksipenjualan_id)->get();
        // dd($transaksi);
        $jumlahangsuran=Angsuran::where('transaksipenjualan_id','=',$data->transaksipenjualan_id)
                                    ->select(DB::raw('sum(Angsurans.nominal_angsuran) as totalangsuran'))
                                    ->first();

        return view('report.reporttransangsuranpenjualandetail',['transaksi'=>$transaksi,'jumlahangsuran'=>$jumlahangsuran,'subtransaksis'=>$subtransaksis,'angsuran'=>$data]);                        

    }

    public function reportangsuran($id)
    {
        $id=decrypt($id);
        $data=Angsuran::where('transaksipenjualan_id','=',$id)->get();
        // dd('sdsd');
        // dd($data.' '.$id);
        // dd($id);
        $transaksi=CTransaksi_Penjualans::leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                    ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                    ->leftJoin('role_user','role_user.user_id','=','Users.id')
                    ->leftJoin('roles','role_user.role_id','=','roles.id')            
                    ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                    ->leftJoin('Jenispelanggans','Pelanggans.jenispelanggan_id','=','Jenispelanggans.id')
                    ->select('Transaksi_Penjualans.*','Cabangs.Kode_Cabang','Cabangs.Nama_Cabang',
                            'Cabangs.No_Telepon','Cabangs.Email','Cabangs.Alamat','Cabangs.Jenis_Cabang',
                            'Users.nama','Jenispelanggans.jenis_pelanggan','roles.display_name')
                    ->withTrashed()
                    ->where('Transaksi_Penjualans.id','=',$id)->first();
                    

        
        // dd($transaksi);

        return view('report.reporttransangsuranpenjualan',['transaksi'=>$transaksi,'angsurans'=>$data]);                        

    }
}
