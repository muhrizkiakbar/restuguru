@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">

<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endpush

@section('body')
    <body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">

      @include('layouts.header')

      @include('layouts.sidebar')

      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Form Layout</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Minimal</label>
                                                <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" class="flat-red"> Flat green skin checkbox
                                            </div>
                                            <div class="form-group">
                                                <label>Date:</label>

                                                <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div> 
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Transaksi</h3>
                                </div>
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <div class="panel box box-success">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                    Collapsible Group Item #1
                                                </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Task</th>
                                                        <th>Progress</th>
                                                        <th style="width: 40px">Label</th>
                                                        </tr>
                                                        <tr>
                                                        <td>1.</td>
                                                        <td>Update software</td>
                                                        <td>
                                                            <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-red">55%</span></td>
                                                        </tr>
                                                        <tr>
                                                        <td>2.</td>
                                                        <td>Clean database</td>
                                                        <td>
                                                            <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-yellow">70%</span></td>
                                                        </tr>
                                                        <tr>
                                                        <td>3.</td>
                                                        <td>Cron job running</td>
                                                        <td>
                                                            <div class="progress progress-xs progress-striped active">
                                                            <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-light-blue">30%</span></td>
                                                        </tr>
                                                        <tr>
                                                        <td>4.</td>
                                                        <td>Fix and squish bugs</td>
                                                        <td>
                                                            <div class="progress progress-xs progress-striped active">
                                                            <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-green">90%</span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-success">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                    Collapsible Group Item #1
                                                </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Task</th>
                                                        <th>Progress</th>
                                                        <th style="width: 40px">Label</th>
                                                        </tr>
                                                        <tr>
                                                        <td>1.</td>
                                                        <td>Update software</td>
                                                        <td>
                                                            <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-red">55%</span></td>
                                                        </tr>
                                                        <tr>
                                                        <td>2.</td>
                                                        <td>Clean database</td>
                                                        <td>
                                                            <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-yellow">70%</span></td>
                                                        </tr>
                                                        <tr>
                                                        <td>3.</td>
                                                        <td>Cron job running</td>
                                                        <td>
                                                            <div class="progress progress-xs progress-striped active">
                                                            <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-light-blue">30%</span></td>
                                                        </tr>
                                                        <tr>
                                                        <td>4.</td>
                                                        <td>Fix and squish bugs</td>
                                                        <td>
                                                            <div class="progress progress-xs progress-striped active">
                                                            <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-green">90%</span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    footer
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Manajemen User</h3>
                                </div>
                                <div class="box-body">
                                    <button type="button" id="modal_add2" class="btn btn-primary" data-toggle="modal" data-target="#modal_add">
                                        Tambah
                                    </button>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="tableaja" class="table">
                                            <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Nama</th>
                                                <th>Telpon</th>
                                                <th>Gaji</th>
                                                <th>Alamat</th>
                                                <th>Reff</th>
                                                <th>Tool</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="modal_add">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Manajemen User</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="error alert-danger alert-dismissible">
                                    </div>
                                    <form id="formuseradd" action="" method="post" role="form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input id="username" name="username" class="form-control pull-right" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input id="email" name="email" class="form-control pull-right" type="email">
                                                    {{csrf_field()}}
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input id="password" name="password" class="form-control pull-right" type="password">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input id="nama" name="nama" class="form-control pull-right" type="text">
                                                </div>
                                                <div class="form-group" >
                                                    <label>Instansi</label>
                                                    <select class="form-control select2" id="instansi" name="instansi" style="width: 100%;">
                                                        
                                                            <option value="tes"></option>
                                                        

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Level</label>
                                                    <select class="form-control select2" id="role" name="role" style="width: 100%;">
                                                    
                                                            <option value="wwe">sdasd</option>
                                                        

                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="button" id="simpanadduser" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <div class="modal modal-warning fade" id="modal_edit">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Edit User</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="error alert-danger alert-dismissible">
                                    </div>
                                    <form id="formedituser" action="" method="post" role="form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input id="username2" readonly name="username2" class="form-control pull-right" type="text">
                                                    <input class="form-control" id="iduser" name="iduser" type="hidden">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input id="email2" readonly name="email2" class="form-control pull-right" type="email">
                                                    {{csrf_field()}}
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input id="password2" name="password2" class="form-control pull-right" type="password">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input id="nama2" name="nama2" class="form-control pull-right" type="text">
                                                </div>
                                                <div class="form-group" >
                                                    <label>Instansi</label>
                                                    <select class="form-control select2" id="instansi2" name="instansi2" style="width: 100%;">
                                                    
                                                            <option value="asdasd">asdasdasd</option>
                                                    

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Level</label>
                                                    <select class="form-control select2" id="role2" name="role2" style="width: 100%;">
                                                        
                                                            <option value="asd">asdasd</option>
                                                        
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                    <button type="button" id="simpanedituser" class="btn btn-outline">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    
                    <!-- /.modal -->
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

    <!-- bootstrap icheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>


    <!-- bootstrap datepicker -->
    <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <!-- DataTables -->
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- Page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
            })

            $('#datepicker').datepicker({
            autoclose: true
            })
        })

    </script>
    </body>
@endsection
