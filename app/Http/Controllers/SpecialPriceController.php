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

                        <button type="button" class="modal_show_range btn btn-info btn-sm" data-toggle="modal"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_show_range"><i class="fa fa-fw fa-gear"></i></button>

                        <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal"
                        data-nama_perusahaan="'.$tables->nama_perusahaan.'"
                        data-nama_produk="'.$tables->nama_produk.'"
                        data-harga_khusus="'.number_format($tables->harga_khusus, 0,",",".").'"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
                </div>
                        ';
            })
            ->editColumn ('harga_khusus', 'Rp {{number_format($harga_khusus,0,",",".")}}')
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

    // onchange produk
    public function price_khusus_pelanggans(Request $request)
    {
        $produk_id = decrypt($request->produk_id);
        $pelanggan_ids = $request->pelanggan_ids;
      
        $specialprices = DB::table('Spesialprices')
                   ->select('pelanggan_id', 'harga_khusus')
                   ->where('produk_id', '=', $produk_id)
                   ->groupBy('pelanggan_id');
        $pelanggans = DB::table('Pelanggans')
                        ->leftJoinSub($specialprices, 'specialprices', function($join) {
                            $join->on('Pelanggans.id', '=', 'specialprices.pelanggan_id');
                        })
                        ->whereIn('Pelanggans.id', $pelanggan_ids)
                        ->select(
                          'Pelanggans.id', 'Pelanggans.nama_perusahaan', 'Pelanggans.nama_pemilik',
                          'specialprices.harga_khusus')
                        ->get();
                
        return response()->json($pelanggans);
    }

    // on add pelanggan of produk
    public function price_khusus_pelanggan($pelanggan_id, $produk_id)
    {
      $produk_id = $produk_id;
      $pelanggan_id = $pelanggan_id;
      
      $specialprice = DB::table('Spesialprices')
                 ->select('pelanggan_id', 'harga_khusus')
                 ->where('produk_id', '=', $produk_id)
                 ->groupBy('pelanggan_id');
      $pelanggan = DB::table('Pelanggans')
                      ->leftJoinSub($specialprice, 'specialprices', function($join) {
                          $join->on('Pelanggans.id', '=', 'specialprices.pelanggan_id');
                      })
                      ->where('Pelanggans.id', '=', $pelanggan_id)
                      ->select(
                        'Pelanggans.id', 'Pelanggans.nama_perusahaan', 'Pelanggans.nama_pemilik',
                        'specialprices.harga_khusus')
                      ->first();
                
        return response()->json($pelanggan);
    }

    public function new_price_khusus_pelanggans()
    {
      $produks=CProduks::all();
      return view ('specialprices.specialpricepelanggans',
                      ['produks'=>$produks]
                  );
    }

    public function create_price_khusus_pelanggans(Request $request)
    {
      DB::beginTransaction();
      try {
        $produk_id = decrypt($request->json('produk_id'));
        $harga_khusus = intval($request->json('harga_khusus'));
        foreach ($request->json('pelanggan_ids') as $key => $pelanggan_id){
          $pelanggan_id = intval($pelanggan_id);
          $specialprice =
            CSpesialprices::where('pelanggan_id','=', $pelanggan_id)
                          ->where('produk_id','=', $produk_id)
                          ->first();
          if ($specialprice == null) {
              $specialprice = new CSpesialprices;
              $specialprice->produk_id = $produk_id;
              $specialprice->user_id=Auth::user()->id;
              $specialprice->pelanggan_id = $pelanggan_id;
              $specialprice->harga_khusus = $harga_khusus;
              $specialprice->saveOrFail();
          } else {
            if ($harga_khusus == 0) {
              $specialprice->delete();
            } else {
              $specialprice->harga_khusus = $harga_khusus;
              $specialprice->user_id=Auth::user()->id;
              $specialprice->saveOrFail();
            }
          }
        }
        DB::commit();
        return response()->json([
            'data' => "done"
        ], 200);
      } catch (\Exception $e) {
        DB::rollback();
        //pesan gagal akan di-return
        return response()->json([
            'status' => 'failed',
            'message' => $e->getMessage()
        ], 400);
      }
    }
}
