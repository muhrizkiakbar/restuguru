<?php

namespace App\Http\Controllers;
use App\CKategories;
use App\CProduks;
use App\CCabangs;
use App\CUsers;
use App\CSpesialprices;
use App\CSpesialpricesgroup;
use App\CPelanggans;
use App\CSub_Tpenjualans;
use App\CTransaksi_Penjualans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaksi()
    {
        //
        $date=date("Y-m-d");

        return view('transaksis.transaksi',['date'=>$date]);
    }

    public function transaksideleted(Request $request)
    {
        //
        $date=date('d-m-Y');
        if ($request->tanggal==""){
            $request->tanggal=$date;
        }
        else
        {
            $request->tanggal=date('d-m-Y',strtotime($request->tanggal));
        }

        if (($request->pembayaran=="semua") || ($request->pembayaran=="")){
            $pembayaran="";
        }
        else
        {
            $pembayaran=$request->pembayaran;
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
                                        ->orderBy('created_at','desc')
                                        ->onlyTrashed()                                        
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
                                        ->orderBy('created_at','desc')
                                        ->onlyTrashed()                                        
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
                                        ->orderBy('created_at','desc')
                                        ->onlyTrashed()                                        
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
                                        ->orderBy('created_at','desc')
                                        ->onlyTrashed()                                        
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
                                        ->orderBy('created_at','desc')
                                        ->onlyTrashed()
                                        ->paginate(50);
        }
        
        
        return view('transaksis.transaksideleted',['date'=>$date,'datas'=>$datas,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
    }

    public function report($id){
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
        $subtransaksis=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')->where('penjualan_id','=',$id)->get();
        return view('report.reporttranspenjualan',['transaksi'=>$transaksi,'subtransaksis'=>$subtransaksis]);
        // $pdf=PDF::loadView('report.reporttranspenjualan',['transaksi'=>$transaksi,'subtransaksis'=>$subtransaksis]);
        // // return $pdf->setPaper('F4', 'landscape')->download('laporanharian.pdf');
        // return $pdf->setPaper('a4', 'landscape')->stream('filename.pdf',array('Attachment'=>1));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function piutang(){
        $date=date("Y-m-d");
        return view('transaksis.piutang.piutang',['date'=>$date]);
    }

    public function angsuranpiutang(){
        $date=date("Y-m-d");
        return view('transaksis.piutang.piutanglist',['date'=>$date]);
    }
    
    public function angsuranpiutangdeleted(){
        $date=date("Y-m-d");
        return view('transaksis.piutang.piutangdeleted',['date'=>$date]);
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
        $nonow=CTransaksi_Penjualans::latest()->withTrashed()->first();

        if ($nonow==null){
            $nonota=1;
            // return $nonota;
        }
        else
        {
            $nonota=$nonow->id+1;
        }
        // dd($nonota);
        $transaksi= new CTransaksi_Penjualans;
        $transaksi->nomor_nota=$nonota;
        $transaksi->hp_pelanggan=$request->json('inputnomorpelanggan');
        $transaksi->nama_pelanggan=$request->json('inputnamapelanggan');
        $transaksi->pelanggan_id=$request->json('inputpelanggan');
        $transaksi->tanggal=$request->json('inputtanggal');
        $transaksi->total_harga=$request->json('inputtotal');
        $transaksi->diskon=$request->json('inputdiskon');
        $transaksi->metode_pembayaran=$request->json('inputpembayaran');
        $transaksi->jumlah_pembayaran=$request->json('inputbayardp');
        $transaksi->sisa_tagihan=$request->json('inputsisa');
        $transaksi->pajak=$request->json('inputpajak');        
        $transaksi->user_id=Auth::user()->id;
        $transaksi->cabang_id=1;
        $transaksi->save();
            

        $detailitem=[];
        foreach ($request->json('jsonprodukid') as $keyproduk=> $dataprodukid){
            $subdetail=[];
            $subdetail['id']=$dataprodukid['value'];
            foreach ($request->json('jsonharga') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['harga']=$data['value'];
                }
            }
            foreach ($request->json('jsonpanjang') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['panjang']=$data['value'];
                }
            }
            foreach ($request->json('jsonlebar') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['lebar']=$data['value'];
                }
            }
            foreach ($request->json('jsonkuantitas') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['kuantitas']=$data['value'];
                }
            }
            foreach ($request->json('jsonfinishing') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['finishing']=$data['value'];
                }
            }
            foreach ($request->json('jsondiskon') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['diskonnow']=$data['value'];
                }
            }
            foreach ($request->json('jsonketerangan') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['keterangan']=$data['value'];
                }
            }
            foreach ($request->json('jsonsubtotal') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['subtotal']=$data['value'];
                }
            }
            foreach ($request->json('jsonsatuan') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['satuan']=$data['value'];
                }
            }
            array_push($detailitem,$subdetail);
        }

        foreach ($detailitem as $key=>$value){
            
            $subtransaksi=new CSub_Tpenjualans;
            $subtransaksi->penjualan_id=$nonota;
            $subtransaksi->produk_id=$value['id'];
            $subtransaksi->harga_satuan=$value['harga'];
            $subtransaksi->panjang=$value['panjang'];
            $subtransaksi->lebar=$value['lebar'];
            $subtransaksi->banyak=$value['kuantitas'];
            $subtransaksi->keterangan=$value['keterangan'];
            $subtransaksi->user_id=Auth::user()->id;
            $subtransaksi->subtotal=$value['subtotal'];
            $subtransaksi->finishing=$value['finishing'];
            $subtransaksi->satuan=$value['satuan'];
            $subtransaksi->diskon=$value['diskonnow'];
            
            if ($subtransaksi->save()){
                $status="Success";
            }else
            {
                $status="Failed";                
            }
            
        }
        $datareturn=[];
        $datareturn['status']=$status;
        $datareturn['id']=encrypt($transaksi->id);
        return $datareturn;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listtransaksi(Request $request){
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
                                        ->orderBy('created_at','desc')
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
                                        ->orderBy('created_at','desc')
                                        ->paginate(50);
        }
        
        
        return view('transaksis.transaksilist',['date'=>$date,'datas'=>$datas,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
    }

    public function datatransaksispesific(Request $request){
        $request->id=decrypt($request->id);
        $table=CTransaksi_Penjualans::where('id','=',$request->id)
                    ->first();
        $data=[];
        $data['nonota']=$table->nomor_nota;
        $data['nama_pelanggan']=$table->nama_pelanggan;

        return $data;
    }

    public function destroytransaksi(Request $request)
    {
        //
        $id=decrypt($request->json('id'));
        // dd($id);
        
        $table=CTransaksi_Penjualans::where('id','=',$id)
                    ->first();

        if ($table->delete()){
            return "{\"msg\":\"success\"}";
        }
        else
        {
            return "{\"msg\":\"failed\"}";
        }

    }

    public function showsubtransaksi(Request $request){
        $request->id=decrypt($request->id);
        $showsubtransaksi=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')
                            ->select('Sub_Tpenjualans.*','Produks.nama_produk')
                            ->where('penjualan_id','=',$request->id)
                            ->get();
        return $showsubtransaksi;                            
    }

    public function show($id)
    {
        //

        $date=date('Y-m-d');

        $id=decrypt($id);
        $showtransaksi=CTransaksi_Penjualans::where('id','=',$id)
        ->first();
        $showsubtransaksi=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')
                                ->where('penjualan_id','=',$id)
                                ->select('Sub_Tpenjualans.*','Produks.nama_produk')
                                ->get();

        $counttransaksi=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')
        ->where('penjualan_id','=',$id)
        ->select('Sub_Tpenjualans.*','Produks.nama_produk')
        ->count();
        return view('transaksis.transaksiedit',['datas'=>$showsubtransaksi,'count'=>$counttransaksi,'transaksi'=>$showtransaksi,'date'=>$date]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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
    public function update(Request $request)
    {
        //
        
        // dd($nonota);
        $transaksi=CTransaksi_Penjualans::where('id','=',decrypt($request->json('inputtransaksiid')))
                        ->first();

        $transaksi->total_harga=$request->json('inputtotal');
        $transaksi->diskon=$request->json('inputdiskon');
        $transaksi->metode_pembayaran=$request->json('inputpembayaran');
        $transaksi->jumlah_pembayaran=$request->json('inputbayardp');
        $transaksi->sisa_tagihan=$request->json('inputsisa');
        $transaksi->pajak=$request->json('inputpajak');        
        $transaksi->user_id=1;
        $transaksi->save();
            

        $detailitem=[];
        foreach ($request->json('jsonprodukid') as $keyproduk=> $dataprodukid){
            $subdetail=[];
            
            $subdetail['id']=$dataprodukid['value'];
            // dd($request->json('jsonsubtransid'));
            foreach ($request->json('jsonsubtransid') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['subtransid']=$data['value'];
                }
            }
            foreach ($request->json('jsonharga') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['harga']=$data['value'];
                }
            }
            foreach ($request->json('jsonpanjang') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['panjang']=$data['value'];
                }
            }
            foreach ($request->json('jsonlebar') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['lebar']=$data['value'];
                }
            }
            foreach ($request->json('jsonkuantitas') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['kuantitas']=$data['value'];
                }
            }
            foreach ($request->json('jsonfinishing') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['finishing']=$data['value'];
                }
            }
            foreach ($request->json('jsondiskon') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['diskonnow']=$data['value'];
                }
            }
            foreach ($request->json('jsonketerangan') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['keterangan']=$data['value'];
                }
            }
            foreach ($request->json('jsonsubtotal') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['subtotal']=$data['value'];
                }
            }
            foreach ($request->json('jsonsatuan') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['satuan']=$data['value'];
                }
            }
            array_push($detailitem,$subdetail);
        }
        $deletesubpenjualan=CSub_Tpenjualans::where('penjualan_id','=',decrypt($request->json('inputtransaksiid')))->forceDelete();

        foreach ($detailitem as $key=>$value){
            // dd($value['subtransid']);
            // $subtransaksi=CSub_Tpenjualans::where('id','=',$value['subtransid'])->first();
            $subtransaksi=new CSub_Tpenjualans;
            $subtransaksi->penjualan_id=$transaksi->nomor_nota;
            $subtransaksi->produk_id=$value['id'];
            $subtransaksi->harga_satuan=$value['harga'];
            $subtransaksi->panjang=$value['panjang'];
            $subtransaksi->lebar=$value['lebar'];
            $subtransaksi->banyak=$value['kuantitas'];
            $subtransaksi->keterangan=$value['keterangan'];
            $subtransaksi->user_id=1;
            $subtransaksi->subtotal=$value['subtotal'];
            $subtransaksi->finishing=$value['finishing'];
            $subtransaksi->satuan=$value['satuan'];
            $subtransaksi->diskon=$value['diskonnow'];
            
            if ($subtransaksi->save()){
                $status="Success";
            }else
            {
                $status="Failed";                
            }
            
        }
        $datareturn=[];
        $datareturn['status']=$status;
        $datareturn['id']=encrypt($transaksi->id);
        return $datareturn;
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
    //catata
    //  data listransaksi sesuai user cabang, mun kd keitu kada kawa meliat data kecual superuser
    // function khusus pencarian data

    public function priceprodukkhusus(Request $request){
            
        $idpelanggan=($request->pelanggan);
        $idproduk=($request->produkid);

        $cekpelanggan=CPelanggans::where('id','=',$idpelanggan)
                ->count();
        // dd($idpelanggan);
        if ($cekpelanggan > 0)
        {
            $carispecialprice=CSpesialprices::where('pelanggan_id','=',$idpelanggan)
                                                ->where('produk_id','=',$idproduk)
                                                ->count();
            if ($carispecialprice > 0)
            {
                $harga=CSpesialprices::where('pelanggan_id','=',$idpelanggan)
                                        ->where('produk_id','=',$idproduk)->first();
                return $harga;
            }      
            else
            {
                $idjenispelanggan=CPelanggans::where('id','=',$idpelanggan)
                                    ->first();
                $harga=CSpesialpricesgroup::where('jenispelanggan_id','=',$idjenispelanggan->jenispelanggan_id)
                                    ->first();
                return $harga;
            }
        }
        
    }

    public function pelanggancari(Request $request){
        $term = trim($request->q);
        if (empty($term)) {
            return response()->json([]);
        }
        $tags = CPelanggans::where('nama_perusahaan','LIKE','%'.$term.'%')->limit(20)->get();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama_perusahaan];
        }
        return response()->json($formatted_tags);
    }

    public function pelanggandetail(Request $request){
        

        $table=CPelanggans::where('id','=',$request->id)
                ->first();
        return $table;
    }
}
