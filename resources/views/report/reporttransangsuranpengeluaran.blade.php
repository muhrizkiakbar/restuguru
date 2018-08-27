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
    .lebarkwitansi
    {
        width: 21cm;
        margin: auto;
        align: "center";
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
    <body class="lebarkwitansi">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                <img src="{{asset('dist/img/rg.png')}}" class="logorg"> <strong>RESTU GURU PROMOSINDO</strong> Cab. {{$transaksi->Nama_Cabang}}
                <small class="pull-right"> Angsuran Pengeluaran {{$transaksi->jenis_pengeluaran}}</small>
                </h2>
            </div>
            <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                Dari
                <address>
                <strong>{{$transaksi->nama}}</strong><br>
                {{$transaksi->display_name}}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Kepada
                <address>
                <strong>{{$transaksi->namapenerima}}</strong><br>
                {{$transaksi->hppenerima}}

                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>No. #{{$transaksi->id}}</b><br>
                <b>Tanggal :</b> {{date("d-m-Y",strtotime($transaksi->tanggal_pengeluaran))}}
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
            @if ($transaksi->sisa_pengeluaran==0)
                <img src="{{asset('dist/img/brush_lunas.png')}}" class="status">
            @endif
            <div class="col-xs-12 table-responsive">
                <table class="table table-bordered table-striped strong" width="100%">
                <thead>
                    <tr>
                        <th>No. Angsuran</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Sisa Tagihan</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($angsurans as $angsuran)
                    <tr>
                        <td>#{{$angsuran->id}}</td>
                        <td>{{date('d-m-Y',strtotime($angsuran->tanggal_angsuran))}}</td>
                        <td>Rp. {{number_format(floatval($angsuran->nominal_angsuran),0,',','.')}}</td>
                        <td>Rp. {{number_format(floatval($angsuran->sisa_angsuran),0,',','.')}}</td>
                        <td>{{$angsuran->metode_pembayaran}}</td>
                    </tr>
                    @endforeach
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
                            <td><center>{{$transaksi->namapenerima}}</center></td>
                            <td><center>{{$transaksi->nama}}</center></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- accepted payments column -->
            <div class="col-xs-4">

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                "Apabila pesanan tidak di cetak maka belum di order"
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Total :</th>
                            <td>Rp. {{number_format(floatval($transaksi->total_pengeluaran),0,',','.')}}</td>
                        </tr>
                        <tr>
                            <th>DP:</th>
                            <td>Rp. {{number_format(floatval($transaksi->pembayaran_pengeluaran),0,',','.')}}</td>
                        </tr>
                        <tr>
                            <th>Sisa:</th>
                            <td>Rp. {{number_format(floatval($transaksi->sisa_pengeluaran),0,',','.')}}</td>
                        </tr>
                        <tr>
                            <th>Pembayaran :</th>
                            <td>{{$transaksi->metode_pembayaran}}</td>
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
