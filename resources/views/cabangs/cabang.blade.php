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

                {{-- Tabel Cabang --}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Cabang</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="modal_tambah_cabang" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah Cabang Baru
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_cabang" class="table">
                                        <thead>
                                        <tr>
                                            <th>Kode Cabang</th>
                                            <th>Nama Cabang</th>
                                            <th>No.Telepon</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Jenis Cabang</th>
                                            <th>User</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Tambah Cabang --}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Cabang Baru</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_cabang" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control" id="tambah_jenis_cabang" style="width: 100%;">
                                                    <option>Kantor Pusat</option>
                                                    <option>Kantor Cabang</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kode Cabang</label>
                                                <input id="tambah_kode_cabang" name="tambah_kode_cabang" class="form-control pull-right" type="text">
                                                {{csrf_field()}}
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Cabang</label>
                                                <input id="tambah_nama_cabang" name="tambah_nama_cabang" class="form-control pull-right" type="text">>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Telepon</label>
                                                <input id="tambah_telepon_cabang" name="tambah_telepon_cabang" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input id="tambah_email_cabang" name="tambah_email_cabang" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea id="tambah_alamat_cabang" name="tambah_alamat_cabang" class="form-control pull-right" type="text"></textarea>
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

                {{-- Modal Edit Cabang --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Cabang</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_cabang" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control" id="edit_jenis_cabang" style="width: 100%;">
                                                    <option>Kantor Pusat</option>
                                                    <option>Kantor Cabang</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kode Cabang</label>
                                                <input id="edit_kode_cabang" name="edit_kode_cabang" class="form-control pull-right" type="text">
                                                <input class="form-control" id="cabang_id" name="cabang_id" type="hidden">
                                                {{csrf_field()}}
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Cabang</label>
                                                <input id="edit_nama_cabang" name="edit_nama_cabang" class="form-control pull-right" type="text">>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Telepon</label>
                                                <input id="edit_telepon_cabang" name="edit_telepon_cabang" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input id="edit_email_cabang" name="edit_email_cabang" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea id="edit_alamat_cabang" name="edit_alamat_cabang" class="form-control pull-right" type="text"></textarea>
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

                {{-- Modal Hapus Cabang --}}
                <div class="modal modal-danger fade" id="modal_hapus">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Cabang</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus_cabang" action="" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus cabang <span class="label_nama_cabang"></span>?
                                    <input id="hapus_cabang_id" name="hapus_cabang_id" type="hidden">
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
            oTable = $('#tabel_cabang').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('dataalluser')}}',
                columns: [
                    { data: 'kode_cabang', name: 'kode_cabang' },
                    { data: 'nama_cabang', name: 'nama_cabang' },
                    { data: 'telepon', name: 'telepon' },
                    { data: 'email', name: 'email' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'jenis_cabang', name: 'jenis_cabang' },
                    { data: 'jumlah_user', name: 'jumlah_user' },
                    {data:'action'}
                ]
            });
        });
    </script>

    {{-- javascript modal tambah --}}
    <script type="text/javascript">
        $(document).on('click','#modal_tambah',function () {
            $('#tambah_jenis_cabang').val("");
            $('#tambah_kode_cabang').val("");
            $('#tambah_nama_cabang').val("");
            $('#tambah_telepon_cabang').val("");
            $('#tambah_email_cabang').val("");
            $('#tambah_alamat_cabang').val("");
            $('#modal_tambah').modal("show");
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#edit_jenis_cabang').val($(this).data('username'));
            $('#edit_kode_cabang').val($(this).data('email'));
            $('#edit_nama_cabang').val($(this).data('nama'));
            $('#edit_telepon_cabang').val("");
            $('#edit_email_cabang').val($(this).data('role'));
            $('#edit_alamat_cabang').val($(this).data('instansi'));
            $('#cabang_id').val($(this).data('id'));
        });
    </script>

    {{-- javascript modal hapus --}}
    <script type="text/javascript">
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_cabang_id').val($(this).data('id'));
            $('.label_nama_cabang').text($(this).data('username'));
        });
    </script>


    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $.ajax({
                type:'post',
                url:'{{route('storeuser')}}',
                data: new FormData($('#form_tambah_cabang')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.username)){
                            swal("tambah_kode_cabang", ""+response.errors.username+"", "error");
                        }
                        
                        if ((response.errors.nama)){
                            swal("tambah_nama_cabang", ""+response.errors.nama+"", "error");
                        }

                        if ((response.errors.password)){
                            swal("tambah_telepon_cabang", ""+response.errors.password+"", "error");
                        }

                        if ((response.errors.Telepon)){
                            swal("tambah_email_cabang", ""+response.errors.Telepon+"", "error");
                        }

                        if ((response.errors.gaji)){
                            swal("tambah_alamat_cabang", ""+response.errors.gaji+"", "error");
                        }
                        $('#modal_tambah').modal('hide');
                    }
                    else
                    {
                        $('.error').addClass('hidden');
                        $('#modal_tambah').modal('hide');
                        oTable.ajax.reload();
                    }
                },
            });
        });
    </script>

    {{-- javascript simpan edit --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_edit',function (){
            $.ajax({
                type:'post',
                url:'#',
                data: new FormData($('#form_edit_cabang')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        $('.error').removeClass('hidden');
                        $('.error').text(response.errors.name);
                    }
                    else
                    {
                        $('.error').addClass('hidden');
                        $('#modal_edit').modal('hide');
                        oTable.ajax.reload();
                    }
                },
            });
        });
    </script>

    {{-- javascript simpan hapus --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_hapus',function (){
            $.ajax({
                type:'post',
                url:'#',
                data: new FormData($('#form_hapus_cabang')[0]),
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
