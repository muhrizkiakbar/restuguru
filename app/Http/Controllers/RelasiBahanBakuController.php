<?php

namespace App\Http\Controllers;

use App\CRelasiBahanBakus;
use App\CProduks;
use App\CBahanBakus;

use Illuminate\Http\Request;

use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class RelasiBahanBakuController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
        $produks=CProduks::all();
        $bahanbakus=CBahanBakus::all();
        return view ('produks.relasibahanbaku', [
            'produks'=>$produks,
            'bahanbakus'=>$bahanbakus
        ]);
    }

    public function loadrelasibahanbaku(){
        $tables=CRelasiBahanBakus::leftJoin('Bahanbakus','Produkbahanbakus.bahanbaku_id','=','Bahanbakus.id')
        ->leftJoin('Produks','Produkbahanbakus.produk_id','=','Produks.id')
        ->select('Produkbahanbakus.*','Produks.nama_produk','Bahanbakus.nama_bahan')
        ->get();
        return Datatables::of($tables)
        -> addColumn ('action', function ($tables) {
            return  '
            <div class="btn-group">
            <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal"
            data-produk_id="'.$tables->produk_id.'"
            data-bahanbaku_id="'.$tables->bahanbaku_id.'"
            data-qtypertrx="'.$tables->qtypertrx.'"
            data-id="'.encrypt($tables->id).'"
            data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>

            <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal"
            data-relasi="'.$tables->nama_bahan.' x '.$tables->nama_produk.'"
            data-id="'.encrypt($tables->id).'"
            data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
            </div>
            ';
        })
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
            'tambah_r_produk' => 'required',
            'tambah_r_bahan_baku' => 'required',
            'tambah_qty_p_trans' => 'required|numeric',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }else{
            $table= new CRelasiBahanBakus;
            $table->produk_id = decrypt($request->tambah_r_produk);
            $table->bahanbaku_id = decrypt($request->tambah_r_bahan_baku);
            $table->qtypertrx = $request->tambah_qty_p_trans;

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
            'edit_r_produk' => 'required',
            'edit_r_bahan_baku' => 'required',
            'edit_qty_p_trans' => 'required|numeric',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        } else {
            $table=CRelasiBahanBakus::where('id','=',decrypt($request->relasi_id))
                    ->first();
            $table->produk_id = $request->edit_r_produk;
            $table->bahanbaku_id = $request->edit_r_bahan_baku;
            $table->qtypertrx = $request->edit_qty_p_trans;

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
        $table=CRelasiBahanBakus::where('id','=',decrypt($request->hapus_relasi_id))
                ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
}
