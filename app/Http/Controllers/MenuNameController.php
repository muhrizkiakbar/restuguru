<?php

namespace App\Http\Controllers;

use App\CPermissions;

use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class MenuNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view ('menu.manajemenmenu');
    }

    public function loadmenuname(){
        $tables=CPermissions::where('index','=','1')
                ->orderByRaw("SUBSTRING_INDEX(name, '-', -1)");
        return Datatables::of($tables)
            -> addColumn ('action', function ($tables) {
                return  '
                <div class="btn-group">
                        <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal"
                        data-akses="'.ucwords(str_replace("-"," ",$tables->name)).'"
                        data-nama="'.$tables->display_name.'"
                        data-deskripsi="'.$tables->description.'"
                        data-id="'.encrypt($tables->id).'"
                        data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>
                </div>
                        ';
            })
            ->editColumn('name', function($tables) {
                $newstring = str_replace("-"," ",$tables->name);
                return "<span class='badge bg-green'>".ucwords($newstring)."</span>";
            })
            ->rawColumns(['name','action'])
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
            'edit_nama_menu'   =>  'required',
        );

        $validator=Validator::make(Input::all(),$rules);

        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        } else {
            $table=CPermissions::where('id','=',decrypt($request->menuname_id))
                            ->first();
            $namaawal = $table->display_name;
            $table->display_name = $request->edit_nama_menu;
            $table->description = $request->edit_deskripsi;

            if ($table->save()){
                $isi=Auth::user()->username." telah mengubah nama menu ".$namaawal." menjadi ".$request->edit_nama_menu." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
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
    }
}
