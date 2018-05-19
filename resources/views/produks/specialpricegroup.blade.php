@extends('layouts.app')
@push('style')

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Bootstrap Color Picker --> 
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">

<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->
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
<!-- sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">

<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

<link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
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

                {{-- Tabel Jenis pelanggan --}}
                <div class="row">

                    {{-- Form Tambah --}}
                    <form id="form_tambah_specialpricegroup" action="" method="post" role="form" enctype="multipart/form-data">
                    <div class="col-md-2">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Tambah Harga Khusus Group</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                
                                        <div class="form-group">
                                            <label>Jenis Pelanggan</label>
                                            <select id="tambah_jenispelanggan" name="tambah_jenispelanggan" class="form-control select2" style="width:100%;" type="text"></select>
                                            <input id="tambah_jenispelangganid" name="tambah_jenispelangganid" class="form-control" type="hidden">
                                            {{csrf_field()}}
                                        </div>
                                        <div class="form-group">
                                            <label>Produk</label>
                                            <select id="add_produk" name="add_produk" class="form-control select2" style="width:100%;" type="text"></select>
                                            <input id="add_produkid" name="add_produkid" class="form-control" type="hidden">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Khusus</label>
                                            <input id="harga_khusus" name="harga_khusus" class="form-control pull-right" type="text">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" id="bt_simpan_tambah" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                    </form>
                    
                    <div class="col-md-10">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Jenis Pelanggan</h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="tabel_jenispelanggan" class="table">
                                        <thead>
                                        <tr>
                                            <th>Jenis Pelanggan</th>
                                            <th>Produk</th>
                                            <th>Harga Khusus</th>
                                            <th>Tanggal</th>
                                            <th>User</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
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

                </div>

                {{-- Modal Tambah--}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Harga Khusus Group</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_jenispelanggan" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Jenis Pelanggan</label>
                                                <select id="tambah_jenispelanggan" name="tambah_jenispelanggan" class="form-control select2" style="width:100%;" type="text"></select>
                                                <input id="tambah_jenispelangganid" name="tambah_jenispelangganid" class="form-control" type="hidden">
                                                {{csrf_field()}}
                                            </div>                                            <div class="form-group">
                                            <div class="form-group">
                                                <label>Produk</label>
                                                <select id="add_produk" name="add_produk" class="form-control select2" style="width:100%;" type="text"></select>
                                                <input id="add_produkid" name="add_produkid" class="form-control" type="hidden">
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Pelanggan</label>
                                                <select id="add_produk" name="add_produk" class="form-control select2" style="width:100%;" type="text"></select>
                                                <input id="add_produkid" name="add_produkid" class="form-control" type="hidden">
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
                    { data: 'produk', name:'produk'},
                    { data: 'harga_khusus', name:'harga_khusus'},
                    { data: 'tanggal', name:'tanggal'},
                    { data: 'user', name:'user'},
                    { data: 'action'}
                ]
            });
        });
    </script>

    {{-- javascript modal tambah --}}
    <script type="text/javascript">
        $(document).on('click','#modal_tambah_jenispelanggan',function () {
            $('#tambah_jenispelanggan').val("");
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
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
                        $('#modal_tambah').modal('hide');
                    }
                    else
                    {   if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_tambah').modal('hide');
                            oTable.ajax.reload();
                        }
                        else{
                            wal("Error !", "Gagal menyimpan !", "error");
                            $('#modal_tambah').modal('hide');
                        }
                    }
                },
                error:function(){
                            swal("Error !", "Gagal menyimpan !", "error");
                            $('#modal_tambah').modal('hide');
                }
            });
        });
    </script>

    {{-- javascript simpan edit --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_edit',function (){
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
                            wal("Error !", "Gagal menyimpan !", "error");
                            $('#modal_edit').modal('hide');
                        }
                    }
                },
                error:function(){
                            swal("Error !", "Gagal menyimpan !", "error");
                            $('#modal_edit').modal('hide');
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
                    $('.error').addClass('hidden');
                    $('#modal_hapus').modal('hide');
                    oTable.ajax.reload();
                },
            });
        });
    </script>

    <script>
        $(function(){
            $('#add_produk').select2({
                placeholder: "Pilih Produk.",
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
            $('#tambah_jenispelanggan').select2({
                placeholder: "Pilih Jenis Pelanggan.",
                minimumInputLength: 1,
                ajax: {
                    url: '{{route('jenispelanggancari')}}',
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
