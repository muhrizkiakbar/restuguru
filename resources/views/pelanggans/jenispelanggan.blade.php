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
    <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

        @include('layouts.header')

        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">

                {{-- Tabel Jenis pelanggan --}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Jenis Pelanggan</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="modal_tambah_jenispelanggan" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah Jenis Pelanggan
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_jenispelanggan" class="table">
                                        <thead>
                                        <tr>
                                            <th>Jenis Pelanggan</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Tambah Jenis Pelanggan --}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Jenis Pelanggan Baru</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_jenispelanggan" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jenis Pelanggan</label>
                                                <input id="tambah_jenispelanggan" name="tambah_jenispelanggan" class="form-control pull-right" type="text">
                                                {{csrf_field()}}
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

                {{-- Modal Edit Jenis pelanggan --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Jenis Pelanggan</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_jenispelanggan" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jenis Pelanggan</label>
                                                <input id="edit_jenispelanggan" name="edit_jenispelanggan" class="form-control pull-right" type="text">
                                                <input class="form-control" id="jenispelanggan_id" name="jenispelanggan_id" type="hidden">
                                                {{csrf_field()}}
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

                {{-- Modal Hapus Jenis Pelanggan --}}
                <div class="modal modal-danger fade" id="modal_hapus">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Jenis Pelanggan</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus_jenispelanggan" action="" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus jenis pelanggan <span class="label_jenispelanggan"></span>?
                                    <input id="hapus_jenispelanggan_id" name="hapus_jenispelanggan_id" type="hidden">
                                </form>
                            </div>
                            <div class="modal-footer">
                                {{-- Tombol Simpan-Batal --}}
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="bt_simpan_hapus" class="btn btn-success">Simpan</button>
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
            oTable = $('#tabel_jenispelanggan').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loadjenispelanggan')}}',
                columns: [
                    { data: 'jenis_pelanggan', name: 'jenis_pelanggan' },
                    { data: 'action'}
                ]
            });
        });
    </script>

    {{-- javascript modal tambah --}}
    <script type="text/javascript">
        $(document).on('click','#modal_tambah_jenispelanggan',function () {
            $('#bt_simpan_tambah').removeAttr('disabled');
            $('#tambah_jenispelanggan').val("");
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#bt_simpan_edit').removeAttr('disabled');
            $('#edit_jenispelanggan').val($(this).data('jenis'));
            $('#jenispelanggan_id').val($(this).data('id'));
        });
    </script>

    {{-- javascript modal hapus --}}
    <script type="text/javascript">
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_jenispelanggan_id').val($(this).data('id'));
            $('.label_jenispelanggan').text($(this).data('jenis'));
        });
    </script>


    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $('#bt_simpan_tambah').attr('disabled',true);
            $.ajax({
                type:'post',
                url:'{{route('storejenispelanggan')}}',
                data: new FormData($('#form_tambah_jenispelanggan')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.tambah_jenispelanggan)){
                            swal("Jenis Pelanggan", ""+response.errors.tambah_jenispelanggan+"", "error");
                        }
                        // $('#modal_tambah').modal('hide');
                    }
                    else
                    {   if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_tambah').modal('hide');
                            oTable.ajax.reload();
                        }
                        else{
                            swal("Error !", "Gagal menyimpan !", "error");
                            $('#modal_tambah').modal('hide');
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
                url:'{{route('updatejenispelanggan')}}',
                data: new FormData($('#form_edit_jenispelanggan')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.edit_jenispelanggan)){
                            swal("Jenis Pelanggan", ""+response.errors.edit_jenispelanggan+"", "error");
                        }
                        $('#modal_edit').modal('hide');
                    }
                    else
                    {   if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }
                        else{
                            swal("Error !", "Gagal menyimpan !", "error");
                            $('#modal_edit').modal('hide');
                        }
                    }
                    $('#bt_simpan_edit').removeAttr('disabled');
                },
                error:function(){
                    swal("Error !", "Gagal menyimpan !", "error");
                    $('#bt_simpan_edit').removeAttr('disabled');
                            // $('#modal_edit').modal('hide');
                }
            });
        });
    </script>

    {{-- javascript simpan hapus --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_hapus',function (){
            $.ajax({
                type:'post',
                url:'{{route('deletejenispelanggan')}}',
                data: new FormData($('#form_hapus_jenispelanggan')[0]),
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
