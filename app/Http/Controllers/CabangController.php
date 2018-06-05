<?php

namespace App\Http\Controllers;

use App\CCabangs;

use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cabangs=CCabangs::all();
        return view ('cabangs.cabang',
                     ['cabang'=>$cabangs]
                    );
    }


    public function loaddatacabang(){
        $tables=CCabangs::leftJoin('Users','Cabangs.user_id','=','Users.id')
                ->select('Cabangs.*','Users.username')
                ->get();
        return Datatables::of($tables)
            -> addColumn ('action', function ($tables) {
                return  '
                <div class="btn-group">
                        <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal" data-jenis="'.$tables->Jenis_Cabang.'" data-kode="'.$tables->Kode_Cabang.'" data-nama="'.$tables->Nama_Cabang.'" data-telepon="'.$tables->No_Telepon.'" data-email="'.$tables->Email.'" data-alamat="'.$tables->Alamat.'" data-id="'.encrypt($tables->id).'" data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>
                        <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal" data-nama="'.$tables->Nama_Cabang.'" data-id="'.encrypt($tables->id).'"  data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
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
            'tambah_jenis_cabang'   =>  'required',
            'tambah_kode_cabang'    =>  'required',
            'tambah_nama_cabang'    =>  'required',
            'tambah_telepon_cabang' =>  'required | numeric | min:10',
            'tambah_email_cabang'   =>  'required',
            'tambah_alamat_cabang'  =>  'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else{
            $table= new CCabangs;
            $table->Kode_Cabang     = $request->tambah_kode_cabang;
            $table->Nama_Cabang     = $request->tambah_nama_cabang;
            $table->No_Telepon      = $request->tambah_telepon_cabang;
            $table->Email           = $request->tambah_email_cabang;
            $table->Alamat          = $request->tambah_alamat_cabang;
            $table->Jenis_Cabang    = $request->tambah_jenis_cabang;
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
            'edit_jenis_cabang'   =>  'required',
            'edit_kode_cabang'    =>  'required',
            'edit_nama_cabang'    =>  'required',
            'edit_telepon_cabang' =>  'required | numeric | min:10 ',
            'edit_email_cabang'   =>  'required',
            'edit_alamat_cabang'  =>  'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        
        
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            // $
            $table=CCabangs::where('id','=',decrypt($request->cabang_id))
                            ->first();           
            $table->Kode_Cabang     = $request->edit_kode_cabang;
            $table->Nama_Cabang     = $request->edit_nama_cabang;
            $table->No_Telepon      = $request->edit_telepon_cabang;
            $table->Email           = $request->edit_email_cabang;
            $table->Alamat          = $request->edit_alamat_cabang;
            $table->Jenis_Cabang    = $request->edit_jenis_cabang;
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
        $table=CCabangs::where('id','=',decrypt($request->hapus_cabang_id))
                            ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        } 
    }
}
