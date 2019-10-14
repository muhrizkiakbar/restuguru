@extends('layouts.app')
@push('style')

    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <body class="hold-transition skin-green sidebar-mini">
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
          <form id="formtrans">
          <div class="col-md-3">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Cari Transaksi</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body">
                    <form action="{{route('stokbahanbaku')}}" method="post">
                      <div class="form-group">
                            <select class="form-control select2" id="bahanbaku_id" name="bahanbaku_id" style="width: 100%;">
                               
                                @if ($bahanbaku_id=="")
                                    <option value="" selected>Semua Bahan Baku</option>
                                @else
                                    <option value="">Semua Bahan Baku</option>
                                @endif

                                @foreach ($bahanbakus as $bahanbaku)
                                    @if (strlen($bahanbaku_id)>0)
                                        @if (($bahanbaku_id)==$bahanbaku->id)
                                        <option value="{{encrypt($bahanbaku->id)}}" selected>{{$bahanbaku->nama_bahan}}</option>
                                        @else
                                        <option value="{{encrypt($bahanbaku->id)}}">{{$bahanbaku->nama_bahan}}</option>
                                        @endif
                                    @else
                                        <option value="{{encrypt($bahanbaku->id)}}">{{$bahanbaku->nama_bahan}}</option>
                                    @endif

                                @endforeach

                            </select>
                        </label> 
                      </div>
                      @if (Auth::user()->roles->first()->name=="owner")
                        <div class="form-group">
                                <select class="form-control  pull-right" id="cabang_id" name="cabang_id" style="width: 100%;">
                                    @if ($cabang_id=="")
                                        <option value="" selected>Semua Cabang</option>
                                    @else
                                        <option value="" >Semua Cabang</option>
                                    @endif

                                    @foreach ($cabangs as $cabang)
                                        @if (strlen($cabang_id)>0)
                                            @if (decrypt($cabang_id) == $cabang->id)
                                            <option value="{{encrypt($cabang->id)}}" selected>{{$cabang->Nama_Cabang}}</option>
                                            @else
                                            <option value="{{encrypt($cabang->id)}}">{{$cabang->Nama_Cabang}}</option>
                                            @endif
                                        @else
                                            <option value="{{encrypt($cabang->id)}}">{{$cabang->Nama_Cabang}}</option>
                                        @endif
                                    @endforeach
                                    
                                </select>
                        </div>
                      @endif
                      </form>  
                                 

                      
                    </div>
                  </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" id="submitpelanggan" class="btn btn-success btn-sm">Submit <i class="fa fa-chevron-circle-right"></i></button>
                </div>
            </div>
          </div>
          </form>

          <div class="col-md-9">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Stok Bahan Baku</h3>
              </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Bahan Baku</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Hitung Luas</th>
                                <th>Cabang</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($datas as $key=>$data)
                            <tr>
                                <td>{{$data->nama_bahan}}</td>
                                @if ($data->banyakstok<=$data->batas_stok)

                                    <td>
                                        <span class="label label-danger">
                                            {{$data->banyakstok}}
                                        </span>
                                    </td>
                                @else
                                    <td>{{$data->banyakstok}}</td>
                                @endif
                                <td>{{$data->satuan}}</td>
                                @if ($data->stokhitungluas=="1")
                                    <td>Ya</td>
                                @else
                                    <td>Tidak</td>
                                @endif
                                <td>{{$data->Nama_Cabang}}</td>    
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-sm" href="/stokbahanbaku/edit/{{encrypt($data->id)}}"><i class="fa fa-edit"></i></a>
                                        <button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-id="{{encrypt($data->id)}}" data-name="{{$data->nama_bahan}}" data-target="#modal_delete"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>                                                           
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{$datas->appends(['cabang_id'=>($cabang_id),'bahanbaku_id'=>($bahanbaku_id)])->links()}}
                    </ul>
                </div>
            </div>
          </div>

        </div>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Sukses</h4>
            {{session('success')}}
        </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Gagal</h4>
                    {{session('error')}}
            </div>
        @endif

        <div class="modal modal-danger fade" id="modal_delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Hapus Stok Bahan Baku</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formdelete" action="#" method="post" role="form" enctype="multipart/form-data">
                            <h4>
                                <i class="icon fa fa-ban"></i>
                                Peringatan
                            </h4>
                            {{csrf_field()}}
                            Yakin ingin menghapus stok bahan baku <span class="label"></span>?
                            <input id="delid" name="delid" type="hidden">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="button" id="simpandel" class="btn btn-outline">Save changes</button>
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
            format: "dd-mm-yyyy",
        });

        
        $('#bahanbaku_id').select2();
        $('#cabang_id').select2();

        
      });
      

      // bagian modal delete
      
    </script>

    <script type="text/javascript">
        $(document).on('click','.modal_delete',function () {
            $('#simpandel').removeAttr('disabled');
            $('#delid').val($(this).data('id'));
            $('.label').text($(this).data('name'));
        });
    </script>
    
    <script type="text/javascript">
        $(document).on('click','#simpandel',function (){
            $('#simpandel').attr('disabled',true);

            $.ajax({
                type:'post',
                url:'{{route('deletestokbahanbaku')}}',
                data: new FormData($('#formdelete')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                        if (response=="Success"){
                            swal({ 
                                title: "Success !",
                                text: "Berhasil menghapus !",
                                type: "success" 
                                }).then(
                                function(){
                                    location.reload(true);
                                });
                            $('#modal_delete').modal('hide');
                            // oTable.ajax.reload();
                        }
                        else{
                            swal("Eror !", "Gagal menghapus !", "error");
                            $('#modal_delete').modal('hide');
                        }
                },
            });
        });
    </script>

    </body>
@endsection
