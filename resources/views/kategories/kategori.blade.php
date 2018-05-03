@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->

<!-- sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

                {{-- Tabel Kategori --}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Kategori</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="modal_tambah_kategori" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah Kategori
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_kategori" class="table">
                                        <thead>
                                        <tr>
                                            <th>Nama Kategori</th>
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

                {{-- Modal Tambah Kategori --}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Kategori</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_kategori" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Kategori</label>
                                                <input id="tambah_nama_kategori" name="tambah_nama_kategori" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea id="tambah_keterangan" name="tambah_keterangan" class="form-control" type="text"></textarea>
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

                {{-- Modal Edit Kategori --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Kategori</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_kategori" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input class="form-control" id="kategori_id" name="kategori_id" type="hidden">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Kategori</label>
                                                <input id="edit_nama_kategori" name="edit_nama_kategori" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea id="edit_keterangan" name="edit_keterangan" class="form-control" type="text"></textarea>
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

                {{-- Modal Hapus Kategori --}}
                <div class="modal modal-danger fade" id="modal_hapus">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Kategori</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus_kategori" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    Yakin ingin menghapus kategori <span class="label_kategori"></span>?
                                    <input id="hapus_kategori_id" name="hapus_kategori_id" type="hidden">
                                </form>
                            </div>
                            <div class="modal-footer">
                                {{-- Tombol Simpan-Batal --}}
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
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{--<script src="{{asset('dist/js/demo.js')}}"></script>--}}
    <!-- Page script -->

    {{-- javascript Tabel --}}
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabel_kategori').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loadkategori')}}',
                columns: [
                    { data: 'Nama_Kategori', name: 'Nama_Kategori' },
                    { data: 'Keterangan', name: 'Keterangan' },
                    { data: 'action'}
                ]
            });
        });
    </script>

    {{-- javascript modal tambah --}}
    <script type="text/javascript">
        $(document).on('click','#modal_tambah_kategori',function () {
            $('#tambah_nama_kategori').val("");
            $('#tambah_keterangan').val("");
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#edit_nama_kategori').val($(this).data('nama_kategori'));
            $('#edit_keterangan').val($(this).data('keterangan'));
            $('#kategori_id').val($(this).data('id'));
        });
    </script>

    {{-- javascript modal hapus --}}
    <script type="text/javascript">
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_kategori_id').val($(this).data('id'));
            $('.label_kategori').text($(this).data('nama_kategori'));
        });
    </script>

    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $.ajax({
                type:'post',
                url:'{{route('storekategori')}}',
                data: new FormData($('#form_tambah_kategori')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.tambah_nama_kategori)){
                            swal("Kategori", ""+response.errors.tambah_nama_kategori+"", "error");
                        }else if ((response.errors.tambah_keterangan)){
                            swal("Kategori", ""+response.errors.tambah_keterangan+"", "error");
                        }
                        // $('#modal_tambah').modal('hide');
                    }else{
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_tambah').modal('hide');
                            oTable.ajax.reload();
                        }else{
                            wal("Error !", "Gagal menyimpan !", "error");
                            // $('#modal_tambah').modal('hide');
                        }
                    }
                },
                error:function(){
                    swal("Error !", "Gagal menyimpan !", "error");
                    // $('#modal_tambah').modal('hide');
                }
            });
        });
    </script>

    {{-- javascript simpan edit --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_edit',function (){
            $.ajax({
                type:'post',
                url:'{{route('updatekategori')}}',
                data: new FormData($('#form_edit_kategori')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.edit_nama_kategori)){
                            swal("Kategori", ""+response.errors.edit_nama_kategori+"", "error");
                        }else if ((response.errors.edit_keterangan)){
                            swal("Kategori", ""+response.errors.edit_keterangan+"", "error");
                        }
                        // $('#modal_edit').modal('hide');
                    }else{
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }else{
                            wal("Error !", "Gagal menyimpan !", "error");
                            // $('#modal_edit').modal('hide');
                        }
                    }
                },
                error:function(){
                    swal("Error !", "Gagal menyimpan !", "error");
                    // $('#modal_edit').modal('hide');
                }
            });
        });
    </script>

    {{-- javascript hapus --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_hapus',function (){
            $.ajax({
                type:'post',
                url:'{{route('deletekategori')}}',
                data: new FormData($('#form_hapus_kategori')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    $('.error').addClass('hidden');
                    $('#modal_hapus').modal('hide');
                    oTable.ajax.reload();
                },
            });
        });
    </script>

</body>
@endsection
