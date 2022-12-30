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
use App\RangePriceGroup;
use App\RangePricePelanggan;

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

    public function report_to_image($id){
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
        return view('report.reporttranspenjualanimage',['transaksi'=>$transaksi,'subtransaksis'=>$subtransaksis,'id'=>$id, 'angsurans'=>$data]);

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
                $this->createlog($isi,"add");
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
                                        ->groupBy('Transaksi_Penjualans.id')
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
                                        ->groupBy('Transaksi_Penjualans.id')
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
                                        ->groupBy('Transaksi_Penjualans.id')
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
                                        ->groupBy('Transaksi_Penjualans.id')
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
                                        ->groupBy('Transaksi_Penjualans.id')
                                        ->orderBy('created_at','desc');
        }
        // dd($datas->get()->count());
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
        
        if ($request->sisa_tagihan=="sisa_tagihan")
        {
            $datas=$datas->where('Transaksi_Penjualans.sisa_tagihan','>',0); 
        }


        $dataproduks=CProduks::all();

        // dd($datas->get()->count());
        if (($request->submitpelanggan == "export"))
        {
          return (new TransaksiListReport)->proses($request->tanggal,$request->periode,$request->pembayaran,$request->nonota,$request->namapelanggan,$request_produk,$request->submitpelanggan)->download('laporantransaksi.xls');
        }
        if (($request->submitpelanggan == "export_detail"))
        {
          return (new TransaksiListReport)->proses($request->tanggal,$request->periode,$request->pembayaran,$request->nonota,$request->namapelanggan,$request_produk,$request->submitpelanggan)->download('laporantransaksi.xls');
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
                                            // ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                            // ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                            ->select(
                                                // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                'Transaksi_Penjualans.id'
                                                // 'Cabangs.kode_cabang',
                                                // 'Transaksi_Penjualans.tanggal',
                                                // 'Produks.nama_produk',
                                                // 'Sub_Tpenjualans.panjang',
                                                // 'Sub_Tpenjualans.lebar',
                                                // 'Bahanbakus.nama_bahan',
                                                // 'Sub_Tpenjualans.harga_satuan',
                                                // DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                                // 'Sub_Tpenjualans.banyak',
                                                // 'Sub_Tpenjualans.subtotal'
                                                )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereDay('Transaksi_Penjualans.tanggal','=',$request->tanggal)
                                            ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)
                                            ->distinct('Sub_Tpenjualans.penjualan_id')
                                            ->orderBy('Transaksi_Penjualans.created_at','desc');
            }
            elseif ($request->periode=="semua"){
    
    
                $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            // ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                            // ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                            ->select(
                                                 // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                 'Transaksi_Penjualans.id'
                                                // 'Cabangs.kode_cabang', 
                                                // 'Transaksi_Penjualans.tanggal',
                                                // 'Produks.nama_produk',
                                                // 'Sub_Tpenjualans.panjang',
                                                // 'Sub_Tpenjualans.lebar',
                                                // 'Bahanbakus.nama_bahan',
                                                // 'Sub_Tpenjualans.harga_satuan',
                                                // DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                                // 'Sub_Tpenjualans.banyak',
                                                // 'Sub_Tpenjualans.subtotal'
                                                )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->distinct('Sub_Tpenjualans.penjualan_id')
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
                                            // ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                            // ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                            ->select(
                                                 // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                 'Transaksi_Penjualans.id'
                                                // 'Cabangs.kode_cabang', 
                                                //  'Transaksi_Penjualans.tanggal',
                                                // 'Produks.nama_produk',
                                                // 'Sub_Tpenjualans.panjang',
                                                // 'Sub_Tpenjualans.lebar',
                                                // 'Bahanbakus.nama_bahan',
                                                // 'Sub_Tpenjualans.harga_satuan',
                                                // DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                                // 'Sub_Tpenjualans.banyak',
                                                // 'Sub_Tpenjualans.subtotal'
                                                )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)                                        
                                            ->distinct('Sub_Tpenjualans.penjualan_id')
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
                                            // ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                            // ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                            ->select(
                                               // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                               'Transaksi_Penjualans.id'
                                            //     'Cabangs.kode_cabang', 
                                            //    'Transaksi_Penjualans.tanggal',
                                            //   'Produks.nama_produk',
                                            //   'Sub_Tpenjualans.panjang',
                                            //   'Sub_Tpenjualans.lebar',
                                            //   'Bahanbakus.nama_bahan',
                                            //   'Sub_Tpenjualans.harga_satuan',
                                            //   DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                            //   'Sub_Tpenjualans.banyak',
                                            //   'Sub_Tpenjualans.subtotal'
                                              )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.id','like','%'.$request->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$request->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)        
                                            ->distinct('Sub_Tpenjualans.penjualan_id')
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
                                            // ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                            // ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                            ->select(
                                                 // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                 'Transaksi_Penjualans.id'
                                                // 'Cabangs.kode_cabang', 
                                                //  'Transaksi_Penjualans.tanggal',
                                                // 'Produks.nama_produk',
                                                // 'Sub_Tpenjualans.panjang',
                                                // 'Sub_Tpenjualans.lebar',
                                                // 'Bahanbakus.nama_bahan',
                                                // 'Sub_Tpenjualans.harga_satuan',
                                                // DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                                // 'Sub_Tpenjualans.banyak',
                                                // 'Sub_Tpenjualans.subtotal'
                                                )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)           
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->distinct('Sub_Tpenjualans.penjualan_id')
                                            ->orderBy('Transaksi_Penjualans.created_at','desc');
            }


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
            

            // dd($datas->get()->count());

            // untuk subtransaksi
            if ($request->periode=="hari"){
                // dd("hari");    
                $tanggal=explode("-",$request->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datasub=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->select(
                                                // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                'Sub_Tpenjualans.id'
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
    
    
                $datasub=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->select(
                                                // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                'Sub_Tpenjualans.id'
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
                $datasub=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->select(
                                                // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                'Sub_Tpenjualans.id'
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
                $datasub=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->select(
                                                // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                'Sub_Tpenjualans.id'
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
                $datasub=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->select(
                                                // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                                'Sub_Tpenjualans.id'
                                                )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)           
                                            ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                            ->orderBy('Transaksi_Penjualans.created_at','desc');
            }

            $baris = ($datas->get()->count()*3)+$datasub->get()->count();
            // dd($baris);

            // dd($datasub->get()->count());
            return Excel::download(new TagihanTransaksi($request->tanggal,$request->periode,$request->pembayaran,$request->nonota,$request->namapelanggan,$request_produk,$baris-1), 'tagihantransaksi.xlsx');
        }
        else
        {

            // dd(decrypt($request_produk));
            return view('transaksis.transaksilist',['date'=>$date,'datas'=>$datas->paginate(50),
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode,'produk_request'=>encrypt($request_produk),
                                                'produks'=>$dataproduks,
                                                'sisa_tagihan'=>$request->sisa_tagihan]);
          
        }

         
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
            $table->reason_on_delete = $request->json('reason_on_delete');
            if ($table->save()) {
                if ($table->delete()){

                    $tableangsuran=Angsuran::where('transaksipenjualan_id','=',$id);
                    
                    foreach($tableangsuran->get() as $key => $value)
                    {
                      $changeAngsuran = Angsuran::find($value->id);
                      $changeAngsuran->reason_on_delete = $request->json('reason_on_delete');
                      $changeAngsuran->save();
                    }

                    $tableangsuran->delete();

        
                    $isi=Auth::user()->username." telah menghapus transaksi penjualan dengan No. ".$id." di Cabang ".Auth::user()->cabangs->Nama_Cabang." dengan alasan ".$request->json('reason_on_delete').".";
                    $save=$this->createlog($isi,"delete","telegram");
                    return "{\"msg\":\"success\"}";
                }
                else
                {
                    return "{\"msg\":\"failed\"}";
                }
            }
        }else{
            return "{\"msg\":\"failed\"}";
        }

        

    }

    public function showsubtransaksi(Request $request){
        $request->id=decrypt($request->id);
        $showsubtransaksi=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')
                            ->leftJoin('Cabangs','Sub_Tpenjualans.cabang_id','=','Cabangs.id')
                            ->leftJoin('Users','Sub_Tpenjualans.useredited_id','=','Users.id')
                            ->select('Sub_Tpenjualans.*','Produks.nama_produk','Cabangs.Nama_Cabang','Users.username')
                            ->where('penjualan_id','=',$request->id);
        $data = [];
        $data["current"] = $showsubtransaksi->get();
        $showsubtransaksideleted = $showsubtransaksi->onlyTrashed()->get();
        $data["deleted"] = $showsubtransaksideleted;
        return $data;                            
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
    public function edit($id,Request $request)
    {
      //
      $transaksi = CTransaksi_Penjualans::where('id','=',decrypt($id))->first();
      $angsurans = Angsuran::where('transaksipenjualan_id','=',decrypt($id))->get();
      $produks=CProduks::all();
    //   dd($transaksi->sub_penjualans());
      return view('transaksis.transaksiedit',['transaksi'=>$transaksi, 'produks'=>$produks, 'angsurans'=> $angsurans]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //
        
        $detail_befores = $this->decrypt_attribute($request->json('purchased')["before"]["items"]);
        $detail_afters = $this->decrypt_attribute($request->json("purchased")["after"]["items"]);

        $datareturn=[];

        $transaksi=CTransaksi_Penjualans::where('id','=',($request->json('id')))
                        ->first();

        $dataAngsuran = Angsuran::where('transaksipenjualan_id','=',$transaksi->id);

        $sum_angsuran = $dataAngsuran->sum('nominal_angsuran');
        $substractPaidOffBefore = $transaksi->jumlah_pembayaran-$sum_angsuran;
        $substractPaidOffAfter = ($request->json("purchased")["after"]["paidOff"]-$sum_angsuran);

        $tes = 0;
        if ($substractPaidOffAfter < 0)
        {
          $sisaPaidAfter = $substractPaidOffAfter*-1;
          foreach($dataAngsuran->get() as $key => $value)
          {
            if ($sisaPaidAfter == 0)
            {
              break;
            }
            
            $changeAngsuran = Angsuran::find($value->id);
            if ($changeAngsuran->nominal_angsuran >= $sisaPaidAfter){

              
              
              $table=new Angsuran;
              $table->tanggal_angsuran=$changeAngsuran->tanggal_angsuran;
              $table->nominal_angsuran=$changeAngsuran->nominal_angsuran-$sisaPaidAfter;
              $table->user_id=Auth::user()->id;
              $table->cabang_id=$changeAngsuran->cabang_id;
              $table->transaksipenjualan_id=$changeAngsuran->transaksipenjualan_id;
              $table->metode_pembayaran=$changeAngsuran->metode_pembayaran;
              
              $table->sisa_angsuran=$changeAngsuran->sisa_angsuran;
              $table->save();
              
              $changeAngsuran->reason_on_edit = $request->json("reason_on_edit");
              $changeAngsuran->save();

              $deleteAngsuran = Angsuran::find($value->id)->delete();
              $sisaPaidAfter = 0;
            }
            else
            {
              $table=new Angsuran;
              $table->tanggal_angsuran=$changeAngsuran->tanggal_angsuran;
              $table->nominal_angsuran=0;
              $table->user_id=Auth::user()->id;
              $table->cabang_id=$changeAngsuran->cabang_id;
              $table->transaksipenjualan_id=$changeAngsuran->transaksipenjualan_id;
              $table->metode_pembayaran=$changeAngsuran->metode_pembayaran;
              $table->sisa_angsuran=$changeAngsuran->sisa_angsuran;
              $table->save();

              $sisaPaidAfter = $sisaPaidAfter - $changeAngsuran->nominal_angsuran;

              $changeAngsuran->reason_on_edit = $request->json("reason_on_edit");
              $changeAngsuran->save();
              $deleteAngsuran = Angsuran::find($value->id)->delete();
              $sisaPaidAfter = 0;
            }
          }
          $paidOff = $dataAngsuran->sum('nominal_angsuran');
        }
        else
        {
          $paidOff =  $request->json("purchased")["after"]["paidOff"];
        }

        $transaksi->total_harga=$request->json("purchased")["after"]["amountItems"];
        $transaksi->diskon=$request->json("purchased")["after"]["discount"];
        $transaksi->metode_pembayaran=$request->json("purchased")["after"]["pmentMethod"];
        $transaksi->jumlah_pembayaran=$paidOff;
        if ($paidOff == $request->json("purchased")["after"]["amountItems"]){
          $sisaInvoice = 0;
        }
        else
        {
          $sisaInvoice = $request->json("purchased")["after"]["amountItems"] - $paidOff;
        }
        #$transaksi->sisa_tagihan=$request->json("purchased")["after"]["debit"];
        $transaksi->reason_on_edit = $request->json("reason_on_edit");
        $transaksi->sisa_tagihan=$sisaInvoice;
        $transaksi->pajak=$request->json("purchased")["after"]["tax"];        
        $transaksi->user_id=Auth::user()->id;

        if ($transaksi->save())
        {
          $datareturn['status']="Success";
          $datareturn['id']=encrypt($transaksi->id);
          $isi=Auth::user()->username." telah mengedit transaksi penjualan dengan No. ".$transaksi->id." di Cabang ".Auth::user()->cabangs->Nama_Cabang." dengan alasan ".$request->json('reason_on_edit').".";
          $save=$this->createlog($isi,"edit", "telegram");
        }    
        else
        {
        
          $datareturn['status']="Failed";
          $datareturn['id']=encrypt($transaksi->id);
          return $datareturn;
        }

        $must_delete=[];
        foreach ($detail_befores as $key => $detail_before)
        {

          //if  (array_search($detail_before["id"],$detail_afters[$key])=="id") 
          //{
          //  //change data
            $subtransaksi=CSub_Tpenjualans::find($detail_befores[$key]["id"]);
            $subtransaksi->useredited_id=Auth::user()->id;
            $subtransaksi->cabang_id=Auth::user()->cabang_id;
            $subtransaksi->reason_on_edit = $request->json("reason_on_edit");
            $subtransaksi->save();
          //}
          //else
          //{
          //  //remove data
          //  array_push($must_delete,$detail_before["id"]);
          //}
          array_push($must_delete,$detail_before["id"]);
        }

        $resultdelete = CSub_Tpenjualans::whereIn('id', $must_delete)->delete();
        foreach ($detail_afters as $detail_after)
        {
            $subtransaksi=new CSub_Tpenjualans;
            $subtransaksi->penjualan_id=$transaksi->id;
            $subtransaksi->produk_id=$detail_after["productId"];
            $subtransaksi->harga_satuan=$detail_after["price"];
            $subtransaksi->panjang=$detail_after["width"];
            $subtransaksi->lebar=$detail_after["length"];
            $subtransaksi->banyak=$detail_after["quantity"];
            $subtransaksi->keterangan=$detail_after["info"];
            $subtransaksi->user_id=Auth::user()->id;
            $subtransaksi->subtotal=$detail_after["totalPrice"];
            $subtransaksi->finishing=$detail_after["finishing"];
            $subtransaksi->satuan=$detail_after["metric"];
            $subtransaksi->diskon=$detail_after["discount"];
            $subtransaksi->save();
          //if ($detail_after["id"]==null)
          //{
          //  $subtransaksi=new CSub_Tpenjualans;
          //  $subtransaksi->penjualan_id=$transaksi->id;
          //  $subtransaksi->produk_id=$detail_after["productId"];
          //  $subtransaksi->harga_satuan=$detail_after["price"];
          //  $subtransaksi->panjang=$detail_after["width"];
          //  $subtransaksi->lebar=$detail_after["length"];
          //  $subtransaksi->banyak=$detail_after["quantity"];
          //  $subtransaksi->keterangan=$detail_after["info"];
          //  $subtransaksi->user_id=Auth::user()->id;
          //  $subtransaksi->subtotal=$detail_after["totalPrice"];
          //  $subtransaksi->finishing=$detail_after["finishing"];
          //  $subtransaksi->satuan=$detail_after["metric"];
          //  $subtransaksi->diskon=$detail_after["discount"];
          //  $subtransaksi->save();
          //}
          //else
          //{
          //  $subtransaksi=CSub_Tpenjualans::where('id','=',$detail_after["id"])->first();
          //  $subtransaksi->produk_id=$detail_after["productId"];
          //  $subtransaksi->harga_satuan=$detail_after["price"];
          //  $subtransaksi->panjang=$detail_after["width"];
          //  $subtransaksi->lebar=$detail_after["length"];
          //  $subtransaksi->banyak=$detail_after["quantity"];
          //  $subtransaksi->keterangan=$detail_after["info"];
          //  $subtransaksi->user_id=Auth::user()->id;
          //  $subtransaksi->subtotal=$detail_after["totalPrice"];
          //  $subtransaksi->finishing=$detail_after["finishing"];
          //  $subtransaksi->satuan=$detail_after["metric"];
          //  $subtransaksi->diskon=$detail_after["discount"];
          //  $subtransaksi->save();
          //}
            

        }

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
              $harga = CSpesialprices:: leftJoin('Produks', 'Spesialprices.produk_id','=','Produks.id')
                                      ->select('Spesialprices.id','Spesialprices.user_id','Spesialprices.produk_id','Spesialprices.harga_khusus','Produks.satuan','Produks.hitung_luas')
                                      ->where('Spesialprices.pelanggan_id','=',$idpelanggan)
                                      ->where('Spesialprices.produk_id','=',$idproduk)
                                      ->first();
              $range_prices =
                RangePricePelanggan::where('special_price_pelanggan_id', '=', $harga->id)->get();
              return response()->json([
                  'user_id'       => $harga->user_id,
                  'produk_id'     => $harga->produk_id,
                  'harga_jual'    => $harga->harga_khusus,
                  'hitung_luas'   => $harga->hitung_luas,
                  'satuan'        => $harga->satuan,
                  'range_prices' => $range_prices
              ]);
            }      
            else
            {
                $idjenispelanggan=CPelanggans::where('id','=',$idpelanggan)
                                    ->first();
                $harga=CSpesialpricesgroup::leftJoin('Produks', 'Spesialpricesgroups.produk_id','=','Produks.id')
                                            ->select('Spesialpricesgroups.id', 'Spesialpricesgroups.user_id','Spesialpricesgroups.produk_id','Spesialpricesgroups.harga_khusus','Produks.satuan','Produks.hitung_luas')
                                            ->where('jenispelanggan_id','=',$idjenispelanggan->jenispelanggan_id)
                                            ->where('produk_id','=',$idproduk)
                                            ->first();
                if ($harga == null){
                  $harga=CProduks::where('id','=',$idproduk)
                                  ->first();
                  return response()->json([
                      'user_id'       => $harga->user_id,
                      'produk_id'     => $harga->id,
                      'harga_jual'    => $harga->harga_jual,
                      'hitung_luas'   => $harga->hitung_luas,
                      'satuan'        => $harga->satuan,
                      'range_prices' => []
                  ]);
                }else if ($harga != null){
                  $range_prices = RangePriceGroup::where('special_price_group_id', '=', $harga->id)->get();
                  return response()->json([
                      'user_id'       => $harga->user_id,
                      'produk_id'     => $harga->produk_id,
                      'harga_jual'    => $harga->harga_khusus,
                      'hitung_luas'   => $harga->hitung_luas,
                      'satuan'        => $harga->satuan,
                      'range_prices' => $range_prices
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

    private function decrypt_attribute($arr)
    {
      foreach ($arr as $key => $data ) 
      {
        if ($arr[$key]["id"]!=null)
        {
          $arr[$key]["id"] = decrypt($data["id"]);
        }
      }

      return $arr;
    }

   
}
