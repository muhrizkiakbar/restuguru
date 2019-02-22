<?php

namespace App\Exports\TransaksiPenjualan\AngsuranPenjualan;

use App\CTransaksi_Penjualans;
use App\Angsuran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AngsuranPenjualanReport implements FromCollection, WithHeadings
{
  use Exportable;

  public function proses($tanggal,$periode,$pembayaran,$nonota,$namapelanggan)
  {
        $this->tanggal = $tanggal;
        $this->periode=$periode;
        $this->pembayaran=$pembayaran;
        $this->nonota=$nonota;
        $this->namapelanggan=$namapelanggan;
        $this->pembayaran=$pembayaran;
        return $this;
  }

  public function collection()
  {
    // dd($this);
    $date=date('d-m-Y');
        if ($this->tanggal==""){
            $this->tanggal=$date;
        }
        else
        {
              
            $this->tanggal=date('d-m-Y',strtotime($this->tanggal));
            $date=$this->tanggal;
        }

        if ($this->pembayaran=="semua"){
            $pembayaran="";
        }
        else
        {
            $pembayaran=$this->pembayaran;
        }
        // dd($request->periode);
        if ($this->periode=="hari"){
            // dd("hari");    
            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.id',
                              'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan',
                              'Angsurans.created_at',
                              'Angsurans.nominal_angsuran',
                              'Angsurans.sisa_angsuran',
                              'Transaksi_Penjualans.total_harga',
                              'Angsurans.metode_pembayaran',
                              'Transaksi_Penjualans.id as idtrans',
                              'Cabangs.Nama_Cabang',
                              'Users.username')
                            ->where('Angsurans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsurans.id','like','%'.$this->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->where('Angsurans.tanggal_angsuran','like','%'.date('Y-m-d',strtotime($this->tanggal)).'%')
                            ->orderBy('Transaksi_Penjualans.created_at','desc')        
                            ->get();
        }
        elseif ($this->periode=="semua"){


            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.id',
                              'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan',
                              'Angsurans.created_at',
                              'Angsurans.nominal_angsuran',
                              'Angsurans.sisa_angsuran',
                              'Transaksi_Penjualans.total_harga',
                              'Angsurans.metode_pembayaran',
                              'Transaksi_Penjualans.id as idtrans',
                              'Cabangs.Nama_Cabang',
                              'Users.username')
                            ->where('Angsurans.id','like','%'.$this->nonota.'%')
                            ->where('Angsurans.cabang_id','=',Auth::user()->cabangs->id) 
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->orderBy('Transaksi_Penjualans.created_at','desc')
                            ->get();
        }
        elseif ($this->periode=="bulan"){
            // dd("bulan");    

            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.id',
                              'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan',
                              'Angsurans.created_at',
                              'Angsurans.nominal_angsuran',
                              'Angsurans.sisa_angsuran',
                              'Transaksi_Penjualans.total_harga',
                              'Angsurans.metode_pembayaran',
                              'Transaksi_Penjualans.id as idtrans',
                              'Cabangs.Nama_Cabang',
                              'Users.username')
                            ->where('Angsurans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsurans.id','like','%'.$this->nonota.'%')
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereMonth('Angsurans.tanggal_angsuran','=',$bulan)
                            ->whereYear('Angsurans.tanggal_angsuran','=',$tahun)
                            ->orderBy('Transaksi_Penjualans.created_at','desc')
                            ->get();
        }
        elseif ($this->periode=="tahun")
        {
            // dd("tahun");    
            
            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.id',
                              'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan',
                              'Angsurans.created_at',
                              'Angsurans.nominal_angsuran',
                              'Angsurans.sisa_angsuran',
                              'Transaksi_Penjualans.total_harga',
                              'Angsurans.metode_pembayaran',
                              'Transaksi_Penjualans.id as idtrans',
                              'Cabangs.Nama_Cabang',
                              'Users.username')
                            ->where('Angsurans.id','like','%'.$this->nonota.'%')
                            ->where('Angsurans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                            ->where('Angsurans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereYear('Angsurans.tanggal_angsuran','=',$tahun)
                            ->orderBy('Transaksi_Penjualans.created_at','desc')
                            ->get();
        }
        else
        {
            // dd("kintil");    

            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran::leftJoin('Transaksi_Penjualans','Angsurans.transaksipenjualan_id','=','Transaksi_Penjualans.id')
                            ->leftJoin('Users','Angsurans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsurans.cabang_id','=','Cabangs.id')
                            ->select('Angsurans.id',
                              'Transaksi_Penjualans.nama_pelanggan','Transaksi_Penjualans.hp_pelanggan',
                              'Angsurans.created_at',
                              'Angsurans.nominal_angsuran',
                              'Angsurans.sisa_angsuran',
                              'Transaksi_Penjualans.total_harga',
                              'Angsurans.metode_pembayaran',
                              'Transaksi_Penjualans.id as idtrans',
                              'Cabangs.Nama_Cabang',
                              'Users.username')
                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                            ->orderBy('Transaksi_Penjualans.created_at','desc')
                            ->get;
        }
        // dd($datas);
        return $datas;
  }

  public function headings(): array
    {
        return [
            'No. Nota',
            'Nama',
            'Hp Pelanggan',
            'Tanggal',
            'Pelunasan',
            'Sisa Tagihan',
            'Total',
            'Pembayaran',
            'Nota Penjualan',
            'Cabang',
            'Pengguna',
        ];
    }

}
