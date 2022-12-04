@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->

<!-- sweet alert -->
<script src="{{asset('bower_components/sweetalert/sweetalert.min.js')}}"></script>
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


                {{-- Modal Show Range Special Price --}}
                <div class="modal fade" id="modal_show_range">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                          {{-- Tombol X --}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Range Special Price</h4>
                      </div>
                      <div class="modal-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Nilai Awal</th>
                                <th>Nilai Akhir</th>
                                <th>Harga</th>
                                <th>Tool</th>
                            </tr>
                            </thead>
                            <tbody id="table_range_price">
                            </tbody>
                        </table>
                      </div>
                      <div class="modal-footer">
                          {{-- Tombol Simpan-Batal --}}
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                          <button type="button" id="modal_bt_tambah_range" class="btn btn-primary pull-right">
                              Tambah
                          </button>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Modal Tambah Range Special Price --}}
                <div class="modal fade" id="modal_tambah_range">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                          {{-- Tombol X --}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Tambah Range Special Price</h4>
                      </div>
                      <div class="modal-body">
                          <div class="error alert-danger alert-dismissible">
                          </div>
                          {{-- Form Tambah --}}
                          <form id="form_tambah_range_special_price" action="" method="post" role="form" enctype="multipart/form-data">
                              {{csrf_field()}}
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Nilai Awal</label>
                                          <input id="tambah_range_nilai_awal" name="tambah_range_nilai_awal" class="form-control pull-right" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Nilai Akhir</label>
                                          <input id="tambah_range_nilai_akhir" name="tambah_range_nilai_akhir" class="form-control pull-right" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Harga Khusus</label>
                                          <input id="tambah_range_harga_khusus" name="tambah_range_harga_khusus" class="form-control pull-right" type="text">
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                          {{-- Tombol Simpan-Batal --}}
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                          <button type="button" id="bt_simpan_tambah_range" class="btn btn-success">Simpan</button>
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
    {{-- <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{--<script src="{{asset('dist/js/demo.js')}}"></script>--}}
    <!-- Page script -->
    <script>
        //numeral
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
        //
    </script>
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
            $('#bt_simpan_tambah').removeAttr('disabled');
            $("#tambah_jenispelanggan").val(null).trigger('change');
            $("#tambah_produk").val(null).trigger('change');
            $("#tambah_harga_khusus").val(numeral(0).format('$ 0,0'));
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

            $("#tambah_harga_khusus").keyup(function(){
                $(this).val(numeral($(this).val()).format('$ 0,0'));
            });


            $("#tambah_range_harga_khusus").keyup(function(){
                $(this).val(numeral($(this).val()).format('$ 0,0'));
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

            $("edit_harga_khusus").keyup(function(){
                $(this).val(numeral($(this).val()).format('$ 0,0'));
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
            $("#edit_harga_khusus").val(numeral($(this).data('harga')).format('$ 0,0'));
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
            $('#bt_simpan_tambah').attr('disabled',true);
            $("#tambah_harga_khusus").val(numeral($('#tambah_harga_khusus').val()).value());
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
                        $("#tambah_harga_khusus").val(numeral($('#tambah_harga_khusus').val()).format('$ 0,0'));
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
                            $("#tambah_harga_khusus").val(null);
                            $('#modal_tambah').modal('hide');
                            oTable.ajax.reload();
                        }
                        else if (response=="Duplicated"){
                            $("#tambah_harga_khusus").val(numeral(0).format('$ 0,0'));
                            $('#tambah_jenispelanggan').val(null).trigger('change');
                            $('#tambah_produk').val(null).trigger('change');
                            swal("Error !", "Duplikasi Data !", "error");
                            
                        }
                        else if (response=="Failed"){
                            $("#tambah_harga_khusus").val(numeral($('#tambah_harga_khusus').val()).format('$ 0,0'));
                            swal("Error !", "Gagal menyimpan !", "error");
                        }
                    }
                    $('#bt_simpan_tambah').removeAttr('disabled');
                },
                error:function(){
                    $("#tambah_harga_khusus").val(numeral($('#tambah_harga_khusus').val()).format('$ 0,0'));
                    swal("Error !", "Gagal, menyimpan !", "error");
                    $('#bt_simpan_tambah').removeAttr('disabled');
                }
            });
        });
    </script>

    {{-- javascript simpan edit --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_edit',function (){
            $("#edit_harga_khusus").val(numeral($('#edit_harga_khusus').val()).value());
            $('#bt_simpan_edit').attr('disabled',true);
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
                        $("#edit_harga_khusus").val(numeral($('#edit_harga_khusus').val()).format('$ 0,0'));
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
                            $("#edit_harga_khusus").val(null);
                            $('#modal_edit').modal('hide');
                            oTable.ajax.reload();
                        }
                        else if (response=="Duplicated"){
                            $("#tambah_harga_khusus").val(numeral(0).format('$ 0,0'));
                            swal("Error !", "Duplikasi Data !", "error");
                            
                        }
                        else if (response=="Failed"){
                            $("#tambah_harga_khusus").val(numeral($('#tambah_harga_khusus').val()).format('$ 0,0'));
                            swal("Error !", "Gagal menyimpan !", "error");
                        }
                    }
                    $('#bt_simpan_edit').removeAttr('disabled');
                },
                error:function(){
                    $("#tambah_harga_khusus").val(numeral($('#tambah_harga_khusus').val()).format('$ 0,0'));
                    swal("Error !", "Gagal menyimpan !", "error");
                    $('#bt_simpan_edit').removeAttr('disabled');
                    // $('#modal_edit').modal('hide');
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

    {{-- javascript button modal tambah range --}}
    <script type="text/javascript">
        var id = null;
        var special_price_group_id = null;
        var uniq_id = null;

        $(document).on('click','#modal_bt_tambah_range',function () {
            $("#tambah_range_harga_khusus, #edit_range_harga_khusus").val(numeral(0).format('$ 0,0'));
            $("#tambah_range_nilai_awal, #tambah_range_nilai_akhir").val(0);
            $('#modal_tambah_range').modal('show')
            id = null;
            uniq_id = null;
            special_price_group_id = null;
        });


        $("#tambah_range_nilai_awal").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        $("#tambah_range_nilai_akhir").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>

    {{-- javascript modal show range --}}
    <script type="text/javascript">
        let special_range_id;
        $(document).on('click','.modal_show_range',function () {
          special_range_id = $(this).data('id');
          $("tbody#table_range_price").html('');
          $.ajax({
              type:'get',
              url:'/specialpricegroup/'+special_range_id+'/rangegroups',
              dataType:'json',
              async:false,
              processData: false,
              success:function(response){
                response.forEach(function (item, index) {
                  contents = '<tr id="rowrange'+item.id+'">'+
                        '<td>'+item.nilai_awal+'</td>'+
                        '<td>'+item.nilai_akhir+'</td>'+
                        '<td>'+numeral(item.harga_khusus).format('$ 0,0')+'</td>'+
                        '<td style="width: 150px;min-width:50px;">'+
                            '<div class="btn-group">'+
                              '<button type="button" class="delete_range_button btn btn-danger btn-xs" data-special-price-group-id="'+item.uniq_special_price_group_id+'" data-uniq-id="'+item.uniq_id+'" data-id="'+item.id+'">'+
                                '<i class="fa fa-trash"></i>'+
                              '</button>'+
                            '</div>'+
                        '</td>'+
                    '</tr>';
                  $("tbody#table_range_price").append(
                    contents
                  );
                });
              },
              error:function(response){
              }
          });
        });
    </script>

    {{-- javascript simpan tambah range --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah_range',function (){
            $("#tambah_range_harga_khusus").val(numeral($('#tambah_range_harga_khusus').val()).value());
            $('#bt_simpan_tambah_range').attr('disabled',true);
            console.log($('#form_tambah_range_special_price')[0]);
            $.ajax({
                type:'post',
                url:'/specialpricegroup/'+special_range_id+'/rangegroups',
                data: new FormData($('#form_tambah_range_special_price')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                  r = response
                  range_nilai_awal = $("#tambah_range_nilai_awal").val(); 
                  range_nilai_akhir = $("#tambah_range_nilai_akhir").val(); 
                  range_harga_khusus = $("#tambah_range_harga_khusus").val(); 
                  $("#tambah_range_harga_khusus").val(numeral($('#tambah_range_harga_khusus').val(0)).format('$ 0,0'));
                  $("#tambah_range_nilai_awal").val(0);
                  $("#tambah_range_nilai_akhir").val(0);
                  $('#bt_simpan_tambah_range').removeAttr('disabled');
                  $('#modal_tambah_range').modal('hide');
                  $("tbody#table_range_price").append(
                    '<tr id="rowrange'+r.id+'">'+
                        '<td>'+r.nilai_awal+'</td>'+
                        '<td>'+r.nilai_akhir+'</td>'+
                        '<td>'+numeral(r.harga_khusus).format('$ 0,0')+'</td>'+
                        '<td style="width: 150px;min-width:50px;">'+
                            '<div class="btn-group">'+
                              '<button type="button" class="delete_range_button btn btn-danger btn-xs" data-special-price-group-id="'+r.uniq_special_price_group_id+'" data-uniq-id="'+r.uniq_id+'" data-id="'+r.id+'">'+
                                '<i class="fa fa-trash"></i>'+
                              '</button>'+
                            '</div>'+
                        '</td>'+
                    '</tr>'
                  );
                },
                error:function(xhr, status, error){
                  if ((xhr.responseJSON.errors.tambah_range_harga_khusus)){
                      swal("Harga khusus", ""+xhr.responseJSON.errors.tambah_range_harga_khusus+"", "error");
                  }else if ((xhr.responseJSON.errors.tambah_range_nilai_awal)){
                      swal("Nilai Awal", ""+xhr.responseJSON.errors.tambah_range_nilai_awal+"", "error");
                  }else if ((xhr.responseJSON.errors.tambah_range_nilai_akhir)){
                      swal("Nilai Akhir", ""+xhr.responseJSON.errors.tambah_range_nilai_akhir+"", "error");
                  }
                  $('#bt_simpan_tambah_range').removeAttr('disabled');
                }
            });
        });
    </script>

    {{-- javascript remove range --}}
    <script type="text/javascript">
        $(document).on('click','.delete_range_button',function (){
          id = null;
          uniq_id = null;
          special_price_group_id = null;
          id = $(this).data('id');
          uniq_id = $(this).data('uniq-id');
          special_price_group_id = $(this).data('special-price-group-id');
          console.log(id);
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                  url: '/specialpricegroup/'+special_price_group_id+'/rangegroups/'+uniq_id,
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type: 'DELETE',
                  data: {"_token": "{{ csrf_token() }}"},
                  success: function(result) {
                    //$("#rowrange"+id).closest('tr').remove();
                    $("#rowrange"+id).empty();
                    swal("Range price pelanggan berhasil dihapus.", {
                      icon: "success",
                    });
                    id = null;
                    uniq_id = null;
                    special_price_group_id = null;
                  }
              });
            } else {
              swal("Your imaginary file is safe!");
            }
          });
        });
    </script>

</body>
@endsection
