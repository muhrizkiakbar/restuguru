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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Menu</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->

              <form role="form" method="post" action="/menu/edit/{{$id}}">
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body">
                      @if ($errors->has('namemenu'))
                      <div class="form-group has-error">
                        <label for="name">Name Menu</label>
                        <input type="text" class="form-control" id="namemenu" name="namemenu" value="{{$kategorimenu->namakategorimenu}}" placeholder="Name Submenu">
                        <span class="help-block">{{$errors->first('namemenu')}}</span>
                      </div>
                      @else
                      <div class="form-group">
                        <label for="name">Name Menu</label>
                        <input type="text" class="form-control" id="namemenu" name="namemenu" value="{{$kategorimenu->namakategorimenu}}" placeholder="Name Submenu">
                      </div>
                      @endif

                      @csrf
                      @if ($errors->has('icon'))
                      <div class="form-group has-error">
                        <label for="displayrole">Icon</label>
                        <input type="text" id="icon" name="icon" value="{{$kategorimenu->icon}}" class="input input1 form-control">                        
                        <span class="help-block">{{$errors->first('icon')}}</span>
                      </div>
                      @else
                      <div class="form-group">
                        <label for="displayrole">Icon</label>
                        <input type="text" id="icon" name="icon" value="{{$kategorimenu->icon}}" class="input input1 form-control">                        
                      </div>
                      @endif

                      <div class="form-group ">
                        <label for="displayrole">Permission</label>
                        <select class="form-control select2" id="page[]" name="page[]" multiple="multiple" data-placeholder="Pilih Permission"
                        style="width: 100%;">
                          @foreach ($permissions as $permission)
                            <option value="{{$permission->id}}">{{$permission->display_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="/menu" class="btn btn-danger">Back</a>
                </div>
                

              </form>
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

    <link rel="stylesheet" href="{{asset('bower_components/jquery-iconpicker/simple-iconpicker.min.css')}}">
    <script src="{{asset('bower_components/jquery-iconpicker/simple-iconpicker.min.js')}}"></script>

    <script>
      $(document).ready(function(){
        $('.input1').iconpicker(".input1");
      });
    </script>

    <!-- iCheck 1.0.1 -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- sweet alert -->
    <script src="{{asset('bower_components/sweetalert/sweetalert.min.js')}}"></script>

    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script>
      $(function(){
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        })
        var data=[];
        
        @foreach ($data as $value)
                data.push("{{$value}}")
        @endforeach
        $('.select2').select2().select2().val(data).trigger('change')
        // $('#permissionrole[]').select2().val(["1","2"]).trigger('change');
      });

    </script>
    

    </body>
@endsection
