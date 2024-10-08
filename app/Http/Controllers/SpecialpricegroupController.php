<?php

namespace App\Http\Controllers;

use App\CSpesialpricesgroup;
use App\CProduks;
use App\CJenispelanggans;

use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class SpecialpricegroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jenispelanggans=CJenispelanggans::all();
        // return view ('produks.specialpricegroup',
        //             ['jenispelanggan'=>$jenispelanggans]
        // );
        return view ('produks.spg',
                    ['jenispelanggan'=>$jenispelanggans]
        );
    }


    public function loaddatatable(){
        $tables=CSpesialpricesgroup:: leftJoin('Produks','Spesialpricesgroups.produk_id','=','Produks.id')
                                    ->leftJoin('Jenispelanggans','Spesialpricesgroups.jenispelanggan_id','=','Jenispelanggans.id')
                                    ->leftJoin('Users','Spesialpricesgroups.user_id','=','Users.id')
                                    ->select('Spesialpricesgroups.id',
                                             'Spesialpricesgroups.jenispelanggan_id',
                                             'Spesialpricesgroups.produk_id',
                                             'Spesialpricesgroups.harga_khusus', 
                                             'Spesialpricesgroups.updated_at',
                                             'Produks.nama_produk',
                                             'Users.username',
                                             'Jenispelanggans.jenis_pelanggan')
                                    ->get();
        return Datatables::of($tables)
            
            -> addColumn ('action', function ($tables) {
                return  '
                <div class="btn-group">
                        <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal" 
                            data-jenis="'.$tables->jenis_pelanggan.'"
                            data-jenis_id="'.$tables->jenispelanggan_id.'"
                            data-produk="'.$tables->nama_produk.'"
                            data-produk_id="'.$tables->produk_id.'"
                            data-harga="'.$tables->harga_khusus.'" 
                            data-id="'.encrypt($tables->id).'" 
                        data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>

                        <button type="button" class="modal_show_range btn btn-info btn-sm" data-toggle="modal"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_show_range"><i class="fa fa-fw fa-gear"></i></button>

                        <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal" 
                            data-jenis="'.$tables->jenis_pelanggan.'"
                            data-produk="'.$tables->nama_produk.'"
                            data-harga="'.number_format($tables->harga_khusus, 0,",",".").'" 
                            data-id="'.encrypt($tables->id).'"  
                        data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
                </div>        
                        ';
            })
            -> editColumn ('harga_khusus', 'Rp {{number_format($harga_khusus,0,",",".")}}')
            -> editColumn ('updated_at', '{{date("d-m-Y", strtotime($updated_at))}}')
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
            'tambah_jenispelanggan'   =>  'required',
            'tambah_produk'   =>  'required',
            'tambah_harga_khusus'   =>  'required | numeric',
        );
        // dd(decrypt($request->tambah_jenispelanggan));
        $count=CSpesialpricesgroup::where([
            ['jenispelanggan_id', '=', decrypt($request->tambah_jenispelanggan)],
            ['produk_id', '=', $request->tambah_produk],
        ])->count();
                 
        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else if($count != 0){
            return response()->json("Duplicated");
        }
        else{
            $table= new CSpesialpricesgroup;
            $table->jenispelanggan_id = decrypt($request->tambah_jenispelanggan);
            $table->produk_id = $request->tambah_produk;
            $table->harga_khusus = $request->tambah_harga_khusus;
            $table->user_id = Auth::user()->id;

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
            'id_edit_jenispelanggan'   =>  'required',
            'id_edit_produk'   =>  'required',
            'edit_harga_khusus'   =>  'required | numeric',
        );
        $validator=Validator::make(Input::all(),$rules);
        
        // dd($countAll, $count);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            // dd(decrypt($request->id_spg));
            $table=CSpesialpricesgroup::where('id','=',decrypt($request->id_spg))
                            ->first();           
            $table->jenispelanggan_id = $request->id_edit_jenispelanggan;
            $table->produk_id = $request->id_edit_produk;
            $table->harga_khusus = $request->edit_harga_khusus;
            
            if ($table->update()){
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
        $table=CSpesialpricesgroup::where('id','=',decrypt($request->hapus_spg_id))
                            ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        } 
    }

    public function new_price_khusus_jenis_pelanggans()
    {
      $produks=CProduks::all();
      $pelanggans = CJenispelanggans::all();
      return view ('specialprices.specialpricejenispelanggans',
                      ['produks'=>$produks, 'jenispelanggans' => $pelanggans]
                  );
    }

    public function create_price_khusus_jenis_pelanggans(Request $request)
    {
      DB::beginTransaction();
      try {
        $produk_ids = $request->json('produk_ids');
        $harga_khusus = $request->json('harga_khusus');
        foreach ($request->json('jenispelanggan_ids') as $key => $jenispelanggan_id){
          $jenispelanggan_id = intval($jenispelanggan_id);
          foreach ($produk_ids as $key_produk_id => $produk_id) {
            $specialprice =
              CSpesialpricesgroup::where('jenispelanggan_id','=', $jenispelanggan_id)
                            ->where('produk_id','=', $produk_id)
                            ->withTrashed()
                            ->first();
            if ($specialprice == null) {
                $specialprice = new CSpesialpricesgroup;
                $specialprice->produk_id = $produk_id;
                $specialprice->user_id=Auth::user()->id;
                $specialprice->jenispelanggan_id = $jenispelanggan_id;
                $specialprice->harga_khusus = $harga_khusus[$key_produk_id];
                $specialprice->saveOrFail();
            } else {
              if (intval($harga_khusus[$key_produk_id]) == 0) {
                $specialprice->harga_khusus = $harga_khusus[$key_produk_id];
                $specialprice->saveOrFail();
                $specialprice->delete();
              } else {
                $specialprice->harga_khusus = $harga_khusus[$key_produk_id];
                $specialprice->user_id=Auth::user()->id;
                $specialprice->deleted_at = null;
                $specialprice->saveOrFail();
              }
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
