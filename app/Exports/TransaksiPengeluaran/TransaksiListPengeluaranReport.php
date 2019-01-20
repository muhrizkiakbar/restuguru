<?php

namespace App\Exports\TransaksiPengeluaran;

use App\Transaksi_Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiListPengeluaranReport implements FromCollection, WithHeadings
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
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->select(   'Transaksi_Pengeluarans.id',
                                                    'Jenis_Pengeluaran.jenis_pengeluaran',
                                                    'Transaksi_Pengeluarans.created_at',
                                                    'Transaksi_Pengeluarans.namapenerima',
                                                    'Transaksi_Pengeluarans.hppenerima',
                                                    'Transaksi_Pengeluarans.total_pengeluaran',
                                                    'Transaksi_Pengeluarans.pembayaran_pengeluaran',
                                                    'Transaksi_Pengeluarans.sisa_pengeluaran',
                                                    'Transaksi_Pengeluarans.metode_pembayaran',
                                                    'Cabangs.Nama_Cabang',
                                                    'Users.username',
                                                    'UserClient.username',
                                                    'Suppliers.nama_supplier')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereDay('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$this->tanggal)
                                        ->whereMonth('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$bulan)
                                        ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)
                                        ->orderBy('created_at','desc')
                                        ->get();
        }
        elseif ($this->periode=="semua"){


            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->select(   'Transaksi_Pengeluarans.id',
                                                    'Jenis_Pengeluaran.jenis_pengeluaran',
                                                    'Transaksi_Pengeluarans.created_at',
                                                    'Transaksi_Pengeluarans.namapenerima',
                                                    'Transaksi_Pengeluarans.hppenerima',
                                                    'Transaksi_Pengeluarans.total_pengeluaran',
                                                    'Transaksi_Pengeluarans.pembayaran_pengeluaran',
                                                    'Transaksi_Pengeluarans.sisa_pengeluaran',
                                                    'Transaksi_Pengeluarans.metode_pembayaran',
                                                    'Cabangs.Nama_Cabang',
                                                    'Users.username',
                                                    'UserClient.username',
                                                    'Suppliers.nama_supplier')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->orderBy('created_at','desc')
                                        ->get();
            // dd($datas);
        }
        elseif ($this->periode=="bulan"){
            // dd("bulan");    

            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->select(   'Transaksi_Pengeluarans.id',
                                                    'Jenis_Pengeluaran.jenis_pengeluaran',
                                                    'Transaksi_Pengeluarans.created_at',
                                                    'Transaksi_Pengeluarans.namapenerima',
                                                    'Transaksi_Pengeluarans.hppenerima',
                                                    'Transaksi_Pengeluarans.total_pengeluaran',
                                                    'Transaksi_Pengeluarans.pembayaran_pengeluaran',
                                                    'Transaksi_Pengeluarans.sisa_pengeluaran',
                                                    'Transaksi_Pengeluarans.metode_pembayaran',
                                                    'Cabangs.Nama_Cabang',
                                                    'Users.username',
                                                    'UserClient.username',
                                                    'Suppliers.nama_supplier')
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereMonth('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$bulan)
                                        ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)
                                        ->orderBy('created_at','desc')
                                        ->get();
        }
        elseif ($this->periode=="tahun")
        {
            // dd("tahun");    
            
            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->select(   'Transaksi_Pengeluarans.id',
                                                    'Jenis_Pengeluaran.jenis_pengeluaran',
                                                    'Transaksi_Pengeluarans.created_at',
                                                    'Transaksi_Pengeluarans.namapenerima',
                                                    'Transaksi_Pengeluarans.hppenerima',
                                                    'Transaksi_Pengeluarans.total_pengeluaran',
                                                    'Transaksi_Pengeluarans.pembayaran_pengeluaran',
                                                    'Transaksi_Pengeluarans.sisa_pengeluaran',
                                                    'Transaksi_Pengeluarans.metode_pembayaran',
                                                    'Cabangs.Nama_Cabang',
                                                    'Users.username',
                                                    'UserClient.username',
                                                    'Suppliers.nama_supplier')                                        
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Pengeluarans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereYear('Transaksi_Pengeluarans.tanggal_pengeluaran','=',$tahun)
                                        ->orderBy('created_at','desc')
                                        ->get();
        }
        else
        {
            // dd("kintil");    

            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Transaksi_Pengeluaran::leftJoin('Users','Transaksi_Pengeluarans.user_id','=','Users.id')
                                        ->leftJoin('Users as UserClient','Transaksi_Pengeluarans.clientuser_id','=','UserClient.id')
                                        ->leftJoin('Cabangs','Transaksi_Pengeluarans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Suppliers','Transaksi_Pengeluarans.supplier_id','=','Suppliers.id')
                                        ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                                        ->select(   'Transaksi_Pengeluarans.id',
                                                    'Jenis_Pengeluaran.jenis_pengeluaran',
                                                    'Transaksi_Pengeluarans.created_at',
                                                    'Transaksi_Pengeluarans.namapenerima',
                                                    'Transaksi_Pengeluarans.hppenerima',
                                                    'Transaksi_Pengeluarans.total_pengeluaran',
                                                    'Transaksi_Pengeluarans.pembayaran_pengeluaran',
                                                    'Transaksi_Pengeluarans.sisa_pengeluaran',
                                                    'Transaksi_Pengeluarans.metode_pembayaran',
                                                    'Cabangs.Nama_Cabang',
                                                    'Users.username',
                                                    'UserClient.username',
                                                    'Suppliers.nama_supplier')                                        
                                        ->where('Transaksi_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
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
            'Jenis Pengeluaran',
            'Tanggal',
            'Nama Penerima',
            'Hp Penerima',
            'Jumlah',
            'Pembayaran',
            'Sisa',
            'Metode Pembayaran',
            'Cabang',
            'Pengguna',
            'Supplier'
        ];
    }

}
