<?php

namespace App\Http\Controllers;
use App\Role;
use App\Permission;
use App\kategorimenu;
use App\kategori_permission;
use Illuminate\Support\Facades\Auth;

use Datatables;
use DB;

use Illuminate\Http\Request;

class KategoriMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return view('kategorimenu.manajemenmenu');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dataload(){
        $tables=kategorimenu::all();
        return Datatables::of($tables)
            ->addColumn('pages',function ($tables){
                $pages=kategori_permission::leftJoin('permissions','kategori_permission.permission_id','=','permissions.id')
                        ->where('kategori_id','=',$tables->id)->get();
                $label="";
                foreach ($pages as $key=>$page)
                {
                    $label=$label."<span class='badge bg-green'>".$page->display_name."</span>";
                }        

                return $label;
            })
            ->editColumn('icon',function ($tables){
                return '<i class="fa '.$tables->icon.'"></i>';
            })
            ->addColumn('edit', function ($tables) {
            return '
            <div class="btn-group">
            <a class="btn btn-success btn-sm" href="/menu/edit/'.encrypt($tables->id).'"><i class="fa fa-edit"></i></a>
            <button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal"  data-id="'.encrypt($tables->id).'" data-name="'.$tables->namakategorimenu.'" data-target="#modal_delete"><i class="fa fa-trash"></i></button>
            </div>';
            })
            ->rawColumns(['edit','pages','icon'])
            ->make(true);
    }

    public function create()
    {

        $tanpapage=kategori_permission::pluck('permission_id');
        // dd($tanpapage);
        $permissions=Permission::where('index','=','1')
                    ->whereNotIn('id',$tanpapage)
                    ->get();
        return view('kategorimenu.addmenu',['permissions'=>$permissions]);        
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
            'namemenu'=>'required | unique:kategorimenu,namakategorimenu',
            'icon'=>'required',
            'page'=>'required',
        ]);

        $table= new kategorimenu;
        $table->namakategorimenu=$request->namemenu;
        $table->icon=$request->icon;
        // dd($request->permissionrole);
        if ($table->save()){
            foreach($request->page as $key => $value) {
                $kategori_menu=new kategori_permission();
                $kategori_menu->kategori_id=$table->id;
                $kategori_menu->permission_id=$value;
                $kategori_menu->save();
            }
            return redirect()->back()->with('success','Berhasil menyimpan submenu.');
        }
        else
        {
            return redirect()->back()->with('error','Gagal menyimpan submenu.');
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
        $id=decrypt($id);
        $kategorimenu=kategorimenu::where('id','=',$id)->first();

        $kategoripermissions=kategori_permission::leftJoin('permissions','kategori_permission.permission_id','=','permissions.id')
                                                ->where('kategori_permission.kategori_id','=',$id)  
                                                ->get();
        // dd($kategoripermissions);
        $data=array(); 
        foreach ($kategoripermissions as $key=>$kategoripermission)
        {
            array_push($data,$kategoripermission->id);
        }

        $tanpapage=kategori_permission::pluck('permission_id')->where('kategori_id','=',$id);
        // dd($tanpapage);
        $permissions=Permission::where('index','=','1')
                    // ->whereNotIn('id',$tanpapage)
                    ->get();
        $id=encrypt($id);
        return view('kategorimenu.editmenu',compact('id','kategorimenu','permissions'),['data'=>$data]);        
        
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
            'namemenu'=>'required',
            'icon'=>'required',
            'page'=>'required',
        ]);
        
        $id=decrypt($id);

        $table=kategorimenu::where('id','=',$id)->first();
        $table->namakategorimenu=$request->namemenu;
        $table->icon=$request->icon;
        // dd($request->permissionrole);
        if ($table->save()){
            $hapuskategoripermission=kategori_permission::where('kategori_id','=',$id)->delete();
            foreach($request->page as $key => $value) {
                $kategori_menu=new kategori_permission();
                $kategori_menu->kategori_id=$table->id;
                $kategori_menu->permission_id=$value;
                $kategori_menu->save();
            }
            return redirect('/menu')->with('success','Berhasil menyimpan submenu.');
        }
        else
        {
            return redirect('/menu')->with('error','Gagal menyimpan submenu.');
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
        $id=decrypt($request->delid);
        $hapuskategoripermission=kategori_permission::where('kategori_id','=',$id)->delete();
        $hapuskategorimenu=kategorimenu::where('id','=',$id)->delete();
        if (($hapuskategorimenu) && ($hapuskategoripermission)){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        }
    }
}
