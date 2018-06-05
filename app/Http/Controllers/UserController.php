<?php

namespace App\Http\Controllers;

use App\User;
use App\CCabangs;
use Illuminate\Http\Request;
use Datatables;
use App\Role;
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
        $role=Role::all();
        return view('users.manajemenuser',['cabangs'=>$cabangs,'roles'=>$role]);
    }

    public function dataalluser(){
        $tables=User::leftJoin('users as users2','users.user_id','=','users2.id')
                ->leftJoin('Cabangs','users.cabang_id','=','Cabangs.id')
                ->select('users.*','users2.username as username2','Cabangs.Nama_Cabang')
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
            'username'=>'required | min:3 | unique:users,username',
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
            $table= new User;
            $table->username=$request->username;
            $table->nama=$request->nama;
            $table->password=bcrypt($request->password);
            $table->Telepon=$request->Telepon;
            $table->gaji=$request->gaji;
            $table->Alamat=$request->alamat;
            $table->cabang_id=decrypt($request->cabang_id);

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
            'Telepon2'=>'required | numeric | min:10',
            'gaji2'=>'required | numeric',
            'alamat2'=>'required',
        );

        // $niceNames = array(
        //     'nama2' => 'Nama',
        //     'Telepon2'=>'Telepon',
        //     'gaji2'=>'Gaji',
        //     'alamat2'=>'Alamat',
        // );

        $validator=Validator::make(Input::all(),$rules);
        
        if($validator->fails()){
            // $validator->setAttributeNames($niceNames); 
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            // $

            $table=User::where('id','=',decrypt($request->iduser2))
                            ->first();

            $table->nama=$request->nama2;
            if ($request->password2==""){

            }
            else
            {
                $table->password=bcrypt($request->password2);
            }
            
            $table->Telepon=$request->Telepon2;
            $table->gaji=$request->gaji2;
            $table->Alamat=$request->alamat2;
            $table->cabang_id=($request->cabang_id2);

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
        $table=User::where('id','=',decrypt($request->deliduser))
                            ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }                    
    }

    public function indexchangepassword(){
        
          return view('users.changepassword');
        
      }
  
    public function changepassword(Request $request){

    // dd("asdads");
        $this->validate($request, [
            'password' => 'required',
            'passwordbaru' => 'required|string|min:8',
            'konfirmasipassword' => 'required|string|min:8|same:passwordbaru'
        ]);

        if (Hash::check($request->password,Hash::make($request->password))) {
            // dd("berubah");
            request()->user()->fill([
                'password' => Hash::make(request()->input('passwordbaru'))
            ])->save();

            return redirect()->back()->with('statussucces','Password berhasil di ubah.');
        }
        else{
            return redirect()->back()->with('statuserror','Password Salah');
        }


    }
}
