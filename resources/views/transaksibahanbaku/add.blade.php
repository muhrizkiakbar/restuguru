@extends('layouts.app')
@push('style')


  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
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
<style>
select{
  font-family:'FontAwesome', Helvetica
}
option{
  font-family:'FontAwesome', Helvetica
}
</style>
<link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
@endpush

@section('body')
    <body class="hold-transition skin-blue sidebar-mini">
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
                <h3 class="box-title">Tambah Transaksi Bahan Baku</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('storetransaksibahanbaku')}}">
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body">
                      @if ($errors->has('bahanbaku_transaksibahanbaku'))
                      <div class="form-group has-error">
                        <label for="displayrole">Bahan Baku</label>
                        <select class="form-control select2" id="bahanbaku_transaksibahanbaku" name="bahanbaku_transaksibahanbaku">
                            @foreach ($bahanbakus as $bahanbaku)
                              <option value="{{encrypt($bahanbaku->id)}}" data-id="{{$bahanbaku->id}}">{{$bahanbaku->nama_bahan}}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('bahanbaku_transaksibahanbaku')}}</span>
                      </div>
                      @else
                      <div class="form-group">
                        <label for="displayrole">Bahan Baku</label>
                        <select class="form-control select2" id="bahanbaku_transaksibahanbaku" name="bahanbaku_transaksibahanbaku">
                              <option value="" selected>Pilih Bahan Baku</option>

                            @foreach ($bahanbakus as $bahanbaku)
                              <option value="{{encrypt($bahanbaku->id)}}">{{$bahanbaku->nama_bahan}}</option>
                            @endforeach
                        </select>
                      </div>
                      @endif

                      @if ($errors->has('cabangtujuan_transaksibahanbaku'))
                      <div class="form-group has-error">
                        <label for="displayrole">Cabang</label>
                        <select class="form-control select2" id="cabangtujuan_transaksibahanbaku" name="cabangtujuan_transaksibahanbaku">
                            @foreach ($cabangs as $cabang)
                              <option value="{{encrypt($cabang->id)}}">{{$cabang->Nama_Cabang}}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('cabangtujuan_transaksibahanbaku')}}</span>
                      </div>
                      @else
                      <div class="form-group">
                        <label for="displayrole">Cabang</label>
                        <select class="form-control select2" id="cabangtujuan_transaksibahanbaku" name="cabangtujuan_transaksibahanbaku">
                            @foreach ($cabangs as $cabang)
                              <option value="{{encrypt($cabang->id)}}">{{$cabang->Nama_Cabang}}</option>
                            @endforeach
                        </select>
                      </div>
                      @endif

                      @if ($errors->has('banyak_transaksibahanbaku'))
                      <div class="form-group has-error">
                        <label for="name">Banyak</label>
                        <input type="text" class="form-control" id="banyak_transaksibahanbaku" name="banyak_transaksibahanbaku" placeholder="Banyak">
                        <span class="help-block">{{$errors->first('banyak_transaksibahanbaku')}}</span>
                      </div>
                      @else
                      <div class="form-group">
                        <label for="name">Banyak</label>
                        <input type="text" class="form-control" id="banyak_transaksibahanbaku" name="banyak_transaksibahanbaku" placeholder="Banyak">
                      </div>
                      @endif
                      
                      <div class="form-group">
                        <label for="displayrole">Satuan</label>
                        <input type="text" class="form-control" id="satuan_transaksibahanbaku" name="satuan_transaksibahanbaku" disabled placeholder="Satuan">
                      </div>

                      <div class="form-group">
                        <label for="name">Keterangan</label>
                        <textarea id="keterangan_transaksibahanbaku" name="keterangan_transaksibahanbaku" class="form-control" type="text"></textarea>
                      </div>


                      @csrf
                    </div>
                  </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="/transaksi/bahan" class="btn btn-danger">Back</a>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

        $('.select2').select2()

        $('#bahanbaku_transaksibahanbaku').on('select2:select', function (e) {
          console.log(e.params.data)
          var id=e.params.data.id;

          $.ajax({

            type:'get',
            url:'{{route('bahanbakuharga')}}',
            data: 'id='+id,
            dataType:'json',
            async:false,
            processData: false,
            contentType: false,
            success:function(response){
                
                $('#satuan_transaksibahanbaku').val((response.satuan));  
            },
            error: function(xhr, status, error) {
              console.log('s')
            }
          });
        });
      });

    </script>
    

    </body>
@endsection
