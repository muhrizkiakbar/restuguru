<?php

namespace App\Http\Controllers;
use App\CKategories;
use App\CProduks;
use App\CCabangs;
use App\Angsuran;
use App\CUsers;
use App\CSpesialprices;
use App\CSpesialpricesgroup;
use App\CPelanggans;
use App\CSub_Tpenjualans;
use App\CTransaksi_Penjualans;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=','1')
                                        ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->where('Transaksi_Penjualans.tanggal','=',$request->tanggal)
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>','0')
                                        ->orderBy('created_at','desc')
                                        ->paginate(50);
        }
        elseif ($request->periode=="semua"){
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=','1')
                                        ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
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
                                        ->where('Transaksi_Penjualans.cabang_id','=','1')
                                        ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
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
                                        ->where('Transaksi_Penjualans.cabang_id','=','1')
                                        ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
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
                                        ->where('Transaksi_Penjualans.cabang_id','=','1')   
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                                         
                                        ->orderBy('created_at','desc')
                                        ->paginate(50);
        }
        
        
        return view('transaksis.piutang.piutanglist',['date'=>$date,'datas'=>$datas,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
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

            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga'
                                    ,'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan')
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->where('Angsurans.tanggal_angsuran','=',$request->tanggal)
                            ->orderBy('created_at','desc')
                            ->paginate(50);

            // $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
            //                             ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
            //                             ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
            //                             ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
            //                             ->where('Transaksi_Penjualans.cabang_id','=','1')
            //                             ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
            //                             ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
            //                             ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
            //                             ->where('Transaksi_Penjualans.tanggal','like','%'.$request->tanggal.'%')
            //                             ->where('Transaksi_Penjualans.sisa_tagihan','>','0')
            //                             ->orderBy('created_at','desc')
            //                             ->paginate(50);
        }
        elseif ($request->periode=="semua"){
            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Penjualans.id as idtrans','Transaksi_Penjualans.total_harga'
                                    ,'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan')
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->orderBy('created_at','desc')
                            ->paginate(50);

            // $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
            //                             ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
            //                             ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
            //                             ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
            //                             ->where('Transaksi_Penjualans.cabang_id','=','1')
            //                             ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
            //                             ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
            //                             ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
            //                             ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                        
            //                             ->orderBy('Transaksi_Penjualans.created_at','desc')
            //                             ->paginate(50);
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
                            ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereMonth('Angsurans.tanggal_angsuran','=',$bulan)
                            ->whereYear('Angsurans.tanggal_angsuran','=',$tahun)
                            ->orderBy('created_at','desc')
                            ->paginate(50);

            // $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
            //                             ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
            //                             ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
            //                             ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
            //                             ->where('Transaksi_Penjualans.cabang_id','=','1')
            //                             ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
            //                             ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
            //                             ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
            //                             ->whereMonth('Transaksi_Penjualans.tanggal','like','%'.$bulan.'%')
            //                             ->whereYear('Transaksi_Penjualans.tanggal','like','%'.$tahun.'%')  
            //                             ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                              
            //                             ->orderBy('created_at','desc')
            //                             ->paginate(50);
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
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereYear('Angsurans.tanggal_angsuran','=',$tahun)
                            ->orderBy('created_at','desc')
                            ->paginate(50);

            // $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
            //                             ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
            //                             ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
            //                             ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
            //                             ->where('Transaksi_Penjualans.cabang_id','=','1')
            //                             ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
            //                             ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
            //                             ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
            //                             ->whereYear('Transaksi_Penjualans.tanggal','like','%'.$tahun.'%')  
            //                             ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                              
            //                             ->orderBy('created_at','desc')
            //                             ->paginate(50);
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
                            // ->where('Angsurans.id','like','%'.$request->nonota.'%')
                            // ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                            // ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            // ->whereMonth('Angsurans.tanggal_angsuran','like','%'.$request->tanggal.'%')
                            // ->whereYear('Angsurans.tanggal_angsuran','like','%'.$request->tanggal.'%')
                            ->orderBy('created_at','desc')
                            ->paginate(50);

            // $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
            //                             ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
            //                             ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
            //                             ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
            //                             ->where('Transaksi_Penjualans.cabang_id','=','1')   
            //                             ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                                         
            //                             ->orderBy('created_at','desc')
            //                             ->paginate(50);
        }
        
        
        return view('transaksis.piutang.angsuranlist',['date'=>$date,'datas'=>$datas,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
    }

    public function indexdeleted(Request $request)
    {
        $date=date('d-m-Y');
        if ($request->tanggal==""){
            $request->tanggal=$date;
        }

        if ($request->periode=="hari"){
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=','1')
                                        ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$request->pembayaran.'%')
                                        ->where('Transaksi_Penjualans.tanggal','=',$request->tanggal)
                                        // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')
                                        ->orderBy('created_at','desc')
                                        ->withTrashed()
                                        ->paginate(50);
        }
        elseif ($request->periode=="semua"){
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=','1')
                                        ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$request->pembayaran.'%')
                                        // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                        
                                        ->orderBy('created_at','desc')
                                        ->withTrashed()
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
                                        ->where('Transaksi_Penjualans.cabang_id','=','1')
                                        ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$request->pembayaran.'%')
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)  
                                        // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                              
                                        ->orderBy('created_at','desc')
                                        ->withTrashed()
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
                                        ->where('Transaksi_Penjualans.cabang_id','=','1')
                                        ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$request->pembayaran.'%')
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)  
                                        // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                              
                                        ->orderBy('created_at','desc')
                                        ->withTrashed()
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
                                        ->where('Transaksi_Penjualans.cabang_id','=','1')   
                                        // ->where('Transaksi_Penjualans.sisa_tagihan','>','0')                                                                                         
                                        ->orderBy('created_at','desc')
                                        ->withTrashed()
                                        ->paginate(50);
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
            $sub['id2']=encrypt($value->id);
            $sub['tanggal_angsuran']=$value->tanggal_angsuran;
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
        $table->user_id='1';
        $table->cabang_id='1';
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

            $transaksi->sisa_tagihan=$sisa;
            $transaksi->save();

        if ($tableangsuran->delete())
        {
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

        $data=Angsuran::where('id','=',$id)->first();
        // dd($data);
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
        $subtransaksis=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')->where('penjualan_id','=',$data->transaksipenjualan_id)->get();
        // dd($transaksi);
        $jumlahangsuran=Angsuran::where('transaksipenjualan_id','=',$data->transaksipenjualan_id)
                                    ->select(DB::raw('sum(Angsurans.nominal_angsuran) as totalangsuran'))
                                    ->first();

        return view('report.reporttransangsuranpenjualandetail',['transaksi'=>$transaksi,'jumlahangsuran'=>$jumlahangsuran,'subtransaksis'=>$subtransaksis,'angsuran'=>$data]);                        

    }

    public function reportangsuran($id)
    {
        $id=decrypt($id);

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
                    
        $data=Angsuran::where('transaksipenjualan_id','=',$transaksi->id)->get();
        

        return view('report.reporttransangsuranpenjualan',['transaksi'=>$transaksi,'angsurans'=>$data]);                        

    }
}
