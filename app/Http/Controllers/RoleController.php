<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Datatables;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('roles.manajemenrole');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $tables=Role::all();
        return Datatables::of($tables)
            ->addColumn('edit', function ($tables) {
            return '
            <div class="btn-group">
            <a class="btn btn-success btn-sm" href="/roles/edit/'.encrypt($tables->id).'"><i class="fa fa-edit"></i></a>
            <button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal"  data-id="'.encrypt($tables->id).'" data-name="'.$tables->name.'" data-target="#modal_delete"><i class="fa fa-trash"></i></button>
            </div>';
            })
            ->rawColumns(['edit'])
            ->make(true);
    }

    public function create()
    {
        //
        $permissions=Permission::all();
        return view('roles.addrole',['permissions'=>$permissions]);
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
        $this->validate($request, [
            'namerole'=>'required | unique:roles,name',
            'descriptionrole'=>'required',
            'displayrole'=>'required',
            'permissionrole'=>'required',
        ]);

        $table= new Role;
        $table->name=$request->namerole;
        $table->display_name=$request->displayrole;
        $table->description=$request->descriptionrole;
        // dd($request->permissionrole);
        if ($table->save()){
            $role=Role::where('name','=',$request->namerole)->first();
            foreach($request->permissionrole as $key => $value) {
                $role->attachPermission($value);
            }

            return redirect()->back()->with('success','Berhasil menyimpan role.');
        }
        else
        {
            return redirect()->back()->withInput($request->input())->with('error','Gagal menyimpan role.');
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

        $roles=Role::where('id','=',decrypt($id))->first();
        // $role=Role::find(decrypt($id));
        // dd($role);

        // $role=$role;

        $id=$id;

        // $role="as";

        if ($role=null){
            return redirect()->back()->with('error','Role tidak ditemukan !');
        }

        $rolePermissions = Permission::join("permission_role", "permission_role.permission_id", "=", "permissions.id")
                ->where('permission_role.role_id', decrypt($id))
                // ->select('permissions.id as id')
                ->get();
        // dd($rolePermissions);

        $datas=array();

        foreach ($rolePermissions as $rolePermission){
            array_push($datas,$rolePermission->id);
        }

        // dd($datas);

        $permissions=Permission::all();
        return view('roles.editrole',compact('id','roles','permissions'),['rolePermissions'=>$datas]);
        // return view('roles.editrole',['id'=>$id,'roles'=>$role,'rolepermissions'=>$rolePermissions,'permissions'=>$permissions]);
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
        $this->validate($request, [
            'namerole'=>'required',
            'descriptionrole'=>'required',
            'displayrole'=>'required',
            'permissionrole'=>'required',
        ]);

        $table= Role::where('id','=',decrypt($id))->first();
        $table->name=$request->namerole;
        $table->display_name=$request->displayrole;
        $table->description=$request->descriptionrole;
        // dd($request->permissionrole);

        if ($table->save()){
            DB::table('permission_role')->where('permission_role.role_id', decrypt($id))
            ->forceDelete();
            
            $role=Role::where('name','=',$request->namerole)->first();
            foreach($request->permissionrole as $key => $value) {
                $role->attachPermission($value);
            }

            return redirect('/roles')->with('success','Berhasil menyimpan role.');
        }
        else
        {
            return redirect('/roles')->with('error','Gagal menyimpan role.');
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
        $role=Role::whereId(decrypt($request->delid))->delete();
        // dd($table);
        
        if ($role){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
}
