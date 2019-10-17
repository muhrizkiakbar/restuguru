<?php 
namespace App\Exports\TransaksiPenjualan;

use App\CTransaksi_Penjualans;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithCustomStartCell;

use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;



class TagihanTransaksi implements FromView, WithCustomStartCell, WithDrawings, WithEvents
{
    use Exportable;

    public function __construct($tanggal,$periode,$pembayaran,$nonota,$namapelanggan,$produk,$baris)
    {
            $this->tanggal = $tanggal;
            $this->periode=$periode;
            $this->pembayaran=$pembayaran;
            $this->nonota=$nonota;
            $this->namapelanggan=$namapelanggan;
            $this->pembayaran=$pembayaran;
            $this->produk=$produk;
            if (($baris==0))
            {
                $this->baris=$baris;
            }
            else
            {
                $this->baris=$baris+22;
            }
            // dd($baris);
            return $this;
    }

   

    public function view(): View
    {

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
        if ($this->periode=="hari"){
            // dd("hari");    
            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        // ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        // ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                        // ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                        // ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                        ->select(
                                            // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                            'Transaksi_Penjualans.id',
                                            'Transaksi_Penjualans.sisa_tagihan',
                                            'Cabangs.kode_cabang',
                                            'Transaksi_Penjualans.tanggal',
                                            'Transaksi_Penjualans.total_harga'
                                            // 'Produks.nama_produk',
                                            // 'Sub_Tpenjualans.panjang',
                                            // 'Sub_Tpenjualans.lebar',
                                            // 'Bahanbakus.nama_bahan',
                                            // 'Sub_Tpenjualans.harga_satuan',
                                            // DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                            // 'Sub_Tpenjualans.banyak',
                                            // 'Sub_Tpenjualans.subtotal'
                                            )
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                        ->whereDay('Transaksi_Penjualans.tanggal','=',$this->tanggal)
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)
                                        // ->distinct('Transaksi_Penjualans.id')
                                        ->orderBy('Transaksi_Penjualans.created_at','desc');
        }
        elseif ($this->periode=="semua"){


            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        // ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        // ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                        // ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                        // ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                        ->select(
                                             // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                             'Transaksi_Penjualans.id',
                                            'Transaksi_Penjualans.sisa_tagihan',
                                            'Cabangs.kode_cabang', 
                                            'Transaksi_Penjualans.tanggal',
                                            'Transaksi_Penjualans.total_harga'
                                            // 'Produks.nama_produk',
                                            // 'Sub_Tpenjualans.panjang',
                                            // 'Sub_Tpenjualans.lebar',
                                            // 'Bahanbakus.nama_bahan',
                                            // 'Sub_Tpenjualans.harga_satuan',
                                            // DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                            // 'Sub_Tpenjualans.banyak',
                                            // 'Sub_Tpenjualans.subtotal'
                                            )
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        // ->distinct('Transaksi_Penjualans.id')
                                        ->orderBy('Transaksi_Penjualans.created_at','desc');
        }
        elseif ($this->periode=="bulan"){
            // dd("bulan");    

            $tanggal=explode("-",$this->tanggal);
            $bulan=$tanggal[1];
            $tahun=$tanggal[2];
            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        // ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        // ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                        // ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                        // ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                        ->select(
                                             // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                             'Transaksi_Penjualans.id',
                                            'Transaksi_Penjualans.sisa_tagihan',
                                            'Cabangs.kode_cabang', 
                                             'Transaksi_Penjualans.tanggal',
                                           'Transaksi_Penjualans.total_harga'
                                            // 'Produks.nama_produk',
                                            // 'Sub_Tpenjualans.panjang',
                                            // 'Sub_Tpenjualans.lebar',
                                            // 'Bahanbakus.nama_bahan',
                                            // 'Sub_Tpenjualans.harga_satuan',
                                            // DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                            // 'Sub_Tpenjualans.banyak',
                                            // 'Sub_Tpenjualans.subtotal'
                                            )
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)                                        
                                        // ->distinct('Transaksi_Penjualans.id')
                                        ->orderBy('Transaksi_Penjualans.created_at','desc');
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
                                        // ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        // ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                        // ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                        // ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                        ->select(
                                           // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                           'Transaksi_Penjualans.id',
                                            'Transaksi_Penjualans.sisa_tagihan',
                                            'Cabangs.kode_cabang', 
                                           'Transaksi_Penjualans.tanggal',
                                           'Transaksi_Penjualans.total_harga'
                                        //   'Produks.nama_produk',
                                        //   'Sub_Tpenjualans.panjang',
                                        //   'Sub_Tpenjualans.lebar',
                                        //   'Bahanbakus.nama_bahan',
                                        //   'Sub_Tpenjualans.harga_satuan',
                                        //   DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                        //   'Sub_Tpenjualans.banyak',
                                        //   'Sub_Tpenjualans.subtotal'
                                          )
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)        
                                        // ->distinct('Transaksi_Penjualans.id')
                                        ->orderBy('Transaksi_Penjualans.created_at','desc');
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
                                        // ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        // ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                        // ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                        // ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                        ->select(
                                             // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                             'Transaksi_Penjualans.id',
                                            'Transaksi_Penjualans.sisa_tagihan',
                                            'Cabangs.kode_cabang', 
                                             'Transaksi_Penjualans.tanggal'
                                            // 'Produks.nama_produk',
                                            // 'Sub_Tpenjualans.panjang',
                                            // 'Sub_Tpenjualans.lebar',
                                            // 'Bahanbakus.nama_bahan',
                                            // 'Sub_Tpenjualans.harga_satuan',
                                            // DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                            // 'Sub_Tpenjualans.banyak',
                                            // 'Sub_Tpenjualans.subtotal'
                                            )
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)           
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                        // ->distinct('Transaksi_Penjualans.id')
                                        ->orderBy('Transaksi_Penjualans.created_at','desc');
        }

        $transaksi= CTransaksi_Penjualans::where('nama_pelanggan','=',$this->namapelanggan)->first();
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

            // $datas=$datas->where('Sub_Tpenjualans.produk_id','=',$request_produk);
        }
        // dd($datas->get());

        // return $datas->get();
        return view('transaksis.excel.tagihan_penjualan', [
            'transaksis' => $datas->get(),
            'nama_pelanggan' =>$this->namapelanggan
        ]);
    }

    public function startCell(): string
    {
        return 'B17';
    }


    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('dist/img/kop.png'));
        $drawing->setResizeProportional(true);
        $drawing->setHeight(202);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(13);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(7);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(7);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(11);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(7);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(15);
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#0000'],
                        ],
                    ],
                ];

                $styleGlobalArray = [
                    'font' => array(
                        'name'      =>  'Times New Roman',
                        'size'      =>  12,
                        // 'bold'      =>  true
                    )
                ];
                $boldtextArray = [
                    'font' => array(
                        'bold'      =>  true
                    )
                ];
                //atur luas baris
                $event->sheet->getDelegate()->getRowDimension('19')->setRowHeight(35);
                if ($this->baris==0)
                {
                    $baris=21; 
                } 
                else
                {
                    $baris=$this->baris; 
                }
                // $event->sheet->getDelegate()->getRowDimension($baris+7)->setRowHeight(35);
                $event->sheet->getStyle('A'.($baris+7))->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A'.($baris+6))->applyFromArray($boldtextArray); //styling font
                $event->sheet->getStyle('A'.($baris+5))->applyFromArray($boldtextArray); //styling font

                

                

                if ($this->baris==0)
                {
                    $baris=21; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                $event->sheet->getStyle('A21:J'.($baris+2))->applyFromArray($styleArray); //styling border isi data

                if ($this->baris==0)
                {
                    $baris=21; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                $event->sheet->getStyle('A2:J'.($baris+15))->applyFromArray($styleGlobalArray); //styling font

                //header table wraptext
                $event->sheet->getStyle('A19')->getAlignment()->setWrapText(true);
                //header table center
                if ($this->baris==0)
                {
                    $baris=21; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                // $event->sheet->getStyle('A21:J'.$baris)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A21:J'.$baris)->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('A21:J'.$baris)->getAlignment()->setVertical('center');
                $event->sheet->getStyle('A21:J'.$baris)->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('C9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

                if ($this->baris==0)
                {
                    $baris=21; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                // dd($baris);
                $event->sheet->getStyle('H'.($baris+10))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


                if ($this->baris==0)
                {
                    $baris=21; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                // dd($baris);
                $event->sheet->getStyle('H'.($baris+14))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('H'.($baris+15))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('H'.($baris+14))->applyFromArray($boldtextArray); //styling font
                $event->sheet->getStyle('H'.($baris+15))->applyFromArray($boldtextArray); //styling font
                //set format currency
                if ($this->baris==0)
                {
                    $baris=22; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                $event->sheet->getStyle('E22:E'.$baris)->getNumberFormat()->setFormatCode('_("Rp"* #,##0_);_("Rp"* \(#,##0\);_("Rp"* "-"??_);_(@_)');
                $event->sheet->getStyle('F22:F'.$baris)->getNumberFormat()->setFormatCode('_("Rp"* #,##0_);_("Rp"* \(#,##0\);_("Rp"* "-"??_);_(@_)');
                $event->sheet->getStyle('H22:H'.$baris)->getNumberFormat()->setFormatCode('_("Rp"* #,##0_);_("Rp"* \(#,##0\);_("Rp"* "-"??_);_(@_)');
                $event->sheet->getStyle('I22:I'.($baris+2))->getNumberFormat()->setFormatCode('_("Rp"* #,##0_);_("Rp"* \(#,##0\);_("Rp"* "-"??_);_(@_)');
                $event->sheet->getStyle('I22:J'.($baris+2))->getNumberFormat()->setFormatCode('_("Rp"* #,##0_);_("Rp"* \(#,##0\);_("Rp"* "-"??_);_(@_)');

                $event->sheet->getPageSetup()->setPrintArea('A1:J'.($baris+17));
                $event->sheet->getPageSetup()->setFitToWidth(1);
                $event->sheet->getPageSetup()->setFitToHeight(0);

            },
        ];
    }
}