<?php

namespace App\Http\Controllers;

use App\CProduks;
use App\CKategories;

use Illuminate\Http\Request;

use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategories=CKategories::all();
        return view ('produks.produk',
                        ['kategories'=>$kategories]
                    );
    }

    public function loadproduk(){
        $tables=CProduks::leftJoin('Kategories','Produks.kategori_id','=','Kategories.id')
               ->select('Produks.*','Kategories.Nama_Kategori')
               ->get();
        return Datatables::of($tables)
            -> addColumn ('action', function ($tables) {
                return  '
                <div class="btn-group">
                        <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal"
                        data-kategori_id="'.$tables->kategori_id.'"
                        data-nama_produk="'.$tables->nama_produk.'"
                        data-satuan="'.$tables->satuan.'"
                        data-harga_beli="'.$tables->harga_beli.'"
                        data-harga_jual="'.$tables->harga_jual.'"
                        data-hitung_luas="'.$tables->hitung_luas.'"
                        data-keterangan="'.$tables->keterangan.'"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>

                        <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal"
                        data-nama_produk="'.$tables->nama_produk.'"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
                </div>
                        ';
            })
            ->editColumn('produks.hitung_luas', function ($tables) {
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
            -> editColumn ('harga_beli', 'Rp {{number_format($harga_beli,2,",",".")}}')
            -> editColumn ('harga_jual', 'Rp {{number_format($harga_jual,2,",",".")}}')
            ->rawColumns(['action','produks.hitung_luas'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dataproduk(){
        $term = Input::get('term');

        $results = array();

        $queries = CProduks::where('nama_produk', 'LIKE', '%'.$term.'%')
            ->limit(10)
            ->get();

            foreach ($queries as $query)
            {
                $results[] = [ 'id' => encrypt($query->id), 'value' => $query->nama_produk ];
            }

        return response()->json($results);

    }

    public function produkcari(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return response()->json([]);
        }
        $tags = CProduks::where('nama_produk','LIKE','%'.$term.'%')->limit(20)->get();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama_produk];
        }
        return response()->json($formatted_tags);
    }

    public function produkharga(Request $request){

        $table=CProduks::where('id','=',$request->id)
                ->first();

        return $table;
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
        $rules=array(
            'tambah_kategori' => 'required',
            'tambah_nama_produk' => 'required',
            'tambah_satuan' => 'required',
            'tambah_harga_beli' => 'required|numeric',
            'tambah_harga_jual' => 'required|numeric',
            'tambah_hitung_luas' => 'required|numeric',
            'tambah_keterangan' => 'required'
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }else{
            $table= new CProduks;
            $table->kategori_id   =decrypt($request->tambah_kategori);
            $table->nama_produk = $request->tambah_nama_produk;
            $table->satuan = $request->tambah_satuan;
            $table->harga_beli = $request->tambah_harga_beli;
            $table->harga_jual = $request->tambah_harga_jual;
            $table->hitung_luas = $request->tambah_hitung_luas;
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
            'edit_kategori' => 'required',
            'edit_nama_produk' => 'required',
            'edit_satuan' => 'required',
            'edit_harga_beli' => 'required|numeric',
            'edit_harga_jual' => 'required|numeric',
            'edit_hitung_luas' => 'required|numeric',
            'edit_keterangan' => 'required'
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        } else {
            $table=CProduks::where('id','=',decrypt($request->produk_id))
                            ->first();
            $table->kategori_id   =$request->edit_kategori;
            $table->nama_produk = $request->edit_nama_produk;
            $table->satuan = $request->edit_satuan;
            $table->harga_beli = $request->edit_harga_beli;
            $table->harga_jual = $request->edit_harga_jual;
            $table->hitung_luas = $request->edit_hitung_luas;
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
        $table=CProduks::where('id','=',decrypt($request->hapus_produk_id))
                            ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
}
