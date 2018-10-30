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
                            <select class="form-control  pull-right" id="periode" name="periode" style="width: 100%;">
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
                      </form>  
                                 

                      
                    </div>
                  </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" id="submitpelanggan" class="btn btn-success btn-sm">Submit <i class="fa fa-chevron-circle-right"></i></button>
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
                                <th>No. Nota</th>
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
                            <tr id="{{$data->nomor_nota}}">
                                <td>#{{$data->nomor_nota}}</td>
                                <td>{{$data->nama_pelanggan}}</td>
                                <td>{{$data->hp_pelanggan}}</td>
                                <td>{{$data->tanggal}} {{date("H:i:s",strtotime($data->created_at))}}</td>
                                <td>Rp. {{number_format(floatval($data->jumlah_pembayaran),2,',','.')}}</td>
                                <td>{{$data->metode_pembayaran}}</td>
                                <td>{{number_format(floatval($data->diskon),2,',','.')}} %</td>
                                <td>Rp. {{number_format(floatval($data->pajak),2,',','.')}}</td>
                                @if ($data->sisa_tagihan!=0)
                                    <td><span class="badge bg-red">
                                    Rp. {{number_format(floatval($data->sisa_tagihan),2,',','.')}}
                                    </span></td>
                                @else
                                    <td>Rp. {{number_format(floatval($data->sisa_tagihan),2,',','.')}}</td>
                                @endif
                                <td>Rp. {{number_format(floatval($data->total_harga),2,',','.')}}</td>
                                <td style="width: 150px;min-width:140px;">
                                    <div class="btn-group">
                                        <button type="button" class="modal_show btn btn-primary btn-xs" data-toggle="modal" data-id="{{encrypt($data->nomor_nota)}}" data-total="Rp. {{ number_format(floatval($data->total_harga),2,',','.')}}" data-target="#modal_show"><i class="fa fa-eye"></i></button>
                                        <button type="button" class="modal_showangsuran btn btn-warning btn-xs" data-toggle="modal" data-id="{{encrypt($data->nomor_nota)}}" data-idsisa="sisa{{$data->nomor_nota}}" data-nonota="{{$data->nomor_nota}}" data-sisa="{{ $data->sisa_tagihan}}" data-target="#modal_showangsuran"><i class="fa fa-money"></i></button>                                        
                                        <!-- <button type="button" class="modal_edit btn btn-success btn-xs" data-id="{{encrypt($data->id)}}"><i class="fa fa-edit"></i></button> -->
                                        <button type="button" class="modal_delete btn btn-danger btn-xs" data-toggle="modal"  data-id="{{encrypt($data->nomor_nota)}}" data-target="#modal_delete"><i class="fa fa-trash"></i></button>
                                        <button type="button" class="buttonprint btn btn-info btn-xs" data-toggle="modal"  data-id="{{encrypt($data->nomor_nota)}}"><i class="fa fa-print"></i></button>
                                    </div>
                                </td>
                                <td>{{$data->Nama_Cabang}}</td> 
                                <td>{{$data->username}}</td>                                                               
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{$datas->appends(['nonota'=>($nonota),'namapelanggan'=>($namapelanggan),'pelanggan'=>($pelanggan),'pembayaran'=>$pembayaran,'tanggal'=>$tanggal,'periode'=>$periode])->links()}}
                    </ul>
                </div>
            </div>
          </div>

            <div class="modal fade " id="modal_show">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Subdetail Transaksi</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th style="width: 450px">Nama Barang</th>
                                        <th style="width: 130px">Harga Satuan</th>
                                        <th style="width: 60px">P</th>
                                        <th style="width: 60px">L</th>
                                        <th style="width: 60px">Kuantitas</th>
                                        <th style="width: 170px">Finishing</th>
                                        <th style="width: 170px">Keterangan</th>
                                        <th style="width: 60px">Diskon</th>
                                        <th  style="width: 130px">Subtotal</th>
                                    </thead>
                                    <tbody  id="showdata">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                            <div class="pull-right">
                                Total : <label id="totalshowmodal"></label>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade " id="modal_showangsuran">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Data Angsuran</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Nota Angsuran</th>
                                        <th>Tanggal</th>
                                        <th>Nominal Angsuran</th>
                                        <th>Pembayaran</th>
                                        <th>Nota Penjualan</th>
                                        <th>Cabang</th>
                                        <th>Pembuat</th>
                                        <th>Tool</th>                                        
                                    </thead>
                                    <tbody  id="showdata2">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                            <div class="pull-right">
                                Sisa : Rp. <label id="sisatagihanlabel"></label>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal modal-danger fade" id="modal_delete">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Hapus Transaksi</h4>
                        </div>
                        <div class="modal-body">
                            <form id="formdeleteuser" action="" method="post" role="form" enctype="multipart/form-data">
                                <h4>
                                    <i class="icon fa fa-ban"></i>
                                    Peringatan
                                </h4>
                                {{csrf_field()}}
                                Yakin ingin menghapus transaksi dengan nomor nota #<span class="labelnota"></span> a.n <span class="labelpelanggan"></span>?
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Keluar</button>
                            <button type="button" id="deleteitem" class="btn btn-outline">Simpan</button>
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

    <script src="http://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>

    <!-- bootstrap datepicker -->
    <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>


    <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>
    <!-- <script src="{{asset('bower_components/jquery-number/jquery.number.js')}}"></script> -->

    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script>
        var idtrans='';
        var idbaris='';

        function gotoreport(protocol,url,id){
            var url2 = protocol+'//'+url + '/transaksi/report/' + id;
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

        $('input[name="tanggal"]').datepicker({
            format: "dd-mm-yyyy",
        });

        
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

        $(document).on('click','.printbutton2',function () {
            id=$(this).data('id');
            gotoreport2(location.protocol,document.domain,id);
        });

        $(document).on('click','.modal_show',function () {
            $("#showdata").empty();
            idtrans=$(this).data('id');
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
                    $.each( response, function( key, value ) {
                        console.log(response[key]['penjualan_id']);
                        if (response[key]['keterangan']==null){
                            var keterangan="";
                        }
                        else
                        {
                            var keterangan=response[key]['keterangan'];
                        }
                        $("#showdata").append(
                            '<tr><td>'+response[key]['nama_produk']+'</td><td>'+response[key]['harga_satuan'].format(2, 3, '.', ',')+'</td><td>'+response[key]['panjang'].format(2, 3, '.', ',')+'</td><td>'+response[key]['lebar'].format(2, 3, '.', ',')+'</td><td>'+response[key]['banyak'].format(2, 3, '.', ',')+'</td><td>'+response[key]['finishing']+'</td><td style="width: 170px;word-break: break-all;">'+keterangan+'</td><td>'+response[key]['diskon'].format(2, 3, '.', ',')+'</td><td>'+response[key]['subtotal'].format(2, 3, '.', ',')+'</td></tr>'
                        );
                    });
                    // $('.labelnota').text(response.nonota);
                    // $('.labelpelanggan').text(response.nama_pelanggan);
                    // idbaris=response.nonota;
                },
            });          
            // alert($(this).data('namaproduk'));
            $('#totalshowmodal').text($(this).data('total'));
        });
        
        $(document).on('click','.modal_showangsuran',function () {
            $("#showdata2").empty();

            $("#sisatagihanlabel").text($(this).data('sisa').format(2, 3, '.', ','));
            idbaris=$(this).data('id');
            datanonota=$(this).data('nonota');
            datasisa=$(this).data('sisa');
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
                    $.each( response, function( key, value ) {
                        
                        $("#showdata2").append(
                            '<tr id="'+response[key]['id']+'"><td>#'+response[key]['id']+'</td><td>'+response[key]['tanggal_angsuran']+'</td><td>Rp. '+response[key]['nominal_angsuran'].format(2, 3, '.', ',')+'</td><td>'+response[key]['metode_pembayaran']+'</td><td><a href="/transaksi/report/'+response[key]['id2']+'" target="_blank">#'+response[key]['transaksipenjualan_id']+'</a></td><td>'+response[key]['Nama_Cabang']+'</td><td>'+response[key]['username']+'</td><td><div class="btn-group"><button type="button" class="printbutton2 btn btn-success btn-xs" data-toggle="modal"  data-id="'+response[key]['id3']+'" data-nominal="'+response[key]['nominal_angsuran'].format(2, 3, '.', ',')+'"><i class="fa fa-print"></i></button></div></td></tr>'
                        );
                    });
                    // $('.labelnota').text(response.nonota);
                    // $('.labelpelanggan').text(response.nama_pelanggan);
                    // idbaris=response.nonota;
                },
            });          
            // alert($(this).data('namaproduk'));
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
            $('#deleteitem').attr('disabled',true);
            var token=$('input[name="_token"]').val();
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'{{route('destroytransaksi')}}',
                data: JSON.stringify({id:idtrans,_token:token}),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                        // console.log(response['msg']);
                        if (response['msg']=="success"){
                            swal("Berhasil !", "Berhasil menghapus transaksi !", "success");
                            $('#'+idbaris+'').remove();
                            $('#modal_delete').modal('hide');
                        }
                        else{
                            swal("Error !", "Gagal menghapus transaksi !", "error");
                            $('#modal_delete').modal('hide');
                            
                        }
                },
                error:function(response){
                            swal("Error !", "Gagal menghapus transaksi !", "error");
                            $('#modal_delete').modal('hide');
                }
            });
            

        });

      // bagian modal delete
      
    </script>
    

    </body>
@endsection
