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

                {{-- Tabel Bahan Baku --}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Bahan Baku</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" id="modal_tambah_produk" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                    Tambah Bahan Baku
                                </button>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tabel_bahan_baku" class="table">
                                        <thead>
                                        <tr>
                                            <th>Nama Bahan Baku</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Batas Stok</th>
                                            <th>Hitung Luas</th>
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

                {{-- Modal Tambah Bahan Baku --}}
                <div class="modal fade" id="modal_tambah">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- Tombol X --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Bahan Baku</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Tambah --}}
                                <form id="form_tambah_bahan_baku" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Kategori" name="tambah_kategori_bb" id="tambah_kategori_bb" style="width: 100%;">
                                                        <option disabled selected>Kategori Bahan Baku</option>
                                                    @foreach ($kategories as $kategori)
                                                        <option value="{{encrypt($kategori->id)}}">{{$kategori->Nama_Kategori}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Bahan Baku</label>
                                                <input id="tambah_nama_bahan" name="tambah_nama_bahan" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Satuan" name="tambah_satuan" id="tambah_satuan" style="width: 100%;">
                                                        <option disabled selected>Satuan Produk</option>
                                                        <option value="CM">Centimeter</option>
                                                        <option value="M">Meter</option>
                                                        <option value="PCS">Pcs</option>
                                                        <option value="PAKET">Paket</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        Rp
                                                    </div>
                                                    <input id="tambah_harga" name="tambah_harga" class="form-control mata-uang" type="text" value="0">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Batas Stok</label>
                                                <input id="tambah_batas_stok" name="tambah_batas_stok" class="form-control mata-uang" type="text" value="0">
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

                {{-- Modal Edit Bahan Baku --}}
                <div class="modal modal-warning fade" id="modal_edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Bahan Baku</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                {{-- Form Edit --}}
                                <form id="form_edit_bahan_baku" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input class="form-control" id="produk_id" name="produk_id" type="hidden">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Kategori" name="edit_kategori_bb" id="edit_kategori_bb" style="width: 100%;">
                                                    @foreach ($kategories as $kategori)
                                                        <option value="{{$kategori->id}}">{{$kategori->Nama_Kategori}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Bahan Baku</label>
                                                <input id="edit_nama_bahan" name="edit_nama_bahan" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control select2" placeholder="Satuan" name="edit_satuan" id="edit_satuan" style="width: 100%;">
                                                        <option disabled selected>Satuan Produk</option>
                                                        <option value="CM">Centimeter</option>
                                                        <option value="M">Meter</option>
                                                        <option value="PCS">Pcs</option>
                                                        <option value="PAKET">Paket</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        Rp
                                                    </div>
                                                    <input id="edit_harga" name="edit_harga" class="form-control mata-uang" type="text" value="0">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Batas Stok</label>
                                                <input id="edit_batas_stok" name="edit_batas_stok" class="form-control mata-uang" type="text" value="0">
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

                {{-- Modal Hapus Bahan Baku --}}
                <div class="modal modal-danger fade" id="modal_hapus">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Bahan Baku</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_hapus_bahan_baku" action="" method="post" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    Yakin ingin menghapus bahan baku <span class="label_bahan_baku"></span>?
                                    <input id="hapus_bahan_baku_id" name="hapus_bahan_baku_id" type="hidden">
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
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
    $('#tambah_kategori_bb, #edit_kategori_bb').select2({
      placeholder: "Pilih Kategori."
    });
    $('#tambah_satuan, #edit_satuan').select2({
      placeholder: "Pilih Satuan."
    });
    // $('#tambah_harga, #tambah_batas_stok, #edit_harga, #edit_batas_stok').maskMoney({thousands:'', decimal:'.',allowZero:true,precision:0});
    $(function(){
        $("input.mata-uang").keyup(function(){
            $(this).val(numeral($(this).val()).format('0,0'));
        });
    });
    </script>

    {{-- javascript Tabel --}}
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabel_bahan_baku').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('loadbahanbaku')}}',
                columns: [
                    { data: 'nama_bahan', name: 'nama_bahan' },
                    { data: 'satuan', name: 'satuan' },
                    { data: 'harga', name: 'harga' },
                    { data: 'batas_stok', name: 'batas_stok' },
                    { data: 'hitung_luas', name: 'hitung_luas' },
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
            $('#tambah_kategori_bb').val(0).trigger('change');
            $('#tambah_nama_bahan').val("");
            $('#tambah_satuan').val(0).trigger('change');
            $('#tambah_harga').val(0);
            $('#tambah_batas_stok').val(0);
            $('#tambah_keterangan').val("");
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#edit_kategori_bb').val($(this).data('kategori_id')).trigger('change');
            $('#edit_nama_bahan').val($(this).data('nama_bahan'));
            $('#edit_satuan').val($(this).data('satuan')).trigger('change');
            $('#edit_harga').val(numeral($(this).data('harga')).format('0,0'));
            $('#edit_batas_stok').val(numeral($(this).data('batas_stok')).format('0,0'));
            $('#edit_keterangan').val($(this).data('keterangan'));
            $('#produk_id').val($(this).data('id'));
        });
    </script>

    {{-- javascript modal hapus --}}
    <script type="text/javascript">
        $(document).on('click','.modal_hapus',function () {
            $('#hapus_bahan_baku_id').val($(this).data('id'));
            $('.label_bahan_baku').text($(this).data('nama_bahan'));
        });
    </script>

    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $("#tambah_harga").val(numeral($("#tambah_harga").val()).value());
            $("#tambah_batas_stok").val(numeral($("#tambah_batas_stok").val()).value());
            $.ajax({
                type:'post',
                url:'{{route('storebahanbaku')}}',
                data: new FormData($('#form_tambah_bahan_baku')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.tambah_kategori_bb)){
                            swal("Bahan Baku", ""+response.errors.tambah_kategori_bb+"", "error");
                        }else if ((response.errors.tambah_nama_bahan)){
                            swal("Bahan Baku", ""+response.errors.tambah_nama_bahan+"", "error");
                        }else if ((response.errors.tambah_satuan)){
                            swal("Bahan Baku", ""+response.errors.tambah_satuan+"", "error");
                        }else if ((response.errors.tambah_harga)){
                            swal("Bahan Baku", ""+response.errors.tambah_harga+"", "error");
                        }else if ((response.errors.tambah_batas_stok)){
                            swal("Bahan Baku", ""+response.errors.tambah_batas_stok+"", "error");
                        }else if ((response.errors.tambah_keterangan)){
                            swal("Bahan Baku", ""+response.errors.tambah_keterangan+"", "error");
                        }
                        $("#tambah_harga").val(numeral($("#tambah_harga").val()).format('0,0'));
                        $("#tambah_batas_stok").val(numeral($("#tambah_batas_stok").val()).format('0,0'));
                        // $('#modal_tambah').modal('hide');
                    }else{
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_tambah').modal('hide');
                            oTable.ajax.reload();
                        }else{
                            wal("Error !", "Gagal menyimpan !", "error");
                            $("#tambah_harga").val(numeral($("#tambah_harga").val()).format('0,0'));
                            $("#tambah_batas_stok").val(numeral($("#tambah_batas_stok").val()).format('0,0'));
                            // $('#modal_tambah').modal('hide');
                        }
                    }
                },
                error:function(response){
                    console.log(response);
                    swal("Error !", "Gagal menyimpan !", "error");
                    $("#tambah_harga").val(numeral($("#tambah_harga").val()).format('0,0'));
                    $("#tambah_batas_stok").val(numeral($("#tambah_batas_stok").val()).format('0,0'));
                    // $('#modal_tambah').modal('hide');
                }
            });
        });
    </script>

    {{-- javascript simpan edit --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_edit',function (){
            $("#edit_harga").val(numeral($("#edit_harga").val()).value());
            $("#edit_batas_stok").val(numeral($("#edit_batas_stok").val()).value());
            $.ajax({
                type:'post',
                url:'{{route('updatebahanbaku')}}',
                data: new FormData($('#form_edit_bahan_baku')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        if ((response.errors.edit_kategori_bb)){
                            swal("Bahan Baku", ""+response.errors.edit_kategori_bb+"", "error");
                        }else if ((response.errors.edit_nama_bahan)){
                            swal("Bahan Baku", ""+response.errors.edit_nama_bahan+"", "error");
                        }else if ((response.errors.edit_satuan)){
                            swal("Bahan Baku", ""+response.errors.edit_satuan+"", "error");
                        }else if ((response.errors.edit_harga)){
                            swal("Bahan Baku", ""+response.errors.edit_harga+"", "error");
                        }else if ((response.errors.edit_batas_stok)){
                            swal("Bahan Baku", ""+response.errors.edit_batas_stok+"", "error");
                        }else if ((response.errors.edit_keterangan)){
                            swal("Bahan Baku", ""+response.errors.edit_keterangan+"", "error");
                        }
                        $("#edit_harga").val(numeral($("#edit_harga").val()).format('0,0'));
                        $("#edit_batas_stok").val(numeral($("#edit_batas_stok").val()).format('0,0'));
                        // $('#modal_edit').modal('hide');
                    }else{
                        if (response=="Success"){
                            swal("Success !", "Berhasil menyimpan !", "success");
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }else{
                            console.log('atas');
                            wal("Error !", "Gagal menyimpan !", "error");
                            $("#edit_harga").val(numeral($("#edit_harga").val()).format('0,0'));
                            $("#edit_batas_stok").val(numeral($("#edit_batas_stok").val()).format('0,0'));
                            // $('#modal_edit').modal('hide');
                        }
                    }
                },
                error:function(response){
                    console.log(response);
                    swal("Error !", "Gagal menyimpan !", "error");
                    $("#edit_harga").val(numeral($("#edit_harga").val()).format('0,0'));
                    $("#edit_batas_stok").val(numeral($("#edit_batas_stok").val()).format('0,0'));
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
                url:'{{route('deletebahanbaku')}}',
                data: new FormData($('#form_hapus_bahan_baku')[0]),
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
