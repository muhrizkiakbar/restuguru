<?php

namespace App\Exports\TransaksiPengeluaran\AngsuranPengeluaran;
use App\Jenis_Pengeluaran;
use App\Transaksi_Pengeluaran;
use App\Angsuran;
use App\User;
use App\Angsuran_Pengeluarans;
use App\CCabangs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AngsuranPengeluaranReport implements FromCollection, WithHeadings
{
  use Exportable;

  public function proses($tanggal,$periode,$pembayaran,$nonota,$namapelanggan,$jenispengeluaran)
  {
        $this->tanggal = $tanggal;
        $this->periode=$periode;
        $this->jenispengeluaran=$jenispengeluaran;
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
        if (($this->jenispengeluaran=="semua") || ($this->jenispengeluaran=="")){
            $jenispengeluaran="";
        }
        else
        {
            $jenispengeluaran=$this->jenispengeluaran;
        }

        // dd($request->periode);
        if ($this->periode=="hari"){
            // dd("hari");    
            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                            ->select(   'Angsuran_Pengeluarans.id',
                                        'Angsuran_Pengeluarans.created_at',
                                        'Transaksi_Pengeluarans.namapenerima',
                                        'Transaksi_Pengeluarans.hppenerima',
                                        'Jenis_Pengeluaran.jenis_pengeluaran',
                                        'Angsuran_Pengeluarans.nominal_angsuran',
                                        'Angsuran_Pengeluarans.sisa_angsuran',
                                        'Transaksi_Pengeluarans.total_pengeluaran',
                                        'Angsuran_Pengeluarans.metode_pembayaran',
                                        'Transaksi_Pengeluarans.id as idtrans',
                                        'Cabangs.Nama_Cabang',
                                        'Users.username')
                            ->where('Angsuran_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsuran_Pengeluarans.id','like','%'.$this->nonota.'%')
                            ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$jenispengeluaran.'%')
                            ->where('Transaksi_Pengeluarans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->where('Angsuran_Pengeluarans.tanggal_angsuran','like','%'.date('Y-m-d',strtotime($this->tanggal)).'%')
                            ->orderBy('created_at','desc')        
                            ->get();
        }
        elseif ($this->periode=="semua"){


            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                            ->select(   'Angsuran_Pengeluarans.id',
                                        'Angsuran_Pengeluarans.created_at',
                                        'Transaksi_Pengeluarans.namapenerima',
                                        'Transaksi_Pengeluarans.hppenerima',
                                        'Jenis_Pengeluaran.jenis_pengeluaran',
                                        'Angsuran_Pengeluarans.nominal_angsuran',
                                        'Angsuran_Pengeluarans.sisa_angsuran',
                                        'Transaksi_Pengeluarans.total_pengeluaran',
                                        'Angsuran_Pengeluarans.metode_pembayaran',
                                        'Transaksi_Pengeluarans.id as idtrans',
                                        'Cabangs.Nama_Cabang',
                                        'Users.username')
                            ->where('Angsuran_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsuran_Pengeluarans.id','like','%'.$this->nonota.'%')
                            ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$jenispengeluaran.'%')
                            ->where('Transaksi_Pengeluarans.namapenerima','like','%'.$this->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->orderBy('created_at','desc')
                            ->get();
        }
        elseif ($this->periode=="bulan"){
            // dd("bulan");    

            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                            ->select(   'Angsuran_Pengeluarans.id',
                                        'Angsuran_Pengeluarans.created_at',
                                        'Transaksi_Pengeluarans.namapenerima',
                                        'Transaksi_Pengeluarans.hppenerima',
                                        'Jenis_Pengeluaran.jenis_pengeluaran',
                                        'Angsuran_Pengeluarans.nominal_angsuran',
                                        'Angsuran_Pengeluarans.sisa_angsuran',
                                        'Transaksi_Pengeluarans.total_pengeluaran',
                                        'Angsuran_Pengeluarans.metode_pembayaran',
                                        'Transaksi_Pengeluarans.id as idtrans',
                                        'Cabangs.Nama_Cabang',
                                        'Users.username')
                            ->where('Angsuran_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsuran_Pengeluarans.id','like','%'.$this->nonota.'%')
                            ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$jenispengeluaran.'%')
                            ->where('Transaksi_Pengeluarans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereMonth('Angsuran_Pengeluarans.tanggal_angsuran','=',$bulan)
                            ->whereYear('Angsuran_Pengeluarans.tanggal_angsuran','=',$tahun)
                            ->orderBy('created_at','desc')
                            ->get();
        }
        elseif ($this->periode=="tahun")
        {
            // dd("tahun");    
            
            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                            ->select(   'Angsuran_Pengeluarans.id',
                                        'Angsuran_Pengeluarans.created_at',
                                        'Transaksi_Pengeluarans.namapenerima',
                                        'Transaksi_Pengeluarans.hppenerima',
                                        'Jenis_Pengeluaran.jenis_pengeluaran',
                                        'Angsuran_Pengeluarans.nominal_angsuran',
                                        'Angsuran_Pengeluarans.sisa_angsuran',
                                        'Transaksi_Pengeluarans.total_pengeluaran',
                                        'Angsuran_Pengeluarans.metode_pembayaran',
                                        'Transaksi_Pengeluarans.id as idtrans',
                                        'Cabangs.Nama_Cabang',
                                        'Users.username')
                            ->where('Angsuran_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                            ->where('Angsuran_Pengeluarans.id','like','%'.$this->nonota.'%')
                            ->where('Transaksi_Pengeluarans.jenispengeluaran_id','like','%'.$jenispengeluaran.'%')
                            ->where('Transaksi_Pengeluarans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                            ->where('Angsuran_Pengeluarans.metode_pembayaran','like','%'.$pembayaran.'%')
                            ->whereYear('Angsuran_Pengeluarans.tanggal_angsuran','=',$tahun)
                            ->orderBy('created_at','desc')
                            ->get();
        }
        else
        {
            // dd("kintil");    

            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=Angsuran_Pengeluarans::leftJoin('Transaksi_Pengeluarans','Angsuran_Pengeluarans.transaksipengeluaran_id','=','Transaksi_Pengeluarans.id')
                            ->leftJoin('Users','Angsuran_Pengeluarans.user_id','=','Users.id')
                            ->leftJoin('Cabangs','Angsuran_Pengeluarans.cabang_id','=','Cabangs.id')
                            ->leftJoin('Jenis_Pengeluaran','Transaksi_Pengeluarans.jenispengeluaran_id','=','Jenis_Pengeluaran.id')
                            ->select(   'Angsuran_Pengeluarans.id',
                                        'Angsuran_Pengeluarans.created_at',
                                        'Transaksi_Pengeluarans.namapenerima',
                                        'Transaksi_Pengeluarans.hppenerima',
                                        'Jenis_Pengeluaran.jenis_pengeluaran',
                                        'Angsuran_Pengeluarans.nominal_angsuran',
                                        'Angsuran_Pengeluarans.sisa_angsuran',
                                        'Transaksi_Pengeluarans.total_pengeluaran',
                                        'Angsuran_Pengeluarans.metode_pembayaran',
                                        'Transaksi_Pengeluarans.id as idtrans',
                                        'Cabangs.Nama_Cabang',
                                        'Users.username')
                            ->where('Angsuran_Pengeluarans.cabang_id','=',Auth::user()->cabangs->id)
                            ->orderBy('created_at','desc')
                            ->get();
        }
        // dd($datas);
        return $datas;
  }

  public function headings(): array
    {
        return [
            'No. Nota Angsuran',
            'Tanggal',
            'Nama',
            'Hp Pelanggan',
            'Jenis Pengeluaran',
            'Pelunasan',
            'Sisa Tagihan',
            'Total',
            'Pembayaran',
            'Nota Pengeluaran',
            'Cabang',
            'Pengguna',
        ];
    }

}
