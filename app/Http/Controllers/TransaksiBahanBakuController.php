<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CBahanBakus;
use App\transaksibahanbaku;
use App\CCabangs;
use App\stokbahanbaku;
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

        // dd($request);

        $table= new transaksibahanbaku;
        $table->bahanbaku_id=decrypt($request->bahanbaku_transaksibahanbaku);

            $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',decrypt($request->bahanbaku_transaksibahanbaku))
                                            ->where('cabang_id','=',Auth::user()->cabangs->id)
                                            ->count();
            $bahanbakugethitungluas=CBahanBakus::find(decrypt($request->bahanbaku_transaksibahanbaku));

            if ($stokbahanbaku==0)
            {
                
                $addbahanbaku=new stokbahanbaku;
                $addbahanbaku->bahanbaku_id=decrypt($request->bahanbaku_transaksibahanbaku);
                $addbahanbaku->cabang_id=Auth::user()->cabangs->id;
                $addbahanbaku->satuan=$bahanbakugethitungluas->satuan;

                

                $addbahanbaku->stokhitungluas=$bahanbakugethitungluas->hitung_luas;

                $addbahanbaku->banyakstok=0-($request->banyak_transaksibahanbaku);

                $addbahanbaku->save();

            }
            else
            {  
                $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',decrypt($request->bahanbaku_transaksibahanbaku))
                                            ->where('cabang_id','=',Auth::user()->cabangs->id)
                                            ->first();

                $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok-$request->banyak_transaksibahanbaku;

                $stokbahanbaku->save();

            }

        $table->cabangdari_id=Auth::user()->cabangs->id;
        $table->cabangtujuan_id=decrypt($request->cabangtujuan_transaksibahanbaku);
        $table->banyak=$request->banyak_transaksibahanbaku;
        $table->tanggal=date('Y-m-d');
        $table->satuan=$bahanbakugethitungluas->satuan;
        $table->keterangan=$request->keterangan_transaksibahanbaku;
        $table->user_id=Auth::user()->id;
        // dd($request->permissionrole)
        if ($table->save()){
            $isi=Auth::user()->username." telah menambah transaksi bahan baku dengan No. ".$table->id." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"add");
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
        
            $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',decrypt($request->bahanbaku_transaksibahanbaku))
                                            ->where('cabang_id','=',Auth::user()->cabangs->id)
                                            ->count();
            $bahanbakugethitungluas=CBahanBakus::find(decrypt($request->bahanbaku_transaksibahanbaku));

            if ($stokbahanbaku==0)
            {
                
                $addbahanbaku=new stokbahanbaku;
                $addbahanbaku->bahanbaku_id=decrypt($request->bahanbaku_transaksibahanbaku);
                $addbahanbaku->cabang_id=Auth::user()->cabangs->id;
                $addbahanbaku->satuan=$bahanbakugethitungluas->satuan;

                

                $addbahanbaku->stokhitungluas=$bahanbakugethitungluas->hitung_luas;

                $addbahanbaku->banyakstok=0-($request->banyak_transaksibahanbaku);

                $addbahanbaku->save();

            }
            else
            {  
                $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',decrypt($request->bahanbaku_transaksibahanbaku))
                                            ->where('cabang_id','=',Auth::user()->cabangs->id)
                                            ->first();

                $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+$table->banyak-$request->banyak_transaksibahanbaku;

                $stokbahanbaku->save();

            }

        $table->cabangtujuan_id=decrypt($request->cabangtujuan_transaksibahanbaku);
        $table->banyak=$request->banyak_transaksibahanbaku;
        $table->satuan=$bahanbakugethitungluas->satuan;
        $table->keterangan=$request->keterangan_transaksibahanbaku;
        $table->user_id=Auth::user()->id;
        // dd($request->permissionrole)
        if ($table->save()){
            $isi=Auth::user()->username." telah mengubah transaksi bahan baku dengan No. ".$table->id." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"edit");
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

        $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$table->bahanbaku_id)
                ->where('cabang_id','=',Auth::user()->cabangs->id)
                ->count();
        $bahanbakugethitungluas=CBahanBakus::find($table->bahanbaku_id);
        // dd($stokbahanbaku);
        if ($stokbahanbaku==0)
        {

        $addbahanbaku=new stokbahanbaku;
        $addbahanbaku->bahanbaku_id=$table->bahanbaku_id;
        $addbahanbaku->cabang_id=Auth::user()->cabangs->id;
        $addbahanbaku->satuan=$bahanbakugethitungluas->satuan;



        $addbahanbaku->stokhitungluas=$bahanbakugethitungluas->hitung_luas;

        $addbahanbaku->banyakstok=0-($request->banyak_transaksibahanbaku);

        $addbahanbaku->save();

        }
        else
        {  
        $stokbahanbaku=stokbahanbaku::where('bahanbaku_id','=',$table->bahanbaku_id)
                ->where('cabang_id','=',Auth::user()->cabangs->id)
                ->first();

        $stokbahanbaku->banyakstok=$stokbahanbaku->banyakstok+$table->banyak;

        $stokbahanbaku->save();

        }
        if ($table->delete()){

            

            $isi=Auth::user()->username." telah menghapus transaksi bahan baku dengan No. ".decrypt($id)." di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"delete");
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
