<?php

namespace App\Http\Controllers;

use App\CSpesialprices;
use App\CPelanggans;
use App\CProduks;

use Illuminate\Http\Request;

use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class SpecialPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pelanggans=CPelanggans::all();
        $produks=CProduks::all();
        return view ('specialprices.specialpriceuser',
                        ['pelanggans'=>$pelanggans,
                          'produks'=>$produks]
                    );
    }

    public function loadspecialprice(){
        $tables=CSpesialprices::leftJoin('Pelanggans','Spesialprices.pelanggan_id','=','Pelanggans.id')
               ->leftJoin('Produks','Spesialprices.produk_id','=','Produks.id')
               ->select('Spesialprices.*','Pelanggans.nama_perusahaan','Produks.nama_produk')
               ->get();
        return Datatables::of($tables)
            -> addColumn ('action', function ($tables) {
                return  '
                <div class="btn-group">
                        <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal"
                        data-nama_perusahaan="'.$tables->nama_perusahaan.'"
                        data-nama_produk="'.$tables->nama_produk.'"
                        data-harga_khusus="'.$tables->harga_khusus.'"
                        data-id_pelanggan="'.$tables->pelanggan_id.'"
                        data-id_produk="'.$tables->produk_id.'"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>

                        <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal"
                        data-nama_perusahaan="'.$tables->nama_perusahaan.'"
                        data-nama_produk="'.$tables->nama_produk.'"
                        data-harga_khusus="'.number_format($tables->harga_khusus, 2,",",".").'"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
                </div>
                        ';
            })
            ->editColumn ('harga_khusus', 'Rp {{number_format($harga_khusus,2,",",".")}}')
            ->rawColumns(['action'])
            ->make(true);
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
        $rules=array(
            'pilih_pelanggan' => 'required',
            'pilih_produk' => 'required',
            'tambah_harga_khusus' => 'required|numeric',
        );
        $count=CSpesialprices::where([
            ['pelanggan_id', '=', decrypt($request->pilih_pelanggan)],
            ['produk_id', '=', decrypt($request->pilih_produk)],
        ])->count();

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }else if($count != 0){
            return response()->json("Duplicated");
        }else{
            $table= new CSpesialprices;
            $table->pelanggan_id   =decrypt($request->pilih_pelanggan);
            $table->produk_id = decrypt($request->pilih_produk);
            $table->harga_khusus = $request->tambah_harga_khusus;
            $table->user_id=Auth::user()->id;
            if ($table->save()){
                return response()->json("Success");
            }else{
                return response()->json("Failed");
            }
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
    public function update(Request $request)
    {
        //
        $rules=array(
            'pilih_edit_pelanggan' => 'required',
            'pilih_edit_produk' => 'required',
            'edit_harga_khusus' => 'required|numeric',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        } else {
            $table=CSpesialprices::where('id','=',decrypt($request->spcprice_id))
                            ->first();
            $table->pelanggan_id   =$request->pilih_edit_pelanggan;
            $table->produk_id = $request->pilih_edit_produk;
            $table->harga_khusus = $request->edit_harga_khusus;
            $table->user_id=Auth::user()->id;
            if ($table->save()){
                return response()->json("Success");
            }else{
                return response()->json("Failed");
            }
        }
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
        $table=CSpesialprices::where('id','=',decrypt($request->hapus_spcprice_id))
                            ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
}
