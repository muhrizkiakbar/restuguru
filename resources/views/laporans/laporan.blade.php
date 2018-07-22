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
                            <div class="col-lg-6 col-xs-6">
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
                                                    <span class="pull-left">DP Penjualan</span>
                                                    <small class="pull-right">Rp. 286.154.000</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 57.23%;"></div>
                                                </div>
                            
                                                <div class="clearfix">
                                                    <span class="pull-left">Piutang</span>
                                                    <small class="pull-right">Rp. 213.846.000</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 42.76%;"></div>
                                                </div>

                                                <div class="clearfix">
                                                    <span class="pull-left">Total</span>
                                                    <small class="pull-right">Rp. 500.000.000</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-6">
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
                                                    <span class="pull-left">Pembayaran Pengeluaran</span>
                                                    <small class="pull-right">Rp. 286.154.000</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 57.23%;"></div>
                                                </div>
                            
                                                <div class="clearfix">
                                                    <span class="pull-left">Hutang</span>
                                                    <small class="pull-right">Rp. 213.846.000</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 42.76%;"></div>
                                                </div>

                                                <div class="clearfix">
                                                    <span class="pull-left">Total</span>
                                                    <small class="pull-right">Rp. 500.000.000</small>
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
                        
                                        <h3 class="box-title">Pencairan utang</h3>
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
                                                    <small class="pull-right">Rp. 500.000.000</small>
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
                                                    <small class="pull-right">Rp. 500.000.000</small>
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
                                        <img class="img-square" src="{{asset('bower_components/custom_icons/cash-payment-icon-5.png')}}" alt="User Avatar">
                                        </div>
                                        <h3 class="widget-user-username">Cash</h3>
                                        <h5 class="widget-user-desc">Pembayaran Tunai</h5>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li><a href="#">Kas Masuk <span class="pull-right badge bg-blue">Rp. 500.000.000,-</span></a></li>
                                            <li>
                                                <ul class="nav nav-stacked">
                                                    <li><a href="#"> - DP Penjualan<span class="pull-right badge bg-blue">Rp. 500.000.000,-</span></a></li>
                                                    <li><a href="#"> - Pencairan Hutang<span class="pull-right badge bg-blue">Rp. 500.000.000,-</span></a></li>
                                                </ul>
                                            <li><a href="#">Kas Keluar <span class="pull-right badge bg-red">5</span></a></li>
                                            <li>
                                                <ul class="nav nav-stacked">
                                                @foreach ($jenispengeluaran as $jpengeluaran)
                                                    <li><a href="#"> - {{$jpengeluaran->jenis_pengeluaran}}<span class="pull-right badge bg-red">Rp. 500.000.000,-</span></a></li>
                                                @endforeach
                                                    <li><a href="#"> - Pembayaran Hutang<span class="pull-right badge bg-red">Rp. 500.000.000,-</span></a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Total <span class="pull-right badge bg-green">12</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"><!-- Transfer-->
                                <div class="box box-widget widget-user-2">
                                    <div class="widget-user-header bg-yellow">
                                        <div class="widget-user-image">
                                        <img class="img-square" src="{{asset('bower_components/custom_icons/Payment-Methods-Card-in-use-icon.png')}}" alt="User Avatar">
                                        </div>
                                        <h3 class="widget-user-username">Transfer</h3>
                                        <h5 class="widget-user-desc">Pembayaran Transfer</h5>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li><a href="#">Kas Masuk <span class="pull-right badge bg-blue">Rp. 500.000.000,-</span></a></li>
                                            <li>
                                                <ul class="nav nav-stacked">
                                                    <li><a href="#"> - DP Penjualan<span class="pull-right badge bg-blue">Rp. 500.000.000,-</span></a></li>
                                                    <li><a href="#"> - Pencairan Hutang<span class="pull-right badge bg-blue">Rp. 500.000.000,-</span></a></li>
                                                </ul>
                                            <li><a href="#">Kas Keluar <span class="pull-right badge bg-red">5</span></a></li>
                                            <li>
                                                <ul class="nav nav-stacked">
                                                @foreach ($jenispengeluaran as $jpengeluaran)
                                                    <li><a href="#"> - {{$jpengeluaran->jenis_pengeluaran}}<span class="pull-right badge bg-red">Rp. 500.000.000,-</span></a></li>
                                                @endforeach
                                                    <li><a href="#"> - Pembayaran Hutang<span class="pull-right badge bg-red">Rp. 500.000.000,-</span></a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Total <span class="pull-right badge bg-green">12</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Penjualan vs Pengeluaran</h3>
                        
                                        <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <p class="text-center">
                                            <strong>{{date('Y')}}</strong>
                                            </p>
                        
                                            <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                                <canvas id="salesChart" style="height: 300px; width: 158px;" width="158" height="300"></canvas>
                                            </div>
                                            <!-- /.chart-responsive -->
                                        </div>
                                        <!-- /.col -->
                                        {{-- <div class="col-md-4">
                                            <p class="text-center">
                                            <strong>Goal Completion</strong>
                                            </p>
                        
                                            <div class="progress-group">
                                            <span class="progress-text">Penjualan</span>
                                            <span class="progress-number"><b>160</b>/200</span>
                        
                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                                            </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                            <span class="progress-text">Pengeluaran</span>
                                            <span class="progress-number"><b>310</b>/400</span>
                        
                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                                            </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                            <span class="progress-text">Sisa Piutang</span>
                                            <span class="progress-number"><b>480</b>/800</span>
                        
                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                                            </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                            <span class="progress-text">Sisa Hutang</span>
                                            <span class="progress-number"><b>Rp. 500.000.000</b>/Rp. 500.000.000</span>
                        
                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                                            </div>
                                            </div>
                                            <!-- /.progress-group -->
                                        </div> --}}
                                        <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- ./box-body -->
                                    <div class="box-footer">
                                        <div class="row">
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                            <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                            <h5 class="description-header">Rp. 500.000.000</h5>
                                            <span class="description-text">Penjualan</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                            <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                            <h5 class="description-header">Rp. 500.000.000</h5>
                                            <span class="description-text">Pengeluaran</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                            <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                            <h5 class="description-header">Rp. 500.000.000</h5>
                                            <span class="description-text">Sisa Piutang</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block">
                                            <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                            <h5 class="description-header">Rp. 500.000.000</h5>
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
    <script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>
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
        // $(function() {
        //     $('#periode').daterangepicker({
        //         opens: 'right'
        //     }, function(ev, picker) {
        //         alert("A new date selection was made: " + val(picker.startDate.format('MM-DD-YYYY')) + ' to ' + val(picker.endDate.format('MM-DD-YYYY')));
        //         // $.ajax({
        //         //     type        :'POST',
        //         //     url         :'{{route('filter')}}',
        //         //     data        :{
        //         //                 'startDate' : start.format('MM-DD-YYYY'),
        //         //                 'endDate'   : end.format('MM-DD-YYYY')
        //         //     }
        //         //     dataType    :'json',
        //         //     async       :false,
        //         //     processData : false,
        //         //     contentType : false,
        //         //     success:function(response){
        //         //         if (response['msg']=="success"){
        //         //             swal("Berhasil !");
        //         //         }
        //         //         else{
        //         //             swal("Error !");                            
        //         //         }
        //         //     }
        //         //     error:function(response){
        //         //         swal("Error !", "Gagal menghapus transaksi !", "error");
        //         //         $('#modal_delete').modal('hide');
        //         //     }
        //         // })
        //     });
        // })
            
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
                    data: {startDate: picker.startDate.format('DD/MM/YYYY'), endDate: picker.endDate.format('DD/MM/YYYY')},
                }).done(function(response){
                    console.log(response);
                }).fail(function (error) {
                    console.log(error);
                });
            });

            $('input[name="periode"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });

        $(function () {
            
            /* ChartJS
            * -------
            * Here we will create a few charts using ChartJS
            */
            $.get('{{route('linedata')}}', function(response)
            {   
                var areaChartData = {
                    labels  : response['label'],
                    datasets: [
                        {
                        label               : 'Penjualan',
                        fillColor           : 'rgba(210, 214, 222, 1)',
                        strokeColor         : 'rgba(210, 214, 222, 1)',
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : response['value']
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
                var areaChartCanvas = $('#salesChart').get(0).getContext('2d')
                // This will get the first returned node in the jQuery collection.
                var areaChart       = new Chart(areaChartCanvas)

                areaChart.Line(areaChartData, areaChartOptions)
                // //-------------
                // //- LINE CHART -
                // //--------------
                // var lineChartCanvas          = $('#salesChart').get(0).getContext('2d')
                // var lineChart                = new Chart(lineChartCanvas)
                // var lineChartOptions         = areaChartOptions
                // lineChartOptions.datasetFill = false
                // lineChart.Line(areaChartData, lineChartOptions)
            });
        // $.get('{{route('piedata')}}', function(response)
        // {   
        //     $( document ).ready(function() {
        //         var i;
        //         for (i = 0; i < response['label'].length; i++) { 
        //             $('#'+i).text(response['label'][i]);
        //         } 
        //     });
                
        //         //-------------
        //         //- PIE CHART -
        //         //-------------
        //         // Get context with jQuery - using jQuery's .get() method.
        //         var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        //         var pieChart       = new Chart(pieChartCanvas)
        //         var PieData        = [
        //         {
        //             value    : response['value'][0],
        //             color    : '#f56954',
        //             highlight: '#f56954',
        //             label    : response['label'][0]
        //         },
        //         {
        //             value    : response['value'][1],
        //             color    : '#00a65a',
        //             highlight: '#00a65a',
        //             label    : response['label'][1]
        //         },
        //         {
        //             value    : response['value'][2],
        //             color    : '#f39c12',
        //             highlight: '#f39c12',
        //             label    : response['label'][2]
        //         },
        //         {
        //             value    : response['value'][3],
        //             color    : '#00c0ef',
        //             highlight: '#00c0ef',
        //             label    : response['label'][3]
        //         },
        //         {
        //             value    : response['value'][4],
        //             color    : '#3c8dbc',
        //             highlight: '#3c8dbc',
        //             label    : response['label'][4]
        //         }
        //         ]
        //         var pieOptions     = {
        //         //Boolean - Whether we should show a stroke on each segment
        //         segmentShowStroke    : true,
        //         //String - The colour of each segment stroke
        //         segmentStrokeColor   : '#fff',
        //         //Number - The width of each segment stroke
        //         segmentStrokeWidth   : 2,
        //         //Number - The percentage of the chart that we cut out of the middle
        //         percentageInnerCutout: 50, // This is 0 for Pie charts
        //         //Number - Amount of animation steps
        //         animationSteps       : 250,
        //         //String - Animation easing effect
        //         animationEasing      : 'easeOutBounce',
        //         //Boolean - Whether we animate the rotation of the Doughnut
        //         animateRotate        : true,
        //         //Boolean - Whether we animate scaling the Doughnut from the centre
        //         animateScale         : false,
        //         //Boolean - whether to make the chart responsive to window resizing
        //         responsive           : true,
        //         // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        //         maintainAspectRatio  : true,
        //         //String - A legend template
        //         legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        //         }
        //         //Create pie or douhnut chart
        //         // You can switch between pie and douhnut using the method below.
        //         pieChart.Doughnut(PieData, pieOptions)
        //         });
            
        })
    </script>
</body>
@endsection