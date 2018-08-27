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
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts.header')

        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Harga Khusus Perorangan</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="modal_tambah_spcprice" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_spcprice" class="table">
                                        <thead>
                                        <tr>
                                            <th>Pelanggan</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Tambah Special Price --}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Special Price</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_spcprice" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Pelanggan" name="pilih_pelanggan" id="pilih_pelanggan" style="width: 100%;">
                                                        <option disabled selected>Pilih Pelanggan</option>
                                                    @foreach ($pelanggans as $pelanggan)
                                                        <option value="{{encrypt($pelanggan->id)}}">{{$pelanggan->nama_perusahaan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Produk" name="pilih_produk" id="pilih_produk" style="width: 100%;">
                                                        <option disabled selected>Pilih Produk</option>
                                                    @foreach ($produks as $produk)
                                                        <option value="{{encrypt($produk->id)}}">{{$produk->nama_produk}}</option>
                                                    @endforeach
                                                </select>
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
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="bt_simpan_tambah" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Edit Special Price --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Special Price</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_spcprice" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input class="form-control" id="spcprice_id" name="spcprice_id" type="hidden">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Pelanggan" name="pilih_edit_pelanggan" id="pilih_edit_pelanggan" style="width: 100%;">
                                                    @foreach ($pelanggans as $pelanggan)
                                                        <option value="{{$pelanggan->id}}">{{$pelanggan->nama_perusahaan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Produk" name="pilih_edit_produk" id="pilih_edit_produk" style="width: 100%;">
                                                    @foreach ($produks as $produk)
                                                        <option value="{{$produk->id}}">{{$produk->nama_produk}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Khusus</label>
                                                <input id="edit_harga_khusus" name="edit_harga_khusus" class="form-control pull-right" type="text">
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

                {{-- Modal Hapus Special Price --}}
                <div class="modal modal-danger fade" id="modal_hapus">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Special Price</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus_spcprice" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    Yakin ingin menghapus Harga Khusus untuk pelanggan <b><span class="label_pelanggan"></span></b> pada produk <b><span class="label_produk"></span></b> dengan harga <b>Rp. <span class="label_harga"></span></b> ?
                                    <input id="hapus_spcprice_id" name="hapus_spcprice_id" type="hidden">
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
    <!-- Mask Money -->
    <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>
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

    {{-- Init JS --}}
    <script type="text/javascript">
        $('#pilih_pelanggan, #pilih_edit_pelanggan').select2({
            placeholder: "Pilih Pelanggan."
        });
        $('#pilih_produk, #pilih_edit_produk').select2({
            placeholder: "Pilih Produk."
        });
    </script>

    {{-- javascript Tabel --}}
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabel_spcprice').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loadspecialprice')}}',
                columns: [
                    { data: 'nama_perusahaan', name: 'nama_perusahaan' },
                    { data: 'nama_produk', name: 'nama_produk' },
                    { data: 'harga_khusus', name: 'harga_khusus' },
                    { data: 'action'}
                ]
            });

            // Mask Money
            $("#tambah_harga_khusus").maskMoney({prefix:'Rp ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $("#tambah_harga_khusus").maskMoney('mask',0)
            $("#tambah_harga_khusus").on('blur',function(){
                $("#tambah_harga_khusus").maskMoney('mask')
            });
            $("#edit_harga_khusus").maskMoney({prefix:'Rp ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $("#edit_harga_khusus").maskMoney('mask',0)
            $("#edit_harga_khusus").on('blur',function(){
                $("#edit_harga_khusus").maskMoney('mask')
            });
        });
        function cleanInputModal(){
            $('#pilih_pelanggan, #pilih_edit_pelanggan, #pilih_produk, #pilih_edit_produk').val(0).trigger('change');
            $("#tambah_harga_khusus, #edit_harga_khusus").val(null).trigger('mask.maskMoney');
        }
    </script>

    {{-- javascript modal tambah --}}
    <script type="text/javascript">
        $(document).on('click','#modal_tambah_spcprice',function () {
            cleanInputModal()
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#pilih_edit_pelanggan').val($(this).data('id_pelanggan')).trigger('change');
            $('#pilih_edit_produk').val($(this).data('id_produk')).trigger('change');
            $('#edit_harga_khusus').val($(this).data('harga_khusus')).trigger('mask.maskMoney');
            $('#spcprice_id').val($(this).data('id'));
        });
    </script>

    {{-- javascript modal hapus --}}
    <script type="text/javascript">
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_spcprice_id').val($(this).data('id'));
            $('.label_pelanggan').text($(this).data('nama_perusahaan'));
            $('.label_produk').text($(this).data('nama_produk'));
            $('.label_harga').text($(this).data('harga_khusus'));
        });
    </script>

    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $("#tambah_harga_khusus").val($("#tambah_harga_khusus").maskMoney('unmasked')[0]);
            $.ajax({
                type:'post',
                url:'{{route('storespecialprice')}}',
                data: new FormData($('#form_tambah_spcprice')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        $("#tambah_harga_khusus").trigger('mask.maskMoney');
                        if ((response.errors.pilih_pelanggan)){
                            swal("Special Price", ""+response.errors.pilih_pelanggan+"", "error");
                        }else if ((response.errors.pilih_produk)){
                            swal("Special Price", ""+response.errors.pilih_produk+"", "error");
                        }else if ((response.errors.tambah_harga_khusus)){
                            swal("Special Price", ""+response.errors.tambah_harga_khusus+"", "error");
                        }
                        // $('#modal_tambah').modal('hide');
                    }else{
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_tambah').modal('hide');
                            oTable.ajax.reload();
                        }else if(response=="Duplicated"){
                            swal("Error !", "Data sudah ada !", "error");
                        }else{
                            wal("Error !", "Gagal menyimpan !", "error");
                            // $('#modal_tambah').modal('hide');
                        }
                    }
                },
                error:function(response){
                    console.log(response);
                    swal("Error !", "Gagal menyimpan !", "error");
                    // $('#modal_tambah').modal('hide');
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
                url:'{{route('updatespecialprice')}}',
                data: new FormData($('#form_edit_spcprice')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        $("#edit_harga_khusus").trigger('mask.maskMoney');
                        if ((response.errors.pilih_edit_pelanggan)){
                            swal("Special Price", ""+response.errors.pilih_edit_pelanggan+"", "error");
                        }else if ((response.errors.pilih_edit_produk)){
                            swal("Special Price", ""+response.errors.pilih_edit_produk+"", "error");
                        }else if ((response.errors.edit_harga_khusus)){
                            swal("Special Price", ""+response.errors.edit_harga_khusus+"", "error");
                        }
                        // $('#modal_edit').modal('hide');
                    }else{
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }else if(response=="Duplicated"){
                            swal("Error !", "Data sudah ada !", "error");
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
                url:'{{route('deletespecialprice')}}',
                data: new FormData($('#form_hapus_spcprice')[0]),
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
