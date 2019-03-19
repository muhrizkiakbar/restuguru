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
                <h3 class="box-title">Ubah Hak Akses</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->

              <form role="form" method="post" action="/roles/edit/{{$id}}">
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body">
                      @if ($errors->has('namerole'))
                      <div class="form-group has-error">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="namerole" name="namerole" value="{{$roles->name}}" placeholder="Name">
                        <span class="help-block">{{$errors->first('namerole')}}</span>
                      </div>
                      @else
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="namerole" name="namerole" value="{{$roles->name}}" placeholder="Name">
                        <!-- {{($roles)}} -->
                      </div>
                      @endif

                      @csrf
                      @if ($errors->has('displayrole'))
                      <div class="form-group has-error">
                        <label for="displayrole">Display Role</label>
                        <input type="text" class="form-control" id="displayrole" name="displayrole" value="{{$roles['display_name']}}" placeholder="Display Role">
                        <span class="help-block">{{$errors->first('displayrole')}}</span>
                      </div>
                      @else
                      <div class="form-group">
                        <label for="displayrole">Display Role</label>
                        <input type="text" class="form-control" id="displayrole" name="displayrole" value="{{$roles->display_name}}" placeholder="Display Role">
                      </div>
                      @endif

                      @if ($errors->has('descriptionrole'))
                      <div class="form-group has-error">
                        <label for="displayrole">Description Role</label>
                        <input type="text" class="form-control" id="descriptionrole" name="descriptionrole" value="{{$roles['description']}}" placeholder="Description">
                        <span class="help-block">{{$errors->first('descriptionrole')}}</span>
                      </div>
                      @else
                      <div class="form-group ">
                        <label for="displayrole">Description Role</label>
                        <input type="text" class="form-control" id="descriptionrole" name="descriptionrole"  value="{{$roles->description}}" placeholder="Description">
                      </div>
                      @endif

                      @if ($errors->has('permissionrole'))
                      <div class="form-group has-error">
                        <label for="displayrole">Permission</label>
                        <select class="form-control select2" id="permissionrole[]" name="permissionrole[]" multiple="multiple" data-placeholder="Pilih Permission"
                        style="width: 100%;">
                          @foreach ($permissions as $permission)
                            <option value="{{$permission->id}}">{{$permission->display_name}}</option>
                          @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('permissionrole')}}</span>
                      </div>
                      @else
                      <div class="form-group ">
                        <label for="displayrole">Permission</label>
                        <select class="form-control select2" id="permissionrole[]" name="permissionrole[]" multiple="multiple" data-placeholder="Pilih Permission"
                        style="width: 100%;">
                          @foreach ($permissions as $permission)
                            <option value="{{$permission->id}}">{{$permission->display_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      @endif
                      
                    </div>
                  </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="/roles" class="btn btn-danger">Back</a>
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
        
        @foreach ($rolePermissions as $value)
                data.push("{{$value}}")
        @endforeach
        $('.select2').select2().select2().val(data).trigger('change')
        // $('#permissionrole[]').select2().val(["1","2"]).trigger('change');
      });

    </script>
    

    </body>
@endsection
