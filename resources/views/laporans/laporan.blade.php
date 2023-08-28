@extends('layouts.app')
@push('style')

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- date range picker -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">

<style type="text/css">
    .jqstooltip 
    { 
        position: absolute;
        left: 0px;
        top: 0px;
        visibility: hidden;
        background: rgb(0, 0, 0) transparent;
        background-color: rgba(0,0,0,0.6);
        filter:progid:DXImageTransform.Microsoft.gradient
        (
            startColorstr=#99000000, 
            endColorstr=#99000000
        );
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
        color: white;
        font: 10px arial, san serif;
        text-align: left;
        white-space: nowrap;
        padding: 5px;
        border: 1px solid white;
        box-sizing: content-box;
        z-index: 10000;
    }
    .jqsfield 
    { 
        color: white;
        font: 10px arial, san serif;
        text-align: left;
    }
</style>

@endpush

@section('body')
    <body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">

        @include('layouts.header')

        @include('layouts.sidebar')

        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <section class="content-header">
                <h1>Laporan Keuangan : <span id=labelTanggal>{{date('l, d-m-Y')}}</span></h1>
                    <br>
                </section>
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-warning">
                            <div class="box-header">
                                <h3 class="box-title">Periode</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" name="periode" id="periode">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">

                        <div class="row">
                            <div class="col-lg-6 col-xs-6"><!--Penjualan -->
                                <div class="box box-solid bg-green-gradient">
                                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                                        <i class="fa fa-fw fa-cart-arrow-down"></i>
                        
                                        <h3 class="box-title">Penjualan</h3>
                                        <div class="pull-right box-tools">
                                            <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body no-padding">
                                    </div>
                                    <div class="box-footer text-black">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Progress bars -->
                                                <div class="clearfix">
                                                    <span class="pull-left">Pembayaran Penjualan</span>
                                                    <small  class="pull-right" id="Pembayaran_Penjualan">Rp. 0</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div id="Progress_Pembayaran_Penjualan" class="progress-bar progress-bar-green" style="width: 0%;"></div>
                                                </div>
                            
                                                <div class="clearfix">
                                                    <span class="pull-left">Piutang Penjualan</span>
                                                    <small id="Piutang_Penjualan" class="pull-right">Rp. 0</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div id="Progress_Piutang_Penjualan" class="progress-bar progress-bar-green" style="width: 0%;"></div>
                                                </div>

                                                <div class="clearfix">
                                                    <span class="pull-left">Total</span>
                                                    <small id="Total_Penjualan" class="pull-right">Rp. 0</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-6"><!--Pengeluaran -->
                                <div class="box box-solid bg-red-gradient">
                                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                                        <i class="fa fa-fw fa-cart-plus"></i>
                        
                                        <h3 class="box-title">Pengeluaran & Pembelian</h3>
                                        <div class="pull-right box-tools">
                                            <button type="button" class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body no-padding">
                                    </div>
                                    <div class="box-footer text-black">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Progress bars -->
                                                <div class="clearfix">
                                                    <span  class="pull-left">Pembayaran Pengeluaran</span>
                                                    <small id="Pembayaran_Pengeluaran" class="pull-right">Rp. 0</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div id="Progress_Pembayaran_Pengeluaran" class="progress-bar progress-bar-red" style="width: 0%;"></div>
                                                </div>
                            
                                                <div class="clearfix">
                                                    <span class="pull-left">Hutang</span>
                                                    <small id="Hutang_Pengeluaran" class="pull-right">Rp. 0</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div id="Progress_Hutang_Pengeluaran" class="progress-bar progress-bar-red" style="width: 0%;"></div>
                                                </div>

                                                <div class="clearfix">
                                                    <span class="pull-left">Total</span>
                                                    <small id="Total_Pengeluaran" class="pull-right">Rp. 0</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-xs-6">
                                <div class="box box-solid bg-blue-gradient">
                                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                                        <i class="fa fa-fw fa-btc"></i>
                        
                                        <h3 class="box-title">Pencairan Piutang</h3>
                                        <div class="pull-right box-tools">
                                            <button type="button" class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body no-padding">
                                    </div>
                                    <div class="box-footer text-black">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="clearfix">
                                                    <span class="pull-left">Total</span>
                                                    <small id="Pencairan_Piutang" class="pull-right">Rp. 0</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-6">
                                <div class="box box-solid bg-aqua-gradient">
                                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                                        <i class="fa fa-fw fa-dollar"></i>
                        
                                        <h3 class="box-title">Pembayaran Hutang</h3>
                                        <div class="pull-right box-tools">
                                            <button type="button" class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body no-padding">
                                    </div>
                                    <div class="box-footer text-black">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="clearfix">
                                                    <span class="pull-left">Total</span>
                                                    <small id="Pembayaran_Hutang" class="pull-right">Rp. 0</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6"><!-- Cash-->
                                <div class="box box-widget widget-user-2">
                                    <div class="widget-user-header bg-yellow">
                                        <div class="widget-user-image">
                                        <img class="img-square" src="{{asset('bower_components/custom_icons/3_purse.svg')}}" alt="User Avatar">
                                        </div>
                                        <h3 class="widget-user-username">Cash</h3>
                                        <h5 class="widget-user-desc">Pembayaran Tunai</h5>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li><a href="#">Kas Masuk <span id="c_Kas_Masuk" class="pull-right badge bg-teal">Rp. 0,-</span></a></li>
                                            <li>
                                                <ul class="nav nav-stacked">
                                                    <li><a href="#"> - Pembayaran Penjualan<span id="c_Pembayaran_Penjualan" class="pull-right badge bg-teal">Rp. 0,-</span></a></li>
                                                    <li><a href="#"> - Pencairan Piutang Hari Ini<span id="c_Pencairan_Piutang" class="pull-right badge bg-teal">Rp. 0,-</span></a></li>
                                                    <li><a href="#"> - Pencairan Piutang Kemarin<span id="c_Pencairan_Piutang_Bukan_Nota" class="pull-right badge bg-teal">Rp. 0,-</span></a></li>
                                                </ul>
                                            <li><a href="#">Kas Keluar <span id="c_Kas_Keluar" class="pull-right badge bg-blue">5</span></a></li>
                                            <li>
                                                <ul class="nav nav-stacked">
                                                @foreach ($data[0] as $jpengeluaran)
                                                    <li><a href="#"> - {{$jpengeluaran->jenis_pengeluaran}}<span id="c_{{str_replace(' ','_',$jpengeluaran->jenis_pengeluaran)}}" class="pull-right badge bg-blue">Rp. 0,-</span></a></li>
                                                @endforeach
                                                    <li><a href="#"> - Pembayaran Hutang<span id="c_Pembayaran_Hutang" class="pull-right badge bg-blue">Rp. 0,-</span></a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Total <span id="c_Total" class="pull-right badge">12</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"><!-- Transfer-->
                                <div class="box box-widget widget-user-2">
                                    <div class="widget-user-header bg-yellow">
                                        <div class="widget-user-image">
                                        <img class="img-square" src="{{asset('bower_components/custom_icons/17_cards.svg')}}" alt="User Avatar">
                                        </div>
                                        <h3 class="widget-user-username">Transfer</h3>
                                        <h5 class="widget-user-desc">Pembayaran Transfer</h5>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li><a href="#">Kas Masuk <span id="t_Kas_Masuk" class="pull-right badge bg-teal">Rp. 0,-</span></a></li>
                                            <li>
                                                <ul class="nav nav-stacked">
                                                    <li><a href="#"> - Pembayaran Penjualan<span id="t_Pembayaran_Penjualan" class="pull-right badge bg-teal">Rp. 0,-</span></a></li>
                                                    <li><a href="#"> - Pencairan Piutang Hari Ini<span id="t_Pencairan_Piutang" class="pull-right badge bg-teal">Rp. 0,-</span></a></li>
                                                    <li><a href="#"> - Pencairan Piutang Kemarin<span id="t_Pencairan_Piutang_Bukan_Nota" class="pull-right badge bg-teal">Rp. 0,-</span></a></li>
                                                </ul>
                                            <li><a href="#">Kas Keluar <span id="t_Kas_Keluar" class="pull-right badge bg-blue">Rp. 0,-</span></a></li>
                                            <li>
                                                <ul class="nav nav-stacked">
                                                @foreach ($data[0] as $jpengeluaran)
                                                    <li><a href="#"> - {{$jpengeluaran->jenis_pengeluaran}}<span id="t_{{str_replace(' ','_',$jpengeluaran->jenis_pengeluaran)}}" class="pull-right badge bg-blue">Rp. 0,-</span></a></li>
                                                @endforeach
                                                    <li><a href="#"> - Pembayaran Hutang<span id="t_Pembayaran_Hutang" class="pull-right badge bg-blue">Rp. 0,-</span></a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Total <span id="t_Total" class="pull-right badge">Rp. 0,-</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row"> <!--Grafik-->
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Grafik Pemasukan, Penjualan, Piutang dan Hutang</h3>                   
                                        <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="row">
                                        <div class="col-md-12">
                        
                                            <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                                <canvas id="salesChart" style="height: 500px; width: 158px;"></canvas>
                                            </div>
                                            <!-- /.chart-responsive -->
                                        </div>
                                        <!-- /.col -->
                                        
                                        <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- ./box-body -->
                                    <div class="box-footer">
                                        <div class="row">
                                            <h4 id="judul_footer" class="box-title text-center"></h4>
                                        </div>
                                        <div class="row">
                                        
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                            <span id="persentase_pemasukan_footer" class="description-percentage text-yellow"><i id="panah_pemasukan" class="fa fa-caret-left"></i> 0%</span>
                                            <h5 id="nilai_pemasukan_footer" class="description-header">Rp. 0</h5>
                                            <span class="description-text">Pemasukan</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                            <span id="persentase_pengeluaran_footer" class="description-percentage text-yellow"><i id="panah_pengeluaran" class="fa fa-caret-left"></i> 0%</span>
                                            <h5 id="nilai_pengeluaran_footer" class="description-header">Rp. 0</h5>
                                            <span class="description-text">Pengeluaran</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                            <span id="persentase_piutang_footer" class="description-percentage text-yellow"><i id="panah_piutang" class="fa fa-caret-left"></i> 0%</span>
                                            <h5 id="nilai_piutang_footer" class="description-header">Rp. 0</h5>
                                            <span class="description-text">Sisa Piutang</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block">
                                            <span id="persentase_hutang_footer" class="description-percentage text-yellow"><i id="panah_hutang" class="fa fa-caret-left"></i> 0%</span>
                                            <h5 id="nilai_hutang_footer" class="description-header">Rp.0 </h5>
                                            <span class="description-text">Sisa Hutang</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.box-footer -->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
        </div>

        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->


    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    

    {{-- <!-- Sparkline -->
    <script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap  -->
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script> --}}
    <!-- ChartJS -->
    {{-- <script src="{{asset('bower_components/chart.js/Chart.js')}}"></script> --}}
    <script src="{{asset('bower_components/chartjs/Chart.js')}}"></script>
    <!-- MaskMoney -->
    <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <script>
        Number.prototype.format = function(n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));
            
            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };

        function footer(idnilai, idpersentase, value){
            //hitung jumlah perubahan
            var nilai_sebelum = value[value.length-2]*1000000;
            var nilai_sesudah = value[value.length-1]*1000000;
            var perubahan = nilai_sesudah - nilai_sebelum;
            var persentase_perubahan = ((perubahan) / nilai_sebelum) * 100;
            
            if (persentase_perubahan == 0) {
                document.getElementById(idpersentase).className = "description-percentage text-yellow";
                document.getElementById(idpersentase).innerHTML = '<i class="fa fa-caret-left"></i> ' + persentase_perubahan.format(2, 0, ',', '') + '%';
                document.getElementById(idnilai).tinnerHTMLext  = "Rp. " + perubahan.format(0, 3, '.', ',');
            }else if (persentase_perubahan  < 0){
                persentase_perubahan = persentase_perubahan * -1;
                perubahan = perubahan * -1;
                document.getElementById(idpersentase).className = "description-percentage text-red";
                document.getElementById(idpersentase).innerHTML = '<i class="fa fa-caret-down"></i> ' + persentase_perubahan.format(2, 0, ',', '') + '%';
                document.getElementById(idnilai).innerHTML      = "Rp. " + perubahan.format(0, 3, '.', ',');
            }else if(persentase_perubahan > 0){
                if (persentase_perubahan == Infinity){
                    persentase_perubahan = 100;
                }
                document.getElementById(idpersentase).className = "description-percentage text-green";
                document.getElementById(idpersentase).innerHTML = '<i class="fa fa-caret-up"></i> ' + persentase_perubahan.format(2, 0, ',', '') + '%';
                document.getElementById(idnilai).innerHTML      = "Rp. " + perubahan.format(0, 3, '.', ',');
            }
        };

        function setData(
                Pembayaran_Penjualan,
                Piutang_Penjualan,
                Pembayaran_Pengeluaran,
                Hutang_Pengeluaran,
                Pencairan_Piutang,
                Pembayaran_Hutang,
                //array label
                label_Jenis_Pengeluaran,
                //Cash In
                c_Pembayaran_Penjualan,
                c_Pencairan_Piutang,
                c_Pencairan_Piutang_Bukan_Nota,
                //Cash Out
                c_Pembayaran_Hutang,
                c_value_Jenis_Pengeluaran,
                //Tansfer In
                t_Pembayaran_Penjualan,
                t_Pencairan_Piutang,
                t_Pencairan_Piutang_Bukan_Nota,
                //Transfer Out
                t_Pembayaran_Hutang,
                t_value_Jenis_Pengeluaran
            ){
                var persentasePembayaran_Penjualan      = 100 * (Pembayaran_Penjualan / (Pembayaran_Penjualan+Piutang_Penjualan));
                var persentasePiutang_Penjualan         = 100 * (Piutang_Penjualan / (Pembayaran_Penjualan+Piutang_Penjualan));
                var persentasePembayaran_Pengeluaran    = 100 * (Pembayaran_Pengeluaran / (Pembayaran_Pengeluaran + Hutang_Pengeluaran))
                var persentaseHutang_Pengeluaran        = 100 * (Hutang_Pengeluaran / (Pembayaran_Pengeluaran + Hutang_Pengeluaran))

                var Total_c_Pengeluaran = 0;
                var Total_t_Pengeluaran = 0;
                // console.log(persentaseHutang_Pengeluaran, persentasePembayaran_Pengeluaran, persentasePembayaran_Penjualan, persentasePiutang_Penjualan);
                $('#Pembayaran_Penjualan').text('Rp. '+Pembayaran_Penjualan.format(0, 3, '.', ','));
                $('#Piutang_Penjualan').text('Rp. '+Piutang_Penjualan.format(0, 3, '.', ','));
                $('#Total_Penjualan').text('Rp. '+ (Pembayaran_Penjualan+Piutang_Penjualan).format(0, 3, '.', ','));
                if (isNaN(persentasePembayaran_Penjualan)){ 
                    document.getElementById('Progress_Pembayaran_Penjualan').style.width= 0 +'%';
                } else {
                    document.getElementById('Progress_Pembayaran_Penjualan').style.width= persentasePembayaran_Penjualan+'%';
                };

                if (isNaN(persentasePiutang_Penjualan)){ 
                    document.getElementById('Progress_Piutang_Penjualan').style.width= 0 +'%';
                } else {
                    document.getElementById('Progress_Piutang_Penjualan').style.width= persentasePiutang_Penjualan+'%';
                };
                // document.getElementById('Progress_Pembayaran_Penjualan').style.width= if ( isNaN(persentasePembayaran_Penjualan) ){ 0 }else{persentasePembayaran_Penjualan}+'%';
                // document.getElementById('Progress_Piutang_Penjualan').style.width=persentasePiutang_Penjualan+'%';

                $('#Pembayaran_Pengeluaran').text('Rp. '+Pembayaran_Pengeluaran.format(0, 3, '.', ','));
                $('#Hutang_Pengeluaran').text('Rp. '+Hutang_Pengeluaran.format(0, 3, '.', ','));
                $('#Total_Pengeluaran').text('Rp. '+ (Pembayaran_Pengeluaran + Hutang_Pengeluaran).format(0, 3, '.', ','));
                if (isNaN(persentasePiutang_Penjualan)){ 
                    document.getElementById('Progress_Pembayaran_Pengeluaran').style.width= 0 +'%';
                } else {
                    document.getElementById('Progress_Pembayaran_Pengeluaran').style.width= persentasePembayaran_Pengeluaran+'%';
                };

                if (isNaN(persentasePiutang_Penjualan)){ 
                    document.getElementById('Progress_Hutang_Pengeluaran').style.width= 0 +'%';
                } else {
                    document.getElementById('Progress_Hutang_Pengeluaran').style.width= persentaseHutang_Pengeluaran+'%';
                };
                // document.getElementById('Progress_Pembayaran_Pengeluaran').style.width= persentasePembayaran_Pengeluaran+'%';
                // document.getElementById('Progress_Hutang_Pengeluaran').style.width=persentaseHutang_Pengeluaran+'%';
                
                $('#Pencairan_Piutang').text('Rp. '+Pencairan_Piutang.format(0, 3, '.', ','));
                $('#Pembayaran_Hutang').text('Rp. '+Pembayaran_Hutang.format(0, 3, '.', ','));
                
                //Detail Cash
                $('#c_Kas_Masuk').text('Rp. '+(c_Pembayaran_Penjualan + c_Pencairan_Piutang).format(0, 3, '.', ','));
                $('#c_Pembayaran_Penjualan').text('Rp. '+c_Pembayaran_Penjualan.format(0, 3, '.', ','));
                $('#c_Pencairan_Piutang').text('Rp. '+c_Pencairan_Piutang.format(0, 3, '.', ','));
                $('#c_Pencairan_Piutang_Bukan_Nota').text('Rp. '+c_Pencairan_Piutang_Bukan_Nota.format(0, 3, '.', ','));
                
                $('#c_Pembayaran_Hutang').text('Rp. '+c_Pembayaran_Hutang.format(0, 3, '.', ','));
                for (i = 0; i < label_Jenis_Pengeluaran.length; i++) {
                    $('#c_'+label_Jenis_Pengeluaran[i].replace(' ','_')).text('Rp. '+c_value_Jenis_Pengeluaran[i].format(0, 3, '.', ','));
                    Total_c_Pengeluaran = Total_c_Pengeluaran + c_value_Jenis_Pengeluaran[i];
                };
                $('#c_Kas_Keluar').text('Rp. '+(c_Pembayaran_Hutang + Total_c_Pengeluaran).format(0, 3, '.', ','));
                $('#c_Total').text('Rp. '+(c_Pembayaran_Penjualan + c_Pencairan_Piutang - Total_c_Pengeluaran).format(0, 3, '.', ','))
                if (((c_Pembayaran_Penjualan + c_Pencairan_Piutang) - Total_c_Pengeluaran) < 0){
                    document.getElementById('c_Total').className = "pull-right badge bg-red";
                }else if (((c_Pembayaran_Penjualan + c_Pencairan_Piutang) - Total_c_Pengeluaran) > 0){
                    document.getElementById('c_Total').className = "pull-right badge bg-green";
                };

                //Detail Transfer
                $('#t_Kas_Masuk').text('Rp. '+(t_Pembayaran_Penjualan + t_Pencairan_Piutang).format(0, 3, '.', ','));
                $('#t_Pembayaran_Penjualan').text('Rp. '+t_Pembayaran_Penjualan.format(0, 3, '.', ','));
                $('#t_Pencairan_Piutang').text('Rp. '+t_Pencairan_Piutang.format(0, 3, '.', ','));
                $('#t_Pencairan_Piutang_Bukan_Nota').text('Rp. '+t_Pencairan_Piutang_Bukan_Nota.format(0, 3, '.', ','));
                
                $('#t_Pembayaran_Hutang').text('Rp. '+t_Pembayaran_Hutang.format(0, 3, '.', ','));
                for (i = 0; i < label_Jenis_Pengeluaran.length; i++) {
                    $('#t_'+label_Jenis_Pengeluaran[i].replace(' ','_')).text('Rp. '+t_value_Jenis_Pengeluaran[i].format(0, 3, '.', ','));
                    Total_t_Pengeluaran = Total_t_Pengeluaran + t_value_Jenis_Pengeluaran[i];
                };
                $('#t_Kas_Keluar').text('Rp. '+(t_Pembayaran_Hutang + Total_t_Pengeluaran).format(0, 3, '.', ','));
                $('#t_Total').text('Rp. '+(t_Pembayaran_Penjualan + t_Pencairan_Piutang - Total_t_Pengeluaran).format(0, 3, '.', ','))
                if (((t_Pembayaran_Penjualan + t_Pencairan_Piutang) - Total_t_Pengeluaran) < 0){
                    document.getElementById('t_Total').className = "pull-right badge bg-red";
                }else if (((t_Pembayaran_Penjualan + t_Pencairan_Piutang) - Total_t_Pengeluaran) > 0){
                    document.getElementById('t_Total').className = "pull-right badge bg-green";
                };
        };
        //Line chart
        var areaChartCanvas = document.getElementById('salesChart').getContext('2d');
        window.myBar = new Chart(areaChartCanvas);

        function setchart(charttitle ,chartLabel, Pemasukan, Pengeluaran, Piutang, Hutang) {
            window.myBar.destroy();
            window.myBar = new Chart(areaChartCanvas, {
                type : 'line',
                data:{
                    labels  : chartLabel,
                    datasets: [
                        {
                        label               : 'Pemasukan',
                        backgroundColor     : 'rgba(17, 115, 17, 0.2)',
                        borderColor         : 'rgba(17, 115, 17, 1)',
                        data                : Pemasukan
                        },
                        {
                        label               : 'Pengeluaran',
                        backgroundColor     : 'rgba(199, 39, 24, 0.2)',
                        borderColor         : 'rgba(199, 39, 24, 1)',
                        data                : Pengeluaran
                        },
                        {
                        label               : 'Piutang',
                        backgroundColor     : 'rgba(24, 97, 199, 0.2)',
                        borderColor         : 'rgba(24, 97, 199, 1)',
                        data                : Piutang
                        },
                        {
                        label               : 'Hutang',
                        backgroundColor     : 'rgba(219, 236, 28, 0.2)',
                        borderColor         : 'rgba(219, 236, 28, 1)',
                        data                : Hutang
                        }
                    ]
                },
                options: {
                    responsive  : true,
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Bulan',
                                fontStyle: 'bold',
                                fontSize: 16
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Juta',
                                fontStyle: 'bold',
                                fontSize: 16
                            }
                        }]
				    },
                    legend      :{
                        position: 'top',
                    },
                    title       :{
                        display : true,
                        fontSize: 20,
                        text    : charttitle
                    },
                    tooltips    :{
                        enabled : true,
                        mode    : 'index',
                        intersect : false
                    }
                }
            });
        };

        $(function(){
            $.get('{{route('filter')}}', {startDate : "{{date('Y/m/d')}}", endDate : "{{date('Y/m/d')}}"} , function(response)
            {

                setData(
                    response['Pembayaran_Penjualan'],
                    response['Piutang_Penjualan'],
                    response['Pembayaran_Pengeluaran'],
                    response['Hutang_Pengeluaran'],
                    response['Pencairan_Piutang'],
                    response['Pembayaran_Hutang'],
                    response['jenispengeluaran'],
                    response['c_Pembayaran_Penjualan'],
                    response['c_Pencairan_Piutang'],
                    response['c_Pencairan_Piutang_Bukan_Nota'],
                    response['c_Pembayaran_Hutang'],
                    response['cvalue_jenispengeluaran'],
                    response['t_Pembayaran_Penjualan'],
                    response['t_Pencairan_Piutang'],
                    response['t_Pencairan_Piutang_Bukan_Nota'],
                    response['t_Pembayaran_Hutang'],
                    response['tvalue_jenispengeluaran']
                );
                setchart(
                    response['charttitle'],
                    response['datachartMonth'],
                    response['datachartPemasukan'],
                    response['datachartPengeluaran'],
                    response['datachartPiutang'],
                    response['datachartHutang']
                );
                footer(
                    'nilai_pemasukan_footer',
                    'persentase_pemasukan_footer',
                    response['datachartPemasukan']
                );
                footer(
                    'nilai_pengeluaran_footer',
                    'persentase_pengeluaran_footer',
                    response['datachartPengeluaran']
                );
                footer(
                    'nilai_piutang_footer',
                    'persentase_piutang_footer',
                    response['datachartPiutang']
                );
                footer(
                    'nilai_hutang_footer',
                    'persentase_hutang_footer',
                    response['datachartHutang']
                );
                document.getElementById('judul_footer').innerHTML = 'Perbandingan Bulan ' + response['datachartMonth'][response['datachartMonth'].length-2] + ' ' +{{date('Y')}} + ' - ' + response['datachartMonth'][response['datachartMonth'].length-1] + ' ' + {{date('Y')}};
            });
        })
            
        $(function() {
            $('input[name="periode"]').daterangepicker({
                opens: 'right',
                autoUpdateInput: false,
                locale: {
                    format: 'DD/MM/YYYY',
                    cancelLabel: 'Clear'
                }
            });


            $('input[name="periode"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                $('#labelTanggal').text(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                $.ajax({
                    async : true,
                    type : 'get',
                    url: '{{route('filter')}}',
                    data: {startDate: picker.startDate.format('YYYY/MM/DD'), endDate: picker.endDate.format('YYYY/MM/DD')},
                }).done(function(response){
                    setData(
                        response['Pembayaran_Penjualan'],
                        response['Piutang_Penjualan'],
                        response['Pembayaran_Pengeluaran'],
                        response['Hutang_Pengeluaran'],
                        response['Pencairan_Piutang'],
                        response['Pembayaran_Hutang'],
                        response['jenispengeluaran'],
                        response['c_Pembayaran_Penjualan'],
                        response['c_Pencairan_Piutang'],
                        response['c_Pencairan_Piutang_Bukan_Nota'],
                        response['c_Pembayaran_Hutang'],
                        response['cvalue_jenispengeluaran'],
                        response['t_Pembayaran_Penjualan'],
                        response['t_Pencairan_Piutang'],
                        response['t_Pencairan_Piutang_Bukan_Nota'],
                        response['t_Pembayaran_Hutang'],
                        response['tvalue_jenispengeluaran']
                    );
                    setchart(
                        response['charttitle'],
                        response['datachartMonth'],
                        response['datachartPemasukan'],
                        response['datachartPengeluaran'],
                        response['datachartPiutang'],
                        response['datachartHutang']
                    );
                }).fail(function (error) {
                    console.log(error);
                });
            });

            $('input[name="periode"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });

        
    </script>
</body>
@endsection
