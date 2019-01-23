<?php

namespace App\Http\Controllers;
use App\Jenis_Pengeluaran;
use App\User;
use App\CBahanBakus;
use App\Transaksi_Pengeluaran;
use App\Sub_Tpengeluaran;
use App\Angsuran_Pengeluarans;
use App\CSuppliers;
use App\stokbahanbaku;
use Illuminate\Http\Request;
use PDF;
use App\Exports\TransaksiPengeluaran\TransaksiListPengeluaranReport;
use Excel;

use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Validator;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $date=date("Y-m-d");
        $jenispengeluaran=Jenis_Pengeluaran::all();
        // dd($jenispengeluaran);
        $bahanbaku=CBahanBakus::all();
        return view('transaksis.pengeluaran.transaksi',['date'=>$date,'jenispengeluarans'=>$jenispengeluaran,'bahanbakus'=>$bahanbaku]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jenispengeluaransearch(Request $request){
        $table=Jenis_Pengeluaran::where('id','=',decrypt($request->id))
                ->select('form_mode','sifat_angsuran')
                ->first();
        return $table;
    }

    public function Usersearchdetail(Request $request){
        $data = User::where('id','=',$request->id)
                    ->select('Telepon','nama')
                    ->first();

        return $data;
    }

    public function Userssearch(Request $request){
        $term = trim($request->q);
        if (empty($term)) {
            return response()->json([]);
        }
        $tags = User::where('nama','LIKE','%'.$term.'%')->limit(20)->get();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama];
        }
        return response()->json($formatted_tags);
    }

    public function suppliersearchdetail(Request $request){
        $data=CSuppliers::where('id','=',$request->id)
                ->select('nama_supplier','telpon_supplier')
                ->first();

        return $data;
    }

    public function suppliersearch(Request $request){
        $term = trim($request->q);
        if (empty($term)) {
            return response()->json([]);
        }
        $tags = CSuppliers::where('nama_supplier','LIKE','%'.$term.'%')->limit(20)->get();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama_supplier];
        }
        return response()->json($formatted_tags);
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
        $nonow=Transaksi_Pengeluaran::withTrashed()->orderBy('id', 'desc')->first();

        if ($nonow==null){
            $nonota=1;
            // return $nonota;
        }
        else
        {
            $nonota=$nonow->id+1;
        }
        // dd($nonota);
        $jenispeng=Jenis_Pengeluaran::where('id','=',decrypt($request->json('inputjenispengeluaran')))
                                    ->first();

        if ($jenispeng->sifat_angsuran==0){
            $sisa=0;
            $pembayaran_pengeluaran=$request->json('inputtotal');
        }                                    
        else
        {
            $sisa=$request->json('inputsisa');
            $pembayaran_pengeluaran=$request->json('inputbayardp');
        }

        $transaksi= new Transaksi_Pengeluaran;
        $transaksi->jenispengeluaran_id=decrypt($request->json('inputjenispengeluaran'));
        $transaksi->hppenerima=$request->json('inputnomorpelanggan');
        $transaksi->namapenerima=$request->json('inputnamapelanggan');
        $transaksi->tanggal_pengeluaran=$request->json('inputtanggal');
        $transaksi->total_pengeluaran=$request->json('inputtotal');
        $transaksi->metode_pembayaran=$request->json('inputpembayaran');
        $transaksi->pembayaran_pengeluaran=$pembayaran_pengeluaran;
        $transaksi->sisa_pengeluaran=$sisa;
        $transaksi->supplier_id=$request->json('inputsupplier');        
        $transaksi->clientuser_id=$request->json('inputpelanggan');        
        $transaksi->user_id=Auth::user()->id;
        $transaksi->cabang_id=Auth::user()->cabangs->id;
        $transaksi->save();

        $isi=Auth::user()->username." telah menambahakan transaksi pengeluaran dengan Nota ".$transaksi->id." di cabang ".Auth::user()->cabangs->Nama_Cabang.".";
        $save=$this->createlog($isi,"add");
        
        if ($transaksi->save())
        {

            $detailitem=[];
            foreach ($request->json('jsonproduk') as $keyproduk=> $dataprodukid){
                $subdetail=[];
                $subdetail['produk']=$dataprodukid['value'];

                foreach ($request->json('jsonprodukid') as $key=>$data){
                    if ($key==$keyproduk){
                        $subdetail['produkid']=$data['value'];
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

            // dd($detailitem);
            foreach ($detailitem as $key=>$value){
                
                $subtransaksi=new Sub_Tpengeluaran;
                $subtransaksi->transaksipengeluaran_id=$transaksi->id;
                $subtransaksi->nama_bahanbaku=$value['produk'];
                $subtransaksi->harga_satuan=$value['harga'];
                $subtransaksi->panjang=$value['panjang'];
                $subtransaksi->lebar=$value['lebar'];
                $subtransaksi->kuantitas=$value['kuantitas'];
                $subtransaksi->keterangan=$value['keterangan'];
                $subtransaksi->user_id=Auth::user()->id;
                $subtransaksi->cabang_id=Auth::user()->cabangs->id;
                $subtransaksi->sub_totalpengeluaran=$value['subtotal'];
                
                // if ($value['satuan']==null)
                // {
                //     $value['satuan']=
                // }

                $subtransaksi->satuan=$value['satuan'];
                // dd(is_numeric($value['produkid']));
                if (is_numeric($value['produkid']))
                {
                    $subtransaksi->bahanbaku_id=$value['produkid'];

                    $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$value['produkid'])
                                                    ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                    ->count();

                    $bahanbakugethitungluas=CBahanBakus::find($value['produkid']);
                    // dd($stokbahanbaku);
                    if ($stokbahanbaku==0)
                    {

                        $addbahanbaku=new stokbahanbaku;
                        $addbahanbaku->bahanbaku_id=$value['produkid'];
                        $addbahanbaku->cabang_id=Auth::user()->cabangs->id;
                        $addbahanbaku->satuan=$bahanbakugethitungluas->satuan;


                        $addbahanbaku->stokhitungluas=$bahanbakugethitungluas->hitung_luas;

                        if (($value['satuan']=="CENTIMETER") || ($value['satuan']=="METER"))
                        {

                            if (($bahanbakugethitungluas->satuan=="CENTIMETER") && ($value['satuan']=="METER"))
                            {
                                $luas=(($value['panjang']*100)*($value['lebar']*100))*$value['kuantitas'];
                            }
                            elseif (($bahanbakugethitungluas->satuan==$value['satuan']))
                            {
                                $luas=(($value['panjang'])*($value['lebar']))*$value['kuantitas'];
                            }
                            elseif (($bahanbakugethitungluas->satuan=="METER") && ($value['satuan']=="CENTIMETER"))
                            {
                                $luas=(($value['panjang']/100)*($value['lebar']/100))*$value['kuantitas'];
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
                        $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$value['produkid'])
                                                    ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                    ->first();

                        if (($value['satuan']=="CENTIMETER") || ($value['satuan']=="METER"))
                        {

                            if (($bahanbakugethitungluas->satuan=="CENTIMETER") && ($value['satuan']=="METER"))
                            {
                                $luas=(($value['panjang']*100)*($value['lebar']*100))*$value['kuantitas'];
                            }
                            elseif (($bahanbakugethitungluas->satuan==$value['satuan']))
                            {
                                $luas=(($value['panjang'])*($value['lebar']))*$value['kuantitas'];
                            }
                            elseif (($bahanbakugethitungluas->satuan=="METER") && ($value['satuan']=="CENTIMETER"))
                            {
                                // dd("sd");
                                $luas=(($value['panjang']/100)*($value['lebar']/100))*$value['kuantitas'];
                            }

                            $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+$luas;
                        }
                        else
                        {
                            $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+$value['kuantitas'];
                        }

                        $stokbahanbaku->save();

                    }


                }
                else
                {
                    $subtransaksi->bahanbaku_id=null;
                }

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
        else
        {
            $datareturn=[];
            $datareturn['status']="Failed";
            return $datareturn;
        }
    }

    
    public function reporttranspengeluaran($id)
    {
        //
        $id=decrypt($id);
        $transaksi=Transaksi_Pengeluaran::leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                    ->leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                    ->leftJoin('role_user','role_user.user_id','=','Users.id')
                    ->leftJoin('roles','role_user.role_id','=','roles.id') 
                    ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')
                    ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                    // ->leftJoin('Jenis_Pengeluaran','Pelanggans.jenispelanggan_id','=','Jenispelanggans.id')
                    ->select('Transaksi_Pengeluarans.*','Cabangs.Kode_Cabang','Cabangs.Nama_Cabang',
                            'Cabangs.No_Telepon','Cabangs.Email','Cabangs.Alamat','Cabangs.Jenis_Cabang',
                            'Users.nama','UserClient.nama as nama_client','Jenis_Pengeluaran.jenis_pengeluaran'
                            ,'roles.display_name')
                    ->withTrashed()
                    ->where('Transaksi_Pengeluarans.id','=',$id)->first();
        // dd($transaksi);
        $data=Angsuran_Pengeluarans::where('transaksipengeluaran_id','=',$transaksi->id)->get();
        $subtransaksis=Sub_Tpengeluaran::where('transaksipengeluaran_id','=',$id)->get();
        return view('report.reporttranspengeluaran',['transaksi'=>$transaksi,'subtransaksis'=>$subtransaksis, 'angsurans'=>$data]);

        // $pdf=PDF::loadView('report.reporttranspengeluaran',['transaksi'=>$transaksi,'subtransaksis'=>$subtransaksis]);
        // // return $pdf->setPaper('F4', 'landscape')->download('laporanharian.pdf');
        // return $pdf->setPaper('a5', 'landscape')->stream();
    }

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

        if (($request->pembayaran=="semua") || ($request->pembayaran=="")){
            $pembayaran="";
        }
        else
        {
            $pembayaran=$request->pembayaran;
        }

        if ($request->periode=="hari"){
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            // dd($tanggal);
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username','Suppliers.nama_supplier')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereDay('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$request->tanggal)
                                        ->whereMonth('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$bulan)
                                        ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->paginate(50);
                                        
        }
        elseif ($request->periode=="semua"){

            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username','Suppliers.nama_supplier')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->paginate(50);
        }
        elseif ($request->periode=="bulan")
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')                                        
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username','Suppliers.nama_supplier')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereMonth('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$bulan)
                                        ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)                                        
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
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
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username','Suppliers.nama_supplier')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)                                        
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
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username','UserClient.username','Suppliers.nama_supplier')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->select('Transaksi_Pengeluarans.*','Cabangs.Nama_Cabang','Users.username')                                            
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->paginate(50);
        }
        
        if (($request->submitpelanggan == "export"))
        {
          return (new TransaksiListPengeluaranReport)->proses($request->tanggal,$request->periode,$request->pembayaran,$request->nonota,$request->namapelanggan)->download('laporanpengeluaran.xls');  
        }
        else
        {
            return view('transaksis.pengeluaran.transaksilist',['date'=>$date,'datas'=>$datas,
                                                    'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                    'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                    'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
        }
    }

    public function pengeluarandeleted(Request $request){
        // dd($request);
        // dd($request->periode);
        
        $date=date('d-m-Y');

        if ($request->tanggal==""){
            $request->tanggal=$date;
        }
        else
        {
            $request->tanggal=date('d-m-Y',strtotime($request->tanggal));
        }
        #######
        if (($request->pembayaran=="semua") || ($request->pembayaran=="")){
            $pembayaran="";
        }
        else
        {
            $pembayaran=$request->pembayaran;
        }
        #########
        if (($request->jenispengeluaran=="semua") || ($request->jenispengeluaran=="")){
            $jenispengeluaran2="";
        }
        else
        {
            $request->jenispengeluaran=decrypt($request->jenispengeluaran);
            $jenispengeluaran2=$request->jenispengeluaran;
        }

        $jenispengeluaran=Jenis_Pengeluaran::all();

        if ($request->periode=="hari"){
            $datas=Transaksi_Pengeluaran::leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as ClientUsers','Transaksi_Pengeluarans.user_id','=','ClientUsers.id')
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->select('Transaksi_Pengeluarans.*','Jenis_Pengeluaran.jenis_pengeluaran'
                                        ,'ClientUsers.username','Suppliers.nama_supplier'
                                        ,'Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->where('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$request->tanggal)
                                        ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$jenispengeluaran2.'%')
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->onlyTrashed()                                        
                                        ->paginate(50);
        }
        elseif ($request->periode=="semua"){
            $datas=Transaksi_Pengeluaran::leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as ClientUsers','Transaksi_Pengeluarans.user_id','=','ClientUsers.id')
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->select('Transaksi_Pengeluarans.*','Jenis_Pengeluaran.jenis_pengeluaran'
                                        ,'ClientUsers.username','Suppliers.nama_supplier'
                                        ,'Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$jenispengeluaran2.'%')
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->onlyTrashed()                                        
                                        ->paginate(50);
                                        // dd($datas);
        }
        elseif ($request->periode=="bulan"){
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Transaksi_Pengeluaran::leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as ClientUsers','Transaksi_Pengeluarans.user_id','=','ClientUsers.id')
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->select('Transaksi_Pengeluarans.*','Jenis_Pengeluaran.jenis_pengeluaran'
                                        ,'ClientUsers.username','Suppliers.nama_supplier'
                                        ,'Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$jenispengeluaran2.'%')
                                        ->whereMonth('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$bulan)
                                        ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->onlyTrashed()                                        
                                        ->paginate(50);

            // dd($tahun);
        }
        elseif ($request->periode=="tahun")
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Transaksi_Pengeluaran::leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as ClientUsers','Transaksi_Pengeluarans.user_id','=','ClientUsers.id')
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->select('Transaksi_Pengeluarans.*','Jenis_Pengeluaran.jenis_pengeluaran'
                                        ,'ClientUsers.username','Suppliers.nama_supplier'
                                        ,'Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$request->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$request->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)
                                        ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$jenispengeluaran2.'%')
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->onlyTrashed()                                        
                                        ->paginate(50);
        }
        else
        {
            $tanggal=explode("-",$request->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Transaksi_Pengeluaran::leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as ClientUsers','Transaksi_Pengeluarans.user_id','=','ClientUsers.id')
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->select('Transaksi_Pengeluarans.*','Jenis_Pengeluaran.jenis_pengeluaran'
                                        ,'ClientUsers.username','Suppliers.nama_supplier'
                                        ,'Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->orderBy('Transaksi_Pengeluarans.created_at','desc')
                                        ->onlyTrashed()                                        
                                        ->paginate(50);
        }
        
        
        return view('transaksis.pengeluaran.transaksideleted',['date'=>$request->tanggal,'datas'=>$datas,'jenispengeluaran'=>$jenispengeluaran,
                                                'jenispengeluaranreq'=>$request->jenispengeluaran,
                                                'nonota'=>$request->nonota,'namapelanggan'=>$request->namapelanggan,
                                                'pelanggan'=>$request->pelanggan,'pembayaran'=>$request->pembayaran,
                                                'tanggal'=>$request->tanggal,'periode'=>$request->periode]);
    }

    public function show($id){

        $date=date('Y-m-d');
        // dd($id);
        $id=decrypt($id);
        // dd($id);
        $showtransaksi=Transaksi_Pengeluaran::where('id','=',$id)
        ->first();



        $showsubtransaksi=Sub_Tpengeluaran::where('transaksipengeluaran_id','=',$id)
                                ->leftJoin('Bahanbakus','Sub_Tpengeluarans.bahanbaku_id','=','Bahanbakus.id')
                                ->select('Sub_Tpengeluarans.*','Bahanbakus.hitung_luas')
                                ->get();

        $counttransaksi=Sub_Tpengeluaran::where('transaksipengeluaran_id','=',$id)
        ->select('Sub_Tpengeluarans.*')
        ->count();

        $bahanbaku=CBahanBakus::all();

        $jenispengeluaran2=Jenis_Pengeluaran::where('id','=',$showtransaksi->jenispengeluaran_id)->first();
        // dd($jenispengeluaran2->form_mode);
        $jenispengeluaran=Jenis_Pengeluaran::all();
        return view('transaksis.pengeluaran.transaksiedit',['datas'=>$showsubtransaksi,'jenispengeluarans'=>$jenispengeluaran,'jenismodal'=>$jenispengeluaran2->form_mode,'count'=>$counttransaksi,'transaksi'=>$showtransaksi,'bahanbakus'=>$bahanbaku,'date'=>$date]);
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
    public function update(Request $request)
    {
        //
        // dd($request->json('transaksiid'));
        $id=decrypt($request->json('transaksiid'));
        $transaksi=Transaksi_Pengeluaran::where('id','=',$id)->first();

        $jenispeng=Jenis_Pengeluaran::where('id','=',$transaksi->jenispengeluaran_id)
                                    ->first();

        if ($jenispeng->sifat_angsuran==0){
            $sisa=0;
            $pembayaran_pengeluaran=$request->json('inputtotal');
        }                                    
        else
        {
            $sisa=$request->json('inputsisa');
            $pembayaran_pengeluaran=$request->json('inputbayardp');
        }

        $transaksi->tanggal_pengeluaran=$request->json('inputtanggal');
        $transaksi->total_pengeluaran=$request->json('inputtotal');
        $transaksi->metode_pembayaran=$request->json('inputpembayaran');
        $transaksi->pembayaran_pengeluaran=$pembayaran_pengeluaran;
        $transaksi->sisa_pengeluaran=$sisa;
        $transaksi->supplier_id=$request->json('inputsupplier');        
        $transaksi->clientuser_id=$request->json('inputpelanggan');        
        $transaksi->user_id=Auth::user()->id;
        $transaksi->cabang_id=Auth::user()->cabangs->id;
        $transaksi->save();
            
        // dd($request->json('jsonsubtotal'));
        $isi=Auth::user()->username." telah mengubah/mengedit transaksi pengeluaran dengan Nota ".$transaksi->id." di cabang ".Auth::user()->cabangs->Nama_Cabang.".";
        $save=$this->createlog($isi,"edit");

        $detailitem=[];
        // dd($request->json('jsonsubtransid'));
        $subtransidarray=[];
        foreach ($request->json('jsonproduk') as $keyproduk=> $dataprodukid){
            $subdetail=[];
            $subdetail['produk']=$dataprodukid['value'];

            foreach ($request->json('jsonsubtransid') as $key=>$data){
                if ($key==$keyproduk){
                    $subdetail['subtransid']=decrypt($data['value']);
                    array_push($subtransidarray,decrypt($data['value']));
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

        // dd($subtransidarray);
            
        $subtransaksideletes=Sub_Tpengeluaran::whereNotIn('id',$subtransidarray)
                        ->where('transaksipengeluaran_id','=',$id)->get();

        foreach ($subtransaksideletes as $subtransaksidelete)
        {
            $deletedata=Sub_Tpengeluaran::where('id','=',$subtransaksidelete->id)->first();

            if ($deletedata->bahanbaku_id!=null)
            {

                $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$deletedata->bahanbaku_id)
                                                    ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                    ->first();

                if (($deletedata->bahanbaku_id=="CENTIMETER") || ($deletedata->bahanbaku_id=="METER"))
                {

                    if (($deletedata->satuan=="CENTIMETER") && ($stokbahanbaku->satuan=="METER"))
                    {
                        $luas=($deletedata->panjang*100)*($deletedata->lebar*100)*$stokbahanbaku->satuan;
                    }
                    elseif (($deletedata->satuan==$stokbahanbaku->satuan))
                    {
                        $luas=($deletedata->panjang)*($deletedata->lebar)*$value['kuantitas'];
                    }
                    elseif (($deletedata->satuan=="METER") && ($stokbahanbaku->satuan=="CENTIMETER"))
                    {
                        // dd("sd");
                        $luas=($deletedata->panjang/100)*($deletedata->lebar/100)*$deletedata->kuantitas;
                    }

                    $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+$luas;
                }
                else
                {
                    $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+$deletedata->kuantitas;
                }

                
                if ($stokbahanbaku->save())
                {
                    $deletedata->delete();
                }
            }
            else
            {
                $deletedata->delete();
            }
        }
        
        foreach ($detailitem as $key=>$value){
            
            $cekdata=Sub_Tpengeluaran::where('id','=',$value['subtransid'])
                                        ->count();

            if ($cekdata>0)
            {
                $subtransaksi=Sub_Tpengeluaran::where('id','=',$value['subtransid'])->first();
                $subtransaksi->transaksipengeluaran_id=$id;
                $subtransaksi->nama_bahanbaku=$value['produk'];
                $subtransaksi->harga_satuan=$value['harga'];
                $subtransaksi->panjang=$value['panjang'];
                $subtransaksi->lebar=$value['lebar'];
                $subtransaksi->kuantitas=$value['kuantitas'];
                $subtransaksi->keterangan=$value['keterangan'];
                $subtransaksi->user_id=Auth::user()->id;
                $subtransaksi->cabang_id=Auth::user()->cabangs->id;
                $subtransaksi->sub_totalpengeluaran=$value['subtotal'];
                $subtransaksi->satuan=$value['satuan'];
                
                if (is_numeric($value['produkid']))
                {
                    $subtransaksi->bahanbaku_id=$value['produkid'];

                    $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$value['produkid'])
                                                    ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                    ->count();

                    $bahanbakugethitungluas=CBahanBakus::find($value['produkid']);

                    if ($stokbahanbaku==0)
                    {

                        $addbahanbaku=new stokbahanbaku;
                        $addbahanbaku->bahanbaku_id=$value['produkid'];
                        $addbahanbaku->cabang_id=Auth::user()->cabangs->id;
                        $addbahanbaku->satuan=$value['satuan'];


                        $addbahanbaku->stokhitungluas=$bahanbakugethitungluas->hitung_luas;

                        if (($value['satuan']=="CENTIMETER") || ($value['satuan']=="METER"))
                        {

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
                        $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$value['produkid'])
                                                    ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                    ->first();

                        if (($value['satuan']=="CENTIMETER") || ($value['satuan']=="METER"))
                        {

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

                            $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok-$luas;
                        }
                        else
                        {
                            $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok-$value['kuantitas'];
                        }

                        $stokbahanbaku->save();

                    }

                }
                else
                {
                    $subtransaksi->bahanbaku_id=null;
                }

                if ($subtransaksi->save()){
                    $status="Success";
                }else
                {
                    $status="Failed";                
                }
            }
            else
            {
                $subtransaksi=new Sub_Tpengeluaran;
                $subtransaksi->transaksipengeluaran_id=$id;
                $subtransaksi->nama_bahanbaku=$value['produk'];
                $subtransaksi->harga_satuan=$value['harga'];
                $subtransaksi->panjang=$value['panjang'];
                $subtransaksi->lebar=$value['lebar'];
                $subtransaksi->kuantitas=$value['kuantitas'];
                $subtransaksi->keterangan=$value['keterangan'];
                $subtransaksi->user_id=Auth::user()->id;
                $subtransaksi->cabang_id=Auth::user()->cabangs->id;
                $subtransaksi->sub_totalpengeluaran=$value['subtotal'];
                $subtransaksi->satuan=$value['satuan'];
                
                if (is_numeric($value['produkid']))
                {
                    $subtransaksi->bahanbaku_id=$value['produkid'];

                    $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$value['produkid'])
                                                    ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                    ->count();

                    $bahanbakugethitungluas=CBahanBakus::find($value['produkid']);

                    if ($stokbahanbaku==0)
                    {

                        $addbahanbaku=new stokbahanbaku;
                        $addbahanbaku->bahanbaku_id=$value['produkid'];
                        $addbahanbaku->cabang_id=Auth::user()->cabangs->id;
                        $addbahanbaku->satuan=$value['satuan'];


                        $addbahanbaku->stokhitungluas=$bahanbakugethitungluas->hitung_luas;

                        if (($value['satuan']=="CENTIMETER") || ($value['satuan']=="METER"))
                        {

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
                        $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$value['produkid'])
                                                    ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                    ->first();

                        if (($value['satuan']=="CENTIMETER") || ($value['satuan']=="METER"))
                        {

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

                            $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+$luas;
                        }
                        else
                        {
                            $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+$value['kuantitas'];
                        }

                        $stokbahanbaku->save();

                    }

                }
                else
                {
                    $subtransaksi->bahanbaku_id=null;
                }

                if ($subtransaksi->save()){
                    $status="Success";
                }else
                {
                    $status="Failed";                
                }
            }
            
        }
        $datareturn=[];
        $datareturn['status']=$status;
        $datareturn['id']=encrypt($transaksi->id);
        return $datareturn;
    }

    public function showsubtransaksipengeluaran(Request $request){
        $request->id=decrypt($request->id);
        $showsubtransaksi=Sub_Tpengeluaran::where('transaksipengeluaran_id','=',$request->id)
                            ->get();
        return $showsubtransaksi;                            
    }

    public function datatransaksipengeluaranspesific(Request $request){
        $request->id=decrypt($request->id);
        $table=Transaksi_Pengeluaran::where('id','=',$request->id)
                    ->first();
        $data=[];
        $data['nonota']=$table->id;
        $data['nama_pelanggan']=$table->namapenerima;

        return $data;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroytransaksipengeluaran(Request $request)
    {
        //
        $id=decrypt($request->json('id'));
        // dd($id);
        
        $table=Transaksi_Pengeluaran::where('id','=',$id)
                    ->first();

        $substransksis=Sub_Tpengeluaran::where('transaksipengeluaran_id','=',$id)
                        ->get();
        foreach ($substransksis as $substransaksi)
        {

            if ($substransaksi->bahanbaku_id!=null)
            {
                // $subtransaksi->bahanbaku_id=$value['produkid'];

                $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$substransaksi->bahanbaku_id)
                                                ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                ->count();

                $bahanbakugethitungluas=CBahanBakus::find($substransaksi->bahanbaku_id);
                // dd($bahanbakugethitungluas);

                if ($bahanbakugethitungluas == null)
                {

                }
                else
                {
                    $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$substransaksi->bahanbaku_id)
                                                ->where('cabang_id','=',Auth::user()->cabangs->id)
                                                ->first();

                    if (($substransaksi->satuan=="CENTIMETER") || ($substransaksi->satuan=="METER"))
                    {

                        if (($bahanbakugethitungluas->satuan=="CENTIMETER") && ($substransaksi->satuan=="METER"))
                        {
                            // dd("(".$substransaksi->panjang." * 100) * (".$substransaksi->lebar." * 100 )) * ".$substransaksi->kuantitas);
                            $luas=(($substransaksi->panjang*100)*($substransaksi->lebar*100))*$substransaksi->kuantitas;
                        }
                        elseif (($bahanbakugethitungluas->satuan==$substransaksi->satuan))
                        {
                            $luas=(($substransaksi->panjang)*($substransaksi->lebar))*$substransaksi->kuantitas;
                        }
                        elseif (($bahanbakugethitungluas->satuan=="METER") && ($substransaksi->satuan=="CENTIMETER"))
                        {
                            $luas=(($substransaksi->panjang/100)*($substransaksi->lebar/100))*$substransaksi->kuantitas;
                        }
                        // dd($stokbahanbaku->banyakstok." - ".$luas);
                        $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok-$luas;
                    }
                    else
                    {
                        $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok-$substransaksi->kuantitas;
                    }
                    // dd($stokbahanbaku->banyakstok);
                    $stokbahanbaku->save();
                }

            }
        }

        if ($table->delete()){
            


            $tableangsuran=Angsuran_Pengeluarans::where('transaksipengeluaran_id','=',$id)
                        ->delete();

            $isi=Auth::user()->username." telah menghapus transaksi pengeluaran dengan Nota ".$table->id." di cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"delete");
            return "{\"msg\":\"success\"}";
        }
        else
        {
            return "{\"msg\":\"failed\"}";
        }

    }

    public function jenispengeluaran_index()
    {
        return view (
            'transaksis.pengeluaran.jenispengeluaran'
        );
    }

    public function loadjenispengeluaran()
    {
        $tables=Jenis_Pengeluaran::all();
        return Datatables::of($tables)
        -> addColumn ('action', function ($tables) {
            return  '
            <div class="btn-group">
                    <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal" 
                        data-jenis="'.$tables->jenis_pengeluaran.'"
                        data-angsuran="'.$tables->sifat_angsuran.'"
                        data-mode="'.$tables->form_mode.'"
                        data-keterangan="'.$tables->keterangan.'"
                        data-id="'.encrypt($tables->id).'" 
                    data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>
                    <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal" 
                        data-jenis="'.$tables->jenis_pengeluaran.'"
                        data-id="'.encrypt($tables->id).'"  
                    data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
            </div>        
                    ';
        })
        -> editColumn ( 'sifat_angsuran', 
                        function ($tables) {
                            if ($tables->sifat_angsuran == 0) return 'Tidak';
                            else if ($tables->sifat_angsuran == 1) return 'Ya';
                        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function storejenispengeluaran(Request $request)
    {
        $rules=array(
            'tambah_jenisPengeluaran'   =>  'required',
            'tambah_sifatAngsuran'   =>  'required',
            'tambah_mode'   =>  'required',
        );
        // dd(decrypt($request->tambah_jenispelanggan));
        $count=Jenis_Pengeluaran::where([
            ['jenis_pengeluaran', '=', $request->tambah_jenisPengeluaran],
        ])->count();
                 
        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else if($count != 0){
            return response()->json("Duplicated");
        }
        else{
            $table= new Jenis_Pengeluaran;
            $table->jenis_pengeluaran = $request->tambah_jenisPengeluaran;
            $table->sifat_angsuran = $request->tambah_sifatAngsuran;
            $table->form_mode = $request->tambah_mode;
            $table->keterangan = $request->tambah_keterangan;

            if ($table->save()){
                $isi=Auth::user()->username." telah menambah jenis pengeluaran di cabang ".Auth::user()->cabangs->Nama_Cabang.".";
                $save=$this->createlog($isi,"add");
                return response()->json("Success");
            }else{
                return response()->json("Failed");
            }
        }
    }

    public function updatejenispengeluaran(Request $request)
    {
        $rules=array(
            'edit_jenisPengeluaran'   =>  'required',
            'edit_sifatAngsuran'   =>  'required',
            'edit_mode'   =>  'required',
        );
        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else{
            $table=Jenis_Pengeluaran::where('id','=',decrypt($request->id_edit))
                    ->first();

            $table->jenis_pengeluaran = $request->edit_jenisPengeluaran;
            $table->sifat_angsuran = $request->edit_sifatAngsuran;
            $table->form_mode = $request->edit_mode;
            $table->keterangan = $request->edit_keterangan;

            if ($table->save()){
                $isi=Auth::user()->username." telah mengubah/mengedit jenis pengeluaran".$table->jenis_pengeluaran." di cabang ".Auth::user()->cabangs->Nama_Cabang.".";
                $save=$this->createlog($isi,"edit");
                return response()->json("Success");
            }else{
                return response()->json("Failed");
            }
        }
    }

    public function deletejenispengeluaran(Request $request)
    {
        $table=Jenis_Pengeluaran::where('id','=',decrypt($request->hapus_id))
                            ->first();
        if ($table->delete()){
            $isi=Auth::user()->username." telah menghapus jenis pengeluaran".$table->jenis_pengeluaran." di cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"delete");
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        } 
    }
}
