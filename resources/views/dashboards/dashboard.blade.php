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

                <div class="row">

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <b><span style="font-size:25px">53</span></b>
                    
                                <p>Total Transaksi<br>{{date('d-M-Y')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <b><span id="income" class="pemasukan" style="font-size:25px">-</span></b>
                    
                                <p>Total Pemasukan<br>{{date('d-M-Y')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-arrow-down"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <b><span class="pengeluaran" style="font-size:25px">-</span></b>
                    
                                <p>Total Pengeluaran<br>{{date('d-M-Y')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-arrow-up"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <b><span class="pendapatan" style="font-size:25px">-</span></b>
                    
                                <p>Total Pendapatan Bersih<br>{{date('d-M-Y')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-usd"></i>
                            </div>
                                <a href="#" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Grafik Penjualan Tahun {{date('Y')}}</h3>
                
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="lineChart" style="height: 310px; width: 357px;" width="357" height="310"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Produk Terlaris Tahun {{date('Y')}}</h3>
                
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
                                </div>
                            </div>
                            <div class="box-body" style="">
                                <div class="row">
                                    <div class="col-md-8">
                                            <canvas id="pieChart" height="175" width="357" style="width: 357px; height: 326px;"></canvas>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="chart-legend clearfix">
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                                            <li><i class="fa fa-circle-o text-green"></i> IE</li>
                                            <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                                            <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                                            <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                                            <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                                        </ul>
                                    </div>
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
    <script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap  -->
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script> --}}
    <!-- ChartJS -->
    <script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>
    <!-- MaskMoney -->
    <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>
    
    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>

    <script>
        $(function() {
            ('#pemasukan').maskMoney('mask',5000);
        })
        $(function () {
            
            /* ChartJS
            * -------
            * Here we will create a few charts using ChartJS
            */
        // $.get()
            var areaChartData = {
            labels  : [ 'Januari', 'Februari', 'Maret',
                        'April', 'Mei', 'Juni', 'Juli',
                        'Agustus', 'September', 'Oktober',
                        'November', 'Desember' ],
            datasets: [
                {
                label               : 'Penjualan',
                fillColor           : 'rgba(210, 214, 222, 1)',
                strokeColor         : 'rgba(210, 214, 222, 1)',
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : [65, 59, 80, 81, 56, 55, 40]
                }
            ]
            }

            var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale               : true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines      : false,
            //String - Colour of the grid lines
            scaleGridLineColor      : 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth      : 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines  : true,
            //Boolean - Whether the line is curved between points
            bezierCurve             : true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension      : 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot                : false,
            //Number - Radius of each point dot in pixels
            pointDotRadius          : 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth     : 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius : 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke           : true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth      : 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill             : true,
            //String - A legend template
            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio     : true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive              : true
            }

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
            var lineChart                = new Chart(lineChartCanvas)
            var lineChartOptions         = areaChartOptions
            lineChartOptions.datasetFill = false
            lineChart.Line(areaChartData, lineChartOptions)

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieChart       = new Chart(pieChartCanvas)
            var PieData        = [
            {
                value    : 700,
                color    : '#f56954',
                highlight: '#f56954',
                label    : 'Chrome'
            },
            {
                value    : 500,
                color    : '#00a65a',
                highlight: '#00a65a',
                label    : 'IE'
            },
            {
                value    : 400,
                color    : '#f39c12',
                highlight: '#f39c12',
                label    : 'FireFox'
            },
            {
                value    : 600,
                color    : '#00c0ef',
                highlight: '#00c0ef',
                label    : 'Safari'
            },
            {
                value    : 300,
                color    : '#3c8dbc',
                highlight: '#3c8dbc',
                label    : 'Opera'
            },
            {
                value    : 100,
                color    : '#d2d6de',
                highlight: '#d2d6de',
                label    : 'Navigator'
            }
            ]
            var pieOptions     = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke    : true,
            //String - The colour of each segment stroke
            segmentStrokeColor   : '#fff',
            //Number - The width of each segment stroke
            segmentStrokeWidth   : 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps       : 100,
            //String - Animation easing effect
            animationEasing      : 'easeOutBounce',
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate        : true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale         : false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive           : true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio  : true,
            //String - A legend template
            legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions)
        })
    </script>

</body>
@endsection