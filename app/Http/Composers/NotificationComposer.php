<?php
namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Role;
use App\Permission;
use App\kategorimenu;
use App\kategori_permission;
use App\CTransaksi_Penjualans;

class NotificationComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Auth::check()) {
            // dd(Auth::user()->cabangs->id);
            $pelanggans=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                ->whereNotNull('Transaksi_Penjualans.pelanggan_id')
                ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                ->select('Pelanggans.id','Pelanggans.nama_perusahaan',DB::raw('SUM(Transaksi_Penjualans.total_harga) as total_harga')
                        ,DB::raw('SUM(Transaksi_Penjualans.sisa_tagihan) as sisa_tagihan2'),'Pelanggans.hp_pelanggan','Pelanggans.limit_pelanggan',
                        'Pelanggans.alamat_pelanggan','Pelanggans.tempo_pelanggan')
                ->havingRaw('sisa_tagihan2 >= limit_pelanggan')
                ->groupBy('Pelanggans.id')
                // ->orWhere('Transaksi_Penjualans.pelanggan_id','=',$request->jenispelanggan)
                //->paginate(30);
                ->get();

             //(count($pelanggans));
             
            $view->with('jatuhtempopelanggan',count($pelanggans));
        }
    }
 
}
