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
    <body class="hold-transition skin-red sidebar-mini">
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
          
          <div class="col-md-12">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Jatuh Tempo <i class="fa  fa-exclamation-circle"></i></h3>
              </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Nama Perusahaan</th>
                                <th>No. Telp</th>
                                <th>Alamat</th>
                                <th>Total Belanja</th>
                                <th>Sisa Tagihan</th>
                                <th>Limit Tagihan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($datas as $key=>$data)
                            <tr>
                                <td>{{$data['nama_perusahaan']}}</td>
                                <td>{{$data['hp_pelanggan']}}</td>
                                <td>{{$data['alamat_pelanggan']}}</td>
                                <td>Rp. {{number_format(floatval($data['total_harga']),2,',','.')}}</td>
                                <td>Rp. {{number_format(floatval($data['sisa_tagihan2']),2,',','.')}}</td>
                                <td>Rp. {{number_format(floatval($data['limit_pelanggan']),2,',','.')}}</td>
                                                                                               
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{$datas->links()}}
                    </ul>
                </div>
            </div>
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
                            '<tr><td>'+response[key]['nama_produk']+'</td><td>'+response[key]['harga_satuan']+'</td><td>'+response[key]['panjang']+'</td><td>'+response[key]['lebar']+'</td><td>'+response[key]['banyak']+'</td><td>'+response[key]['finishing']+'</td><td style="width: 170px;word-break: break-all;">'+keterangan+'</td><td>'+response[key]['diskon']+'</td><td>'+response[key]['subtotal']+'</td></tr>'
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
                            '<tr id="'+response[key]['id']+'"><td>#'+response[key]['id']+'</td><td>'+response[key]['tanggal_angsuran']+'</td><td>Rp. '+response[key]['nominal_angsuran'].format(2, 3, '.', ',')+'</td><td>'+response[key]['metode_pembayaran']+'</td><td><a href="/transaksi/report/'+response[key]['id2']+'" target="_blank">#'+response[key]['transaksipenjualan_id']+'</a></td><td>'+response[key]['Nama_Cabang']+'</td><td>'+response[key]['username']+'</td><td><div class="btn-group"><button type="button" class="printbutton2 btn btn-success btn-xs" data-toggle="modal"  data-id="'+response[key]['id2']+'" data-nominal="'+response[key]['nominal_angsuran']+'"><i class="fa fa-print"></i></button></div></td></tr>'
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
