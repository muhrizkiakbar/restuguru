<?php

namespace App\Http\Controllers;

use App\CSpesialprices;
use App\CPelanggans;
use App\CProduks;
use App\RangePricePelanggan;

use Illuminate\Http\Request;

use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class RangePricePelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
      $range_prices = RangePricePelanggan::where('special_price_pelanggan_id', '=', decrypt($id))->get();
      foreach ($range_prices as $range_price) {
        $range_price['uniq_id'] = encrypt($range_price->id);
        $range_price['uniq_special_price_pelanggan_id'] = encrypt($range_price->special_price_pelanggan_id);
      }


      return Response::json($range_prices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($id, Request $request)
    {
        //
        $rules=array(
            'tambah_range_nilai_awal' => 'required|numeric|min:2',
            'tambah_range_nilai_akhir' => 'required|numeric|min:2',
            'tambah_range_harga_khusus' => 'required|numeric|min:1',
        );
        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()), 422);
        }else{
            $table= new RangePricePelanggan;
            $table->special_price_pelanggan_id = decrypt($id);
            $table->nilai_awal = $request->tambah_range_nilai_awal;
            $table->nilai_akhir = $request->tambah_range_nilai_akhir;
            $table->harga_khusus = $request->tambah_range_harga_khusus;
            $table->user_id = Auth::user()->id;
            if ($table->save()){
                $table["uniq_id"] = encrypt($table->id);
                $table["uniq_special_price_pelanggan_id"] = encrypt($table->special_price_pelanggan_id);
                return response()->json($table);
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
                return response()->json(encrypt($table->id));
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
    public function destroy($id, $range_price_pelanggan_id)
    {
        //
        $table=RangePricePelanggan::where('id','=', decrypt($range_price_pelanggan_id))
                            ->first();
        if ($table->delete()){
            return response()->json($range_price_pelanggan_id, 200);
        }else{
            return response()->json("Unprocessable entity", 422);
        }
    }
}
