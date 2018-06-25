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
                                <h3 class="box-title">Pelanggan</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="modal_tambah_pelanggan" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah Pelanggan Baru
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_pelanggan" class="table">
                                        <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Status</th>
                                            <th>Jenis Pelanggan</th>
                                            <th>Nama Pemilik</th>
                                            <th>Nama Perusahaan</th>
                                            <th>No Hp</th>
                                            <th>No Telepon</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Limit</th>
                                            <th>Rekening</th>
                                            <th>KTP</th>
                                            <th>Keterangan</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Tambah Pelanggan --}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Pelanggan Baru</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_pelanggan" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control" placeholder="Jenis Pelanggan" name="tambah_jenis_pelanggan" id="tambah_jenis_pelanggan" style="width: 100%;">
                                                        <option value="null" disabled selected>Jenis Pelanggan</option>
                                                    @foreach ($jenispelanggans as $jenispelanggan)
                                                        <option value="{{encrypt($jenispelanggan->id)}}">{{$jenispelanggan->jenis_pelanggan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label>Nama Pemilik</label>
                                                <input id="tambah_namapemilik" name="tambah_namapemilik" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>No KTP</label>
                                                <input id="tambah_ktppelanggan" name="tambah_ktppelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Handphone</label>
                                                <input id="tambah_hppelanggan" name="tambah_hppelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Perusahaan</label>
                                                <input id="tambah_namaperusahaan" name="tambah_namaperusahaan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Telepon Kantor</label>
                                                <input id="tambah_teleponpelanggan" name="tambah_teleponpelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input id="tambah_emailpelanggan" name="tambah_emailpelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input id="tambah_alamatpelanggan" name="tambah_alamatpelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempo Tagihan</label>
                                                <input id="tambah_tempotagihan" name="tambah_tempotagihan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Limit Tagihan</label>
                                                <input id="tambah_limittagihan" name="tambah_limittagihan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>No Rekening</label>
                                                <input id="tambah_rekpelanggan" name="tambah_rekpelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea id="tambah_keterangan" name="tambah_keterangan" rows="3" class="form-control pull-right" type="text"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="tambah_statuspelanggan" id="tambah_statuspelanggan" style="width: 100%;">
                                                    <option value="1" selected>Aktif</option>
                                                    <option value="0">Tidak Aktif</option>
                                                </select>
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
                                <h4 class="modal-title">Edit Pelanggan</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_pelanggan" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control" placeholder="Jenis Pelanggan" name="edit_jenis_pelanggan" id="edit_jenis_pelanggan" style="width: 100%;">
                                                        <option disabled selected>Jenis Pelanggan</option>
                                                    @foreach ($jenispelanggans as $jenispelanggan)
                                                        <option value="{{encrypt($jenispelanggan->id)}}">{{$jenispelanggan->jenis_pelanggan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label>Nama Pemilik</label>
                                                <input id="edit_namapemilik" name="edit_namapemilik" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>No KTP</label>
                                                <input id="edit_ktppelanggan" name="edit_ktppelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Handphone</label>
                                                <input id="edit_hppelanggan" name="edit_hppelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Perusahaan</label>
                                                <input id="edit_namaperusahaan" name="edit_namaperusahaan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Telepon Kantor</label>
                                                <input id="edit_teleponpelanggan" name="edit_teleponpelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input id="edit_emailpelanggan" name="edit_emailpelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input id="edit_alamatpelanggan" name="edit_alamatpelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempo Tagihan</label>
                                                <input id="edit_tempotagihan" name="edit_tempotagihan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Limit Tagihan</label>
                                                <input id="edit_limittagihan" name="edit_limittagihan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>No Rekening</label>
                                                <input id="edit_rekpelanggan" name="edit_rekpelanggan" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea id="edit_keterangan" name="edit_keterangan" rows="3" class="form-control pull-right" type="text"></textarea>
                                            </div>
                                            <input type="hidden" id="pelanggan_id" name="pelanggan_id">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="edit_statuspelanggan" id="edit_statuspelanggan" style="width: 100%;">
                                                    <option value=1 selected>Aktif</option>
                                                    <option value=0>Tidak Aktif</option>
                                                </select>
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
                                <h4 class="modal-title">Hapus Pelanggan</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus_pelanggan" action="" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus pelanggan <span class="label_nama_pelanggan"></span>?
                                    <input id="hapus_pelanggan_id" name="hapus_pelanggan_id" type="hidden">
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
    {{-- Swal --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{--<script src="{{asset('dist/js/demo.js')}}"></script>--}}
    <!-- Page script -->
    
    {{-- javascript Tabel --}}
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabel_pelanggan').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loaddatapelanggan')}}',
                columns: [
                    { data: 'action'},
                    { data: 'Pelanggans.status_pelanggan', name: 'status_pelanggan' },
                    { data: 'jenis_pelanggan', name: 'jenis_pelanggan' },
                    { data: 'nama_pemilik', name: 'nama_pemilik' },
                    { data: 'nama_perusahaan', name: 'nama_perusahaan' },
                    { data: 'hp_pelanggan', name: 'hp_pelangganEmail' },
                    { data: 'telpon_pelanggan', name: 'telpon_pelanggan' },
                    { data: 'email_pelanggan', name: 'email_pelanggan' },
                    { data: 'alamat_pelanggan', name: 'alamat_pelanggan' },
                    { data: 'tempo_pelanggan', name: 'tempo_pelanggan' },
                    { data: 'limit_pelanggan', name: 'limit_pelanggan' },
                    { data: 'norek_pelanggan', name: 'norek_pelanggan' },
                    { data: 'ktp', name: 'ktp' },
                    { data: 'keterangan_pelanggan', name: 'keterangan_pelanggan' }
                    
                ]
            });
        });
    </script>

    {{-- javascript modal tambah --}}
    <script type="text/javascript">
        $(document).on('click','#modal_tambah_pelanggan',function () {
            // $('#tambah_jenis_cabang').val("");
            $('#tambah_namapemilik').val("");
            $('#tambah_ktppelanggan').val("");
            $('#tambah_hppelanggan').val("");
            $('#tambah_namaperusahaan').val("");
            $('#tambah_teleponpelanggan').val("");
            $('#tambah_emailpelanggan').val("");
            $('#tambah_alamatpelanggan').val("");
            $('#tambah_tempotagihan').val("");
            $('#tambah_limittagihan').val("");
            $('#tambah_rekpelanggan').val("");
            $('#tambah_keterangan').val("");
            $('#modal_tambah').modal("show");
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#edit_namapemilik').val($(this).data('nama_pemilik'));
            $('#edit_ktppelanggan').val($(this).data('ktp'));
            $('#edit_hppelanggan').val($(this).data('hp_pelanggan'));
            $('#edit_namaperusahaan').val($(this).data('nama_perusahaan'));
            $('#edit_teleponpelanggan').val($(this).data('telpon_pelanggan'));
            $('#edit_emailpelanggan').val($(this).data('email_pelanggan'));
            $('#edit_alamatpelanggan').val($(this).data('alamat_pelanggan'));
            $('#edit_tempotagihan').val($(this).data('tempo_pelanggan'));
            $('#edit_limittagihan').val($(this).data('limit_pelanggan'));
            $('#edit_rekpelanggan').val($(this).data('norek_pelanggan'));
            $('#edit_keterangan').val($(this).data('keterangan_pelanggan'));
            $('#pelanggan_id').val($(this).data('id'));
        });
    </script>

    {{-- javascript modal hapus --}}
    <script type="text/javascript">
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_pelanggan_id').val($(this).data('id'));
            $('.label_nama_pelanggan').text($(this).data('nama_pemilik'));
        });
    </script>


    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $.ajax({
                type:'post',
                url:'{{route('storepelanggan')}}',
                data: new FormData($('#form_tambah_pelanggan')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.tambah_namapemilik)){
                            swal("Nama Pemilik", ""+response.errors.tambah_namapemilik+"", "error");
                        }

                        if ((response.errors.tambah_ktppelanggan)){
                            swal("No KTP", ""+response.errors.tambah_ktppelanggan+"", "error");
                        }
                        
                        if ((response.errors.tambah_hppelanggan)){
                            swal("Handphone", ""+response.errors.tambah_hppelanggan+"", "error");
                        }

                        if ((response.errors.tambah_namaperusahaan)){
                            swal("Perusahaan", ""+response.errors.tambah_namaperusahaan+"", "error");
                        }

                        if ((response.errors.tambah_teleponpelanggan)){
                            swal("Telepon Kantor", ""+response.errors.tambah_teleponpelanggan+"", "error");
                        }

                        if ((response.errors.tambah_emailpelanggan)){
                            swal("Email", ""+response.errors.tambah_emailpelanggan+"", "error");
                        }

                        if ((response.errors.tambah_alamatpelanggan)){
                            swal("Alamat", ""+response.errors.tambah_alamatpelanggan+"", "error");
                        }

                        if ((response.errors.tambah_tempotagihan)){
                            swal("Tempo Tagihan", ""+response.errors.tambah_tempotagihan+"", "error");
                        }
                        
                        if ((response.errors.tambah_limittagihan)){
                            swal("Limit Tagihan", ""+response.errors.tambah_limittagihan+"", "error");
                        }

                        if ((response.errors.tambah_rekpelanggan)){
                            swal("No Rekening", ""+response.errors.tambah_rekpelanggan+"", "error");
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
                url:'{{route('updatepelanggan')}}',
                data: new FormData($('#form_edit_pelanggan')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        
                        if ((response.errors.edit_jenis_pelanggan)){
                            swal("Jenis Pelanggan", ""+response.errors.edit_jenis_pelanggan+"", "error");
                        }

                        if ((response.errors.edit_namapemilik)){
                            swal("Nama Pemilik", ""+response.errors.edit_namapemilik+"", "error");
                        }

                        if ((response.errors.edit_ktppelanggan)){
                            swal("No KTP", ""+response.errors.edit_ktppelanggan+"", "error");
                        }
                        
                        if ((response.errors.edit_hppelanggan)){
                            swal("Handphone", ""+response.errors.edit_hppelanggan+"", "error");
                        }

                        if ((response.errors.edit_namaperusahaan)){
                            swal("Perusahaan", ""+response.errors.edit_namaperusahaan+"", "error");
                        }

                        if ((response.errors.edit_teleponpelanggan)){
                            swal("Telepon Kantor", ""+response.errors.edit_teleponpelanggan+"", "error");
                        }

                        if ((response.errors.edit_emailpelanggan)){
                            swal("Email", ""+response.errors.edit_emailpelanggan+"", "error");
                        }

                        if ((response.errors.edit_alamatpelanggan)){
                            swal("Alamat", ""+response.errors.edit_alamatpelanggan+"", "error");
                        }

                        if ((response.errors.edit_tempotagihan)){
                            swal("Tempo Tagihan", ""+response.errors.edit_tempotagihan+"", "error");
                        }
                        
                        if ((response.errors.edit_limittagihan)){
                            swal("Limit Tagihan", ""+response.errors.edit_limittagihan+"", "error");
                        }

                        if ((response.errors.edit_rekpelanggan)){
                            swal("No Rekening", ""+response.errors.edit_rekpelanggan+"", "error");
                        }
                        // $('#modal_edit').modal('hide');
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
                url:'{{route('deletepelanggan')}}',
                data: new FormData($('#form_hapus_pelanggan')[0]),
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
