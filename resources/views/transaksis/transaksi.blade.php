@extends('layouts.app')
@push('style')


  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
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

<link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
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
            <!-- form addrole         -->
        
        <div class="row">
          <!-- left column -->
          <div class="col-md-2">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Pelanggan</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body">

                      <div class="form-group">
                        <input type="text" class="form-control" id="namerole" name="namerole" placeholder="Nama Pelanggan">

                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="namerole" name="namerole" placeholder="Nomor Handphone">

                      </div>

                      @csrf
                      
                    </div>
                  </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" id="submitpelanggan" class="btn btn-success btn-sm">Submit <i class="fa fa-chevron-circle-right"></i></button>
                </div>
            </div>
          </div>

          <div class="col-md-10">
          <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Trolly <i class="fa  fa-shopping-cart"></i></h3>
              </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="tanggal">No. Nota : </label><span id="nonota"></span>
                      </div>

                      
                        <div class="form-group">
                          <label for="tanggal">Tanggal</label>
                          <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="Nomor Handphone">
                        </div>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="tanggal">Kepada : </label><span id="kepadalabel"></span>
                      </div>

                      <div class="form-group">
                        <label for="tanggal">Nomor Handphone : </label><span id="handphonelabel"></span>
                      </div>

                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-12">
                      <div class="box-body no-padding">
                        <table class="table table-striped">
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
                
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" id="submitpelanggan" class="btn btn-primary">Submit</button>
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

    <!-- iCheck 1.0.1 -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script>
      $(function(){
       
      });

    </script>
    

    </body>
@endsection
