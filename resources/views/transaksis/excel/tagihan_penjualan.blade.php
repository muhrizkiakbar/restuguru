
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
        <tr><th>No </th><th>:</th><th colspan="7">Banjarbaru, Bulan Tahun</th></tr>
        <tr><th>Perihal</th><th>: PENAGIHAN</th></tr>
        <tr><th>Lampiran</th><th>: NOTA TAGIHAN</th></tr>
        <tr></tr>
        <tr><th>Kepada Yth.</th></tr>
        <tr><th><strong>{{$nama_pelanggan}}</strong></th></tr>
        <tr><th>di - Tempat</th></tr>
        <tr></tr>
        <tr></tr>
        <tr><th>Dengan Hormat,</th></tr>
        <tr><th colspan="9">Bersama ini kami sampaikan daftar pekerjaan yang telah kami kerjakan sebagai
bentuk penagihan kepada perusahaan anda dengan data sebagai berikut:</th></tr>
        <tr></tr>
        <tr>
            <th>Tanggal</th>
            <th>Item</th>
            <th style="word-wrap: break-word;">P</th>
            <th style="word-wrap: break-word;">L</th>
            <th style="word-wrap: break-word;">Bahan</th>
            <th style="word-wrap: break-word;">Harga/M2</th>
            <th style="word-wrap: break-word;">Harga Satuan</th>
            <th style="word-wrap: break-word;">Qty</th>
            <th width="180px" style="width: 170px;">Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subtransaksis as $subtransaksi)
        <tr>
            <td style="word-break: break-all;">{{$subtransaksi->kode_cabang}}.{{$subtransaksi->id}}<br>({{date("d-m-Y",strtotime($subtransaksi->tanggal))}})</td>
            <td style="word-break: break-all;">{{$subtransaksi->nama_produk}}</td>
            <td style="word-break: break-all;">{{$subtransaksi->panjang}}</td>
            <td style="word-break: break-all;">{{$subtransaksi->panjang}}</td>
            <td style="word-break: break-all;">{{$subtransaksi->nama_bahan}}</td>
            <td style="word-wrap: break-word;">{{$subtransaksi->harga_satuan}}</td>
            <td style="word-wrap: break-word;">{{$subtransaksi->harga_satuan_item}}</td>
            <td style="word-wrap: break-word;">{{$subtransaksi->banyak}}</td>
            <td style="width: 170px;">{{$subtransaksi->subtotal}}</td>
        </tr>
        @endforeach
       
        @if ($subtransaksis==null)
            <tr><td colspan="8">Jumlah</td><td>0</td></tr>
            <tr><td colspan="8">PPN</td><td>0</td></tr>
        @else
            <tr><td colspan="8">Jumlah</td><td>{{$subtransaksis->sum('subtotal')}}</td></tr>
            <tr><td colspan="8">PPN</td><td>{{$subtransaksis->sum('subtotal')*0.1}}</td></tr>
        @endif
        <tr></tr>
        <tr><td colspan="9">Pembayaran dapat dilakukan ke rekening dibawah : </td></tr>
        <tr><td colspan="9">REK. BANK MANDIRI BISNIS Atas nama CV. RESTU GURU PROMOSINDO </td></tr>
        <tr><td colspan="9">Rekening 031-00-1288777-7</td></tr>
        <tr><td colspan="9">Demikian yang dapat kami sampaikan, besar harapan kita untuk dapat bekerjasama. Atas perhatiannya
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
            <td colspan="2">Managing Director</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2">Putra Qomalludin A.N</td>
        </tr>
    </tbody>
</table>