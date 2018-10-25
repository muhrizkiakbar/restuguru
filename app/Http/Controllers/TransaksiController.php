<?php

namespace App\Http\Controllers;
use App\CKategories;
use App\CProduks;
use App\CCabangs;
use App\CSpesialprices;
use App\CSpesialpricesgroup;
use App\CPelanggans;
use App\CSub_Tpenjualans;
use App\CTransaksi_Penjualans;
use App\Angsuran;
use App\CRelasiBahanBakus;
use App\stokbahanbaku;
use App\CBahanBakus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Pagination\LengthAwarePaginator;

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
        $produks=CProduks::all();

        return view('transaksis.transaksi',['date'=>$date,'produks'=>$produks]);
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
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
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
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
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
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
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
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
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
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)                                                    
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
        $subtransaksis=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')
                        ->select('Sub_Tpenjualans.*','Produks.nama_produk')
                        ->where('penjualan_id','=',$id)->get();
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
        // dd($request->json('inputpelanggan'));
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
        $transaksi->cabang_id=Auth::user()->cabangs->id;
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
    
            $relasibahanbakus=CRelasiBahanBakus::where('produk_id','=',$value['id'])
                                                 ->get();

            foreach( $relasibahanbakus as $key=>$relasibahanbaku ){
                $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$relasibahanbaku->bahanbaku_id)
                                            ->where('cabang_id','=',Auth::user()->cabangs->id)
                                            ->count();

                $bahanbakugethitungluas=CBahanBakus::find($relasibahanbaku->bahanbaku_id);
                // dd($stokbahanbaku);
                if ($stokbahanbaku==0)
                {

                    $addbahanbaku=new stokbahanbaku;
                    $addbahanbaku->bahanbaku_id=$relasibahanbaku->bahanbaku_id;
                    $addbahanbaku->cabang_id=Auth::user()->cabangs->id;
                    $addbahanbaku->satuan=$bahanbakugethitungluas->satuan;


                    $addbahanbaku->stokhitungluas=$bahanbakugethitungluas->hitung_luas;

                    if (($value['satuan']=="CENTIMETER") || ($value['satuan']=="METER"))
                    {
                        // dd('jancokkk');
                        if (($bahanbakugethitungluas->satuan=="CENTIMETER") && ($value['satuan']=="METER"))
                        {
                            $luas=($value['panjang']*100)*($value['lebar']*100)*$value['kuantitas'];
                        }
                        elseif (($bahanbakugethitungluas->satuan==$value['satuan']))
                        {
                            $luas=($value['panjang'])*($value['lebar'])*$value['kuantitas'];
                        }
                        elseif (($bahanbakugethitungluas->satuan=="METER") && ($value['satuan']=="CENTIMETER"))
                        {
                            $luas=($value['panjang']/100)*($value['lebar']/100)*$value['kuantitas'];
                        }

                        $addbahanbaku->banyakstok=$luas;
                    }
                    else
                    {
                        $addbahanbaku->banyakstok=$value['kuantitas'];
                    }

                    $addbahanbaku->save();

                }
                else
                {  
                    $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$relasibahanbaku->bahanbaku_id)
                                                ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                ->first();

                    if (($value['satuan']=="CENTIMETER") || ($value['satuan']=="METER"))
                    {
                        // dd('jancok');
                        if (($bahanbakugethitungluas->satuan=="CENTIMETER") && ($value['satuan']=="METER"))
                        {
                            $luas=($value['panjang']*100)*($value['lebar']*100)*$value['kuantitas'];
                        }
                        elseif (($bahanbakugethitungluas->satuan==$value['satuan']))
                        {
                            $luas=($value['panjang'])*($value['lebar'])*$value['kuantitas'];
                        }
                        elseif (($bahanbakugethitungluas->satuan=="METER") && ($value['satuan']=="CENTIMETER"))
                        {
                            // dd("sd");
                            $luas=($value['panjang']/100)*($value['lebar']/100)*$value['kuantitas'];
                        }
                        // dd($stokbahanbaku->banyakstok);

                        $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok-( $luas * $relasibahanbaku->qtypertrx );
                        // dd($relasibahanbaku->qtypertrx);
                    }
                    else
                    {
                        $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok-( $value['kuantitas'] * $relasibahanbaku->qtypertrx );
                    }

                    $stokbahanbaku->save();
                  

                }

            }

            
            if ($subtransaksi->save()){

                $isi=Auth::user()->username." telah menambah transaksi penjualan dengan No. ".$transaksi->id." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
                $save=$this->createlog($isi,"add");
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
            $date=$request->tanggal;
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
                                        ->where('Transaksi_Penjualans.nomor_nota','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereDay('Transaksi_Penjualans.tanggal','=',$request->tanggal)
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)
                                        ->orderBy('created_at','desc')
                                        ->paginate(50);
        }
        elseif ($request->periode=="semua"){
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
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
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
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
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
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
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)                                                    
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

        $subtransaksis=CSub_Tpenjualans::where('penjualan_id','=',$id)->get();

        foreach($subtransaksis as $subtransaksi){
            $relasibahanbakus=CRelasiBahanBakus::where('produk_id','=',$subtransaksi->produk_id)
                                                 ->get();
            // dd($relasibahanbakus);
            foreach( $relasibahanbakus as $key=>$relasibahanbaku ){
                $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$relasibahanbaku->bahanbaku_id)
                                            ->where('cabang_id','=',Auth::user()->cabangs->id)
                                            ->count();

                $bahanbakugethitungluas=CBahanBakus::find($relasibahanbaku->bahanbaku_id);
                // dd($stokbahanbaku);
                $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$relasibahanbaku->bahanbaku_id)
                                            ->where('cabang_id','=',Auth::user()->cabangs->id)
                                            ->first();

                if (($subtransaksi->satuan=="CENTIMETER") || ($subtransaksi->satuan=="METER"))
                {
                    // dd('jancok');
                    if (($bahanbakugethitungluas->satuan=="CENTIMETER") && ($subtransaksi->satuan=="METER"))
                    {
                        $luas=($subtransaksi->panjang*100)*($subtransaksi->lebar*100)*$subtransaksi->banyak;
                    }
                    elseif (($bahanbakugethitungluas->satuan==$subtransaksi->satuan))
                    {
                        $luas=($subtransaksi->panjang)*($subtransaksi->lebar)*$subtransaksi->banyak;
                    }
                    elseif (($bahanbakugethitungluas->satuan=="METER") && ($subtransaksi->satuan=="CENTIMETER"))
                    {
                        $luas=($subtransaksi->panjang/100)*($subtransaksi->lebar/100)*$subtransaksi->banyak;
                    }

                    $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+( $luas * $relasibahanbaku->qtypertrx );
                }
                else
                {
                    $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+( $subtransaksi->banyak * $relasibahanbaku->qtypertrx );
                }
                // dd($stokbahanbaku->banyakstok);
                // dd($stokbahanbaku->banyakstok);

                if ($stokbahanbaku->save())
                {
                    $stokbahanbakustatus = true;
                }else{
                    $stokbahanbakustatus = false;
                }


            }
        }

        if ($stokbahanbakustatus){
            if ($table->delete()){
                $tableangsuran=Angsuran::where('transaksipenjualan_id','=',$id)
                            ->delete();
    
                $isi=Auth::user()->username." telah menghapus transaksi penjualan dengan No. ".$id." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
                $save=$this->createlog($isi,"delete");
                return "{\"msg\":\"success\"}";
            }
            else
            {
                return "{\"msg\":\"failed\"}";
            }
        }else{
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

        $produks=CProduks::all();

        return view('transaksis.transaksiedit',['datas'=>$showsubtransaksi,'count'=>$counttransaksi,'transaksi'=>$showtransaksi,'date'=>$date,'produks'=>$produks]);
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

                $isi=Auth::user()->username." telah mengedit transaksi penjualan dengan No. ".decrypt($request->json('inputtransaksiid'))." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
                $save=$this->createlog($isi,"edit");
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
                $harga=CSpesialprices:: leftJoin('Produks', 'Spesialprices.produk_id','=','Produks.id')
                                        ->select('Spesialprices.user_id','Spesialprices.produk_id','Spesialprices.harga_khusus','Produks.satuan','Produks.hitung_luas')
                                        ->where('Spesialprices.pelanggan_id','=',$idpelanggan)
                                        ->where('Spesialprices.produk_id','=',$idproduk)
                                        ->first();
                return response()->json([
                    'user_id'       => $harga->user_id,
                    'produk_id'     => $harga->produk_id,
                    'harga_jual'    => $harga->harga_khusus,
                    'hitung_luas'   => $harga->hitung_luas,
                    'satuan'        => $harga->satuan
                ]);
            }      
            else
            {
                $idjenispelanggan=CPelanggans::where('id','=',$idpelanggan)
                                    ->first();
                $harga=CSpesialpricesgroup::leftJoin('Produks', 'Spesialpricesgroups.produk_id','=','Produks.id')
                                            ->select('Spesialpricesgroups.user_id','Spesialpricesgroups.produk_id','Spesialpricesgroups.harga_khusus','Produks.satuan','Produks.hitung_luas')
                                            ->where('jenispelanggan_id','=',$idjenispelanggan->jenispelanggan_id)
                                            ->where('produk_id','=',$idproduk)
                                            ->first();
                if ($harga == null){
                    $harga=CProduks::where('id','=',$idproduk)
                                    ->first();
                    return $harga;
                }else if ($harga != null){
                    return response()->json([
                        'user_id'       => $harga->user_id,
                        'produk_id'     => $harga->produk_id,
                        'harga_jual'    => $harga->harga_khusus,
                        'hitung_luas'   => $harga->hitung_luas,
                        'satuan'        => $harga->satuan
                    ]);
                }
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


    public function jatuhtempo()
    {
        $pelanggans=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                ->whereNotNull('Transaksi_Penjualans.pelanggan_id')
                ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                ->select('Pelanggans.id','Pelanggans.nama_perusahaan',DB::raw('SUM(Transaksi_Penjualans.total_harga) as total_harga')
                        ,DB::raw('SUM(Transaksi_Penjualans.sisa_tagihan) as sisa_tagihan2'),'Pelanggans.hp_pelanggan','Pelanggans.limit_pelanggan',
                        'Pelanggans.alamat_pelanggan','Pelanggans.tempo_pelanggan')
                ->havingRaw('sisa_tagihan2 >= limit_pelanggan')
                ->groupBy('Pelanggans.id')
                // ->orWhere('Transaksi_Penjualans.pelanggan_id','=',$request->jenispelanggan)
                //->paginate(30);
                ->get();
        $data=[];
        foreach ($pelanggans as $key=>$pelanggan)
        {
            $subdata=[];
            $subdata['id']=$pelanggan->id;
            $subdata['nama_perusahaan']=$pelanggan->nama_perusahaan;
            $subdata['hp_pelanggan']=$pelanggan->hp_pelanggan;
            $subdata['alamat_pelanggan']=$pelanggan->alamat_pelanggan;
            $subdata['total_harga']=$pelanggan->total_harga;
            $subdata['sisa_tagihan2']=$pelanggan->sisa_tagihan2;
            $subdata['limit_pelanggan']=$pelanggan->limit_pelanggan;
            array_push($data,$subdata);
        }

        $article=collect($data);

        // pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 30;
        $currentResults = $article->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $results = new LengthAwarePaginator($currentResults, $article->count(), $perPage);
        return view('jatuhtempo.jatuhtempo',['datas'=>$results]); 
    }

    public function jatuhtempocari(Request $request)
    {
        $id=($request->pelanggan);
        $pelanggan=CPelanggans::where('id','=',$id)->first();
        $pelanggans=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                ->whereNotNull('Transaksi_Penjualans.pelanggan_id')
                ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                ->where('Transaksi_Penjualans.pelanggan_id','=',$id)
                ->select('Pelanggans.id','Pelanggans.nama_perusahaan',DB::raw('SUM(Transaksi_Penjualans.total_harga) as total_harga')
                        ,DB::raw('SUM(Transaksi_Penjualans.sisa_tagihan) as sisa_tagihan'),'Pelanggans.hp_pelanggan','Pelanggans.limit_pelanggan',
                        'Pelanggans.alamat_pelanggan','Pelanggans.tempo_pelanggan')
                ->where('sisa_tagihan','>=',$pelanggan->limit_pelanggan)
                ->groupBy('Pelanggans.id')
                // ->orWhere('Transaksi_Penjualans.pelanggan_id','=',$request->jenispelanggan)
                //->paginate(30);
                ->count();
        
        return $pelanggans;
    }


   
}
