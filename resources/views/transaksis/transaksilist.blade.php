@extends('layouts.app')
@push('style')

    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">

  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- daterange picker -->
  <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/dark-hive/jquery-ui.css"> -->
  <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> -->
  <style>
    .ui-autocomplete {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    display: none;
    min-width: 160px;
    _width: 160px;
    padding: 4px 0;
    margin: 2px 0 0 0;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;

    .ui-menu-item {
        display: block;
        padding: 3px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;

        &.ui-state-focus, &.ui-state-active {
        color: #ffffff;
        text-decoration: none;
        background-color: #0088cc;
        border-radius: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        background-image: none;
        }
    }
    }

    .ui-helper-hidden-accessible { display:none; }
    tr.active>td{background-color: #e8e8e8;}
  </style>
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">

  <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
@endpush

@section('body')
    <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      @include('layouts.header')

      @include('layouts.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

          <!-- Main content -->
        <section class="content">
            <!-- form addrole         -->

        <div class="row">
          <!-- left column -->
          <form id="formtrans">
          <div class="col-md-3">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Cari Transaksi</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body">
                    <form action="{{route('transaksilist')}}" method="post">
                      <div class="form-group">
                        <input type="text" class="form-control" id="nonota" name="nonota" value="{{$nonota}}" placeholder="Nomor Nota">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="namapelanggan" name="namapelanggan" value="{{$namapelanggan}}" placeholder="Nama Pelanggan">
                      </div>

                      <div class="form-group">
                        <select id="pelanggan" name="pelanggan" class="form-control select2" style="width:100%;" type="text"></select>
                      </div>
                      <div class="form-group">
                            <select class="form-control " id="pembayaran" name="pembayaran" style="width: 100%;">

                                @if ($pembayaran=="semua")
                                    <option value="semua" selected>Semua Metode Pembayaran</option>
                                @else
                                    <option value="semua">Semua Metode Pembayaran</option>
                                @endif
                                @if ($pembayaran=="Cash")
                                    <option value="Cash" selected>Cash</option>
                                @else
                                    <option value="Cash">Cash</option>
                                @endif
                                @if ($pembayaran=="Transfer")
                                    <option value="Transfer" selected>Transfer</option>
                                @else
                                    <option value="Transfer">Transfer</option>
                                @endif

                            </select>
                        </label>
                      </div>

                      <div class="form-group">
                        <input type="text" class="form-control" id="tanggal" readonly name="tanggal" value="{{$date}}" placeholder="Tanggal">
                      </div>
                      <div class="form-group">
                            <select class="form-control" id="periode" name="periode" style="width: 100%;">
                                @if ($periode=="semua")
                                    <option value="semua" selected>Semua</option>
                                @else
                                    <option value="semua" >Semua</option>
                                @endif

                                @if ($periode=="hari")
                                    <option value="hari" selected>Hari</option>
                                @else
                                    <option value="hari" >Hari</option>
                                @endif

                                @if ($periode=="bulan")
                                    <option value="bulan" selected>Bulan</option>
                                @else
                                    <option value="bulan" >Bulan</option>
                                @endif

                                @if ($periode=="tahun")
                                    <option value="tahun" selected>Tahun</option>
                                @else
                                    <option value="tahun" >Tahun</option>
                                @endif
                            </select>
                      </div>

                      <div class="form-group">
                            <select class="form-control select2" id="produk" name="produk" style="width: 100%;">
                                
                                @if (decrypt($produk_request)=="semua")
                                    <option value="semua" selected>Semua</option>
                                @else
                                    <option value="semua" >Semua</option>
                                @endif

                                @foreach ($produks as $key => $produk)
                                    @if (decrypt($produk_request)==$produk->id)
                                        <option value="{{encrypt($produk->id)}}" selected>{{$produk->nama_produk}}</option>
                                    @else
                                        <option value="{{encrypt($produk->id)}}" >{{$produk->nama_produk}}</option>
                                    @endif
                                @endforeach
                            </select>
                      </div>
                      <div class="form-group">
                            @if ($sisa_tagihan=="sisa_tagihan") 
                                <input type="checkbox" class="flat-red checkbox" id="sisa_tagihan" checked name="sisa_tagihan" value="sisa_tagihan"> Filter Sisa Tagihan
                            @else
                                <input type="checkbox" class="flat-red checkbox" id="sisa_tagihan" name="sisa_tagihan" value="sisa_tagihan"> Filter Sisa Tagihan
                            @endif
                      </div>
                      </form>



                    </div>
                  </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                        <div class="form-group">
                            <button type="submit" id="submitpelanggan" name="submitpelanggan" value="cari" class="btn btn-primary btn-sm">Submit <i class="fa fa-chevron-circle-right"></i></button>
                            <button type="submit" id="submitpelanggan" name="submitpelanggan" value="export" class="btn btn-success btn-sm">Export <i class="fa fa-file-excel-o"></i></button>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submitpelanggan" name="submitpelanggan" value="tagihan" class="btn btn-warning btn-sm">Tagihan <i class="fa fa-file-excel-o"></i></button>
                            <button type="submit" id="submitpelanggan" name="submitpelanggan" value="export_detail" class="btn btn-success btn-sm">Full Export <i class="fa fa-file-excel-o"></i></button>
                        </div>
                </div>
            </div>
          </div>
          </form>

          <div class="col-md-9">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Transaksi Penjualan <i class="fa  fa-shopping-cart"></i></h3>
              </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th style='width: 71px'>No. Nota</th>
                                <th>Nama</th>
                                <th>Telp.</th>
                                <th>Tanggal</th>
                                <th>DP</th>
                                <th>Pembayaran</th>
                                <th>Diskon</th>
                                <th>Pajak</th>
                                <th>Sisa Tagihan</th>
                                <th>Total</th>
                                <th>Tool</th>
                                <th>Cabang</th>
                                <th>Pembuat</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($datas as $key=>$data)
                            <tr id="{{$data->id}}">
                                <td>#{{$data->id}}
                                @if ($data->sub_penjualans()->onlyTrashed()->count() != 0)
                                <span class="label label-success pull-left">edited</span>
                                @endif
                                </td>
                                <td>{{$data->nama_pelanggan}}</td>
                                <td>{{$data->hp_pelanggan}}</td>
                                <td>{{date("d-m-Y",strtotime($data->tanggal))}} {{date("H:i:s",strtotime($data->created_at))}}</td>
                                <td>Rp. {{number_format(floatval($data->jumlah_pembayaran),2,',','.')}}</td>
                                <td>{{$data->metode_pembayaran}}</td>
                                <td>{{number_format(floatval($data->diskon),2,',','.')}} %</td>
                                <td>{{number_format(floatval($data->pajak),2,',','.')}} %</td>
                                @if ($data->sisa_tagihan!=0)
                                    <td style="background: #ffff99;"><span class="badge bg-red" id="sisa{{$data->id}}">
                                    Rp. {{number_format(floatval($data->sisa_tagihan),2,',','.')}}
                                    </span></td>
                                @else
                                    <td style="background: #ffc2b3;" id="sisa{{$data->id}}">Rp. {{number_format(floatval($data->sisa_tagihan),2,',','.')}}</td>
                                @endif
                                <td style="background: #e6e6e6;" >Rp. {{number_format(floatval($data->total_harga),2,',','.')}}</td>
                                <td style="width: 150px;min-width:140px;">
                                    <div class="btn-group">
                                        <button type="button" class="detail_show btn btn-primary btn-xs" data-id="{{encrypt($data->id)}}" data-total="Rp. {{ number_format(floatval($data->total_harga),2,',','.')}}"><i class="fa fa-eye"></i></button>
                                        <button type="button" class="detail_showangsuran btn btn-warning btn-xs" data-id="{{encrypt($data->id)}}" data-idsisa="sisa{{$data->id}}" data-nonota="{{$data->id}}" data-sisa="{{ $data->sisa_tagihan}}"><i class="fa fa-money"></i></button>
                                        <a class="btn btn-success btn-xs" href="/transaksi/edit/{{encrypt($data->id)}}" ><i class="fa fa-edit"></i></a>
                                        <button type="button" class="modal_delete btn btn-danger btn-xs" data-toggle="modal"  data-id="{{encrypt($data->id)}}" data-target="#modal_delete" data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i></button>
                                        <button type="button" class="buttonprint btn btn-info btn-xs" data-toggle="modal"  data-id="{{encrypt($data->id)}}"><i class="fa fa-print"></i></button>
                                        <button type="button" class="buttonprintjpg btn btn-success btn-xs" data-toggle="modal"  data-id="{{encrypt($data->id)}}"><i class="fa fa-print"></i></button>
                                    </div>
                                </td>
                                <td>{{$data->Nama_Cabang}}</td>
                                <td>{{$data->username}}</td>
                            </tr>
                            @endforeach
                            <tr style="background: #d9d9d9;">
                                <td colspan="8" align="center"><strong>Total</strong></td>
                                <td>Rp. {{number_format(floatval($datas->sum('sisa_tagihan')),2,',','.')}}</td>
                                <td>Rp. {{number_format(floatval($datas->sum('total_harga')),2,',','.')}}</td>
                                <td colspan="3"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{$datas->appends(['nonota'=>($nonota),'namapelanggan'=>($namapelanggan),'pelanggan'=>($pelanggan),'pembayaran'=>$pembayaran,'tanggal'=>$tanggal,'periode'=>$periode,'sisa_tagihan'=>$sisa_tagihan,'produk'=>decrypt($produk_request)])->links()}}
                    </ul>
                </div>
            </div>
          </div>

            <div class="modal modal-danger fade" id="modal_delete">
                <div class="modal-dialog">
                    <div class="modal-content box">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Hapus Transaksi</h4>
                        </div>
                        <div class="modal-body box-body">
                            <form id="formdeleteuser" action="" method="post" role="form" enctype="multipart/form-data">
                                <h4>
                                    <i class="icon fa fa-ban"></i>
                                    Peringatan
                                </h4>
                                {{csrf_field()}}
                                Yakin ingin menghapus transaksi dengan nomor nota #<span class="labelnota"></span> a.n <span class="labelpelanggan"></span>?
                                <div class="form-group">
                                    <label class="text-white">Alasan</label>
                                    <textarea name="delete-reason" id="reason-transaksi" rows="3" class="form-control"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Keluar</button>
                            <button type="button" id="deleteitem" class="btn btn-outline">Simpan</button>
                        </div>
                        <div class="overlay" style="display: none">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal modal-danger fade" id="modal_delete_angsuran">
                    <div class="modal-dialog">
                        <div class="modal-content box">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Angsuran</h4>
                            </div>
                            <div class="modal-body">
                                <form id="formdeleteangsuran" action="" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus angsuran #<span class="labelnoangsuran"></span> ?
                                    <div class="form-group">
                                        <label class="text-white">Alasan</label>
                                        <textarea name="delete-reason" id="reason-angsuran" rows="3" class="form-control"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Keluar</button>
                                <button type="button" id="deleteangsuran" class="btn btn-outline">Simpan</button>
                            </div>
                            <div class="overlay" style="display: none">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
            </div>
        </div>

        </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- FastClick -->

    <script src="{{asset('bower_components/jquery-ui/jquery-ui-new.js')}}"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>

    <!-- bootstrap datepicker -->
    <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>


    <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>
    <!-- <script src="{{asset('bower_components/jquery-number/jquery.number.js')}}"></script> -->

    <!-- sweet alert -->
    <script src="{{asset('bower_components/sweetalert/sweetalert.min.js')}}"></script>

    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script>
        var idtrans='';
        var idbaris='';
        var idsisa='';
        var idtombol='';

        var nominalangsuran=0;
        var arrayidtrans=[];

        var dataid=0;
        var datasisa=0;
        var datanonota=0;
        var datatotal=0;
        var datanominal=0;
        var datapembayaran=0;

        function gotoreport(protocol,url,id){
            var url2 = protocol+'//'+url + '/transaksi/report/' + id;
            window.open(url2, '_blank');
        }

        function gotoreportjpg(protocol,url,id){
            var url2 = protocol+'//'+url + '/transaksi/report_to_image/' + id;
            window.open(url2, '_blank');
        }

        function gotoreport2(protocol,url,id){
            var url2 = protocol+'//'+url + '/transaksi/angsuran/report/detail/' + id;
            window.open(url2, '_blank');
        }

        Number.prototype.format = function(n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));

            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };

      $(function(){

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })

        $('input[name="tanggal"]').datepicker({
            format: "dd-mm-yyyy",
        });

        $('#produk').select2()
        $('#pelanggan').select2({
            placeholder: "Pilih Pelanggan.",
            minimumInputLength: 1,
            ajax: {
                url: '{{route('pelanggancari')}}',
                dataType: 'json',
                data: function (params)
                {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data)
                {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

      });


    //   bagian form

        $('#pelanggan').on('select2:select', function (e) {

            var id=e.params.data.id;
            $.ajax({
                async: true,
                type:'get',
                url:'{{route('pelanggandetail')}}',
                data: 'id='+id,
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                     $('#namapelanggan').val(response.nama_perusahaan);
                     $('#nomorhandphone').val(response.telpon_pelanggan);
                },
            });
        });

      //bagian modal delete
        $(document).on('click','.modal_edit',function () {
            idtrans=$(this).data('id');
            var url = window.location.pathname + '/edit/' + idtrans;
            window.location.href = url;
        });

        $(document).on('click','.buttonprint',function () {
            id=$(this).data('id');
            gotoreport(location.protocol,document.domain,id);
        });

        $(document).on('click','.buttonprintjpg',function () {
            id=$(this).data('id');
            gotoreportjpg(location.protocol,document.domain,id);
        });

        $(document).on('click','.printbutton2',function () {
            id=$(this).data('id');
            gotoreport2(location.protocol,document.domain,id);
        });

        $(document).on('click','.detail_show',function () {
            idtrans=$(this).data('id');
            rowselected = $(this).parent().parent().parent();
            colsize = $(this).parent().parent().parent().find('td').length;
            if ($(rowselected).next().hasClass('detail_click item')) {
                $('.detail_click').remove();
                $(rowselected).parent('tbody').find('td').css('border','');
                $(rowselected).removeClass('active');
            } else {
                $('.detail_click').remove();
                $(rowselected).parent('tbody').find('td').css('border','');
                $(rowselected).parent('tbody').find('tr.active').removeClass('active');
                $.ajax({
                    async: true,
                    type:'get',
                    url:'{{route('showsubtransaksi')}}',
                    data: 'id='+idtrans,
                    dataType:'json',
                    async:false,
                    processData: false,
                    contentType: false,
                    success:function(response){
                        console.log( response );
                        $(rowselected).after(function() {
                            return "\
                                <tr class='detail_click item'>\
                                    <td colspan="+colsize+" style='margin: 0; padding: 0 0 12px;background: #fcfcfc'>\
                                        <table class='table table-hover table-detail' style='background:#fcfcfc; margin-bottom: 0'>\
                                            <thead>\
                                                <tr style='background-color:#00a65a'>\
                                                    <th colspan='9' class='text-center'>\
                                                        Produk Dibeli\
                                                    </th>\
                                                </tr>\
                                            </thead>\
                                            <thead>\
                                                <th style='width: 450px'>Nama Barang</th>\
                                                <th style='width: 130px'>Harga Satuan</th>\
                                                <th style='width: 60px'>P</th>\
                                                <th style='width: 60px'>L</th>\
                                                <th style='width: 60px'>Kuantitas</th>\
                                                <th style='width: 170px'>Finishing</th>\
                                                <th style='width: 170px'>Keterangan</th>\
                                                <th style='width: 60px'>Diskon</th>\
                                                <th style='width: 130px;text-align:right'>Subtotal</th>\
                                            </thead>\
                                            <tbody id='showdata'>\
                                            </tbody>\
                                            <thead>\
                                                <tr style='background-color:#dd4b39'>\
                                                    <th colspan='9' class='text-center'>\
                                                        Produk Sebelumnya\
                                                    </th>\
                                                </tr>\
                                            </thead>\
                                            <thead>\
                                                <th style='width: 450px'>Nama Barang</th>\
                                                <th style='width: 130px'>Harga Satuan</th>\
                                                <th style='width: 60px'>P</th>\
                                                <th style='width: 60px'>L</th>\
                                                <th style='width: 60px'>Kuantitas</th>\
                                                <th style='width: 170px'>Finishing</th>\
                                                <th style='width: 170px'>Keterangan</th>\
                                                <th style='width: 60px'>Diskon</th>\
                                                <th style='width: 130px;text-align:right'>Subtotal</th>\
                                            </thead>\
                                            <tbody id='last-product'>\
                                            </tbody>\
                                        </table>\
                                    </td>\
                                </tr>";
                        });
                        $(rowselected).addClass('active');
                        $('.detail_click.item').find('td').first().css('border-left','1px solid #3c8dbc');
                        $('.detail_click.item').find('td').last().css('border-right','1px solid #3c8dbc');
                        $('.detail_click.item').find('td').last().css('border-bottom','1px solid #3c8dbc');
                        $('.detail_click.item').next().find('td').first().css('border-left','1px solid #3c8dbc');
                        $('.detail_click.item').next().find('td').last().css('border-right','1px solid #3c8dbc');
                        $.each( response, function( key, value ) {
                            // console.log(response[key]['penjualan_id']);
                            if (response[key]['keterangan']==null){
                                var keterangan="";
                            }
                            else
                            {
                                var keterangan=response[key]['keterangan'];
                            }
                            $("#showdata").append(
                                '<tr><td>'+response[key]['nama_produk']+'</td><td>'+response[key]['harga_satuan'].format(2, 3, '.', ',')+'</td><td>'+response[key]['panjang'].format(2, 3, '.', ',')+'</td><td>'+response[key]['lebar'].format(2, 3, '.', ',')+'</td><td>'+response[key]['banyak'].format(2, 3, '.', ',')+'</td><td>'+response[key]['finishing']+'</td><td style="width: 170px;word-break: break-all;">'+keterangan+'</td><td>'+response[key]['diskon'].format(2, 3, '.', ',')+'</td><td style="text-align:right">'+response[key]['subtotal'].format(2, 3, '.', ',')+'</td></tr>'
                            );
                        });
                        $("#showdata").append("<tr>\
                            <th colspan='8' class='text-right'>Total : </th>\
                            <th id='totalshowmodal' class='text-right'></th>\
                        </tr>");
                        $('.labelnota').text(response.nonota);
                        $('.labelpelanggan').text(response.nama_pelanggan);
                        idbaris=response.nonota;
                    },
                });
                // alert($(this).data('namaproduk'));
                $('#totalshowmodal').text($(this).data('total'));
            }
        });

        $(document).on('click','.detail_showangsuran',function () {
            sisatagihan = $(this).data('sisa').format(0, 3, '.', ',');
            idbaris=$(this).data('id');
            datanonota=$(this).data('nonota');
            datasisa=$(this).data('sisa');
            datapembayaran=$(this).data('pembayaran');
            rowselected = $(this).parent().parent().parent();
            colsize = $(this).parent().parent().parent().find('td').length;
            // console.log(rowselected)

            if ($(rowselected).next().hasClass('detail_click angsuran')) {
                $('.detail_click').remove();
                $(rowselected).parent('tbody').find('td').css('border','');
            } else {
                $('.detail_click').remove();
                $(rowselected).parent('tbody').find('td').css('border','');
                $.ajax({
                    async: true,
                    type:'get',
                    url:'{{route('showangsuranpenjualan')}}',
                    data: 'id='+idbaris,
                    dataType:'json',
                    async:false,
                    processData: false,
                    contentType: false,
                    success:function(response){
                        console.log( response );
                        $(rowselected).after(function() {
                            return "\
                                <tr class='detail_click angsuran'>\
                                    <td colspan="+colsize+" style='margin: 0; padding: 0 0 12px;background: #fcfcfc'>\
                                        <table class='table table-hover' style='background:#fcfcfc'>\
                                            <thead>\
                                                <th>Nota Angsuran</th>\
                                                <th>Tanggal</th>\
                                                <th>Nominal Angsuran</th>\
                                                <th>Pembayaran</th>\
                                                <th>Nota Penjualan</th>\
                                                <th>Cabang</th>\
                                                <th>Pembuat</th>\
                                                <th style='text-align:right'>Tool</th>\
                                            </thead>\
                                            <tbody  id='showdata2'>\
                                            </tbody>\
                                        </table>\
                                        <div class='pull-right' style='padding: 8px;'>\
                                            Sisa : Rp. <label id='sisatagihanlabel'>"+sisatagihan+"</label>\
                                        </div>\
                                    </td>\
                                </tr>";
                        });
                        $(rowselected).find('td').first().css('border-left','1px solid #00a65a');
                        $(rowselected).find('td').last().css('border-right','1px solid #00a65a');
                        $(rowselected).next().find('td').first().css('border-left','1px solid #00a65a');
                        $(rowselected).next().find('td').last().css('border-right','1px solid #00a65a');
                        $.each( response, function( key, value ) {

                            $("#showdata2").append(
                                '<tr id="show'+response[key]['id']+'"><td>#'+response[key]['id']+'</td><td>'+response[key]['tanggal_angsuran']+'</td><td>Rp. '+response[key]['nominal_angsuran'].format(2, 3, '.', ',')+'</td><td>'+response[key]['metode_pembayaran']+'</td><td><a href="/transaksi/report/'+response[key]['id2']+'" target="_blank">#'+response[key]['transaksipenjualan_id']+'</a></td><td>'+response[key]['Nama_Cabang']+'</td><td>'+response[key]['username']+'</td><td style="text-align:right"><div class="btn-group"><button type="button" class="deletebutton btn btn-danger btn-xs" data-toggle="modal"  data-id="'+response[key]['id']+'" data-target="#modal_delete_angsuran" data-nominal="'+response[key]['nominal_angsuran']+'" data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i></button><button type="button" class="printbutton2 btn btn-success btn-xs" data-toggle="modal"  data-id="'+response[key]['id3']+'" data-nominal="'+response[key]['nominal_angsuran'].format(2, 3, '.', ',')+' "><i class="fa fa-print"></i></button></div></td></tr>'
                            );
                        });
                        // $('.labelnota').text(response.nonota);
                        // $('.labelpelanggan').text(response.nama_pelanggan);
                        // idbaris=response.nonota;
                    },
                });
                // alert($(this).data('namaproduk'));
            }
        });

        $(document).on('click','.modal_delete',function () {
            $('#deleteitem').removeAttr('disabled');
            idtrans=$(this).data('id');
            $.ajax({
                async: true,
                type:'get',
                url:'{{route('datatransaksispesific')}}',
                data: 'id='+idtrans,
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    $('.labelnota').text(response.nonota);
                    $('.labelpelanggan').text(response.nama_pelanggan);
                    idbaris=response.nonota;
                },
            });
            // alert($(this).data('namaproduk'));

        });

        $(document).on('click','#deleteitem',function (){
            var token=$('input[name="_token"]').val();
            var reason = $('#reason-transaksi').val();
            if (reason != '') {
                
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'{{route('destroytransaksi')}}',
                    data: JSON.stringify(
                        {
                            id:idtrans,
                            _token:token,
                            reason_on_delete: reason
                        }
                    ),
                    beforeSend: function() {
                        $('#modal_delete.in > .modal-dialog > .modal-content.box > .overlay').css('display', 'block');
                    },
                    complete: function() { 
                        $('#modal_delete.in > .modal-dialog > .modal-content.box > .overlay').css('display', 'none');
                    },
                    dataType:'json',
                    async:true,
                    processData: false,
                    contentType: false,
                    success:function(response){
                            // console.log(response['msg']);
                            if (response['msg']=="success"){
                                swal("Berhasil !", "Berhasil menghapus transaksi !", "success");
                                $('#deleteitem').attr('disabled',true);
                                $('#'+idbaris+'').remove();
                                $('#modal_delete').modal('hide');
                            }
                            else if (response['msg']=="failed") {
                                swal("Error !", "Gagal menghapus transaksi !", "error");
                                $('#modal_delete').modal('hide');
                            }
                            else
                            {
                                swal("Gagal !",response['msg'], "error");
                                $('#modal_delete').modal('hide');
                            }
                    },
                    error:function(response){
                                swal("Error !", "Gagal menghapus transaksi !", "error");
                                $('#modal_delete').modal('hide');
                    }
                });
            } else {
                swal("Error !", "Alasan Wajib diisi !", "error");
            }


        });

        $('#modal_delete').on('hide.bs.modal', function() {
            $('#reason-transaksi').val('');
            $('#modal_delete > .modal-dialog > .modal-content.box > .overlay').css('display', 'none');
        })

        // modal delete angsuran
        $(document).on('click','.deletebutton',function () {
            idtrans=$(this).data('id');
            $(".labelnoangsuran").text($(this).data('id'));
            datanominal=$(this).data('nominal');
        });

        $(document).on('click','#deleteangsuran',function (){
            var token=$('input[name="_token"]').val();
            var sisatagihan=datasisa+datanominal;
            datapembayaran=datapembayaran-datanominal;
            console.log(sisatagihan+'='+datasisa+'+'+datanominal)
            var sisapembayaran=datapembayaran;
            var reason = $('#reason-angsuran').val();
            if (reason != '') {
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'{{route('destroyangsuran')}}',
                    data: JSON.stringify(
                        {
                            idtrans:idtrans,
                            _token:token,
                            reason_on_delete: reason
                        }
                    ),
                    dataType:'json',
                    async:true,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#modal_delete_angsuran.in > .modal-dialog > .modal-content.box > .overlay').css('display', 'block');
                    },
                    complete: function() { 
                        $('#modal_delete_angsuran.in > .modal-dialog > .modal-content.box > .overlay').css('display', 'none');
                    },
                    success:function(response){
                            // console.log(response['msg']);
                            if (response['msg']=="success"){
                                swal("Berhasil !", "Berhasil menghapus angsuran !", "success");
                                $('#show'+idtrans+'').remove();
                                $('#sisatagihanlabel').text(sisatagihan.format(0, 3, '.', ','));
                                datasisa=sisatagihan;
                                // console.log(sisapembayaran)
                                $('#sisa'+datanonota).html('<span class="badge bg-red">Rp. '+sisatagihan.format(0, 3,'.',',')+'</span>');
                                $('#pembayaran'+datanonota).html('Rp. '+sisapembayaran.format(0, 3, '.', ','));
                                $('#showtombol'+datanonota).data('sisa',datasisa);
                                $('#simpantombol'+datanonota).data('sisa',datasisa);
                                $('#showtombol'+datanonota).data('pembayaran',sisapembayaran);
                                $('#simpantombol'+datanonota).data('pembayaran',sisapembayaran);
                                // datasisa=0;
                                $('#modal_delete_angsuran').modal('hide');
                            }
                            else{
                                // datasisa=0;
                                console.log('succes' + response);
                                swal("Error !", "Gagal menghapus angsuran !", "error");
                                $('#modal_delete_angsuran').modal('hide');

                            }
                    },
                    error:function(response){
                                console.log('error');
                                swal("Error !", "Gagal menghapus angsuran !", "error");
                                $('#modal_delete_angsuran').modal('hide');
                    }
                });
            } else {
                swal("Error !", "Alasan Wajib diisi !", "error");
            }


        });

        $('#modal_delete_angsuran').on('hide.bs.modal', function() {
            $('#reason-angsuran').val('');
            $('#modal_delete_angsuran > .modal-dialog > .modal-content.box > .overlay').css('display', 'none');
        })
    </script>


    </body>
@endsection
