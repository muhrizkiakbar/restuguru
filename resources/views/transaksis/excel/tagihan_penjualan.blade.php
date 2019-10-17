
<table>
    <thead>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <?php
            function dateIndonesia($date){
                if($date != '0000 00 00'){
                    $date = explode(' ', $date);
         
                    $data = $date[2] . ' ' . bulan($date[1]) . ' '. $date[0];
                }else{
                    $data = 'Format tanggal salah';
                }
         
                return $data;
            }
         
            function bulan($bln) {
                $bulan = $bln;
         
                switch ($bulan) {
                    case 1:
                        $bulan = "Januari";
                        break;
                    case 2:
                        $bulan = "Februari";
                        break;
                    case 3:
                        $bulan = "Maret";
                        break;
                    case 4:
                        $bulan = "April";
                        break;
                    case 5:
                        $bulan = "Mei";
                        break;
                    case 6:
                        $bulan = "Juni";
                        break;
                    case 7:
                        $bulan = "Juli";
                        break;
                    case 8:
                        $bulan = "Agustus";
                        break;
                    case 9:
                        $bulan = "September";
                        break;
                    case 10:
                        $bulan = "Oktober";
                        break;
                    case 11:
                        $bulan = "November";
                        break;
                    case 12:
                        $bulan = "Desember";
                        break;
                }
                return $bulan;
            }
        ?>
        <tr><th>No </th><th>:</th><th colspan="8">Banjarbaru, {{dateIndonesia(date("Y m d"))}}</th></tr>
        <tr><th>Perihal</th><th>: PENAGIHAN</th></tr>
        <tr><th>Lampiran</th><th>: NOTA TAGIHAN</th></tr>
        <tr></tr>
        <tr><th>Kepada Yth.</th></tr>
        <tr><th><strong>{{$nama_pelanggan}}</strong></th></tr>
        <tr><th>di - Tempat</th></tr>
        <tr></tr>
        <tr></tr>
        <tr><th>Dengan Hormat,</th></tr>
        <tr><th colspan="10">Bersama ini kami sampaikan daftar pekerjaan yang telah kami kerjakan sebagai
bentuk penagihan kepada perusahaan anda dengan data sebagai berikut:</th></tr>
        <tr></tr>
        
    </thead>
    <tbody>
        @foreach ($transaksis as $transaksi)
        <tr>
            <th>No. Nota</th>
            <th colspan="7">Tanggal</th>
            <th>Sisa Tagihan</th>
            <th>Total</th>
        </tr>
        <tr>
            <td style="word-break: break-all;">{{$transaksi->kode_cabang}}.{{$transaksi->id}}<br></td>
            <td style="word-break: break-all;" colspan="7">{{date("d-m-Y",strtotime($transaksi->tanggal))}}</td>
            <td>{{$transaksi->sisa_tagihan}}</td>
            <td>{{$transaksi->total_harga}}</td>
        </tr>
        <tr>
            <th>Item</th>
            <th>P</th>
            <th>L</th>
            <th style="word-wrap: break-word;">Finishing</th>
            <th style="word-wrap: break-word;">Harga/M2</th>
            <th style="word-wrap: break-word;">Harga Satuan</th>
            <th style="word-wrap: break-word;">Qty</th>
            <th width="180px" style="width: 170px;">Jumlah</th>
            <th style="word-wrap: break-word;" colspan="2">Keterangan</th>
        </tr>
            @foreach ($transaksi->sub_penjualans as $subtransaksi)
                <tr>
                    <td style="word-break: break-all;">{{$subtransaksi->produk->nama_produk}}</td>
                    <td style="word-break: break-all;">{{$subtransaksi->panjang}}</td>
                    <td style="word-break: break-all;">{{$subtransaksi->lebar}}</td>
                    <td style="word-break: break-all;">{{$subtransaksi->finishing}}</td>
                    <td style="word-wrap: break-word;">{{$subtransaksi->harga_satuan}}</td>
                    <td style="word-wrap: break-word;">{{$subtransaksi->subtotal/$subtransaksi->banyak}}</td>
                    <td style="word-wrap: break-word;">{{$subtransaksi->banyak}}</td>
                    <td style="width: 170px;">{{$subtransaksi->subtotal}}</td>

                    <td style="word-wrap: break-word;" colspan="2">{{$subtransaksi->keterangan}}</td>
                </tr> 
            @endforeach
        @endforeach
       
        @if ($transaksis==null)
            <tr><td colspan="9">Sisa Tagihan</td><td>0</td></tr>
            <tr><td colspan="9">PPN</td><td>0</td></tr>
            <tr><td colspan="9">Total</td><td>0</td></tr>
        @else
            <tr><td colspan="9">Sisa Tagihan</td><td>{{$transaksis->sum('sisa_tagihan')}}</td></tr>
            <tr><td colspan="9">PPN</td><td>{{$transaksis->sum('sisa_tagihan')*0.1}}</td></tr>
            <tr><td colspan="9">Total</td><td>{{$transaksis->sum('total_harga')}}</td></tr>
        @endif
        <tr></tr>
        <tr><td colspan="10">Pembayaran dapat dilakukan ke rekening dibawah : </td></tr>
        <tr><td colspan="10">REK. BANK MANDIRI BISNIS Atas nama CV. RESTU GURU PROMOSINDO </td></tr>
        <tr><td colspan="10">Rekening 031-00-1288777-7</td></tr>
        <tr><td colspan="10">Demikian yang dapat kami sampaikan, besar harapan kita untuk dapat bekerjasama. Atas perhatiannya
kami mengucapkan terima kasih.</td></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2">Hormat kami,</td>
        </tr>

        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2">Manager</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2">Beti Sulistilawati</td>
        </tr>
    </tbody>
</table>