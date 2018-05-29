<?php

namespace App\Http\Controllers;
use App\Jenis_Pengeluaran;
use Illuminate\Http\Request;

use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Validator;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $date=date("Y-m-d");
        $jenispengeluaran=Jenis_Pengeluaran::all();
        dd($jenispengeluaran);
        return view('transaksis.pengeluaran.transaksi',['date'=>$date]);
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

    public function jenispengeluaran_index()
    {
        return view (
            'transaksis.pengeluaran.jenispengeluaran'
        );
    }

    public function loadjenispengeluaran()
    {
        $tables=Jenis_Pengeluaran::all();
        return Datatables::of($tables)
        -> addColumn ('action', function ($tables) {
            return  '
            <div class="btn-group">
                    <button type="button" class="modal_edit btn btn-info btn-sm" data-toggle="modal" 
                        data-jenis="'.$tables->jenis_pengeluaran.'"
                        data-angsuran="'.$tables->sifat_angsuran.'"
                        data-keterangan="'.$tables->keterangan.'"
                        data-id="'.encrypt($tables->id).'" 
                    data-target="#modal_edit"><i class="fa fa-fw fa-edit"></i></button>
                    <button type="button" class="modal_hapus btn btn-danger btn-sm" data-toggle="modal" 
                        data-jenis="'.$tables->jenis_pengeluaran.'"
                        data-id="'.encrypt($tables->id).'"  
                    data-target="#modal_hapus"><i class="fa fa-fw fa-trash"></i></button>
            </div>        
                    ';
        })
        -> editColumn ( 'sifat_angsuran', 
                        function ($tables) {
                            if ($tables->sifat_angsuran == 0) return 'Tidak';
                            else if ($tables->sifat_angsuran == 1) return 'Ya';
                        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function storejenispengeluaran(Request $request)
    {
        $rules=array(
            'tambah_jenisPengeluaran'   =>  'required',
            'tambah_sifatAngsuran'   =>  'required',
        );
        // dd(decrypt($request->tambah_jenispelanggan));
        $count=Jenis_Pengeluaran::where([
            ['jenis_pengeluaran', '=', $request->tambah_jenisPengeluaran],
        ])->count();
                 
        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else if($count != 0){
            return response()->json("Duplicated");
        }
        else{
            $table= new Jenis_Pengeluaran;
            $table->jenis_pengeluaran = $request->tambah_jenisPengeluaran;
            $table->sifat_angsuran = $request->tambah_sifatAngsuran;
            $table->keterangan = $request->tambah_keterangan;

            if ($table->save()){
                return response()->json("Success");
            }else{
                return response()->json("Failed");
            }
        }
    }

    public function updatejenispengeluaran(Request $request)
    {
        $rules=array(
            'edit_jenisPengeluaran'   =>  'required',
            'edit_sifatAngsuran'   =>  'required',
        );
        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Response::json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        else{
            $table=Jenis_Pengeluaran::where('id','=',decrypt($request->id_edit))
                    ->first();
            $table->jenis_pengeluaran = $request->edit_jenisPengeluaran;
            $table->sifat_angsuran = $request->edit_sifatAngsuran;
            $table->keterangan = $request->edit_keterangan;

            if ($table->save()){
                return response()->json("Success");
            }else{
                return response()->json("Failed");
            }
        }
    }

    public function deletejenispengeluaran(Request $request)
    {
        $table=Jenis_Pengeluaran::where('id','=',decrypt($request->hapus_id))
                            ->first();
        if ($table->delete()){
            return response()->json("Success");
        }else{
            return response()->json("Failed");
        } 
    }
}
