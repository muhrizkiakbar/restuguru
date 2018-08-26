<?php

namespace App\Http\Controllers;

use App\CBahanBakus;
use App\CKategories;

use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class BahanBakuController extends Controller
{
    public function index()
    {
        //
        $kategories=CKategories::all();
        return view ('produks.bahanbaku',
                        ['kategories'=>$kategories]
                    );
    }

    public function bahanbakucari(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return response()->json([]);
        }
        $tags = CBahanBakus::where('nama_bahan','LIKE','%'.$term.'%')->limit(20)->get();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama_bahan];
        }
        return response()->json($formatted_tags);
    }

    public function bahanbakuharga(Request $request){

        if (strlen($request->id)>10)
        {
            $request->id=decrypt($request->id);
        }

        $table=CBahanBakus::where('id','=',$request->id)
                ->first();

        // if ($table==null)
        // {
        //     $table['hitung_luas']="1";
        //     $table['satuan']="CENTIMETER";
        // }
        return $table;
    }

    public function loadbahanbaku(){
        $tables=CBahanBakus::leftJoin('Kategories','Bahanbakus.kategori_id','=','Kategories.id')
               ->select('Bahanbakus.*','Kategories.Nama_Kategori')
               ->get();
        return Datatables::of($tables)
            -> addColumn ('action', function ($tables) {
                return  '
                <div class="btn-group">
                        <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal"
                        data-kategori_id="'.$tables->kategori_id.'"
                        data-nama_bahan="'.$tables->nama_bahan.'"
                        data-satuan="'.$tables->satuan.'"
                        data-harga="'.$tables->harga.'"
                        data-batas_stok="'.$tables->batas_stok.'"
                        data-hitung_luas="'.$tables->hitung_luas.'"
                        data-keterangan="'.$tables->keterangan.'"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>

                        <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal"
                        data-nama_bahan="'.$tables->nama_bahan.'"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
                </div>
                        ';
            })
            ->editColumn('hitung_luas', function ($tables) {
                if ($tables->hitung_luas == 1) {
                    $tables->hitung_luas = "Ya";
                    $warna = "bg-green";
                }else if ($tables->hitung_luas == 0) {
                    $tables->hitung_luas = "Tidak";
                    $warna = "bg-red";
                }
                return '<span class="">
                        <small class="label '.$warna.'">'.$tables->hitung_luas.'</small>
                        </span>';
                })
            ->editColumn('harga', '{{number_format($harga,0,",",".")}}')
            ->editColumn('batas_stok', '{{number_format($batas_stok,0,",",".")}}')
            ->rawColumns(['action','hitung_luas'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //
    // public function dataproduk(){
    //     $term = Input::get('term');
    //
    //     $results = array();
    //
    //     $queries = CBahanBakus::where('nama_bahan', 'LIKE', '%'.$term.'%')
    //         ->limit(10)
    //         ->get();
    //
    //         foreach ($queries as $query)
    //         {
    //             $results[] = [ 'id' => encrypt($query->id), 'value' => $query->nama_bahan ];
    //         }
    //
    //     return response()->json($results);
    //
    // }
    //
    // public function produkcari(Request $request)
    // {
    //     $term = trim($request->q);
    //     if (empty($term)) {
    //         return response()->json([]);
    //     }
    //     $tags = CBahanBakus::where('nama_bahan','LIKE','%'.$term.'%')->limit(20)->get();
    //     $formatted_tags = [];
    //     foreach ($tags as $tag) {
    //         $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama_bahan];
    //     }
    //     return response()->json($formatted_tags);
    // }
    //
    // public function produkharga(Request $request){
    //
    //     $table=CBahanBakus::where('id','=',$request->id)
    //             ->first();
    //
    //     return $table;
    // }

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
            'tambah_kategori_bb' => 'required',
            'tambah_nama_bahan' => 'required',
            'tambah_satuan' => 'required',
            'tambah_harga' => 'required|numeric',
            'tambah_batas_stok' => 'required|numeric',
            'tambah_keterangan' => 'required'
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }else{
            $table= new CBahanBakus;
            $table->kategori_id = decrypt($request->tambah_kategori_bb);
            $table->nama_bahan = $request->tambah_nama_bahan;
            $table->satuan = strtoupper($request->tambah_satuan);
            $table->harga = $request->tambah_harga;
            $table->batas_stok = $request->tambah_batas_stok;
            if (
              ($request->tambah_satuan=='CM') ||
              ($request->tambah_satuan=='M')
            ) {
              $table->hitung_luas = 1;
            } else {
              $table->hitung_luas = 0;
            }
            $table->keterangan = $request->tambah_keterangan;

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
            'edit_kategori_bb' => 'required',
            'edit_nama_bahan' => 'required',
            'edit_satuan' => 'required',
            'edit_harga' => 'required|numeric',
            'edit_batas_stok' => 'required|numeric',
            'edit_keterangan' => 'required'
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        } else {
            $table=CBahanBakus::where('id','=',decrypt($request->produk_id))
                            ->first();
            $table->kategori_id   =$request->edit_kategori_bb;
            $table->nama_bahan = $request->edit_nama_bahan;
            $table->satuan = $request->edit_satuan;
            $table->harga = $request->edit_harga;
            $table->batas_stok = $request->edit_batas_stok;
            if (
              ($request->edit_satuan=='CM') ||
              ($request->edit_satuan=='M')
            ) {
              $table->hitung_luas = 1;
            } else {
              $table->hitung_luas = 0;
            }
            $table->keterangan = $request->edit_keterangan;

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
        $table=CBahanBakus::where('id','=',decrypt($request->hapus_bahan_baku_id))
                            ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
}
