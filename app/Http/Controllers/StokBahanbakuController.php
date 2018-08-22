<?php

namespace App\Http\Controllers;

use App\stokbahanbaku;
use App\CBahanBakus;
use App\CCabangs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StokBahanbakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $bahanbakus=CBahanBakus::all();

        $cabangs=CCabangs::where('Nama_Cabang','!=','Admin')->get();

        $data=stokbahanbaku::leftJoin('Bahanbakus','stokbahanbakus.bahanbaku_id','=','Bahanbakus.id')
                ->leftJoin('Cabangs','stokbahanbakus.cabang_id','=','Cabangs.id')
                ->select('stokbahanbakus.*','Bahanbakus.nama_bahan','Bahanbakus.batas_stok','Cabangs.Nama_Cabang');

        if (isset($request->bahanbaku_id))
        {
            $request->bahanbaku_id=decrypt($request->bahanbaku_id);
            $data=$data->where('stokbahanbakus.bahanbaku_id','=',$request->bahanbaku_id);
        }
        else
        {
            $request->bahanbaku_id="";
        }

        if (isset($request->cabang_id))
        {
            $request->cabang_id=decrypt($request->cabang_id);
            $data=$data->where('stokbahanbakus.cabang_id','=',$request->cabang_id);
        }
        else
        {
            $request->cabang_id="";
        }
        
        if (Auth::user()->roles->first()->name=="owner")
        {
            $data=$data->orderBy('stokbahanbakus.banyakstok','asc')->paginate(30);
        }
        else
        {
            $data=$data->where('stokbahanbakus.cabang_id','=',Auth::user()->cabangs->id);
            $data=$data->orderBy('stokbahanbakus.banyakstok','asc')->paginate(30);
        }

        return view('stokbahanbaku.list',['datas'=>$data,'bahanbakus'=>$bahanbakus,'cabangs'=>$cabangs,'bahanbaku_id'=>$request->bahanbaku_id,'cabang_id'=>$request->cabang_id]);

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
