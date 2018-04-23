<?php

namespace App\Http\Controllers;

use App\CKategories;

use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategori=CKategories::all();
        return view ('kategories.kategori',
                     ['kategori'=>$kategori]
                    );
    }

    public function loadkategori(){
        $tables=CKategories::all();
        return Datatables::of($tables)
            -> addColumn ('action', function ($tables) {
                return  '
                <div class="btn-group">
                        <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal" data-nama_kategori="'.$tables->Nama_Kategori.'" data-keterangan="'.$tables->Keterangan.'" data-id="'.encrypt($tables->id).'" data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>
                        <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal" data-nama_kategori="'.$tables->Nama_Kategori.'" data-keterangan="'.$tables->Keterangan.'" data-id="'.encrypt($tables->id).'"  data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
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
            'tambah_nama_kategori'   =>  'required',
            'tambah_keterangan'   =>  'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }else{
            $table= new CKategories;
            $table->Nama_Kategori = $request->tambah_nama_kategori;
            $table->Keterangan = $request->tambah_keterangan;

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
            'edit_nama_kategori'   =>  'required',
            'edit_keterangan'   =>  'required',
        );

        $validator=Validator::make(Input::all(),$rules);

        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        } else {
            $table=CKategories::where('id','=',decrypt($request->kategori_id))
                            ->first();
            $table->Nama_Kategori = $request->edit_nama_kategori;
            $table->Keterangan = $request->edit_keterangan;

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
        $table=CKategories::where('id','=',decrypt($request->hapus_kategori_id))
                            ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
}
