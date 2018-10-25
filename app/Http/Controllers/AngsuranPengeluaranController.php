<?php

namespace App\Http\Controllers;
use App\Jenis_Pengeluaran;
use App\User;
use App\Angsuran_Pengeluarans;
use App\Transaksi_Pengeluaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Sub_Tpengeluaran;
use Illuminate\Http\Request;

class AngsuranPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd("asd");
        $date=date('d-m-Y');
        if ($request->tanggal==""){
            $request->tanggal=$date;
        }
        else
        {
            $request->tanggal=date('d-m-Y',strtotime($request->tanggal));
        }

        if (($request->jenispengeluaran=="semua") || ($request->jenispengeluaran=="")){
            $request->jenispengeluaran="";
        }
        else
        {
            $request->jenispengeluaran=decrypt($request->jenispengeluaran);
        }

        if (($request->pembayaran2=="semua") || ($request->pembayaran2=="")){
            $pembayaran="";
        }
        else
        {
            $pembayaran=$request->pembayaran2;
        }

        if ($request->periode=="hari"){
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username as username2','Suppliers.nama_supplier','Jenis_Pengeluaran.jenis_pengeluaran')                                        
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$request->jenispengeluaran.'%')                                                                                
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereDay('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$request->tanggal)
                                        ->where('Transaksi_Pengeluarans.sisa_pengeluaran','>','0')
                                        ->where('Jenis_Pengeluaran.sifat_angsuran','=','1')
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->paginate(50);
        }
        elseif ($request->periode=="semua"){
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username as username2','Suppliers.nama_supplier','Jenis_Pengeluaran.jenis_pengeluaran')                                        
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$request->jenispengeluaran.'%')                                                                                                                      
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->where('Jenis_Pengeluaran.sifat_angsuran','=','1')
                                        ->where('Transaksi_Pengeluarans.sisa_pengeluaran','>','0')                                        
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->paginate(50);
        }
        elseif ($request->periode=="bulan"){
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username as username2','Suppliers.nama_supplier','Jenis_Pengeluaran.jenis_pengeluaran')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$request->jenispengeluaran.'%')                                                                                                                      
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereMonth('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$bulan)
                                        ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)  
                                        ->where('Transaksi_Pengeluarans.sisa_pengeluaran','>','0')                                                                              
                                        ->where('Jenis_Pengeluaran.sifat_angsuran','=','1')
                                        ->orderBy('created_at','desc')
                                        ->paginate(50);
        }
        elseif ($request->periode=="tahun")
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username as username2','Suppliers.nama_supplier','Jenis_Pengeluaran.jenis_pengeluaran')                                        
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$request->jenispengeluaran.'%')                                                                                                                  
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)  
                                        ->where('Transaksi_Pengeluarans.sisa_pengeluaran','>','0')                                                                              
                                        ->where('Jenis_Pengeluaran.sifat_angsuran','=','1')
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->paginate(50);
        }
        else
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username as username2','Suppliers.nama_supplier','Jenis_Pengeluaran.jenis_pengeluaran')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)                                        
                                        ->where('Transaksi_Pengeluarans.sisa_pengeluaran','>','0')                                                                                         
                                        ->where('Jenis_Pengeluaran.sifat_angsuran','=','1')
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->paginate(50);
        }
        // dd($datas);
        $jenispengeluaran=Jenis_Pengeluaran::all();
        return view('transaksis.pengeluaran.piutang.piutanglist',['date'=>$date,'datas'=>$datas,
                                                'datajenispengeluarans'=>$jenispengeluaran,
                                                'jenispengeluaran'=>$request->jenispengeluaran,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function angsuranlist(Request $request)
    {
        $date=date('d-m-Y');
        if ($request->tanggal==""){
            $request->tanggal=$date;
        }
        else
        {
            $request->tanggal=date('d-m-Y',strtotime($request->tanggal));
        }

        if (($request->jenispengeluaran=="semua") || ($request->jenispengeluaran=="")){
            $request->jenispengeluaran="";
        }
        else
        {
            $request->jenispengeluaran=decrypt($request->jenispengeluaran);
        }

        if (($request->pembayaran2=="semua") || ($request->pembayaran2=="")){
            $pembayaran="";
        }
        else
        {
            $pembayaran=$request->pembayaran2;
        }

        if ($request->periode=="hari"){
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->select('Angsuran_Pengeluarans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Pengeluarans.id as idtrans','Transaksi_Pengeluarans.total_pengeluaran'
                                    ,'Transaksi_Pengeluarans.namapenerima','Transaksi_Pengeluarans.hppenerima')
                            ->where('Angsuran_Pengeluarans.id','like','%'.$request->nonota.'%')
                            ->where('Angsuran_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id) 
                            ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->where('Angsuran_Pengeluarans.tanggal_angsuran','=',$request->tanggal)
                            ->whereMonth('Angsuran_Pengeluarans.tanggal_angsuran','=',$bulan)
                            ->whereYear('Angsuran_Pengeluarans.tanggal_angsuran','=',$tahun)
                            ->orderBy('created_at','desc')
                            ->paginate(50);

            // $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
            //                             ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
            //                             ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
            //                             ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
            //                             ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
            //                             ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username as username2','Suppliers.nama_supplier','Jenis_Pengeluaran.jenis_pengeluaran')                                        
            //                             ->where('Transaksi_Pengeluarans.cabang_id','=','1')
            //                             ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
            //                             ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$request->jenispengeluaran.'%')                                                                                
            //                             ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
            //                             ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
            //                             ->where('Transaksi_Pengeluarans.tanggal_pengeluaran','like','%'.$request->tanggal.'%')
            //                             ->where('Transaksi_Pengeluarans.sisa_pengeluaran','>','0')
            //                             ->where('Jenis_Pengeluarans.sifat_angsuran','=','1')
            //                             ->orderBy('Transaksi_Pengeluarans.created_at','desc')
            //                             ->paginate(50);
        }
        elseif ($request->periode=="semua"){
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->select('Angsuran_Pengeluarans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Pengeluarans.id as idtrans','Transaksi_Pengeluarans.total_pengeluaran'
                                    ,'Transaksi_Pengeluarans.namapenerima','Transaksi_Pengeluarans.hppenerima')
                            ->where('Angsuran_Pengeluarans.id','like','%'.$request->nonota.'%')
                            ->where('Angsuran_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id) 
                            ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->orderBy('created_at','desc')
                            ->paginate(50);

            // $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        // ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                                        // ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        // ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        // ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        // ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username as username2','Suppliers.nama_supplier','Jenis_Pengeluaran.jenis_pengeluaran')                                        
                                        // ->where('Transaksi_Pengeluarans.cabang_id','=','1')
                                        // ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        // ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$request->jenispengeluaran.'%')                                                                                                                      
                                        // ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        // ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        // ->where('Jenis_Pengeluarans.sifat_angsuran','=','1')
                                        // ->where('Transaksi_Pengeluarans.sisa_pengeluaran','>','0')                                        
                                        // ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        // ->paginate(50);
        }
        elseif ($request->periode=="bulan"){
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];

            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->select('Angsuran_Pengeluarans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Pengeluarans.id as idtrans','Transaksi_Pengeluarans.total_pengeluaran'
                                    ,'Transaksi_Pengeluarans.namapenerima','Transaksi_Pengeluarans.hppenerima')
                            ->where('Angsuran_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id) 
                            ->where('Angsuran_Pengeluarans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereMonth('Angsuran_Pengeluarans.tanggal_angsuran','=',$bulan)
                            ->whereYear('Angsuran_Pengeluarans.tanggal_angsuran','=',$tahun)
                            ->orderBy('created_at','desc')
                            ->paginate(50);

            // $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
            //                             ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
            //                             ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
            //                             ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
            //                             ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
            //                             ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username as username2','Suppliers.nama_supplier','Jenis_Pengeluaran.jenis_pengeluaran')
            //                             ->where('Transaksi_Pengeluarans.cabang_id','=','1')
            //                             ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
            //                             ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$request->jenispengeluaran.'%')                                                                                                                      
            //                             ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
            //                             ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
            //                             ->whereMonth('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$bulan)
            //                             ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)  
            //                             ->where('Transaksi_Pengeluarans.sisa_pengeluaran','>','0')                                                                              
            //                             ->where('Jenis_Pengeluarans.sifat_angsuran','=','1')
            //                             ->orderBy('created_at','desc')
            //                             ->paginate(50);
        }
        elseif ($request->periode=="tahun")
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->select('Angsuran_Pengeluarans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Pengeluarans.id as idtrans','Transaksi_Pengeluarans.total_pengeluaran'
                                    ,'Transaksi_Pengeluarans.namapenerima','Transaksi_Pengeluarans.hppenerima')
                            ->where('Angsuran_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id) 
                            ->where('Angsuran_Pengeluarans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereYear('Angsuran_Pengeluarans.tanggal_angsuran','=',$tahun)
                            ->orderBy('created_at','desc')
                            ->paginate(50);
        }
        else
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->select('Angsuran_Pengeluarans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Pengeluarans.id as idtrans','Transaksi_Pengeluarans.total_pengeluaran'
                                    ,'Transaksi_Pengeluarans.namapenerima','Transaksi_Pengeluarans.hppenerima')
                            ->where('Angsuran_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id) 
                            ->orderBy('created_at','desc')
                            ->paginate(50);
        }
        // dd($datas);
        $jenispengeluaran=Jenis_Pengeluaran::all();
        return view('transaksis.pengeluaran.piutang.angsuranlist',['date'=>$date,'datas'=>$datas,
                                                'datajenispengeluarans'=>$jenispengeluaran,
                                                'jenispengeluaran'=>$request->jenispengeluaran,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
    }

    public function angsurandeleted(Request $request)
    {
        $date=date('d-m-Y');
        if ($request->tanggal==""){
            $request->tanggal=$date;
        }
        else
        {
            $request->tanggal=date('d-m-Y',strtotime($request->tanggal));
        }

        if (($request->jenispengeluaran=="semua") || ($request->jenispengeluaran=="")){
            $request->jenispengeluaran="";
        }
        else
        {
            $request->jenispengeluaran=decrypt($request->jenispengeluaran);
        }

        if (($request->pembayaran2=="semua") || ($request->pembayaran2=="")){
            $pembayaran="";
        }
        else
        {
            $pembayaran=$request->pembayaran2;
        }

        if ($request->periode=="hari"){
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->select('Angsuran_Pengeluarans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Pengeluarans.id as idtrans','Transaksi_Pengeluarans.total_pengeluaran'
                                    ,'Transaksi_Pengeluarans.namapenerima','Transaksi_Pengeluarans.hppenerima')
                            ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsuran_Pengeluarans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->where('Angsuran_Pengeluarans.tanggal_angsuran','=',$request->tanggal)
                            ->orderBy('created_at','desc')
                            ->onlyTrashed()
                            ->paginate(50);

            
        }
        elseif ($request->periode=="semua"){
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->select('Angsuran_Pengeluarans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Pengeluarans.id as idtrans','Transaksi_Pengeluarans.total_pengeluaran'
                                    ,'Transaksi_Pengeluarans.namapenerima','Transaksi_Pengeluarans.hppenerima')
                            ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsuran_Pengeluarans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->onlyTrashed()
                            ->orderBy('created_at','desc')
                            ->paginate(50);

            
        }
        elseif ($request->periode=="bulan"){
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];

            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->select('Angsuran_Pengeluarans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Pengeluarans.id as idtrans','Transaksi_Pengeluarans.total_pengeluaran'
                                    ,'Transaksi_Pengeluarans.namapenerima','Transaksi_Pengeluarans.hppenerima')
                            ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsuran_Pengeluarans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereMonth('Angsuran_Pengeluarans.tanggal_angsuran','=',$bulan)
                            ->whereYear('Angsuran_Pengeluarans.tanggal_angsuran','=',$tahun)
                            ->orderBy('created_at','desc')
                            ->onlyTrashed()
                            ->paginate(50);

        }
        elseif ($request->periode=="tahun")
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->select('Angsuran_Pengeluarans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Pengeluarans.id as idtrans','Transaksi_Pengeluarans.total_pengeluaran'
                                    ,'Transaksi_Pengeluarans.namapenerima','Transaksi_Pengeluarans.hppenerima')
                            ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsuran_Pengeluarans.id','like','%'.$request->nonota.'%')
                            ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereYear('Angsuran_Pengeluarans.tanggal_angsuran','=',$tahun)
                            ->orderBy('created_at','desc')
                            ->onlyTrashed()
                            ->paginate(50);
        }
        else
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->select('Angsuran_Pengeluarans.*','Users.username','Cabangs.Nama_Cabang',
                                    'Transaksi_Pengeluarans.id as idtrans','Transaksi_Pengeluarans.total_pengeluaran'
                                    ,'Transaksi_Pengeluarans.namapenerima','Transaksi_Pengeluarans.hppenerima')
                            ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                            ->orderBy('created_at','desc')
                            ->onlyTrashed()
                            ->paginate(50);
        }
        // dd($datas);
        $jenispengeluaran=Jenis_Pengeluaran::all();
        return view('transaksis.pengeluaran.piutang.piutangdeleted',['date'=>$date,'datas'=>$datas,
                                                'datajenispengeluarans'=>$jenispengeluaran,
                                                'jenispengeluaran'=>$request->jenispengeluaran,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
    }


    public function showangsuran(Request $request){
        $request->id=decrypt($request->id);
        // dd($request->id);
        $showsubtransaksis=Angsuran_Pengeluarans::leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->select('Angsuran_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username')
                            ->where('Angsuran_Pengeluarans.transaksipengeluaran_id','=',$request->id)
                            ->get();
        $transaksi=[];
        foreach ($showsubtransaksis as $key => $value){
            $sub=[];
            $sub['id']=$value->id;
            $sub['id3']=encrypt($value->id);
            $sub['id2']=encrypt($request->id);
            $sub['tanggal_angsuran']=$value->tanggal_angsuran;
            $sub['nominal_angsuran']=$value->nominal_angsuran;
            $sub['metode_pembayaran']=$value->metode_pembayaran;
            $sub['transaksipengeluaran_id']=$value->transaksipengeluaran_id;
            $sub['Nama_Cabang']=$value->Nama_Cabang;
            $sub['username']=$value->username;
            array_push($transaksi,$sub);
        }                            
        return $transaksi;
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
        $table=new Angsuran_Pengeluarans;
        $table->tanggal_angsuran=$date;
        $table->nominal_angsuran=$request->json('nominal');
        $table->user_id=Auth::user()->id;
        $table->cabang_id=Auth::user()->cabangs->id;
        $table->transaksipengeluaran_id=$idtrans;
        $table->metode_pembayaran=$request->json('metode');

        $transaksi=Transaksi_Pengeluaran::where('id','=',$idtrans)
                            ->first();

        $sisa=$transaksi->sisa_pengeluaran - $request->json('nominal');
        $jumlahpembayaran=$transaksi->pembayaran_pengeluaran + $request->json('nominal');

        $transaksi->sisa_pengeluaran=$sisa;
        $transaksi->pembayaran_pengeluaran=$jumlahpembayaran;
        $transaksi->save();

        $table->sisa_angsuran=$sisa;
        if ($table->save())
        {
            $isi=Auth::user()->username." telah menambah angsuran pengeluaran dengan No. Angsuran ".$table->id."pada No. Transaksi Penjualan ".$transaksi->id." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"add");
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
        $tableangsuran=Angsuran_Pengeluarans::where('id','=',$idtrans)
                        ->first();
            // dd($tableangsuran->transaksipenjualan_id);
            $transaksi=Transaksi_Pengeluaran::where('id','=',$tableangsuran->transaksipengeluaran_id)
            ->first();
            // dd($transaksi);
            $sisa=$transaksi->sisa_pengeluaran + $tableangsuran->nominal_angsuran;
            $jumlahpembayaran=$transaksi->pembayaran_pengeluaran - $tableangsuran->nominal_angsuran;

            $transaksi->pembayaran_pengeluaran=$jumlahpembayaran;
            $transaksi->sisa_pengeluaran=$sisa;
            $transaksi->save();

        if ($tableangsuran->delete())
        {
            $isi=Auth::user()->username." telah menghapus angsuran pengeluaran dengan No. Angsuran ".$tableangsuran->id."pada No. Transaksi Penjualan ".$transaksi->id." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"delete");
            return "{\"msg\":\"success\"}";
        }
        else
        {
            return "{\"msg\":\"failed\"}";            
        }
    }

    public function reportangsuran($id)
    {
        $id=decrypt($id);
        // dd("sad");
        $transaksi=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                    ->leftJoin('role_user','role_user.user_id','=','Users.id')
                    ->leftJoin('roles','role_user.role_id','=','roles.id')            
                    ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                    ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                    ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                    ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                    ->select('Transaksi_Pengeluarans.*','Cabangs.Kode_Cabang','Cabangs.Nama_Cabang','Jenis_Pengeluaran.jenis_pengeluaran',
                            'Cabangs.No_Telepon','Cabangs.Email','Cabangs.Alamat','Cabangs.Jenis_Cabang',
                            'Users.nama','roles.display_name')
                    ->withTrashed()
                    ->where('Transaksi_Pengeluarans.id','=',$id)->first();
                    
        $data=Angsuran_Pengeluarans::where('transaksipengeluaran_id','=',$transaksi->id)->get();
        

        return view('report.reporttransangsuranpengeluaran',['transaksi'=>$transaksi,'angsurans'=>$data]);                        

    }

    public function reportdetail($id)
    {
        $id=decrypt($id);

        $data=Angsuran_Pengeluarans::where('id','=',$id)->withTrashed()->first();
        // dd($id);
        $transaksi=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                    ->leftJoin('role_user','role_user.user_id','=','Users.id')
                    ->leftJoin('roles','role_user.role_id','=','roles.id')          
                    ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                    ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                    ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                    ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                    ->select('Transaksi_Pengeluarans.*','Cabangs.Kode_Cabang','Cabangs.Nama_Cabang','Jenis_Pengeluaran.jenis_pengeluaran',
                            'Cabangs.No_Telepon','Cabangs.Email','Cabangs.Alamat','Cabangs.Jenis_Cabang',
                            'Users.nama','roles.display_name')
                    ->withTrashed()
                    ->where('Transaksi_Pengeluarans.id','=',$data->transaksipengeluaran_id)->first();

        $subtransaksis=Sub_Tpengeluaran::where('transaksipengeluaran_id','=',$data->transaksipenjualan_id)->get();
        // dd($transaksi);
        $jumlahangsuran=Angsuran_Pengeluarans::where('transaksipengeluaran_id','=',$data->transaksipengeluaran_id)
                                    ->select(DB::raw('sum(Angsuran_Pengeluarans.nominal_angsuran) as totalangsuran'))
                                    ->first();

        return view('report.reporttransangsuranpengeluarandetail',['transaksi'=>$transaksi,'jumlahangsuran'=>$jumlahangsuran,'subtransaksis'=>$subtransaksis,'angsuran'=>$data]);                        

    }
}
