@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{secure_asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{secure_asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{secure_asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{secure_asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{secure_asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{secure_asset('plugins/iCheck/all.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{secure_asset('bower_components/select2/dist/css/select2.min.css')}}">

<link rel="stylesheet" href="{{secure_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

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
                    <div class="col-xs-12">
                        <div class="box box-warning">
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
                                            <th>Cabang</th>
                                            <th>Hak Akses</th>
                                            <th width="50px">Tool</th>
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
                                                <input id="username" name="username" class="form-control pull-right" maxlength="20" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input id="nama" name="nama" class="form-control pull-right" type="text">
                                                {{csrf_field()}}
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input id="password" name="password" class="form-control pull-right" type="password">
                                            </div>
                                            <div class="form-group">
                                                <label>Telepon</label>
                                                <input id="Telepon" name="Telepon" class="form-control pull-right" maxlength="13" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Gaji</label>
                                                <input id="gaji" name="gaji" class="form-control pull-right" type="text" maxlength="20" value="0">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea id="alamat" name="alamat" class="form-control pull-right" type="text"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Cabang</label>
                                                <select class="form-control select2" id="cabang_id" name="cabang_id" style="width: 100%;">
                                                    @foreach ($cabangs as $cabang)
                                                        <option value="{{encrypt($cabang->id)}}">{{$cabang->Nama_Cabang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Level</label>
                                                <select class="form-control select2" id="role" name="role" style="width: 100%;">
                                                    @foreach ($roles as $role)
                                                        <option value="{{encrypt($role->id)}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" id="simpanadduser" class="btn btn-success">Save</button>
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
                                                <input id="username2" name="username2" class="form-control pull-right" maxlength="20" disabled type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input id="nama2" name="nama2" class="form-control pull-right" type="text">
                                                {{csrf_field()}}
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input id="password2" name="password2" class="form-control pull-right" type="password">
                                            </div>
                                            <input type="hidden" id="iduser2" name="iduser2">
                                            <div class="form-group">
                                                <label>Telepon</label>
                                                <input id="Telepon2" name="Telepon2" class="form-control pull-right" maxlength="13" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Gaji</label>
                                                <input id="gaji2" name="gaji2" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea id="alamat2" name="alamat2" class="form-control pull-right" type="text"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Cabang</label>
                                                <select class="form-control select2" id="cabang_id2" name="cabang_id2" style="width: 100%;">
                                                    @foreach ($cabangs as $cabang)
                                                        <option value="{{($cabang->id)}}">{{$cabang->Nama_Cabang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Level</label>
                                                <select class="form-control select2" id="role2" name="role2" style="width: 100%;">
                                                    @foreach ($roles as $role)
                                                        <option value="{{($role->id)}}">{{$role->name}}</option>
                                                    @endforeach
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

                <div class="modal modal-danger fade" id="modal_delete">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus User</h4>
                            </div>
                            <div class="modal-body">
                                <form id="formdeleteuser" action="" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus user <span class="labelusername"></span>?
                                    <input id="deliduser" name="deliduser" type="hidden">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                <button type="button" id="simpandeluser" class="btn btn-outline">Save changes</button>
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
    <script src="{{secure_asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{secure_asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{secure_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{secure_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{secure_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- FastClick -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <!-- sweet alert -->
    <script src="{{secure_asset('bower_components/sweetalert/sweetalert.min.js')}}"></script>

    <script src="{{secure_asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{secure_asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- Page script -->
    <script>
        numeral.register('locale', 'idr', {
            delimiters: {
                thousands: '.',
                decimal: ','
            },
            abbreviations: {
                thousand: 'ribu',
                million: 'juta',
                billion: 'ratus juta',
                trillion: 'milyar'
            },
            currency: {
                symbol: 'Rp'
            }
        });
        $(function () {
            numeral.locale('idr');
            //Initialize Select2 Elements
            $('.select2').select2()
            $('#Telepon,#Telepon2').bind('keypress', function(e){
                var keyCode = (e.which)?e.which:event.keyCode
                return !(keyCode>31 && (keyCode<48 || keyCode>57));
            });
            $('#gaji,#gaji2').bind('keypress', function(e){
                gaji = numeral($(this).val()).value();
                if(String(gaji).length==13){
                    return false;
                }
                var keyCode = (e.which)?e.which:event.keyCode
                return !(keyCode>31 && (keyCode<48 || keyCode>57));
            });
            $('#username,#username2').bind('keypress', function(e){
                var keyCode = (e.which)?e.which:event.keyCode
                return !(keyCode==32);
            });

            $("#gaji,#gaji2").keyup(function (e) {
                // console.log(numeral($("#gaji").val()).format('$ 0,0'));
                gaji = numeral($(this).val()).format('$ 0,0');
                $(this).val(gaji);
            });
        })
    </script>
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tableaja').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('dataalluser')}}',
                columns: [
                    { data: 'username', name: 'username' },
                    { data: 'nama', name: 'nama' },
                    { data: 'Telepon', name: 'Telepon' },
                    { data: 'gaji', name: 'gaji' },
                    { data: 'Alamat', name: 'Alamat' },
                    { data: 'Nama_Cabang', name: 'Nama_Cabang' },
                    { data: 'name', name: 'name' },
                    {data:'action'}
                ]
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('click','#modal_add2',function () {
            $('#simpanadduser').removeAttr('disabled');

            $('#username').val("");
            $('#password').val("");
            $('#nama').val("");
            $('#gaji').val("0");
            $('#Telepon').val("");
            $('#alamat').val("");
            $('#modal_add').modal("show");
        });
    </script>

    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            // alert($(this).data('telepon'));
            $('#simpanedituser').removeAttr('disabled');
            $('#username2').val($(this).data('username'));
            $('#password2').val("");
            $('#nama2').val($(this).data('nama'));
            gaji = numeral($(this).data('gaji')).format('$ 0,0');
            $('#gaji2').val(gaji);
            $('#Telepon2').val($(this).data('telepon'));
            $('#alamat2').val($(this).data('alamat'));
            // $('#cabang_id2').val($(this).data('cabang')).change();
            // $('#cabang_id2').select2("val",$(this).data('cabang'));
            $('#cabang_id2').select2().val($(this).data('cabang')).trigger('change');
            $('#role2').select2().val($(this).data('role')).trigger('change');
            $('#iduser2').val($(this).data('id'));
        });
    </script>

    <script type="text/javascript">
        $(document).on('click','.modal_delete',function () {
            $('#simpandeluser').removeAttr('disabled');
            $('#deliduser').val($(this).data('id'));
            $('.labelusername').text($(this).data('username'));
        });
    </script>

    <script type="text/javascript">

        $(document).on('click','#simpanadduser',function (){

            $('#simpanadduser').attr('disabled',true);

            gaji = numeral($("#gaji").val()).value();
            $("#gaji").val(gaji);
            $.ajax({
                type:'post',
                url:'{{route('storeuser')}}',
                data: new FormData($('#formuseradd')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.username)){
                            swal("Username", ""+response.errors.username+"", "error");
                        }
                        
                        else if ((response.errors.nama)){
                            swal("Nama", ""+response.errors.nama+"", "error");
                        }

                        else if ((response.errors.password)){
                            swal("Password", ""+response.errors.password+"", "error");
                        }

                        else if ((response.errors.Telepon)){
                            swal("Telepon", ""+response.errors.Telepon+"", "error");
                        }

                        else if ((response.errors.gaji)){
                            swal("Gaji", ""+response.errors.gaji+"", "error");
                        }

                        else if ((response.errors.alamat)){
                            swal("Alamat", ""+response.errors.alamat+"", "error");
                        }
                        // $('#modal_add').modal('hide');
                        gaji = numeral(gaji).format('$ 0,0');
                        $("#gaji").val(gaji);
                    }
                    else
                    {
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_add').modal('hide');
                            oTable.ajax.reload();
                        }
                        else{
                            wal("Eror !", "Gagal menyimpan !", "error");
                            gaji = numeral(gaji).format('$ 0,0');
                            $("#gaji").val(gaji);
                            // $('#modal_add').modal('hide');
                        }
                        
                    }
                },
                error:function(){
                    swal("Eror !", "Gagal menyimpan !", "error");
                    gaji = numeral(gaji).format('$ 0,0');
                    $("#gaji").val(gaji);
                    // $('#modal_add').modal('hide');
                }
            });
        });
    </script>
    
    <script type="text/javascript">
        $(document).on('click','#simpanedituser',function (){
            $('#simpanedituser').attr('disabled',true);

            gaji = numeral($("#gaji2").val()).value();
            $("#gaji2").val(gaji);
            $.ajax({
                type:'post',
                url:'{{route('updateuser')}}',
                data: new FormData($('#formedituser')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.nama2)){
                            swal("Nama", ""+response.errors.nama2+"", "error");
                        }

                        else if ((response.errors.password2)){
                            swal("Password", ""+response.errors.password2+"", "error");
                        }

                        else if ((response.errors.Telepon2)){
                            swal("Telepon", ""+response.errors.Telepon2+"", "error");
                        }

                        else if ((response.errors.gaji2)){
                            swal("Gaji", ""+response.errors.gaji2+"", "error");
                        }

                        else if ((response.errors.alamat2)){
                            swal("Alamat", ""+response.errors.alamat2+"", "error");
                        }
                        // $('#modal_add').modal('hide');
                        gaji = numeral(gaji).format('$ 0,0');
                        $("#gaji2").val(gaji);
                    }
                    else
                    {
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }
                        else{
                            wal("Eror !", "Gagal menyimpan !", "error");
                            gaji = numeral(gaji).format('$ 0,0');
                            $("#gaji2").val(gaji);
                            // $('#modal_edit').modal('hide');
                        }
                        
                    }
                },
                error:function(){
                    swal("Eror !", "Gagal menyimpan !", "error");
                    gaji = numeral(gaji).format('$ 0,0');
                    $("#gaji2").val(gaji);
                    // $('#modal_edit').modal('hide');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).on('click','#simpandeluser',function (){
            $('#simpandeluser').attr('disabled',true);
            $.ajax({
                type:'post',
                url:'{{route('deleteuser')}}',
                data: new FormData($('#formdeleteuser')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                        if (response=="Success"){
                            swal("Success !", "Berhasil menghapus !", "success");
                            $('#modal_delete').modal('hide');
                            oTable.ajax.reload();
                        }
                        else{
                            wal("Eror !", "Gagal menghapus !", "error");
                            $('#modal_delete').modal('hide');
                        }
                },
            });
        });
    </script>
    </body>
@endsection
