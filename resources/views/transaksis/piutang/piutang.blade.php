@extends('layouts.app')
@push('style')


  <!-- daterange picker -->
  <link rel="stylesheet" href="{{secure_asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- Bootstrap Color Picker --> 
  <link rel="stylesheet" href="{{secure_asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{secure_asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{secure_asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <link rel="stylesheet" href="{{secure_asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  
  <link rel="stylesheet" href="{{secure_asset('bower_components/select2/dist/css/select2.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{secure_asset('bower_components/Ionicons/css/ionicons.min.css')}}">
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
  <link rel="stylesheet" href="{{secure_asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{secure_asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{secure_asset('plugins/iCheck/all.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{secure_asset('bower_components/select2/dist/css/select2.min.css')}}">

  <link rel="stylesheet" href="{{secure_asset('plugins/iCheck/square/blue.css')}}">
  <link rel="stylesheet" href="{{secure_asset('dist/css/skins/_all-skins.min.css')}}">
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
          <div class="col-md-3">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Cari</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body">

                      <div class="form-group">
                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{$date}}" placeholder="Tanggal">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="namapelanggan" name="namapelanggan" placeholder="Nama Pelanggan">
                      </div>
                      <div class="form-group">
                        <select id="admin" name="admin" class="form-control select2" style="width:100%;" type="text"></select>
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

          <div class="col-md-9">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"> Pelunasan Angsuran Penjualan <i class="fa fa-money"></i></h3>
              </div>

              <div class="box-body">

                <div class="row">
                  <div class="col-md-12">
                      <div class="box-body no-padding table-responsive">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <th>Nota</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>DP</th>
                            <th>Pelunasan</th>
                            <th>Sisa</th>
                            <th>Penerima</th>
                            <th>Nota Angsuran</th>
                            <th>Tool</th>
                          </thead>
                          <tbody>
                            
                            
                          </tbody>
                        </table>
                      </div>
                      
                  </div>
                </div>

              </div>

                
                
                <!-- /.box-body -->
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">

                    </ul>
                  
                </div>
            </div>
          </div>

          <div class="modal fade" id="modal_angsur">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Angsuran</h4>
                      </div>
                      <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label>Pembayaran
                                            <select class="form-control  pull-right"  id="pembayaran" name="pembayaran" style="width: 100%;">
                                                <option value="Cash">Cash</option>
                                                <option value="Transfer">Transfer</option>
                                            </select>
                                            </label>           
                                        </div>
                                        <div class="form-group">
                                            <label>Nominal</label>
                                            <input id="nominal" name="nominal" class="form-control pull-right" type="text">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" id="closeitem" data-dismiss="modal">Keluar</button>
                          <button type="button" id="lunas" class="btn btn-success"><i class="fa fa-check-circle"></i> Lunas</button>                          
                          <button type="button" id="additem" class="btn btn-success">Simpan</button>
                      </div>
                  </div>
                  <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
          </div>

          <div class="modal fade" id="modal_view">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Rincian Penjualan</h4>
                      </div>
                      <div class="modal-body">
                              <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Nama Barang</th>
                                            <th style="width: 130px">Harga Satuan</th>
                                            <th style="width: 60px">P</th>
                                            <th style="width: 60px">L</th>
                                            <th style="width: 60px">Kuantitas</th>
                                            <th style="width: 170px">Finishing</th>
                                            <th style="width: 170px">Keterangan</th>
                                            <th  style="width: 130px">Subtotal</th>
                                            <th style="width: 100px">Tool</th>
                                        </thead>
                                        <tbody>
                                            
                                            
                                        </tbody>
                                        </table>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" id="closeitem" data-dismiss="modal">Keluar</button>
                      </div>
                  </div>
                  <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
          </div>

        </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{secure_asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{secure_asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{secure_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{secure_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{secure_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- FastClick -->

    <script src="{{secure_asset('bower_components/jquery-ui/jquery-ui-new.js')}}"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{secure_asset('plugins/iCheck/icheck.min.js')}}"></script>

    <!-- bootstrap datepicker -->
    <script src="{{secure_asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>


    <script src="{{secure_asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>
    <!-- <script src="{{secure_asset('bower_components/jquery-number/jquery.number.js')}}"></script> -->

    <!-- sweet alert -->
    <script src="{{secure_asset('bower_components/sweetalert/sweetalert.min.js')}}"></script>

    <script src="{{secure_asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{secure_asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script>

     
      $(function(){

        $('input[name="tanggal"]').datepicker({
            format: "yyyy-mm-dd",
        });
    
        $('#admin').select2({
            placeholder: "Pilih Pembuat Nota.",
            minimumInputLength: 1,
            ajax: {
                url: '{{route('produkcari')}}',
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
      
    </script>
    

    </body>
@endsection
