<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CBahanBakus;
use App\transaksibahanbaku;
use App\CCabangs;
use App\User;
use Illuminate\Support\Facades\Auth;

class TransaksiBahanBakuController extends Controller
{
    //
    public function index(Request $request)
    {
        // $request->cabangtujuan=decrypt($request->cabangtujuan);
        // if ($re)
        $cabangs=CCabangs::where('id','!=',Auth::user()->cabangs->id)
                    ->get();
        $bahanbakus=CBahanBakus::all();
        $data=transaksibahanbaku::leftJoin('Bahanbakus','transaksibahanbakus.bahanbaku_id','=','Bahanbakus.id')
                ->leftJoin('Cabangs as CabangDari','transaksibahanbakus.cabangdari_id','=','CabangDari.id')
                ->leftJoin('Cabangs as CabangTujuan','transaksibahanbakus.cabangtujuan_id','=','CabangTujuan.id')
                ->leftJoin('Users','transaksibahanbakus.user_id','=','Users.id')
                ->select('transaksibahanbakus.*','Bahanbakus.nama_bahan','CabangDari.Nama_Cabang as cabangdari',
                        'CabangTujuan.Nama_Cabang as cabangtujuan','Users.username');

                if ($request->no!=null)
                {
                    $data->where('transaksibahanbakus.id','like','%'.$request->no.'%');
                }

                if ($request->namabahanbaku=="semua")
                {

                }
                elseif ($request->namabahanbaku!=null)
                {
                    
                    $data->where('Bahanbakus.id','like','%'.decrypt($request->namabahanbaku).'%');
                    $request->namabahanbaku=decrypt($request->namabahanbaku);
                    // dd($request->namabahanbaku);
                }

                if ($request->tanggal!=null)
                {
                    // dd(date('Y-m-d',strtotime($request->tanggal)));
                    $data->where('transaksibahanbakus.tanggal','=',date('Y-m-d',strtotime($request->tanggal)));
                }

                if ($request->cabangtujuan=="semua")
                {

                }
                elseif ($request->cabangtujuan!=null)
                {
                    $data->where('transaksibahanbakus.cabangtujuan_id','=',decrypt($request->cabangtujuan));
                    $request->cabangtujuan=decrypt($request->cabangtujuan);
                }

                $datas=$data->paginate(30);



        return view('transaksibahanbaku.list',
                    ['no'=>$request->no,'namabahanbaku'=>($request->namabahanbaku),'date'=>$request->tanggal,
                    'cabangtujuan'=>($request->cabangtujuan),'bahanbakus'=>$bahanbakus,'datas'=>$datas,'cabangs'=>$cabangs]);
    }

    public function create()
    {
        $bahanbakus=CBahanBakus::all();
        $cabangs=CCabangs::where('id','!=',Auth::user()->cabangs->id)
                    ->get();

        return view('transaksibahanbaku.add',['cabangs'=>$cabangs,'bahanbakus'=>$bahanbakus]);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'bahanbaku_transaksibahanbaku'=>'required',
            'cabangtujuan_transaksibahanbaku'=>'required',
            'banyak_transaksibahanbaku'=>'required | numeric',
        ]);

        $table= new transaksibahanbaku;
        $table->bahanbaku_id=decrypt($request->bahanbaku_transaksibahanbaku);
        $table->cabangdari_id=Auth::user()->cabangs->id;
        $table->cabangtujuan_id=decrypt($request->cabangtujuan_transaksibahanbaku);
        $table->banyak=$request->banyak_transaksibahanbaku;
        $table->tanggal=date('Y-m-d');
        $table->satuan=$request->satuan_transaksibahanbaku;
        $table->keterangan=$request->keterangan_transaksibahanbaku;
        $table->user_id=Auth::user()->id;
        // dd($request->permissionrole)
        if ($table->save()){
            $isi=Auth::user()->username." telah menambah transaksi bahan baku dengan No. ".$table->id." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi);
            return redirect()->back()->with('success','Berhasil menyimpan transaki bahan baku.');
        }
        else
        {
            return redirect()->back()->with('error','Gagal menyimpan transaksi bahan baku.');
        }
    }

    public function show($id)
    {
        $bahanbakus=CBahanBakus::all();
        $cabangs=CCabangs::where('id','!=',Auth::user()->cabangs->id)
                    ->get();

        $data=transaksibahanbaku::
                                leftJoin('Bahanbakus','transaksibahanbakus.bahanbaku_id','=','Bahanbakus.id')
                                ->leftJoin('Cabangs as CabangDari','transaksibahanbakus.cabangdari_id','=','CabangDari.id')
                                ->leftJoin('Cabangs as CabangTujuan','transaksibahanbakus.cabangtujuan_id','=','CabangTujuan.id')
                                ->leftJoin('Users','transaksibahanbakus.user_id','=','Users.id')
                                ->select('transaksibahanbakus.*','Bahanbakus.nama_bahan','CabangDari.Nama_Cabang as cabangdari',
                                        'CabangTujuan.Nama_Cabang as cabangtujuan','Users.username')
                                ->where('transaksibahanbakus.id','=',decrypt($id))->first();

        return view('transaksibahanbaku.edit',['cabangs'=>$cabangs,'bahanbakus'=>$bahanbakus,'data'=>$data]);
    }

    public function update($id,Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'bahanbaku_transaksibahanbaku'=>'required',
            'cabangtujuan_transaksibahanbaku'=>'required',
            'banyak_transaksibahanbaku'=>'required | numeric',
        ]);


        $table=transaksibahanbaku::where('id','=',decrypt($id))->first();
        $table->bahanbaku_id=decrypt($request->bahanbaku_transaksibahanbaku);
        $table->cabangtujuan_id=decrypt($request->cabangtujuan_transaksibahanbaku);
        $table->banyak=$request->banyak_transaksibahanbaku;
        $table->satuan=$request->satuan_transaksibahanbaku;
        $table->keterangan=$request->keterangan_transaksibahanbaku;
        $table->user_id=Auth::user()->id;
        // dd($request->permissionrole)
        if ($table->save()){
            $isi=Auth::user()->username." telah mengubah transaksi bahan baku dengan No. ".$table->id." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi);
            return redirect('/transaksi/bahan')->with('success','Berhasil mengubah transaki bahan baku.');
        }
        else
        {
            return redirect('/transaksi/bahan')->back()->with('error','Gagal mengubah transaksi bahan baku.');
        }
    }

    public function destroy($id)
    {
        $table=transaksibahanbaku::where('id','=',decrypt($id))->first();
        if ($table->delete()){
            $isi=Auth::user()->username." telah menghapus transaksi bahan baku dengan No. ".decrypt($id)." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi);
            return redirect('/transaksi/bahan')->with('success','Berhasil menghapus transaki bahan baku.');
        }
        else
        {
            return redirect('/transaksi/bahan')->back()->with('error','Gagal menghapus transaksi bahan baku.');
        }
    }

    public function indexdeleted(Request $request)
    {
        // $request->cabangtujuan=decrypt($request->cabangtujuan);
        // if ($re)
        $cabangs=CCabangs::where('id','!=',Auth::user()->cabangs->id)
                    ->get();
        $bahanbakus=CBahanBakus::all();
        $data=transaksibahanbaku::leftJoin('Bahanbakus','transaksibahanbakus.bahanbaku_id','=','Bahanbakus.id')
                ->leftJoin('Cabangs as CabangDari','transaksibahanbakus.cabangdari_id','=','CabangDari.id')
                ->leftJoin('Cabangs as CabangTujuan','transaksibahanbakus.cabangtujuan_id','=','CabangTujuan.id')
                ->leftJoin('Users','transaksibahanbakus.user_id','=','Users.id')
                ->select('transaksibahanbakus.*','Bahanbakus.nama_bahan','CabangDari.Nama_Cabang as cabangdari',
                        'CabangTujuan.Nama_Cabang as cabangtujuan','Users.username')
                ->onlyTrashed();
                if ($request->no!=null)
                {
                    $data->where('transaksibahanbakus.id','like','%'.$request->no.'%');
                }

                if ($request->namabahanbaku=="semua")
                {

                }
                elseif ($request->namabahanbaku!=null)
                {
                    
                    $data->where('Bahanbakus.id','like','%'.decrypt($request->namabahanbaku).'%');
                    $request->namabahanbaku=decrypt($request->namabahanbaku);
                    // dd($request->namabahanbaku);
                }

                if ($request->tanggal!=null)
                {
                    // dd(date('Y-m-d',strtotime($request->tanggal)));
                    $data->where('transaksibahanbakus.tanggal','=',date('Y-m-d',strtotime($request->tanggal)));
                }

                if ($request->cabangtujuan=="semua")
                {

                }
                elseif ($request->cabangtujuan!=null)
                {
                    $data->where('transaksibahanbakus.cabangtujuan_id','=',decrypt($request->cabangtujuan));
                    $request->cabangtujuan=decrypt($request->cabangtujuan);
                }

                $datas=$data->paginate(30);



        return view('transaksibahanbaku.deleted',
                    ['no'=>$request->no,'namabahanbaku'=>($request->namabahanbaku),'date'=>$request->tanggal,
                    'cabangtujuan'=>($request->cabangtujuan),'bahanbakus'=>$bahanbakus,'datas'=>$datas,'cabangs'=>$cabangs]);
    }
}
