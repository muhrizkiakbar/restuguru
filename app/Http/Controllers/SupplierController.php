<?php

namespace App\Http\Controllers;

use App\CSuppliers;

use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view ('suppliers.supplier');
    }

    public function loadsupplier(){
        $tables=CSuppliers::all();
        return Datatables::of($tables)
            -> addColumn ('action', function ($tables) {
                return  '
                <div class="btn-group">
                        <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal"
                        data-nama_supplier="'.$tables->nama_supplier.'"
                        data-pemilik_supplier="'.$tables->pemilik_supplier.'"
                        data-telpon_supplier="'.$tables->telpon_supplier.'"
                        data-email_supplier="'.$tables->email_supplier.'"
                        data-alamat_supplier="'.$tables->alamat_supplier.'"
                        data-rekening_suppliers="'.$tables->rekening_suppliers.'"
                        data-keterangan_suppliers="'.$tables->keterangan_suppliers.'"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>

                        <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal"
                        data-nama_supplier="'.$tables->nama_supplier.'"
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
            'tambah_nama_supplier'     =>  'required',
            'tambah_pemilik_supplier'  =>  'required',
            'tambah_telpon_supplier'   =>  'required | numeric',
            // 'tambah_email_supplier'    =>  'required | email',
            'tambah_alamat_supplier'   =>  'required',
            // 'tambah_rekening_suppliers'    =>  'numeric',
            'tambah_keterangan_suppliers'  =>  'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }else{
            $table= new CSuppliers;
            $table->nama_supplier = $request->tambah_nama_supplier;
            $table->pemilik_supplier = $request->tambah_pemilik_supplier;
            $table->telpon_supplier = $request->tambah_telpon_supplier;
            $table->email_supplier = $request->tambah_email_supplier;
            $table->alamat_supplier = $request->tambah_alamat_supplier;
            $table->rekening_suppliers = $request->tambah_rekening_suppliers;
            $table->keterangan_suppliers = $request->tambah_keterangan_suppliers;
            $table->user_id=Auth::user()->id;
            if ($table->save()){
                $isi=Auth::user()->username." telah menambah supplier ".$table->nama_supplier." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
                $save=$this->createlog($isi,"add");
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
            'edit_nama_supplier'     =>  'required',
            'edit_pemilik_supplier'  =>  'required',
            'edit_telpon_supplier'   =>  'required | numeric',
            // 'edit_email_supplier'    =>  'required | email',
            'edit_alamat_supplier'   =>  'required',
            // 'edit_rekening_suppliers'    =>  'required | numeric | digits_between:5,30',
            'edit_keterangan_suppliers'  =>  'required',
        );

        $validator=Validator::make(Input::all(),$rules);

        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        } else {
            $table=CSuppliers::where('id','=',decrypt($request->supplier_id))
                            ->first();
            $table->nama_supplier = $request->edit_nama_supplier;
            $table->pemilik_supplier = $request->edit_pemilik_supplier;
            $table->telpon_supplier = $request->edit_telpon_supplier;
            $table->email_supplier = $request->edit_email_supplier;
            $table->alamat_supplier = $request->edit_alamat_supplier;
            $table->rekening_suppliers = $request->edit_rekening_suppliers;
            $table->keterangan_suppliers = $request->edit_keterangan_suppliers;

            if ($table->save()){
                $isi=Auth::user()->username." telah mengubah supplier ".$table->nama_supplier." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
                $save=$this->createlog($isi,"edit");
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
        $table=CSuppliers::where('id','=',decrypt($request->hapus_supplier_id))
                            ->first();
        if ($table->delete()){
            $isi=Auth::user()->username." telah menghapus supplier ".$table->nama_supplier." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"delete");
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
}
