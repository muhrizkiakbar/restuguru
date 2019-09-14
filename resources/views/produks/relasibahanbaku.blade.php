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
    <body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">

        @include('layouts.header')

        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">

                {{-- Tabel Relasi Bahan Baku --}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Relasi Bahan Baku</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="modal_tambah_relasi" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah Relasi
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_relasi_bahan_baku" class="table">
                                        <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Bahan Baku</th>
                                            <th>Qty per Transaksi</th>
                                            <th style="width: 80px;">Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Tambah Relasi Bahan Baku --}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Relasi Bahan Baku</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_relasi" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control select2" name="tambah_r_produk" id="tambah_r_produk" style="width: 100%;">
                                                        <option disabled selected>Produk</option>
                                                    @foreach ($produks as $produk)
                                                        <option value="{{encrypt($produk->id)}}">{{$produk->nama_produk}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Bahan Baku" name="tambah_r_bahan_baku" id="tambah_r_bahan_baku" style="width: 100%;">
                                                        <option disabled selected>Bahan Baku</option>
                                                    @foreach ($bahanbakus as $bahanbaku)
                                                        <option value="{{encrypt($bahanbaku->id)}}">{{$bahanbaku->nama_bahan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Quantity Per Transaksi</label>
                                                <input id="tambah_qty_p_trans" name="tambah_qty_p_trans" class="form-control" type="text" value="0">
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

                {{-- Modal Edit Relasi Bahan Baku --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Relasi Bahan Baku</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_relasi" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input class="form-control" id="relasi_id" name="relasi_id" type="hidden">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control select2" name="edit_r_produk" id="edit_r_produk" style="width: 100%;">
                                                        <option disabled selected>Produk</option>
                                                    @foreach ($produks as $produk)
                                                        <option value="{{($produk->id)}}">{{$produk->nama_produk}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control select2" name="edit_r_bahan_baku" id="edit_r_bahan_baku" style="width: 100%;">
                                                        <option disabled selected>Bahan Baku</option>
                                                    @foreach ($bahanbakus as $bahanbaku)
                                                        <option value="{{($bahanbaku->id)}}">{{$bahanbaku->nama_bahan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Quantity Per Transaksi</label>
                                                <input id="edit_qty_p_trans" name="edit_qty_p_trans" class="form-control" type="text" value="0">
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

                {{-- Modal Hapus Relasi Bahan Baku --}}
                <div class="modal modal-danger fade" id="modal_hapus">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Relasi Bahan Baku</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus_relasi" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    Yakin ingin menghapus relasi : <span class="label_relasi"></span>?
                                    <input id="hapus_relasi_id" name="hapus_relasi_id" type="hidden">
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
    <script src="{{secure_asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{secure_asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{secure_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- Mask Money -->
    <script src="{{secure_asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>
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
        $('#tambah_r_produk, #edit_r_produk').select2({
            placeholder: "Pilih Produk."
        });
        $('#tambah_r_bahan_baku, #edit_r_bahan_baku').select2({
            placeholder: "Pilih Bahan Baku."
        });
        $('#tambah_qty_p_trans, #edit_qty_p_trans').maskMoney({thousands:'', decimal:'.',allowZero:true,precision:0});
    </script>

    {{-- javascript Tabel --}}
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabel_relasi_bahan_baku').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loadrelasibahanbaku')}}',
                columns: [
                    { data: 'nama_produk', name: 'nama_produk' },
                    { data: 'nama_bahan', name: 'nama_bahan' },
                    { data: 'qtypertrx', name: 'qtypertrx' },
                    { data: 'action'}
                ]
            });
        });
    </script>

    {{-- javascript modal tambah --}}
    <script type="text/javascript">
        $(document).on('click','#modal_tambah_relasi',function () {
            $('#bt_simpan_tambah').removeAttr('disabled');
            $('#tambah_r_produk').val(0).trigger('change');
            $('#tambah_r_bahan_baku').val(0).trigger('change');
            $('#tambah_qty_p_trans').val(0);
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#bt_simpan_edit').removeAttr('disabled');
            $('#edit_r_produk').val($(this).data('produk_id')).trigger('change');
            $('#edit_r_bahan_baku').val($(this).data('bahanbaku_id')).trigger('change');
            $('#edit_qty_p_trans').val($(this).data('qtypertrx'));
            $('#relasi_id').val($(this).data('id'));
        });
    </script>

    {{-- javascript modal hapus --}}
    <script type="text/javascript">
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_relasi_id').val($(this).data('id'));
            $('.label_relasi').text($(this).data('relasi'));
        });
    </script>

    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $('#bt_simpan_tambah').attr('disabled',true);
            $.ajax({
                type:'post',
                url:'{{route('storerelasibahanbaku')}}',
                data: new FormData($('#form_tambah_relasi')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.tambah_r_produk)){
                            swal("Relasi Bahan Baku", ""+response.errors.tambah_r_produk+"", "error");
                        }else if ((response.errors.tambah_r_bahan_baku)){
                            swal("Relasi Bahan Baku", ""+response.errors.tambah_r_bahan_baku+"", "error");
                        }else if ((response.errors.tambah_qty_p_trans)){
                            swal("Relasi Bahan Baku", ""+response.errors.tambah_qty_p_trans+"", "error");
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
                error:function(response){
                    console.log(response);
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
                url:'{{route('updaterelasibahanbaku')}}',
                data: new FormData($('#form_edit_relasi')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.edit_r_produk)){
                            swal("Relasi Bahan Baku", ""+response.errors.edit_r_produk+"", "error");
                        }else if ((response.errors.edit_r_bahan_baku)){
                            swal("Relasi Bahan Baku", ""+response.errors.edit_r_bahan_baku+"", "error");
                        }else if ((response.errors.edit_qty_p_trans)){
                            swal("Relasi Bahan Baku", ""+response.errors.edit_qty_p_trans+"", "error");
                        }
                        // $('#modal_edit').modal('hide');
                    }else{
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }else{
                            console.log('atas');
                            swal("Error !", "Gagal menyimpan !", "error");
                            // $('#modal_edit').modal('hide');
                        }
                    }
                    $('#bt_simpan_edit').removeAttr('disabled');
                },
                error:function(response){
                    console.log(response);
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
                url:'{{route('deleterelasibahanbaku')}}',
                data: new FormData($('#form_hapus_relasi')[0]),
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
