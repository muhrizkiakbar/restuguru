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
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">

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

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Harga Khusus Jenis Pelanggan</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="modal_tambah_spg" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah Harga Khusus Baru
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_spg" class="table">
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
                </div>

                {{-- Modal Tambah Jenis Pelanggan --}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Harga Khusus</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_spg" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jenis Pelanggan</label>
                                                <select id="tambah_jenispelanggan" name="tambah_jenispelanggan" class="form-control select2" style="width:100%;" type="text">
                                                    <option selected></option>
                                                    @foreach ($jenispelanggan as $jenispelanggan)
                                                        <option value="{{encrypt($jenispelanggan->id)}}">{{$jenispelanggan->jenis_pelanggan}}</option>
                                                    @endforeach
                                                </select>
                                                {{csrf_field()}}
                                            </div>
                                            <div class="form-group">
                                                <label>Produk</label>
                                                <select id="tambah_produk" name="tambah_produk" class="form-control select2" style="width:100%;" type="text"></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Khusus</label>
                                                <input id="tambah_harga_khusus" name="tambah_harga_khusus" class="form-control pull-right" type="text">
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

                {{-- Modal Edit Jenis pelanggan --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Harga Khusus</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_spg" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jenis Pelanggan</label>
                                                <select id="edit_jenispelanggan" name="edit_jenispelanggan" class="form-control" style="width:100%;" type="text">
                                                </select>
                                                {{csrf_field()}}
                                                <input id="id_edit_jenispelanggan" name="id_edit_jenispelanggan" class="form-control pull-right" type="hidden">
                                            </div>
                                            <div class="form-group">
                                                <label>Produk</label>
                                                <select id="edit_produk" name="edit_produk" class="form-control" style="width:100%;" type="text"></select>
                                                <input id="id_edit_produk" name="id_edit_produk" class="form-control pull-right" type="hidden">                                            </div>
                                            <div class="form-group">
                                                <label>Harga Khusus</label>
                                                <input id="edit_harga_khusus" name="edit_harga_khusus" class="form-control pull-right" type="text">
                                                <input id="id_spg" name="id_spg" class="form-control pull-right" type="hidden">
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
                                <h4 class="modal-title">Hapus Harga Khusus</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus_spg" action="" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus Harga Khusus untuk jenis pelanggan <b><span class="label_jenispelanggan"></span></b>
                                    pada produk <b><span class="label_produk"></span></b> dengan harga <b>Rp. <span class="label_harga"></span></b> ?
                                    <input id="hapus_spg_id" name="hapus_spg_id" type="hidden">
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
    <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>

    <!-- AdminLTE for demo purposes -->
    {{--<script src="{{asset('dist/js/demo.js')}}"></script>--}}
    <!-- Page script -->
    
    {{-- javascript Tabel --}}
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabel_spg').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loaddata')}}',
                columns: [
                    { data: 'jenis_pelanggan', name: 'jenis_pelanggan' },
                    { data: 'nama_produk', name: 'nama_produk'},
                    { data: 'harga_khusus', name: 'harga_khusus'},
                    { data: 'updated_at', name: 'updated_at'},
                    { data: 'username', name: 'username'},
                    { data: 'action'}
                ]
            });
        });
    </script>

    {{-- javascript modal tambah --}}
    
    <script type="text/javascript">
        $(document).on('click','#bt_batal_tambah',function () {
            $("#tambah_jenispelanggan").val(null).trigger('change');
            $("#tambah_produk").val(null).trigger('change');
            $("#tambah_harga_khusus").maskMoney('mask',0);
        });
    </script>


    <script type="text/javascript">
        $(function(){
            $('#tambah_produk').select2({
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
                minimumResultsForSearch: Infinity,
            });

            $("#tambah_harga_khusus").maskMoney({prefix:'Rp ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $("#tambah_harga_khusus").maskMoney('mask',0)
            $("#tambah_harga_khusus").on('blur',function(){
                $("#tambah_harga_khusus").maskMoney('mask')
            });

        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(function(){
            $('#edit_produk').select2({
                placeholder: "Pilih Produk.",
                disabled: true,
            });

            $('#edit_jenispelanggan').select2({
                placeholder: "Pilih Jenis Pelanggan.",
                disabled: true,
            });

            $("#edit_harga_khusus").maskMoney({prefix:'Rp ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $("#edit_harga_khusus").maskMoney('mask',0)
            $("#edit_harga_khusus").on('blur',function(){
                $("#edit_harga_khusus").maskMoney('mask')
            });

        });
    </script>

    <script type="text/javascript">
        
        $(document).on('click','.modal_edit',function () {
            var datajenis = {
                id: $(this).data('jenis_id'),
                text: $(this).data('jenis')
            };
            var dataproduk = {
                id: $(this).data('produk_id'),
                text: $(this).data('produk')
            };
            var oJenis = new Option(datajenis.text, datajenis.id, false, false);
            var oProduk = new Option(dataproduk.text, dataproduk.id, false, false);
            $('#id_edit_jenispelanggan').val($(this).data('jenis_id'));
            $('#id_edit_produk').val($(this).data('produk_id')); 
            $('#edit_jenispelanggan').append(oJenis).trigger('change');
            $('#edit_produk').append(oProduk).trigger('change');
            $("#edit_harga_khusus").val($(this).data('harga')).trigger('mask.maskMoney');
            $('#id_spg').val($(this).data('id'))
        });
    </script>

    {{-- javascript modal hapus --}}
    <script type="text/javascript">
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_spg_id').val($(this).data('id'));
            $('.label_jenispelanggan').text($(this).data('jenis'));
            $('.label_produk').text($(this).data('produk'));
            $('.label_harga').text($(this).data('harga'));
        });
    </script>


    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $("#tambah_harga_khusus").val($("#tambah_harga_khusus").maskMoney('unmasked')[0]);
            $.ajax({
                type:'post',
                url:'{{route('storespg')}}',
                data: new FormData($('#form_tambah_spg')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        $("#tambah_harga_khusus").trigger('mask.maskMoney');
                        if ((response.errors.tambah_jenispelanggan)){
                            swal("Jenis Pelanggan", ""+response.errors.tambah_jenispelanggan+"", "error");
                        }
                        if ((response.errors.tambah_produk)){
                            swal("Produk", ""+response.errors.tambah_produk+"", "error");
                        }
                        if ((response.errors.tambah_harga_khusus)){
                            swal("Harga Khusus", ""+response.errors.tambah_harga_khusus+"", "error");
                        }
                        // $('#modal_tambah').modal('hide');
                    }
                    else
                    {   if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#tambah_jenispelanggan').val(null).trigger('change');
                            $('#tambah_produk').val(null).trigger('change');
                            $("#tambah_harga_khusus").val(null).trigger('mask.maskMoney');
                            $('#modal_tambah').modal('hide');
                            oTable.ajax.reload();
                        }
                        else if (response=="Duplicated"){
                            $("#tambah_harga_khusus").val(0).trigger('mask.maskMoney');
                            $('#tambah_jenispelanggan').val(null).trigger('change');
                            $('#tambah_produk').val(null).trigger('change');
                            swal("Error !", "Duplikasi Data !", "error");
                            
                        }
                        else if (response=="Failed"){
                            $("#tambah_harga_khusus").trigger('mask.maskMoney');
                            swal("Error !", "Gagal menyimpan !", "error");
                        }
                    }
                },
                error:function(){
                    $("#tambah_harga_khusus").trigger('mask.maskMoney');
                    swal("Error !", "Gagal, menyimpan !", "error");
                }
            });
        });
    </script>

    {{-- javascript simpan edit --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_edit',function (){
            $("#edit_harga_khusus").val($("#edit_harga_khusus").maskMoney('unmasked')[0]);
            $.ajax({
                type:'post',
                url:'{{route('updatespg')}}',
                data: new FormData($('#form_edit_spg')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        $("#edit_harga_khusus").trigger('mask.maskMoney');
                        if ((response.errors.id_edit_jenispelanggan)){
                            swal("Jenis Pelanggan", ""+response.errors.id_edit_jenispelanggan+"", "error");
                        }
                        if ((response.errors.id_edit_produk)){
                            swal("Produk", ""+response.errors.id_edit_produk+"", "error");
                        }
                        if ((response.errors.edit_harga_khusus)){
                            swal("Harga Khusus", ""+response.errors.edit_harga_khusus+"", "error");
                        }
                        // $('#modal_edit').modal('hide');
                    }
                    else
                    {   if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#edit_jenispelanggan').val(null).trigger('change');
                            $('#edit_produk').val(null).trigger('change');
                            $("#edit_harga_khusus").val(null).trigger('mask.maskMoney');
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }
                        else if (response=="Duplicated"){
                            $("#edit_harga_khusus").trigger('mask.maskMoney');
                            swal("Error !", "Duplikasi Data !", "error");
                            
                        }
                        else if (response=="Failed"){
                            $("#edit_harga_khusus").trigger('mask.maskMoney');
                            swal("Error !", "Gagal menyimpan !", "error");
                        }
                    }
                },
                error:function(){
                    $("#edit_harga_khusus").trigger('mask.maskMoney');
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
                url:'{{route('deletespg')}}',
                data: new FormData($('#form_hapus_spg')[0]),
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
                        swal("Error !", "Gagal menyimpan !", "error");
                        // $('#modal_edit').modal('hide');
                    }
                },
            });
        });
    </script>

</body>
@endsection
