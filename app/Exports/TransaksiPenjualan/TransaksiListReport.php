<?php

namespace App\Exports\TransaksiPenjualan;

use App\CTransaksi_Penjualans;
use App\CSub_Tpenjualans;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class TransaksiListReport implements FromCollection, WithHeadings
{
  use Exportable;

  public function proses($tanggal,$periode,$pembayaran,$nonota,$namapelanggan,$produk,$submitpelanggan)
  {
        $this->tanggal = $tanggal;
        $this->periode=$periode;
        $this->pembayaran=$pembayaran;
        $this->nonota=$nonota;
        $this->namapelanggan=$namapelanggan;
        $this->pembayaran=$pembayaran;
        $this->produk=$produk;
        $this->submitpelanggan=$submitpelanggan;
        // dd($this);
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
        // dd($this->produk);
        if ($this->submitpelanggan=="export")
        {
            if ($this->periode=="hari"){
                // dd("hari");    
                $tanggal=explode("-",$this->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->select('Transaksi_Penjualans.id',
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
                                            ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereDay('Transaksi_Penjualans.tanggal','=',$this->tanggal)
                                            ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)
                                            ->whereNull('Transaksi_Penjualans.deleted_at')         
                                            ->groupBy('Transaksi_Penjualans.id')
                                            ->orderBy('created_at','desc');
            }
            elseif ($this->periode=="semua"){


                $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->select('Transaksi_Penjualans.id',
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
                                            ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereNull('Transaksi_Penjualans.deleted_at')         
                                            ->orderBy('created_at','desc')
                                            ->groupBy('Transaksi_Penjualans.id');
            }
            elseif ($this->periode=="bulan"){
                // dd("bulan");    

                $tanggal=explode("-",$this->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->select('Transaksi_Penjualans.id',
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
                                            ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)  
                                            ->whereNull('Transaksi_Penjualans.deleted_at')                                         
                                            ->orderBy('created_at','desc')
                                            ->groupBy('Transaksi_Penjualans.id');
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
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->select('Transaksi_Penjualans.id',
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
                                            ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)    
                                            ->whereNull('Transaksi_Penjualans.deleted_at')                                    
                                            ->groupBy('Transaksi_Penjualans.id')
                                            ->orderBy('created_at','desc');
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
                                            ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->select('Transaksi_Penjualans.id',
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
                                            ->whereNull('Transaksi_Penjualans.deleted_at')                              
                                            ->groupBy('Transaksi_Penjualans.id')
                                            ->orderBy('created_at','desc');
            }
        }
        elseif ($this->submitpelanggan=="export_detail")
        {
            if ($this->periode=="hari"){
                // dd("hari");    
                $tanggal=explode("-",$this->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datas=CSub_Tpenjualans::leftJoin('Transaksi_Penjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            // ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->select('Transaksi_Penjualans.id',
                                              'Transaksi_Penjualans.nama_pelanggan',
                                              'Transaksi_Penjualans.hp_pelanggan',
                                              'Transaksi_Penjualans.created_at',
                                              'Transaksi_Penjualans.jumlah_pembayaran',
                                              'Transaksi_Penjualans.metode_pembayaran',
                                              'Transaksi_Penjualans.diskon',
                                              'Transaksi_Penjualans.pajak',
                                              'Transaksi_Penjualans.sisa_tagihan',
                                              'Transaksi_Penjualans.total_harga','Cabangs.Nama_Cabang','Users.username',
                                              'Produks.nama_produk',
                                              'Sub_Tpenjualans.panjang',
                                              'Sub_Tpenjualans.lebar',
                                              'Sub_Tpenjualans.finishing',
                                              'Sub_Tpenjualans.harga_satuan',
                                              DB::raw('(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_total'),
                                              'Sub_Tpenjualans.banyak',
                                              'Sub_Tpenjualans.subtotal',
                                              'Sub_Tpenjualans.keterangan'
                                              )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereDay('Transaksi_Penjualans.tanggal','=',$this->tanggal)
                                            ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)
                                            ->whereNull('Transaksi_Penjualans.deleted_at')         
                                            ->orderBy('created_at','desc');
            }
            elseif ($this->periode=="semua"){


                $datas=CSub_Tpenjualans::leftJoin('Transaksi_Penjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            // ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->select('Transaksi_Penjualans.id',
                                              'Transaksi_Penjualans.nama_pelanggan',
                                              'Transaksi_Penjualans.hp_pelanggan',
                                              'Transaksi_Penjualans.created_at',
                                              'Transaksi_Penjualans.jumlah_pembayaran',
                                              'Transaksi_Penjualans.metode_pembayaran',
                                              'Transaksi_Penjualans.diskon',
                                              'Transaksi_Penjualans.pajak',
                                              'Transaksi_Penjualans.sisa_tagihan',
                                              'Transaksi_Penjualans.total_harga','Cabangs.Nama_Cabang','Users.username',
                                              'Produks.nama_produk',
                                              'Sub_Tpenjualans.panjang',
                                              'Sub_Tpenjualans.lebar',
                                              'Sub_Tpenjualans.finishing',
                                              'Sub_Tpenjualans.harga_satuan',
                                              DB::raw('(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_total'),
                                              'Sub_Tpenjualans.banyak',
                                              'Sub_Tpenjualans.subtotal',
                                              'Sub_Tpenjualans.keterangan'
                                              )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereNull('Transaksi_Penjualans.deleted_at')         
                                            ->orderBy('created_at','desc');
            }
            elseif ($this->periode=="bulan"){
                // dd("bulan");    

                $tanggal=explode("-",$this->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datas=CSub_Tpenjualans::leftJoin('Transaksi_Penjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            // ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->select('Transaksi_Penjualans.id',
                                              'Transaksi_Penjualans.nama_pelanggan',
                                              'Transaksi_Penjualans.hp_pelanggan',
                                              'Transaksi_Penjualans.created_at',
                                              'Transaksi_Penjualans.jumlah_pembayaran',
                                              'Transaksi_Penjualans.metode_pembayaran',
                                              'Transaksi_Penjualans.diskon',
                                              'Transaksi_Penjualans.pajak',
                                              'Transaksi_Penjualans.sisa_tagihan',
                                              'Transaksi_Penjualans.total_harga','Cabangs.Nama_Cabang','Users.username',
                                              'Produks.nama_produk',
                                              'Sub_Tpenjualans.panjang',
                                              'Sub_Tpenjualans.lebar',
                                              'Sub_Tpenjualans.finishing',
                                              'Sub_Tpenjualans.harga_satuan',
                                              DB::raw('(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_total'),
                                              'Sub_Tpenjualans.banyak',
                                              'Sub_Tpenjualans.subtotal',
                                              'Sub_Tpenjualans.keterangan'
                                              )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)  
                                            ->whereNull('Transaksi_Penjualans.deleted_at')                                              
                                            ->orderBy('created_at','desc');
            }
            elseif ($this->periode=="tahun")
            {
                // dd("tahun");    
                
                $tanggal=explode("-",$this->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datas=CSub_Tpenjualans::leftJoin('Transaksi_Penjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            // ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->select('Transaksi_Penjualans.id',
                                              'Transaksi_Penjualans.nama_pelanggan',
                                              'Transaksi_Penjualans.hp_pelanggan',
                                              'Transaksi_Penjualans.created_at',
                                              'Transaksi_Penjualans.jumlah_pembayaran',
                                              'Transaksi_Penjualans.metode_pembayaran',
                                              'Transaksi_Penjualans.diskon',
                                              'Transaksi_Penjualans.pajak',
                                              'Transaksi_Penjualans.sisa_tagihan',
                                              'Transaksi_Penjualans.total_harga','Cabangs.Nama_Cabang','Users.username',
                                              'Produks.nama_produk',
                                              'Sub_Tpenjualans.panjang',
                                              'Sub_Tpenjualans.lebar',
                                              'Sub_Tpenjualans.finishing',
                                              'Sub_Tpenjualans.harga_satuan',
                                              DB::raw('(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_total'),
                                              'Sub_Tpenjualans.banyak',
                                              'Sub_Tpenjualans.subtotal',
                                              'Sub_Tpenjualans.keterangan'
                                              )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                            ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                            ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                            ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                            ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)         
                                            ->whereNull('Transaksi_Penjualans.deleted_at')                        
                                            ->orderBy('created_at','desc');
            }
            else
            {
                // dd("kintil");    

                $tanggal=explode("-",$this->tanggal);
                $bulan=$tanggal[1];
                $tahun=$tanggal[2];
                $datas=CSub_Tpenjualans::leftJoin('Transaksi_Penjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                            ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                            ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                            // ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                            ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                            ->select('Transaksi_Penjualans.id',
                                              'Transaksi_Penjualans.nama_pelanggan',
                                              'Transaksi_Penjualans.hp_pelanggan',
                                              'Transaksi_Penjualans.created_at',
                                              'Transaksi_Penjualans.jumlah_pembayaran',
                                              'Transaksi_Penjualans.metode_pembayaran',
                                              'Transaksi_Penjualans.diskon',
                                              'Transaksi_Penjualans.pajak',
                                              'Transaksi_Penjualans.sisa_tagihan',
                                              'Transaksi_Penjualans.total_harga','Cabangs.Nama_Cabang','Users.username',
                                              'Produks.nama_produk',
                                              'Sub_Tpenjualans.panjang',
                                              'Sub_Tpenjualans.lebar',
                                              'Sub_Tpenjualans.finishing',
                                              'Sub_Tpenjualans.harga_satuan',
                                              DB::raw('(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_total'),
                                              'Sub_Tpenjualans.banyak',
                                              'Sub_Tpenjualans.subtotal',
                                              'Sub_Tpenjualans.keterangan'
                                              )
                                            ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)                 
                                            ->whereNull('Transaksi_Penjualans.deleted_at')                                   
                                            ->orderBy('created_at','desc');
            } 
        }
            


        // dd($datas);
        $request_produk=($this->produk);
        if (($request_produk=="") || ($request_produk=="semua"))
        {
            if ($request_produk=="")
            {
                $request_produk=("semua");
            }
        }
        else
        {
          
            $request_produk=($this->produk);
            // dd($request_produk);

            $datas=$datas->where('Sub_Tpenjualans.produk_id','=',$request_produk);
        }
        return $datas->get();
  }

  public function headings(): array
    {
        if ($this->submitpelanggan=="export")
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
                'Pengguna'
            ];
        }
        elseif ($this->submitpelanggan=="export_detail")
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
                'Produk',
                'Panjang',
                'Lebar',
                'Finishing',
                'Harga Barang',
                'Harga Satuan',
                'Banyak',
                'Subtotal',
                'Keterangan'
            ];
        }
    }

}
