@extends('layouts.app')
@push('style')

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{secure_asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{secure_asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{secure_asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{secure_asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{secure_asset('dist/css/AdminLTE.min.css')}}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{secure_asset('dist/css/skins/_all-skins.min.css')}}">

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

                <div class="row">

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <b><span style="font-size:25px">{{$data[0]}}</span></b>
                    
                                <p>Total Transaksi<br>{{date('d-M-Y')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <a href="{{route('transaksipenjualanmanageindex')}}?nonota=&namapelanggan=&pembayaran=semua&tanggal={{date('d-m-Y')}}&periode=hari" class="small-box-footer">
                            Detail <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <b><span id="income" class="pemasukan" style="font-size:25px">Rp. {{number_format($data[1],0,',','.')}}</span></b>
                    
                                <p>Total Pemasukan<br>{{date('d-M-Y')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-arrow-down"></i>
                            </div>
                            <a href="{{route('laporan')}}" class="small-box-footer">
                            Detail <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <b><span class="pengeluaran" style="font-size:25px">Rp. {{number_format($data[2],0,',','.')}}</span></b>
                    
                                <p>Total Pengeluaran<br>{{date('d-M-Y')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-arrow-up"></i>
                            </div>
                            <a href="{{route('laporan')}}" class="small-box-footer">
                            Detail <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <b><span class="pendapatan" style="font-size:25px">Rp. {{number_format($data[3],0,',','.')}}</span></b>
                    
                                <p>Total Pendapatan Bersih<br>{{date('d-M-Y')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-usd"></i>
                            </div>
                                <a href="{{route('laporan')}}" class="small-box-footer">
                                Detail <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Grafik Penjualan Tahun {{date('Y')}}</h3>
                
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="lineChart" style="height: 400px; width: 357px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Produk Terlaris Tahun {{date('Y')}}</h3>
                
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body" style="">
                                <div class="col-md-12">
                                    <canvas id="pieChart" style="width: 357px; height: 200px;"></canvas>
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

    {{-- <!-- Sparkline -->
    <script src="{{secure_asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap  -->
    <script src="{{secure_asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{secure_asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script> --}}
    <!-- MaskMoney -->
    {{-- <script src="{{secure_asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script> --}}
    <script src="{{secure_asset('bower_components/chartjs/Chart.js')}}"></script>

    <!-- jQuery 3 -->
    <script src="{{secure_asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{secure_asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{secure_asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{secure_asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{secure_asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{secure_asset('dist/js/demo.js')}}"></script>

    <script>
        var areaChartCanvas = document.getElementById('lineChart').getContext('2d');
        window.myBar = new Chart(areaChartCanvas);

        function setDonat(data){
            var config = {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [
                            data['value'][0],
                            data['value'][1],
                            data['value'][2],
                            data['value'][3],
                            data['value'][4],
                        ],
                        backgroundColor: [
                            '#f56954',
                            '#00a65a',
                            '#f39c12',
                            '#00c0ef',
                            '#3c8dbc'
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        data['label'][0],
                        data['label'][1],
                        data['label'][2],
                        data['label'][3],
                        data['label'][4]
                    ]
                },
                options: {
                    responsive: true,
                    legend: {
                        display:true,
                        position: 'top',
                    },
                    title: {
                        display: false,
                        text: 'Produk Terlaris'
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            };
            var ctx = document.getElementById('pieChart').getContext('2d');
			window.myDoughnut = new Chart(ctx, config);
        };

        function setchart(charttitle ,chartLabel, Pemasukan, Pengeluaran, Piutang, Hutang) {
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
                                fontSize: 12
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Juta',
                                fontStyle: 'bold',
                                fontSize: 12
                            }
                        }]
                    },
                    legend      :{
                        position: 'top',
                    },
                    title       :{
                        display : true,
                        fontSize: 14,
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

        $(function () {
            
            $.get('{{route('linedata')}}', function(response)
            {   
                setchart(
                    {{date('Y')}},
                    response['labelBulan'],
                    response['Pemasukan'],
                    response['Pengeluaran'],
                    response['Piutang'],
                    response['Hutang']
                );
            });
            $.get('{{route('piedata')}}', function(response)
            {   
                
                setDonat(response);
                
            });
            
        })
    </script>

</body>
@endsection