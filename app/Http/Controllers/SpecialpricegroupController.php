<?php

namespace App\Http\Controllers;

use App\CSpesialpricesgroup;

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
        // $jenispelanggans=CJenispelanggans::all();
        return view ('specialprices.specialpricegroup');
    }


    public function loadjenispelanggan(){
        $tables=CJenispelanggans::all();
        return Datatables::of($tables)
            -> addColumn ('action', function ($tables) {
                return  '
                <div class="btn-group">
                        <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal" data-jenis="'.$tables->jenis_pelanggan.'" data-id="'.encrypt($tables->id).'" data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>
                        <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal" data-jenis="'.$tables->jenis_pelanggan.'" data-id="'.encrypt($tables->id).'"  data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
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
            'tambah_jenispelanggan'   =>  'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else{
            $table= new CJenispelanggans;
            $table->jenis_pelanggan = $request->tambah_jenispelanggan;

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
            'edit_jenispelanggan'   =>  'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        
        
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            // $
            $table=CJenispelanggans::where('id','=',decrypt($request->jenispelanggan_id))
                            ->first();           
            $table->jenis_pelanggan = $request->edit_jenispelanggan;
            
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
        $table=CJenispelanggans::where('id','=',decrypt($request->hapus_jenispelanggan_id))
                            ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        } 
    }
}
