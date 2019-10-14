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
use App\Exports\TransaksiPenjualan\TagihanTransaksi;
use App\Exports\TransaksiPenjualan\TransaksiListReport;
use Excel;
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
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
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
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
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
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
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
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
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
        // dd($transaksi);
        $subtransaksis=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')
                        ->select('Sub_Tpenjualans.*','Produks.nama_produk')
                        ->where('penjualan_id','=',$id)->get();

        $data=Angsuran::where('transaksipenjualan_id','=',$id)->get();
        return view('report.reporttranspenjualan',['transaksi'=>$transaksi,'subtransaksis'=>$subtransaksis, 'angsurans'=>$data]);
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
        $nonow=CTransaksi_Penjualans::withTrashed()->latest()->first();
        
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
        // $transaksi->nomor_nota=$nonota;
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
            $subtransaksi->penjualan_id=$transaksi->id;
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
    public function listtransaksi(TransaksiListReport $transaksiReport,Request $request){
        
        $date=date('d-m-Y');
        if ($request->tanggal==""){
            $request->tanggal=$date;
        }
        else
        {
              
            $request->tanggal=date('d-m-Y',strtotime($request->tanggal));
            $date=$request->tanggal;
        }
        // dd($request->tanggal);

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
                                        ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereDay('Transaksi_Penjualans.tanggal','=',$request->tanggal)
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)
                                        ->orderBy('created_at','desc');
        }
        elseif ($request->periode=="semua"){
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->orderBy('created_at','desc');
        }
        elseif ($request->periode=="bulan"){
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)                                        
                                        ->orderBy('created_at','desc');
        }
        elseif ($request->periode=="tahun")
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)                                        
                                        ->orderBy('created_at','desc');
        }
        else
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        ->select('Transaksi_Penjualans.*','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)                                                    
                                        ->orderBy('created_at','desc');
        }
        //dd($datas);
        $request_produk=($request->produk);
        if (($request_produk=="") || ($request_produk=="semua"))
        {
            if ($request_produk=="")
            {
                $request_produk=("semua");
            }
        }
        else
        {
            $request_produk=decrypt($request->produk);
            $datas=$datas->where('Sub_Tpenjualans.produk_id','=',$request_produk);
        }
        

        $dataproduks=CProduks::all();

        if (($request->submitpelanggan == "export"))
        {
          return (new TransaksiListReport)->proses($request->tanggal,$request->periode,$request->pembayaran,$request->nonota,$request->namapelanggan,$request_produk)->download('laporantransaksi.xls');
        }
        elseif (($request->submitpelanggan == "tagihan")) 
        {
            if ($request->periode=="hari"){
                // dd("hari");    
                $tanggal=explode("-",$request->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                            ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                            ->select(
                                                // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                'Transaksi_Penjualans.id',
                                                'Cabangs.kode_cabang',
                                                'Transaksi_Penjualans.tanggal',
                                                'Produks.nama_produk',
                                                'Sub_Tpenjualans.panjang',
                                                'Sub_Tpenjualans.lebar',
                                                'Bahanbakus.nama_bahan',
                                                'Sub_Tpenjualans.harga_satuan',
                                                DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                                'Sub_Tpenjualans.banyak',
                                                'Sub_Tpenjualans.subtotal'
                                                )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereDay('Transaksi_Penjualans.tanggal','=',$request->tanggal)
                                            ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)
                                            ->orderBy('Transaksi_Penjualans.created_at','desc');
            }
            elseif ($request->periode=="semua"){
    
    
                $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                            ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                            ->select(
                                                 // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                 'Transaksi_Penjualans.id',
                                                'Cabangs.kode_cabang', 
                                                'Transaksi_Penjualans.tanggal',
                                                'Produks.nama_produk',
                                                'Sub_Tpenjualans.panjang',
                                                'Sub_Tpenjualans.lebar',
                                                'Bahanbakus.nama_bahan',
                                                'Sub_Tpenjualans.harga_satuan',
                                                DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                                'Sub_Tpenjualans.banyak',
                                                'Sub_Tpenjualans.subtotal'
                                                )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->orderBy('Transaksi_Penjualans.created_at','desc');
            }
            elseif ($request->periode=="bulan"){
                // dd("bulan");    
    
                $tanggal=explode("-",$request->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                            ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                            ->select(
                                                 // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                 'Transaksi_Penjualans.id',
                                                'Cabangs.kode_cabang', 
                                                 'Transaksi_Penjualans.tanggal',
                                                'Produks.nama_produk',
                                                'Sub_Tpenjualans.panjang',
                                                'Sub_Tpenjualans.lebar',
                                                'Bahanbakus.nama_bahan',
                                                'Sub_Tpenjualans.harga_satuan',
                                                DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                                'Sub_Tpenjualans.banyak',
                                                'Sub_Tpenjualans.subtotal'
                                                )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)                                        
                                            ->orderBy('Transaksi_Penjualans.created_at','desc');
            }
            elseif ($request->periode=="tahun")
            {
                // dd("tahun");    
                
                $tanggal=explode("-",$request->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                            ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                            ->select(
                                               // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                               'Transaksi_Penjualans.id',
                                                'Cabangs.kode_cabang', 
                                               'Transaksi_Penjualans.tanggal',
                                              'Produks.nama_produk',
                                              'Sub_Tpenjualans.panjang',
                                              'Sub_Tpenjualans.lebar',
                                              'Bahanbakus.nama_bahan',
                                              'Sub_Tpenjualans.harga_satuan',
                                              DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                              'Sub_Tpenjualans.banyak',
                                              'Sub_Tpenjualans.subtotal'
                                              )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)        
                                            ->orderBy('Transaksi_Penjualans.created_at','desc');
            }
            else
            {
                // dd("kintil");    
    
                $tanggal=explode("-",$request->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                            ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                            ->select(
                                                 // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                 'Transaksi_Penjualans.id',
                                                'Cabangs.kode_cabang', 
                                                 'Transaksi_Penjualans.tanggal',
                                                'Produks.nama_produk',
                                                'Sub_Tpenjualans.panjang',
                                                'Sub_Tpenjualans.lebar',
                                                'Bahanbakus.nama_bahan',
                                                'Sub_Tpenjualans.harga_satuan',
                                                DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                                'Sub_Tpenjualans.banyak',
                                                'Sub_Tpenjualans.subtotal'
                                                )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)           
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->orderBy('Transaksi_Penjualans.created_at','desc');
            }
            // dd($datas->get()->count());
            return Excel::download(new TagihanTransaksi($request->tanggal,$request->periode,$request->pembayaran,$request->nonota,$request->namapelanggan,$request_produk,$datas->get()->count()), 'tagihantransaksi.xlsx');
        }
        else
        {

            // dd(decrypt($request_produk));
            return view('transaksis.transaksilist',['date'=>$date,'datas'=>$datas->paginate(50),
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode,'produk_request'=>encrypt($request_produk),
                                                'produks'=>$dataproduks]);
          
        }

         
    }

    
    private function tagihanexport($namaFile, $instansi, $periodeH, $atts, $jumlahbaris){
        //for not repeat function in another function
        //excel for month report
        //data header
        $headerdata_1 = array('NIP','Nama','Periode','Hari Kerja (WA | TWA)','Hadir (WA | TWA)','Apel (WA | TWA)', 'Akumulasi Jam Kerja');
        $headerdata_2 = array('Tanpa Kabar (WA | TWA)','Izin (WA | TWA)','Izin Terlambat (WA | TWA)','Izin Pulang Cepat (WA | TWA)',
                            'Sakit (WA | TWA)','Cuti (WA | TWA)','Tugas Luar (WA | TWA)','Tugas Belajar (WA | TWA)','Ijin Kepentingan Lain (WA | TWA)',
                            'Terlambat (WA | TWA)','Akumulasi Jam Terlambat','Pulang Cepat (WA | TWA)');
        $headerdata_3 = array('Tidak Masuk Kerja','Melanggar Ketentuan Jam Kerja');
  
        return Excel::create($namaFile,function($excel) use ($instansi, $periodeH, $headerdata_1, $headerdata_2, $headerdata_3, $atts, $jumlahbaris ){ // create('namaFilenya',function($excel) use ($atts)
                //dd(); cek ouput
                $excel->sheet('Laporan',function($sheet) use ($instansi, $periodeH, $headerdata_1, $headerdata_2, $headerdata_3, $atts, $jumlahbaris){
                        $sheet->setPrintArea('A1:S'.$jumlahbaris); //set printing area
                        $sheet->setOrientation('portrait');
                        $sheet->setFitToPage(1);
                        $sheet->setFitToWidth(1);  // fit allcolumn in one page
                        $sheet->setFitToHeight(0);
                        $sheet->setRowsToRepeatAtTop(1,5);
                        $sheet->setFreeze('A7');
  
                        $sheet->setAutoSize(array('A','B','C'));
                        $sheet->setWidth(array( 'D' => 8.43, 'F' => 8.43, 'G' => 14.29, 'H' => 8.43, 'J' => 11, 'K' => 8.43, 'N' => 8.43, 'O' => 8.43, 'P' => 14.29, 'Q' => 8.43, 'R' => 13.57, 'S' => 14.57 ));
                        $sheet->getStyle('D2:S2')->getAlignment()->setWrapText(true);
                        $sheet->getStyle('D6:S6')->getAlignment()->setWrapText(true); //wrap text nama instansi
  
                        //HEADER UTAMA//
                        $sheet->mergeCells('B1:S1');
                        $sheet->cell('B1',function ($cell){
                          $cell->setAlignment('center');
                          $cell->setValue('REKAPITULASI DAFTAR HADIR PEGAWAI NEGERI SIPIL');
                          $cell->setFontWeight('bold');
                          $cell->setFontSize(25);
                        });
  
                        $sheet->cell('B2',function ($cell) { $cell->setAlignment('left'); $cell->setValignment('center'); $cell->setValue('UNIT'); $cell->setFontWeight('bold'); $cell->setFontSize(20); });
                        $sheet->cell('C2',function ($cell) { $cell->setAlignment('left'); $cell->setValignment('center'); $cell->setValue(':'); $cell->setFontWeight('bold'); $cell->setFontSize(20); });
                        $sheet->mergeCells('D2:S2');
                        $sheet->cell('D2',function ($cell) use ($instansi){
                          $cell->setAlignment('left');
                          $cell->setValignment('center');
                          $cell->setValue($instansi.' PROVINSI KALIMANTAN SELATAN');
                          $cell->setFontWeight('bold');
                          $cell->setFontSize(20);
                        });
  
                        $sheet->cell('B3',function ($cell) { $cell->setAlignment('left');$cell->setValignment('top'); $cell->setValue('PERIODE'); $cell->setFontWeight('bold'); $cell->setFontSize(20); });
                        $sheet->cell('C3',function ($cell) { $cell->setAlignment('left');$cell->setValignment('top'); $cell->setValue(':'); $cell->setFontWeight('bold'); $cell->setFontSize(20); });
                        $sheet->mergeCells('D3:S3');
                        $sheet->cell('D3',function ($cell) use ($periodeH){
                          $cell->setAlignment('left');
                          $cell->setValignment('top');
                          $cell->setValue($periodeH);
                          $cell->setFontWeight('bold');
                          $cell->setFontSize(22);
                        });
  
                        $objDrawing = new PHPExcel_Worksheet_Drawing;
                        $objDrawing->setPath(public_path('dist/img/kop.jpg')); //your image path
                        $objDrawing->setCoordinates('A1');
                        $objDrawing->setResizeProportional(false);
                        $objDrawing->setWidth(65);
                        $objDrawing->setHeight(200);
                        $objDrawing->setWorksheet($sheet);
                        $sheet->setHeight(array(1=>45,2=>62,3=>45)); //pas
                        $sheet->mergeCells('A1:A3');
                        //$sheet->cell('A3',function($cell){$cell->setBorder('none','none','thick','none');});
                        $sheet->cell('A4:S4',function($cell){$cell->setBorder('thick','none','none','none');});
                        //HEADER UTAMA//
  
                        $sheet->getStyle('A5:S5')->getAlignment()->setWrapText(true);
                        $sheet->cell('A5:S6',function ($cell){
                          $cell->setBackground('#a9abb1');
                          $cell->setAlignment('center');
                          $cell->setValignment('center');
                          $cell->setFontWeight('bold');
                          $cell->setFontSize(12);
                        });
                        $sheet->cell('C',function ($cell){ $cell->setAlignment('center'); });
                        $sheet->cell('G',function ($cell){ $cell->setAlignment('center'); });
                        $sheet->cell('R',function ($cell){ $cell->setAlignment('center'); });
                        //Merge for header data
                        $sheet->setMergeColumn(array(
                            'columns' => array('A','B','C','D','E','F','G'),
                            'rows' => array(
                                array(5,6)
                            )
                        ));
                        $sheet->mergeCells('H5:P5');
                        $sheet->mergeCells('Q5:S5');
                        //styling isi data
                        $sheet->setBorder('A5:S'.$jumlahbaris, 'thin'); //styling border isi data
  
                        //data nama header, data akan ditambahkan pada baris array data berikutnya
                        $sheet->cell('A5:S6',function ($cell) use ($headerdata_3){ 
                            $cell->setAlignment('center');$cell->setValignment('center');$cell->setValue($headerdata_3[0]);$cell->setFontWeight('bold');
                        });
                        $sheet->cell('A5',function ($cell) use ($headerdata_1){ $cell->setValue($headerdata_1[0]);});
                        $sheet->cell('B5',function ($cell) use ($headerdata_1){ $cell->setValue($headerdata_1[1]);});
                        $sheet->cell('C5',function ($cell) use ($headerdata_1){ $cell->setValue($headerdata_1[2]);});
                        $sheet->cell('D5',function ($cell) use ($headerdata_1){ $cell->setValue($headerdata_1[3]);});
                        $sheet->cell('E5',function ($cell) use ($headerdata_1){ $cell->setValue($headerdata_1[4]);});
                        $sheet->cell('F5',function ($cell) use ($headerdata_1){ $cell->setValue($headerdata_1[5]);});
                        $sheet->cell('G5',function ($cell) use ($headerdata_1){ $cell->setValue($headerdata_1[6]);});
                        $sheet->cell('H5',function ($cell) use ($headerdata_3){ $cell->setValue($headerdata_3[0]);});
                        $sheet->cell('Q5',function ($cell) use ($headerdata_3){ $cell->setValue($headerdata_3[1]);});
                        $sheet->cell('H6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[0]);});
                        $sheet->cell('I6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[1]);});
                        $sheet->cell('J6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[2]);});
                        $sheet->cell('K6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[3]);});
                        $sheet->cell('L6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[4]);});
                        $sheet->cell('M6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[5]);});
                        $sheet->cell('N6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[6]);});
                        $sheet->cell('O6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[7]);});
                        $sheet->cell('P6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[8]);});
                        $sheet->cell('Q6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[9]);});
                        $sheet->cell('R6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[10]);});
                        $sheet->cell('S6',function ($cell) use ($headerdata_2){ $cell->setValue($headerdata_2[11]);});
                        //$sheet->cell('Q5',function ($cell) use ($headerdata_3){ $cell->setAlignment('center');$cell->setValignment('center');$cell->setValue($headerdata_3[1]);$cell->setFontWeight('bold');});
                        $sheet->fromArray($atts, null, 'A7', true, false); //data jumlah absensi. data header ditambahkan kesini
                        //dd($sheet->fromArray()); //for check data from sheet array
  
                        //paremeter ke 4 untuk mengubah nilai 0 ditulis sebagai 0, bukan sebagai null data
                        //array use ->fromArray($source, $nullValue, $startCell, $strictNullComparison, $headingGeneration) inside the sheet closure.
  
                    });
            })->download('xls');
    }


    public function datatransaksispesific(Request $request){
        $request->id=decrypt($request->id);
        $table=CTransaksi_Penjualans::where('id','=',$request->id)
                    ->first();
        $data=[];
        $data['nonota']=$table->id;
        $data['nama_pelanggan']=$table->nama_pelanggan;

        return $data;
    }

    public function destroytransaksi(Request $request)
    {
        //
        $id=decrypt($request->json('id'));
        // dd($id);
        $stokbahanbakustatus=false;
        $table=CTransaksi_Penjualans::where('id','=',$id)
                    ->first();

        $subtransaksis=CSub_Tpenjualans::where('penjualan_id','=',$id)->get();

        if ($subtransaksis->count()==0)
        {
            $stokbahanbakustatus=true;
        }
        else
        {
            foreach($subtransaksis as $subtransaksi){
                $relasibahanbakus=CRelasiBahanBakus::where('produk_id','=',$subtransaksi->produk_id)
                                                    ->get();
                                
                if ($relasibahanbakus->count()==0)
                {
                    return "{\"msg\":\"Relasi Bahan Baku Tidak Ditemukan !!\"}"; 
                }
                foreach( $relasibahanbakus as $key=>$relasibahanbaku ){
                    $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$relasibahanbaku->bahanbaku_id)
                                                ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                ->count();

                    $bahanbakugethitungluas=CBahanBakus::find($relasibahanbaku->bahanbaku_id);
                    $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$relasibahanbaku->bahanbaku_id)
                                                ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                ->first();
                    // dd($stokbahanbaku);

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
                        // dd('atas'.$stokbahanbaku->banyakstok);
                    }
                    else
                    {
                        $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+( $subtransaksi->banyak * $relasibahanbaku->qtypertrx );
                        // dd('bawah'.$stokbahanbaku->banyakstok);
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
        }
        // dd($stokbahanbakustatus);
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
            $subtransaksi->penjualan_id=$transaksi->id;
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
