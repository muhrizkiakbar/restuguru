<?php

namespace App\Http\Controllers;

use App\CUsers;
use App\CCabangs;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
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
        return view('users.manajemenuser',['cabangs'=>$cabangs]);
    }

    public function dataalluser(){
        $tables=CUsers::leftJoin('Users as Users2','Users.user_id','=','Users2.id')
                ->leftJoin('Cabangs','Users.user_id','=','Cabangs.id')
                ->select('Users.*','Users2.username','Cabangs.Nama_Cabang')
                ->get();
        return Datatables::of($tables)
        ->addColumn('action', function ($tables) {
            return '<button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-username="'.$tables->username.'" data-nama="'.$tables->nama.'" data-telepon="'.$tables->telepon.'" data-gaji="'.$tables->gaji.'" data-alamat="'.$tables->alamat.'"  data-target="#modal_delete"><i class="fa-trash"></i></button>
            <button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-username="'.$tables->username.'" data-nama="'.$tables->nama.'" data-telepon="'.$tables->telepon.'" data-gaji="'.$tables->gaji.'" data-alamat="'.$tables->alamat.'"  data-target="#modal_edit"><i class="fa-edit"></i></button>
            ';
            })
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
            'username'=>'required | min:3 | unique:Users,username',
            'nama'=>'required',
            'password'=>'required | min:8',
            'Telepon'=>'required | numeric | min:10',
            'gaji'=>'required | numeric',
            'alamat'=>'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            $table= new CUsers;
            $table->username=$request->username;
            $table->nama=$request->nama;
            $table->password=bcrypt($request->password);
            $table->Telepon=$request->Telepon;
            $table->gaji=$request->gaji;
            $table->alamat=$request->alamat;
            $table->cabang_id=$request->cabang_id;

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
    public function show($id,$apa)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
