@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{secure_asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{secure_asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{secure_asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->

<!-- sweet alert -->
<script src="{{secure_asset('bower_components/sweetalert/sweetalert.min.js')}}"></script>
<!-- Select2 -->
<link rel="stylesheet" href="{{secure_asset('bower_components/select2/dist/css/select2.min.css')}}">

<link rel="stylesheet" href="{{secure_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

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

                {{-- Tabel Supplier --}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Supplier</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="modal_tambah_supplier" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah Supplier
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_supplier" class="table">
                                        <thead>
                                        <tr>
                                            <th>Nama Supplier</th>
                                            <th>Pemilik</th>
                                            <th>Telepon</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Rekening</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Tambah Supplier --}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Supplier</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_supplier" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Supplier</label>
                                                <input id="tambah_nama_supplier" name="tambah_nama_supplier" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Pemilik</label>
                                                <input id="tambah_pemilik_supplier" name="tambah_pemilik_supplier" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Telepon</label>
                                                <input id="tambah_telpon_supplier" name="tambah_telpon_supplier" class="form-control" type="text" maxlength="13">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input id="tambah_email_supplier" name="tambah_email_supplier" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea id="tambah_alamat_supplier" name="tambah_alamat_supplier" class="form-control" type="text"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Rekening</label>
                                                <input id="tambah_rekening_suppliers" name="tambah_rekening_suppliers" class="form-control" type="text" maxlength="30">
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea id="tambah_keterangan_suppliers" name="tambah_keterangan_suppliers" class="form-control" type="text"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                {{-- Tombol Simpan-Batal --}}
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="bt_simpan_tambah" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Edit Supplier --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Supplier</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_supplier" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input class="form-control" id="supplier_id" name="supplier_id" type="hidden">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Supplier</label>
                                                <input id="edit_nama_supplier" name="edit_nama_supplier" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Pemilik</label>
                                                <input id="edit_pemilik_supplier" name="edit_pemilik_supplier" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Telepon</label>
                                                <input id="edit_telpon_supplier" name="edit_telpon_supplier" class="form-control" type="text" maxlength="13">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input id="edit_email_supplier" name="edit_email_supplier" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea id="edit_alamat_supplier" name="edit_alamat_supplier" class="form-control" type="text"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Rekening</label>
                                                <input id="edit_rekening_suppliers" name="edit_rekening_suppliers" class="form-control" type="text" maxlength="30">
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea id="edit_keterangan_suppliers" name="edit_keterangan_suppliers" class="form-control" type="text"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                {{-- Tombol Simpan-Batal --}}
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="bt_simpan_edit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Hapus Supplier --}}
                <div class="modal modal-danger fade" id="modal_hapus">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Supplier</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus_supplier" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    Yakin ingin menghapus supplier <span class="label_supplier"></span>?
                                    <input id="hapus_supplier_id" name="hapus_supplier_id" type="hidden">
                                </form>
                            </div>
                            <div class="modal-footer">
                                {{-- Tombol Hapus-Batal --}}
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="bt_simpan_hapus" class="btn btn-success">Hapus</button>
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
    <script src="{{secure_asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{secure_asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{secure_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{secure_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{secure_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{secure_asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{secure_asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{--<script src="{{secure_asset('dist/js/demo.js')}}"></script>--}}
    <!-- Page script -->

    {{-- Init JS --}}
    <script type="text/javascript">
        $(function(){
            $('input[name="tambah_telpon_supplier"],input[name="tambah_rekening_suppliers"],input[name="edit_telpon_supplier"],input[name="edit_rekening_suppliers"]').bind('keypress', function(e){
                var keyCode = (e.which)?e.which:event.keyCode
                return !(keyCode>31 && (keyCode<48 || keyCode>57));
            });
        });
    </script>

    {{-- javascript Tabel --}}
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabel_supplier').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loadsupplier')}}',
                columns: [
                    { data: 'nama_supplier', name: 'nama_supplier' },
                    { data: 'pemilik_supplier', name: 'pemilik_supplier' },
                    { data: 'telpon_supplier', name: 'telpon_supplier' },
                    { data: 'email_supplier', name: 'email_supplier' },
                    { data: 'alamat_supplier', name: 'alamat_supplier' },
                    { data: 'rekening_suppliers', name: 'rekening_suppliers' },
                    { data: 'keterangan_suppliers', name: 'keterangan_suppliers' },
                    { data: 'action'}
                ]
            });
        });
    </script>

    {{-- javascript modal tambah --}}
    <script type="text/javascript">
        $(document).on('click','#modal_tambah_supplier',function () {
            $('#bt_simpan_tambah').removeAttr('disabled');
            $('#tambah_nama_supplier').val("");
            $('#tambah_pemilik_supplier').val("");
            $('#tambah_telpon_supplier').val("");
            $('#tambah_email_supplier').val("");
            $('#tambah_alamat_supplier').val("");
            $('#tambah_rekening_suppliers').val("");
            $('#tambah_keterangan_suppliers').val("");
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#bt_simpan_edit').removeAttr('disabled');
            $('#edit_nama_supplier').val($(this).data('nama_supplier'));
            $('#edit_pemilik_supplier').val($(this).data('pemilik_supplier'));
            $('#edit_telpon_supplier').val($(this).data('telpon_supplier'));
            $('#edit_email_supplier').val($(this).data('email_supplier'));
            $('#edit_alamat_supplier').val($(this).data('alamat_supplier'));
            $('#edit_rekening_suppliers').val($(this).data('rekening_suppliers'));
            $('#edit_keterangan_suppliers').val($(this).data('keterangan_suppliers'));
            $('#supplier_id').val($(this).data('id'));
        });
    </script>

    {{-- javascript modal hapus --}}
    <script type="text/javascript">
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_supplier_id').val($(this).data('id'));
            $('.label_supplier').text($(this).data('nama_supplier'));
        });
    </script>

    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $('#bt_simpan_tambah').attr('disabled',true);
            $.ajax({
                type:'post',
                url:'{{route('storesupplier')}}',
                data: new FormData($('#form_tambah_supplier')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.tambah_nama_supplier)){
                            swal("Supplier", ""+response.errors.tambah_nama_supplier+"", "error");
                        } else if ((response.errors.tambah_pemilik_supplier)){
                            swal("Supplier", ""+response.errors.tambah_pemilik_supplier+"", "error");
                        } else if ((response.errors.tambah_telpon_supplier)){
                            swal("Supplier", ""+response.errors.tambah_telpon_supplier+"", "error");
                        } else if ((response.errors.tambah_email_supplier)){
                            swal("Supplier", ""+response.errors.tambah_email_supplier+"", "error");
                        } else if ((response.errors.tambah_alamat_supplier)){
                            swal("Supplier", ""+response.errors.tambah_alamat_supplier+"", "error");
                        } else if ((response.errors.tambah_rekening_suppliers)){
                            swal("Supplier", ""+response.errors.tambah_rekening_suppliers+"", "error");
                        } else if ((response.errors.tambah_keterangan_suppliers)){
                            swal("Supplier", ""+response.errors.tambah_keterangan_suppliers+"", "error");
                        }
                        // $('#modal_tambah').modal('hide');
                    }else{
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_tambah').modal('hide');
                            oTable.ajax.reload();
                        }else{
                            swal("Error !", "Gagal menyimpan !", "error");
                            // $('#modal_tambah').modal('hide');
                        }
                    }
                    $('#bt_simpan_tambah').removeAttr('disabled');
                },
                error:function(){
                    swal("Error !", "Gagal menyimpan !", "error");
                    $('#bt_simpan_tambah').removeAttr('disabled');
                }
            });
        });
    </script>

    {{-- javascript simpan edit --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_edit',function (){
            $('#bt_simpan_edit').attr('disabled',true);
            $.ajax({
                type:'post',
                url:'{{route('updatesupplier')}}',
                data: new FormData($('#form_edit_supplier')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.edit_nama_supplier)){
                            swal("Supplier", ""+response.errors.edit_nama_supplier+"", "error");
                        } else if ((response.errors.edit_pemilik_supplier)){
                            swal("Supplier", ""+response.errors.edit_pemilik_supplier+"", "error");
                        } else if ((response.errors.edit_telpon_supplier)){
                            swal("Supplier", ""+response.errors.edit_telpon_supplier+"", "error");
                        } else if ((response.errors.edit_email_supplier)){
                            swal("Supplier", ""+response.errors.edit_email_supplier+"", "error");
                        } else if ((response.errors.edit_alamat_supplier)){
                            swal("Supplier", ""+response.errors.edit_alamat_supplier+"", "error");
                        } else if ((response.errors.edit_rekening_suppliers)){
                            swal("Supplier", ""+response.errors.edit_rekening_suppliers+"", "error");
                        } else if ((response.errors.edit_keterangan_suppliers)){
                            swal("Supplier", ""+response.errors.edit_keterangan_suppliers+"", "error");
                        }
                        // $('#modal_edit').modal('hide');
                    }else{
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }else{
                            swal("Error !", "Gagal menyimpan !", "error");
                            // $('#modal_edit').modal('hide');
                        }
                    }
                    $('#bt_simpan_edit').removeAttr('disabled');
                },
                error:function(){
                    swal("Error !", "Gagal menyimpan !", "error");
                    $('#bt_simpan_edit').removeAttr('disabled');
                }
            });
        });
    </script>

    {{-- javascript hapus --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_hapus',function (){
            $.ajax({
                type:'post',
                url:'{{route('deletesupplier')}}',
                data: new FormData($('#form_hapus_supplier')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if (response=="Success"){
                        swal("Success !", "Berhasil menghapus !", "success");
                        $('.error').addClass('hidden');
                        $('#modal_hapus').modal('hide');
                        oTable.ajax.reload();
                    }else{
                        swal("Error !", "Gagal menghapus !", "error");
                        // $('#modal_edit').modal('hide');
                    }
                },
                error:function(){
                    swal("Error !", "Gagal menghapus !", "error");
                }
            });
        });
    </script>

</body>
@endsection
