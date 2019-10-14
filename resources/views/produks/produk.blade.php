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

                {{-- Tabel Produk --}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Produk</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="modal_tambah_produk" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah Produk
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_produk" class="table">
                                        <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Satuan</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Hitng Luas</th>
                                            <th>Kategori</th>
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

                {{-- Modal Tambah Produk --}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Produk</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_produk" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Kategori" name="tambah_kategori" id="tambah_kategori" style="width: 100%;">
                                                        <option disabled selected>Kategori Produk</option>
                                                    @foreach ($kategories as $kategori)
                                                        <option value="{{encrypt($kategori->id)}}">{{$kategori->Nama_Kategori}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input id="tambah_nama_produk" name="tambah_nama_produk" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Satuan" name="tambah_satuan" id="tambah_satuan" style="width: 100%;">
                                                        <option disabled selected>Satuan Produk</option>
                                                        <option value="CENTIMETER">Centimeter</option>
                                                        <option value="METER">Meter</option>
                                                        <option value="PCS">Pcs</option>
                                                        <option value="PAKET">Paket</option>
                                                        <option value="ITEM">Item</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Beli</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        Rp
                                                    </div>
                                                    <input id="tambah_harga_beli" name="tambah_harga_beli" class="form-control mata-uang" type="text" value="0">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Jual</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        Rp
                                                    </div>
                                                    <input id="tambah_harga_jual" name="tambah_harga_jual" class="form-control mata-uang" type="text" value="0">
                                                </div>
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

                {{-- Modal Edit Produk --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Produk</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_produk" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input class="form-control" id="produk_id" name="produk_id" type="hidden">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Kategori" name="edit_kategori" id="edit_kategori" style="width: 100%;">
                                                    @foreach ($kategories as $kategori)
                                                        <option value="{{$kategori->id}}">{{$kategori->Nama_Kategori}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input id="edit_nama_produk" name="edit_nama_produk" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Satuan" name="edit_satuan" id="edit_satuan" style="width: 100%;">
                                                        <option disabled selected>Satuan Produk</option>
                                                        <option value="CENTIMETER">Centimeter</option>
                                                        <option value="METER">Meter</option>
                                                        <option value="PCS">Pcs</option>
                                                        <option value="PAKET">Paket</option>
                                                        <option value="ITEM">Item</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Beli</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        Rp
                                                    </div>
                                                    <input id="edit_harga_beli" name="edit_harga_beli" class="form-control mata-uang" type="text" value="0">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Jual</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        Rp
                                                    </div>
                                                    <input id="edit_harga_jual" name="edit_harga_jual" class="form-control mata-uang" type="text" value="0">
                                                </div>
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

                {{-- Modal Hapus Produk --}}
                <div class="modal modal-danger fade" id="modal_hapus">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Produk</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus_produk" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    Yakin ingin menghapus produk <span class="label_produk"></span>?
                                    <input id="hapus_produk_id" name="hapus_produk_id" type="hidden">
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
    {{-- <script src="{{secure_asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
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
        numeral.register('locale', 'idr', {
            delimiters: {
                thousands: '.',
                decimal: ','
            },
            abbreviations: {
                thousand: 'ribu',
                million: 'juta',
                billion: 'ratus juta',
                trillion: 'milyar'
            },
            currency: {
                symbol: 'Rp'
            }
        });
        numeral.locale('idr');
        $('#tambah_kategori, #edit_kategori').select2({
            placeholder: "Pilih Kategori."
        });
        $('#tambah_satuan, #edit_satuan').select2({
            placeholder: "Pilih Satuan."
        });
        $(function(){
            $("input.mata-uang").keyup(function(){
                $(this).val(numeral($(this).val()).format('0,0'));
            });
        });
        // $('#tambah_harga_beli, #tambah_harga_jual, #edit_harga_beli, #edit_harga_jual').maskMoney({thousands:'', decimal:'.',allowZero:true,precision:0});
    </script>

    {{-- javascript Tabel --}}
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabel_produk').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loadproduk')}}',
                columns: [
                    { data: 'nama_produk', name: 'nama_produk' },
                    { data: 'satuan', name: 'satuan' },
                    { data: 'harga_beli', name: 'harga_beli' },
                    { data: 'harga_jual', name: 'harga_jual' },
                    { data: 'produks.hitung_luas', name: 'hitung_luas' },
                    { data: 'Nama_Kategori', name: 'Nama_Kategori' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'action'}
                ]
            });
        });
    </script>

    {{-- javascript modal tambah --}}
    <script type="text/javascript">
        $(document).on('click','#modal_tambah_produk',function () {
            $('#bt_simpan_tambah').removeAttr('disabled');
            $('#tambah_kategori').val(0).trigger('change');
            $('#tambah_nama_produk').val("");
            $('#tambah_satuan').val(0).trigger('change');
            // $('#tambah_harga_beli, #tambah_harga_jual').maskMoney({ allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $('#tambah_harga_beli').val(0);
            $('#tambah_harga_jual').val(0);
            $('#tambah_keterangan').val("");
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#bt_simpan_edit').removeAttr('disabled');
            $('#edit_kategori').val($(this).data('kategori_id')).trigger('change');
            $('#edit_nama_produk').val($(this).data('nama_produk'));
            $('#edit_satuan').val($(this).data('satuan')).trigger('change');
            // $('#edit_harga_beli, #edit_harga_jual').maskMoney({ allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $('#edit_harga_beli').val(numeral($(this).data('harga_beli')).format('0,0'));
            $('#edit_harga_jual').val(numeral($(this).data('harga_jual')).format('0,0'));
            $('#edit_keterangan').val($(this).data('keterangan'));
            $('#produk_id').val($(this).data('id'));
        });
    </script>

    {{-- javascript modal hapus --}}
    <script type="text/javascript">
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_produk_id').val($(this).data('id'));
            $('.label_produk').text($(this).data('nama_produk'));
        });
    </script>

    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $("#tambah_harga_jual").val(numeral($("#tambah_harga_jual").val()).value());
            $("#tambah_harga_beli").val(numeral($("#tambah_harga_beli").val()).value());
            $('#bt_simpan_tambah').attr('disabled',true);
            $.ajax({
                type:'post',
                url:'{{route('storeproduk')}}',
                data: new FormData($('#form_tambah_produk')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.tambah_kategori)){
                            swal("Produk", ""+response.errors.tambah_kategori+"", "error");
                        }else if ((response.errors.tambah_nama_produk)){
                            swal("Produk", ""+response.errors.tambah_nama_produk+"", "error");
                        }else if ((response.errors.tambah_satuan)){
                            swal("Produk", ""+response.errors.tambah_satuan+"", "error");
                        }else if ((response.errors.tambah_harga_beli)){
                            swal("Produk", ""+response.errors.tambah_harga_beli+"", "error");
                        }else if ((response.errors.tambah_harga_jual)){
                            swal("Produk", ""+response.errors.tambah_harga_jual+"", "error");
                        }else if ((response.errors.tambah_keterangan)){
                            swal("Produk", ""+response.errors.tambah_keterangan+"", "error");
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
            $("#edit_harga_jual").val(numeral($("#edit_harga_jual").val()).value());
            $("#edit_harga_beli").val(numeral($("#edit_harga_beli").val()).value());
            $('#bt_simpan_edit').attr('disabled',true);
            $.ajax({
                type:'post',
                url:'{{route('updateproduk')}}',
                data: new FormData($('#form_edit_produk')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.edit_kategori)){
                            swal("Produk", ""+response.errors.edit_kategori+"", "error");
                        }else if ((response.errors.edit_nama_produk)){
                            swal("Produk", ""+response.errors.edit_nama_produk+"", "error");
                        }else if ((response.errors.edit_satuan)){
                            swal("Produk", ""+response.errors.edit_satuan+"", "error");
                        }else if ((response.errors.edit_harga_beli)){
                            swal("Produk", ""+response.errors.edit_harga_beli+"", "error");
                        }else if ((response.errors.edit_harga_jual)){
                            swal("Produk", ""+response.errors.edit_harga_jual+"", "error");
                        }else if ((response.errors.edit_keterangan)){
                            swal("Produk", ""+response.errors.edit_keterangan+"", "error");
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
                url:'{{route('deleteproduk')}}',
                data: new FormData($('#form_hapus_produk')[0]),
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
