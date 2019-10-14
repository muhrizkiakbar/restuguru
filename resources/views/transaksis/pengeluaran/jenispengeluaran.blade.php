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
<!-- Ionicons -->
<link rel="stylesheet" href="{{secure_asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<link rel="stylesheet" href="{{secure_asset('dist/css/skins/_all-skins.min.css')}}">

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

                {{-- Tabel--}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Jenis Pengeluaran</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="tombol_tambah" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah Baru
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel" class="table">
                                        <thead>
                                        <tr>
                                            <th>Jenis Pengeluaran</th>
                                            <th>Angsuran</th>
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

                {{-- Modal Tambah--}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Jenis Pengeluaran Baru</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jenis Pengeluaran</label>
                                                <input id="tambah_jenisPengeluaran" name="tambah_jenisPengeluaran" class="form-control pull-right" type="text">
                                                {{csrf_field()}}
                                            </div>
                                            <div class="form-group">
                                                <label>Angsuran</label>
                                                <select id="tambah_sifatAngsuran" name="tambah_sifatAngsuran" class="form-control select2" style="width:100%;" type="text">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Form Mode</label>
                                                <select id="tambah_mode" name="tambah_mode" class="form-control select2" style="width:100%;" type="text">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea id="tambah_keterangan" name="tambah_keterangan" class="form-control pull-right" type="text"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                {{-- Tombol Simpan-Batal --}}
                                <button type="button" id="bt_batal_tambah" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="bt_simpan_tambah" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Modal Edit --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Jenis Pengeluaran</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jenis Pengeluaran</label>
                                                <input id="edit_jenisPengeluaran" name="edit_jenisPengeluaran" class="form-control pull-right" type="text">
                                                {{csrf_field()}}
                                            </div>
                                            <div class="form-group">
                                                <label>Angsuran</label>
                                                <select id="edit_sifatAngsuran" name="edit_sifatAngsuran" class="form-control select2" style="width:100%;" type="text">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Form Mode</label>
                                                <select id="edit_mode" name="edit_mode" class="form-control select2" style="width:100%;" type="text">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea id="edit_keterangan" name="edit_keterangan" class="form-control pull-right" type="text"></textarea>
                                                <input id="id_edit" name="id_edit" type="hidden">
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

                {{-- Modal Hapus --}}
                <div class="modal modal-danger fade" id="modal_hapus">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Jenis Pengeluaran</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus" action="" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus jenis pengeluaran <b><span class="label_jenispengeluaran"></span></b> ?
                                    <input id="hapus_id" name="hapus_id" type="hidden">
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
    <script src="{{secure_asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>

    <!-- AdminLTE for demo purposes -->
    {{--<script src="{{secure_asset('dist/js/demo.js')}}"></script>--}}
    <!-- Page script -->
    
    {{-- Select2 --}}
    <script type="text/javascript">
        var data = [
            {
                id: 0,
                text: 'Tidak'
            },
            {
                id: 1,
                text: 'Ya'
            }
        ];

        var mode=[
            {
                id:'mode_luas',
                text:'Mode Luas'
            },
            {
                id:'mode_pencairan',
                text:'Mode Pencairan'
            },
            {
                id:'mode_satuan',
                text:'Mode Satuan'
            }
        ]

        $(function(){
            $('#tambah_sifatAngsuran').select2({
                placeholder: "Angsuran",
                minimumResultsForSearch: Infinity,
                data: data
            });
            $('#edit_sifatAngsuran').select2({
                placeholder: "Angsuran",
                minimumResultsForSearch: Infinity,
                data: data
            });
            $('#tambah_mode').select2({
                placeholder: "Form Mode",
                minimumResultsForSearch: Infinity,
                data: mode
            });
            $('#edit_mode').select2({
                placeholder: "Form Mode",
                minimumResultsForSearch: Infinity,
                data: mode
            });
        });

        function bersihkan(){
            $("#tambah_jenisPengeluaran").val(null);
            $("#tambah_sifatAngsuran").val(null).trigger('change');
            $("#tambah_mode").val(null).trigger('change');
            $("#tambah_keterangan").val(null);
        };
    </script>

    {{-- javascript Tabel --}}
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loadjenispengeluaran')}}',
                columns: [
                    { data: 'jenis_pengeluaran', name: 'jenis_pengeluaran' },
                    { data: 'sifat_angsuran', name: 'sifat_angsuran'},
                    { data: 'keterangan', name: 'keterangan'},
                    { data: 'action'}
                ]
            });
        });
    </script>

    {{-- Tambah JS --}}
    <script type="text/javascript"> 
        // Tombol Batal
        $(document).on('click','#bt_batal_tambah',function () {
            bersihkan();
        });
        // Tombol Simpan
        $(document).on('click','#bt_simpan_tambah',function (){
            $.ajax({
                type:'post',
                url:'{{route('storejenispengeluaran')}}',
                data: new FormData($('#form_tambah')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.tambah_jenisPengeluaran)){
                            swal("Jenis Pengeluaran", ""+response.errors.tambah_jenisPengeluaran+"", "error");
                        }
                        if ((response.errors.tambah_sifatAngsuran)){
                            swal("Sifat Angsuran", ""+response.errors.tambah_sifatAngsuran+"", "error");
                        }
                        if ((response.errors.tambah_mode)){
                            swal("Form Mode", ""+response.errors.tambah_mode+"", "error");
                        }
                    }
                    else
                    {   if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            bersihkan();
                            oTable.ajax.reload();
                        }
                        else if (response=="Duplicated"){
                            swal("Error !", "Duplikasi Data !", "error");
                            
                        }
                        else if (response=="Failed"){
                            swal("Error !", "Gagal menyimpan !", "error");
                        }

                    }
                    $('#modal_tambah').modal('hide');
                },
                error:function(){
                    swal("Error !", "Gagal, menyimpan !", "error");
                }
            });
        });
    </script>

    {{-- Edit --}}
    <script type="text/javascript">
    // Add Data to Edit Modal
        $(document).on('click','.modal_edit',function () {
            $('#edit_sifatAngsuran').val($(this).data('angsuran')).trigger('change');
            $('#edit_mode').val($(this).data('mode')).trigger('change');
            $("#edit_jenisPengeluaran").val($(this).data('jenis'));
            $("#edit_keterangan").val($(this).data('keterangan'));
            $('#id_edit').val($(this).data('id'))
        });
    // Tombol Simpan
        $(document).on('click','#bt_simpan_edit',function (){
            $.ajax({
                type:'post',
                url:'{{route('updatejenispengeluaran')}}',
                data: new FormData($('#form_edit')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.edit_jenisPengeluaran)){
                            swal("Jenis Pelanggan", ""+response.errors.edit_jenisPengeluaran+"", "error");
                        }
                        if ((response.errors.edit_sifatAngsuran)){
                            swal("Produk", ""+response.errors.edit_sifatAngsuran+"", "error");
                        }
                        // $('#modal_tambah').modal('hide');
                    }
                    else
                    {   if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }
                        else if (response=="Failed"){
                            swal("Error !", "Gagal menyimpan !", "error");
                        }
                    }
                },
                error:function(){
                    swal("Error !", "Gagal, menyimpan !", "error");
                }
            });
        });
    </script>

    {{-- Hapus --}}
    <script type="text/javascript">
    // Modal
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_id').val($(this).data('id'));
            $('.label_jenispengeluaran').text($(this).data('jenis'));
        });
    // Tombol
        $(document).on('click','#bt_simpan_hapus',function (){
            $.ajax({
                type:'post',
                url:'{{route('deletejenispengeluaran')}}',
                data: new FormData($('#form_hapus')[0]),
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
