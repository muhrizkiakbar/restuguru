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
            $this->baris=$baris+21;
            // dd($this->baris);
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
                                        ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                        ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                        ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                        ->select(
                                            // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                            'Transaksi_Penjualans.id',
                                            'Cabangs.kode_cabang',
                                            'Transaksi_Penjualans.tanggal',
                                            'Produks.nama_produk',
                                            'Sub_Tpenjualans.panjang',
                                            'Sub_Tpenjualans.lebar',
                                            'Bahanbakus.nama_bahan',
                                            'Sub_Tpenjualans.harga_satuan',
                                            DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                            'Sub_Tpenjualans.banyak',
                                            'Sub_Tpenjualans.subtotal'
                                            )
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                        ->whereDay('Transaksi_Penjualans.tanggal','=',$this->tanggal)
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)
                                        ->orderBy('Transaksi_Penjualans.created_at','desc');
        }
        elseif ($this->periode=="semua"){


            $datas=CTransaksi_Penjualans::leftJoin('Pelanggans','Transaksi_Penjualans.pelanggan_id','=','Pelanggans.id')
                                        ->leftJoin('Users','Transaksi_Penjualans.user_id','=','Users.id')
                                        ->leftJoin('Cabangs','Transaksi_Penjualans.cabang_id','=','Cabangs.id')
                                        ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                        ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                        ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                        ->select(
                                             // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                             'Transaksi_Penjualans.id',
                                            'Cabangs.kode_cabang', 
                                            'Transaksi_Penjualans.tanggal',
                                            'Produks.nama_produk',
                                            'Sub_Tpenjualans.panjang',
                                            'Sub_Tpenjualans.lebar',
                                            'Bahanbakus.nama_bahan',
                                            'Sub_Tpenjualans.harga_satuan',
                                            DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                            'Sub_Tpenjualans.banyak',
                                            'Sub_Tpenjualans.subtotal'
                                            )
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
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
                                        ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                        ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                        ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                        ->select(
                                             // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                             'Transaksi_Penjualans.id',
                                            'Cabangs.kode_cabang', 
                                             'Transaksi_Penjualans.tanggal',
                                            'Produks.nama_produk',
                                            'Sub_Tpenjualans.panjang',
                                            'Sub_Tpenjualans.lebar',
                                            'Bahanbakus.nama_bahan',
                                            'Sub_Tpenjualans.harga_satuan',
                                            DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                            'Sub_Tpenjualans.banyak',
                                            'Sub_Tpenjualans.subtotal'
                                            )
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereMonth('Transaksi_Penjualans.tanggal','=',$bulan)
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)                                        
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
                                        ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                        ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                        ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                        ->select(
                                           // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                           'Transaksi_Penjualans.id',
                                            'Cabangs.kode_cabang', 
                                           'Transaksi_Penjualans.tanggal',
                                          'Produks.nama_produk',
                                          'Sub_Tpenjualans.panjang',
                                          'Sub_Tpenjualans.lebar',
                                          'Bahanbakus.nama_bahan',
                                          'Sub_Tpenjualans.harga_satuan',
                                          DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                          'Sub_Tpenjualans.banyak',
                                          'Sub_Tpenjualans.subtotal'
                                          )
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)
                                        ->where('Transaksi_Penjualans.id','like','%'.$this->nonota.'%')
                                        ->where('Transaksi_Penjualans.nama_pelanggan','like','%'.$this->namapelanggan.'%')
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
                                        ->where('Transaksi_Penjualans.metode_pembayaran','like','%'.$pembayaran.'%')
                                        ->whereYear('Transaksi_Penjualans.tanggal','=',$tahun)        
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
                                        ->leftJoin('Sub_Tpenjualans','Transaksi_Penjualans.id','Sub_Tpenjualans.penjualan_id')
                                        ->leftJoin('Produks','Produks.id','=','Sub_Tpenjualans.produk_id')
                                        ->leftJoin('Produkbahanbakus','Produkbahanbakus.produk_id','=','Produks.id')
                                        ->leftJoin('Bahanbakus','Bahanbakus.id','=','Produkbahanbakus.bahanbaku_id')
                                        ->select(
                                             // DB::raw("concat'Transaksi_Penjualans.id,' ''Transaksi_Penjualans.tanggal) as tanggal"),
                                             'Transaksi_Penjualans.id',
                                            'Cabangs.kode_cabang', 
                                             'Transaksi_Penjualans.tanggal',
                                            'Produks.nama_produk',
                                            'Sub_Tpenjualans.panjang',
                                            'Sub_Tpenjualans.lebar',
                                            'Bahanbakus.nama_bahan',
                                            'Sub_Tpenjualans.harga_satuan',
                                            DB::raw("(Sub_Tpenjualans.subtotal/Sub_Tpenjualans.banyak) as harga_satuan_item"),
                                            'Sub_Tpenjualans.banyak',
                                            'Sub_Tpenjualans.subtotal'
                                            )
                                        ->where('Transaksi_Penjualans.cabang_id','=',Auth::user()->cabangs->id)           
                                        ->where('Transaksi_Penjualans.sisa_tagihan','>',0)
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

            $datas=$datas->where('Sub_Tpenjualans.produk_id','=',$request_produk);
        }
        // dd($datas->get());

        // return $datas->get();
        return view('transaksis.excel.tagihan_penjualan', [
            'subtransaksis' => $datas->get(),
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
        $drawing->setHeight(171.4);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(13);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(18);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(6);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(6);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(12);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(12);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(12);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(8);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(13);
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
                $event->sheet->getDelegate()->getRowDimension($baris+5)->setRowHeight(35);
                $event->sheet->getStyle('A'.($baris+5))->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A'.($baris+4))->applyFromArray($boldtextArray); //styling font
                $event->sheet->getStyle('A'.($baris+3))->applyFromArray($boldtextArray); //styling font

                

                

                if ($this->baris==0)
                {
                    $baris=21; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                $event->sheet->getStyle('A21:I'.$baris)->applyFromArray($styleArray); //styling border isi data
                if ($this->baris==0)
                {
                    $baris=36; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                $event->sheet->getStyle('A2:I'.$baris)->applyFromArray($styleGlobalArray); //styling font

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
                $event->sheet->getStyle('A21:I'.$baris)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A21:I'.$baris)->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('C9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

                if ($this->baris==0)
                {
                    $baris=29; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                $event->sheet->getStyle('H'.$baris)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


                if ($this->baris==0)
                {
                    $baris=33; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                $event->sheet->getStyle('H'.$baris)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('H'.($baris+1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                //set format currency
                if ($this->baris==0)
                {
                    $baris=22; 
                }
                else
                {
                    $baris=$this->baris; 
                }
                $event->sheet->getStyle('F22:F'.$baris)->getNumberFormat()->setFormatCode('_("Rp"* #,##0_);_("Rp"* \(#,##0\);_("Rp"* "-"??_);_(@_)');
                $event->sheet->getStyle('G22:G'.$baris)->getNumberFormat()->setFormatCode('_("Rp"* #,##0_);_("Rp"* \(#,##0\);_("Rp"* "-"??_);_(@_)');
                $event->sheet->getStyle('I22:I'.$baris)->getNumberFormat()->setFormatCode('_("Rp"* #,##0_);_("Rp"* \(#,##0\);_("Rp"* "-"??_);_(@_)');

                $event->sheet->getPageSetup()->setPrintArea('A1:I'.($baris+15));
                $event->sheet->getPageSetup()->setFitToWidth(1);

            },
        ];
    }
}