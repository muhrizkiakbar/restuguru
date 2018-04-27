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

                {{-- Tabel Produk --}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-default">
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
                                                <select class="form-control" placeholder="Kategori" name="tambah_kategori" id="tambah_kategori" style="width: 100%;">
                                                        <option disabled selected>Kategori Produk</option>
                                                    @foreach ($kategories as $kategori)
                                                        <option value="{{encrypt($kategori->id)}}">{{$kategori->Nama_Kategori}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input id="tambah_nama_produk" name="tambah_nama_produk" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Satuan</label>
                                                <input id="tambah_satuan" name="tambah_satuan" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Harga Beli</label>
                                                <input id="tambah_harga_beli" name="tambah_harga_beli" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Harga Jual</label>
                                                <input id="tambah_harga_jual" name="tambah_harga_jual" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Hitung Luas</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="tambah_hitung_luas" id="tambah_hitung_luas_t" value="0" checked>
                                                        Tidak
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="tambah_hitung_luas" id="tambah_hitung_luas_y" value="1">
                                                        Ya
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
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
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select class="form-control" placeholder="Kategori" name="edit_kategori" id="edit_kategori" style="width: 100%;">
                                                            <option disabled>Kategori Produk</option>
                                                        @foreach ($kategories as $kategori)
                                                            <option value="{{encrypt($kategori->id)}}">{{$kategori->Nama_Kategori}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nama Produk</label>
                                                    <input id="edit_nama_produk" name="edit_nama_produk" class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Satuan</label>
                                                    <input id="edit_satuan" name="edit_satuan" class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Harga Beli</label>
                                                    <input id="edit_harga_beli" name="edit_harga_beli" class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Harga Jual</label>
                                                    <input id="edit_harga_jual" name="edit_harga_jual" class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Hitung Luas</label>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="edit_hitung_luas" id="edit_hitung_luas_t" value="0" checked>
                                                            Tidak
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="edit_hitung_luas" id="edit_hitung_luas_y" value="1">
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea id="edit_keterangan" name="edit_keterangan" class="form-control" type="text"></textarea>
                                                </div>
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
            $('#tambah_kategori :nth-child(1)').prop('selected', true);
            $('#tambah_nama_produk').val("");
            $('#tambah_satuan').val("");
            $('#tambah_harga_beli').val("");
            $('#tambah_harga_jual').val("");
            $('#tambah_hitung_luas').val(0);
            $('#tambah_keterangan').val("");
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#edit_kategori option').filter(function () { return $(this).html() == $(this).data('kategori'); }).val();
            $('#edit_nama_produk').val($(this).data('nama_produk'));
            $('#edit_satuan').val($(this).data('satuan'));
            $('#edit_harga_beli').val($(this).data('harga_beli'));
            $('#edit_harga_jual').val($(this).data('harga_jual'));
            $('#edit_hitung_luas').val($(this).data('hitung_luas'));
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
                        }else if ((response.errors.tambah_hitung_luas)){
                            swal("Produk", ""+response.errors.tambah_hitung_luas+"", "error");
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
                        }else if ((response.errors.edit_hitung_luas)){
                            swal("Produk", ""+response.errors.edit_hitung_luas+"", "error");
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
                url:'{{route('deleteproduk')}}',
                data: new FormData($('#form_hapus_produk')[0]),
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
