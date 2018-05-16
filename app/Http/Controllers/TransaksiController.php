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
use Illuminate\Http\Request;

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

    public function transaksideleted()
    {
        //
        $date=date("Y-m-d");

        return view('transaksis.transaksideleted',['date'=>$date]);
    }

    public function report($id){
        $id=decrypt($id);
        $transaksi=CTransaksi_Penjualans::leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                    ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                    ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                    ->leftJoin('Jenispelanggans','Pelanggans.jenispelanggan_id','=','Jenispelanggans.id')
                    ->select('Transaksi_Penjualans.*','Cabangs.Kode_Cabang','Cabangs.Nama_Cabang',
                            'Cabangs.No_Telepon','Cabangs.Email','Cabangs.Alamat','Cabangs.Jenis_Cabang',
                            'Users.nama','Jenispelanggans.jenis_pelanggan')
                    ->where('Transaksi_Penjualans.id','=',$id)->first();
        $subtransaksis=CSub_Tpenjualans::leftJoin('Produks','Sub_Tpenjualans.produk_id','=','Produks.id')->where('penjualan_id','=',$id)->get();
        return view('report.invoiceprint',['transaksi'=>$transaksi,'subtransaksis'=>$subtransaksis]);
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
        $nonow=CTransaksi_Penjualans::latest()->first();

        if ($nonow==null){
            $nonota=1;
            // return $nonota;
        }
        else
        {
            $nonota=$nonow->id+1;
        }

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
        $transaksi->user_id=1;
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
            $subtransaksi->user_id=1;
            $subtransaksi->subtotal=$value['subtotal'];
            $subtransaksi->finishing=$value['finishing'];
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
