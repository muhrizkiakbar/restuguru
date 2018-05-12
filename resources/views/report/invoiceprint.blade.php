@extends('layouts.app')
@push('style')


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
	.status
	{
		position:absolute;
		top: 270px;
		left: 250px;
        width: 300px;
        height: 70px;
		z-index: 2;
        opacity: 0.5;
        transform: rotate(340deg);
	}
    .logorg
	{

        width: 45px;
        height: 40px;
		z-index: 2;
	}
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
    <body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                <img src="{{asset('dist/img/rg.png')}}" class="logorg"> <strong>RESTU GURU PROMOSINDO</strong> Cab. Banjarmasin
                <small class="pull-right"> </small>
                </h2>
            </div>
            <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                Dari
                <address>
                <strong>Admin</strong><br>
                Level<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Kepada
                <address>
                <strong>Akbar Rahardian</strong><br>
                0811513044 (Member)
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>No. #007612</b><br>
                <b>Order ID:</b> di transaksi<br>
                <b>Waktu:</b> 20:00:00 20/10/2014
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <img src="{{asset('dist/img/brush_lunas.png')}}" class="status">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <th style="word-wrap: break-word;">Produk</th>
                        <th style="word-wrap: break-word;">Harga</th>
                        <th style="word-wrap: break-word;">P</th>
                        <th style="word-wrap: break-word;">L</th>
                        <th style="word-wrap: break-word;">Kuantitas</th>
                        <th style="word-wrap: break-word;">Finishing</th>
                        <th style="word-wrap: break-word;">Keterangan</th>
                        <th style="word-wrap: break-word;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="word-break: break-all;">Flexy 280</td>
                        <td style="word-wrap: break-word;">Rp. 100.000</td>
                        <td style="word-wrap: break-word;">100</td>
                        <td style="word-wrap: break-word;">100</td>
                        <td style="word-wrap: break-word;">1</td>
                        <td style="word-wrap: break-word;">mata ayam</td>
                        <td style="width: 20%;word-break: break-all;">aasdasdasdasdadsasdasdasdasdasdasdasdasdasdasdasdasdasdasdasaddaaasdasdasdasdadsasdasdasdasdasdasdasdasdasdasdasdasdasdasdasadda</td>
                        <td style="word-wrap: break-word;">Rp. 10.100.000</td>
                    </tr>
                </tbody>
                </table>
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
            
            <div class="col-xs-4">
                
                <table class="table no-border">
                    <thead>
                        <th><center>Penerima</center></th>
                        <th><center>Pembuat</center></th>
                    </thead>
                    <tbody>
                        <tr><td></td><td></td></tr>
                        <tr><td></td><td></td></tr>
                        <tr><td></td><td></td></tr>
                        <tr><td></td><td></td></tr>
                        <tr>
                            <td><center>nama Pelanggan</center></td>
                            <td><center>Admin yg buat</center></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- accepted payments column -->
            <div class="col-xs-4">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Pajak</th></th>
                            <td>10.34%</td>
                        </tr>
                        <tr>
                            <th>Diskon:</th>
                            <td>5.80%</td>
                        </tr>
                    </table>
                </div>

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                "Apabila pesanan tidak di cetak maka belum di order"
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>Rp. 250.30</td>
                        </tr>
                        <tr>
                            <th>DP:</th>
                            <td>Rp. 5.80</td>
                        </tr>
                        <tr>
                            <th>Sisa:</th>
                            <td>Rp. 5.80</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>Rp. 265.24</td>
                        </tr>
                    </table>
                </div>
            </div>

            
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
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

    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    

    </body>
@endsection
