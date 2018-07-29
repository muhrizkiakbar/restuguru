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

                {{-- Tabel Nama Menu --}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Nama Menu</h3>
                            </div>
                            <div class="box-body">
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_menuname" class="table">
                                        <thead>
                                        <tr>
                                            <th>Akses</th>
                                            <th>Nama Menu</th>
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Edit Nama Menu --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Nama Menu</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_menuname" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input class="form-control" id="menuname_id" name="menuname_id" type="hidden">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Akses</label>
                                                <input id="aksesname" name="aksesname" class="form-control" type="text" readonly="readonly">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Menu</label>
                                                <input id="edit_nama_menu" name="edit_nama_menu" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea id="edit_deskripsi" name="edit_deskripsi" class="form-control" type="text"></textarea>
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
            oTable = $('#tabel_menuname').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loadmenuname')}}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'display_name', name: 'display_name' },
                    { data: 'description', name: 'description' },
                    { data: 'action'}
                ]
            });
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#aksesname').val($(this).data('akses'));
            $('#edit_nama_menu').val($(this).data('nama'));
            $('#edit_deskripsi').val($(this).data('deskripsi'));
            $('#menuname_id').val($(this).data('id'));
        });
    </script>

    {{-- javascript simpan edit --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_edit',function (){
            $.ajax({
                type:'post',
                url:'{{route('updatemenuname')}}',
                data: new FormData($('#form_edit_menuname')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.edit_nama_menu)){
                            swal("Nama Menu", ""+response.errors.edit_nama_menu+"", "error");
                        }
                    }else{
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }else{
                            wal("Error !", "Gagal menyimpan !", "error");
                        }
                    }
                },
                error:function(){
                    swal("Error !", "Gagal menyimpan !", "error");
                }
            });
        });
    </script>

</body>
@endsection
