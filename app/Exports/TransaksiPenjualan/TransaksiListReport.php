<?php

namespace App\Exports\TransaksiPenjualan;

use App\CTransaksi_Penjualans;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiListReport implements FromCollection, WithHeadings
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
    // dd($this)
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
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualansid',
                                          'Transaksi_Penjualans.nama_pelanggan',
                                          'Transaksi_Penjualans.hp_pelanggan',
                                          'Transaksi_Penjualans.created_at',
                                          'Transaksi_Penjualans.jumlah_pembayaran',
                                          'Transaksi_Penjualans.metode_pembayaran',
                                          'Transaksi_Penjualans.diskon',
                                          'Transaksi_Penjualans.pajak',
                                          'Transaksi_Penjualans.sisa_tagihan',
                                          'Transaksi_Penjualans.total_harga','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualansid','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereDay('Transaksi_Penjualans.tanggal','=',$this->tanggal)
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)
                                        ->orderBy('created_at','desc')
                                        ->get();
        }
        elseif ($this->periode=="semua"){


            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualansid',
                                          'Transaksi_Penjualans.nama_pelanggan',
                                          'Transaksi_Penjualans.hp_pelanggan',
                                          'Transaksi_Penjualans.created_at',
                                          'Transaksi_Penjualans.jumlah_pembayaran',
                                          'Transaksi_Penjualans.metode_pembayaran',
                                          'Transaksi_Penjualans.diskon',
                                          'Transaksi_Penjualans.pajak',
                                          'Transaksi_Penjualans.sisa_tagihan',
                                          'Transaksi_Penjualans.total_harga','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualansid','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->orderBy('created_at','desc')
                                        ->get();
        }
        elseif ($this->periode=="bulan"){
            // dd("bulan");    

            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualansid',
                                          'Transaksi_Penjualans.nama_pelanggan',
                                          'Transaksi_Penjualans.hp_pelanggan',
                                          'Transaksi_Penjualans.created_at',
                                          'Transaksi_Penjualans.jumlah_pembayaran',
                                          'Transaksi_Penjualans.metode_pembayaran',
                                          'Transaksi_Penjualans.diskon',
                                          'Transaksi_Penjualans.pajak',
                                          'Transaksi_Penjualans.sisa_tagihan',
                                          'Transaksi_Penjualans.total_harga','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualansid','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)                                        
                                        ->orderBy('created_at','desc')
                                        ->get();
        }
        elseif ($this->periode=="tahun")
        {
            // dd("tahun");    
            
            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualansid',
                                          'Transaksi_Penjualans.nama_pelanggan',
                                          'Transaksi_Penjualans.hp_pelanggan',
                                          'Transaksi_Penjualans.created_at',
                                          'Transaksi_Penjualans.jumlah_pembayaran',
                                          'Transaksi_Penjualans.metode_pembayaran',
                                          'Transaksi_Penjualans.diskon',
                                          'Transaksi_Penjualans.pajak',
                                          'Transaksi_Penjualans.sisa_tagihan',
                                          'Transaksi_Penjualans.total_harga','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualansid','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)                                        
                                        ->orderBy('created_at','desc')
                                        ->get();
        }
        else
        {
            // dd("kintil");    

            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->select('Transaksi_Penjualansid',
                                          'Transaksi_Penjualans.nama_pelanggan',
                                          'Transaksi_Penjualans.hp_pelanggan',
                                          'Transaksi_Penjualans.created_at',
                                          'Transaksi_Penjualans.jumlah_pembayaran',
                                          'Transaksi_Penjualans.metode_pembayaran',
                                          'Transaksi_Penjualans.diskon',
                                          'Transaksi_Penjualans.pajak',
                                          'Transaksi_Penjualans.sisa_tagihan',
                                          'Transaksi_Penjualans.total_harga','Cabangs.Nama_Cabang','Users.username')
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)                                                    
                                        ->orderBy('created_at','desc')
                                        ->get();
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
            'Jumlah Pembayaran',
            'Metode Pembayaran',
            'Diskon',
            'Pajak',
            'Sisa Tagihan',
            'Total',
            'Cabang',
            'Pengguna',
        ];
    }

}
