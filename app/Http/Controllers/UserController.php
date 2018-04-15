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
                ->leftJoin('Cabangs','Users.cabang_id','=','Cabangs.id')
                ->select('Users.*','Users2.username as username2','Cabangs.Nama_Cabang')
                ->get();
        return Datatables::of($tables)
        ->addColumn('action', function ($tables) {
            return '
            <div class="btn-group">
            <button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal"  data-id="'.encrypt($tables->id).'" data-username="'.$tables->username.'" data-nama="'.$tables->nama.'" data-telepon="'.$tables->Telepon.'" data-gaji="'.$tables->gaji.'" data-alamat="'.$tables->Alamat.'" data-cabang="'.($tables->cabang_id).'"  data-target="#modal_delete"><i class="fa fa-trash"></i></button>
            <button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-id="'.encrypt($tables->id).'" data-username="'.$tables->username.'" data-nama="'.$tables->nama.'" data-telepon="'.$tables->Telepon.'" data-gaji="'.$tables->gaji.'" data-alamat="'.$tables->Alamat.'" data-cabang="'.($tables->cabang_id).'" data-target="#modal_edit"><i class="fa fa-edit"></i></button>
            </div>';
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
        // dd($request->cabang_id);
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
            $table->Alamat=$request->alamat;
            $table->cabang_id=($request->cabang_id);

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
    public function update(Request $request)
    {
        //
        $rules=array(
            'nama2'=>'required',
            // 'password2'=>'min:8',
            'Telepon2'=>'required | numeric | min:10',
            'gaji2'=>'required | numeric',
            'alamat2'=>'required',
        );

        $niceNames = array(
            'nama2' => 'Nama',
            'Telepon2'=>'Telepon',
            'gaji2'=>'Gaji',
            'alamat2'=>'Alamat',
        );

        $validator=Validator::make(Input::all(),$rules);
        // dd($validator);
        
        if($validator->fails()){
            $validator->setAttributeNames($niceNames); 
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            // $

            $table=CUsers::where('id','=',decrypt($request->iduser2))
                            ->first();

            $table->nama=$request->nama;
            if ($request->password==""){

            }
            else
            {
                $table->password=bcrypt($request->password);
            }
            
            $table->Telepon=$request->Telepon;
            $table->gaji=$request->gaji;
            $table->Alamat=$request->alamat;
            $table->cabang_id=($request->cabang_id);

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
    public function destroy($id)
    {
        //
    }
}
