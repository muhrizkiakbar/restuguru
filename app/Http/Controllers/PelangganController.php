<?php

namespace App\Http\Controllers;

use App\CPelanggans;
use App\CJenispelanggans;

use Illuminate\Http\Request;

use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use Validator;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jenispelanggans=CJenispelanggans::all();
        return view('pelanggans.pelanggan',['jenispelanggans'=>$jenispelanggans]);
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

    public function datapelanggan(){
        $tables=CPelanggans::leftJoin('Jenispelanggans','Pelanggans.jenispelanggan_id','=','Jenispelanggans.id')
                ->select('Pelanggans.*','Jenispelanggans.jenis_pelanggan')
                ->get();
        return Datatables::of($tables)
        ->addColumn('action', function ($tables) {
            return '
            <div class="btn-group">
            <button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal"   
                data-jenispelanggan         ="'.$tables->jenispelanggan_id.'" 
                data-nama_pemilik           ="'.$tables->nama_pemilik.'" 
                data-ktp                    ="'.$tables->ktp.'" 
                data-hp_pelanggan           ="'.$tables->hp_pelanggan.'" 
                data-nama_perusahaan        ="'.$tables->nama_perusahaan.'" 
                data-telpon_pelanggan       ="'.$tables->telpon_pelanggan.'" 
                data-email_pelanggan        ="'.$tables->email_pelanggan.'"  
                data-alamat_pelanggan       ="'.$tables->alamat_pelanggan.'" 
                data-tempo_pelanggan        ="'.$tables->tempo_pelanggan.'" 
                data-limit_pelanggan        ="'.$tables->limit_pelanggan.'" 
                data-norek_pelanggan        ="'.$tables->norek_pelanggan.'" 
                data-keterangan_pelanggan   ="'.$tables->keterangan_pelanggan.'" 
                data-status_pelanggan       ="'.$tables->status_pelanggan.'"
                data-id                     ="'.encrypt($tables->id).'"
            data-target="#modal_edit"><i class="fa fa-edit"></i></button>  
        
            <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal" 
                data-id                 ="'.encrypt($tables->id).'" 
                data-nama_pemilik       ="'.$tables->nama_pemilik.'"
            data-target="#modal_hapus"><i class="fa fa-trash"></i></button>
            </div>';
            })
        ->editColumn('Pelanggans.status_pelanggan', function ($tables) {
            if ($tables->status_pelanggan == 1) {
                $tables->status_pelanggan = "Aktif";
                $warna = "bg-green";
            }else if ($tables->status_pelanggan == 0) {
                $tables->status_pelanggan = "Tidak Aktif";
                $warna = "bg-red";
            }
            return '<span class="">
                    <small class="label '.$warna.'">'.$tables->status_pelanggan.'</small>
                    </span>';
            })
            ->rawColumns(['action','Pelanggans.status_pelanggan'])
            ->make(true);
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
            'tambah_namapemilik'=>'required',
            'tambah_ktppelanggan'=>'required',
            'tambah_hppelanggan'=>'required',
            'tambah_namaperusahaan'=>'required',
            'tambah_teleponpelanggan'=>'required',
            'tambah_emailpelanggan'=>'required',
            'tambah_alamatpelanggan'=>'required',
            'tambah_limittagihan'=>'required',
            'tambah_rekpelanggan'=>'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            $table= new CPelanggans;
            $table->jenispelanggan_id   =decrypt($request->tambah_jenis_pelanggan);
            $table->nama_pemilik        =$request->tambah_namapemilik;
            $table->ktp                 =$request->tambah_ktppelanggan;
            $table->hp_pelanggan        =$request->tambah_hppelanggan;
            $table->nama_perusahaan     =$request->tambah_namaperusahaan;
            $table->telpon_pelanggan    =$request->tambah_teleponpelanggan;
            $table->email_pelanggan     =$request->tambah_emailpelanggan;
            $table->alamat_pelanggan    =$request->tambah_alamatpelanggan;
            $table->tempo_pelanggan     =$request->tambah_tempotagihan;
            $table->limit_pelanggan     =$request->tambah_limittagihan;
            $table->norek_pelanggan     =$request->tambah_rekpelanggan;
            $table->keterangan_pelanggan=$request->tambah_keterangan;
            $table->status_pelanggan    =$request->tambah_statuspelanggan;

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
            'edit_jenis_pelanggan'=>'required',
            'edit_namapemilik'=>'required',
            'edit_ktppelanggan'=>'required',
            'edit_hppelanggan'=>'required',
            'edit_namaperusahaan'=>'required',
            'edit_teleponpelanggan'=>'required',
            'edit_emailpelanggan'=>'required',
            'edit_alamatpelanggan'=>'required',
            'edit_limittagihan'=>'required',
            'edit_rekpelanggan'=>'required',
        );

        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else {
            $table= CPelanggans::where('id','=',decrypt($request->pelanggan_id))
                    ->first();
            $table->jenispelanggan_id   =decrypt($request->edit_jenis_pelanggan);
            $table->nama_pemilik        =$request->edit_namapemilik;
            $table->ktp                 =$request->edit_ktppelanggan;
            $table->hp_pelanggan        =$request->edit_hppelanggan;
            $table->nama_perusahaan     =$request->edit_namaperusahaan;
            $table->telpon_pelanggan    =$request->edit_teleponpelanggan;
            $table->email_pelanggan     =$request->edit_emailpelanggan;
            $table->alamat_pelanggan    =$request->edit_alamatpelanggan;
            $table->tempo_pelanggan     =$request->edit_tempotagihan;
            $table->limit_pelanggan     =$request->edit_limittagihan;
            $table->norek_pelanggan     =$request->edit_rekpelanggan;
            $table->keterangan_pelanggan=$request->edit_keterangan;
            $table->status_pelanggan    =$request->edit_statuspelanggan;

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
        $table=CPelanggans::where('id','=',decrypt($request->hapus_pelanggan_id))
                            ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        } 
    }
}
