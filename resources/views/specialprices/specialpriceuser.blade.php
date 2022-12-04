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
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <!-- Mask Money -->
    {{-- <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script> --}}
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
            $("#tambah_harga_khusus").keyup(function(){
                $(this).val(numeral($(this).val()).format('$ 0,0'));
            });

            $("#tambah_range_harga_khusus").keyup(function(){
                $(this).val(numeral($(this).val()).format('$ 0,0'));
            });

            $("#edit_harga_khusus").keyup(function(){
                $(this).val(numeral($(this).val()).format('$ 0,0'));
            });

        });
        function cleanInputModal(){
            $('#pilih_pelanggan, #pilih_edit_pelanggan, #pilih_produk, #pilih_edit_produk').val(0).trigger('change');
            $("#tambah_harga_khusus, #edit_harga_khusus").val(numeral(0).format('$ 0,0'));
            $("#tambah_range_harga_khusus, #edit_range_harga_khusus").val(numeral(0).format('$ 0,0'));
            $("#tambah_range_nilai_awal, #tambah_range_nilai_akhir").val(0);
        }
    </script>

    {{-- javascript modal tambah --}}
    <script type="text/javascript">
        $(document).on('click','#modal_tambah_spcprice',function () {
            $('#bt_simpan_tambah').removeAttr('disabled');
            cleanInputModal()
        });
    </script>

    {{-- javascript modal edit --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#bt_simpan_edit').removeAttr('disabled');
            $('#pilih_edit_pelanggan').val($(this).data('id_pelanggan')).trigger('change');
            $('#pilih_edit_produk').val($(this).data('id_produk')).trigger('change');
            $('#edit_harga_khusus').val(numeral($(this).data('harga_khusus')).format('$ 0,0'));
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

    {{-- javascript button modal tambah range --}}
    <script type="text/javascript">
        var id = null;
        var uniq_id = null;
        var special_price_pelanggan_id = null;

        $(document).on('click','#modal_bt_tambah_range',function () {
            cleanInputModal()
            $('#modal_tambah_range').modal('show')
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
              url:'/specialprice/'+special_range_id+'/ranges',
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
                              '<button type="button" class="delete_range_button btn btn-danger btn-xs" data-special-price-pelanggan-id="'+item.uniq_special_price_pelanggan_id+'" data-uniq-id="'+item.uniq_id+'" data-id="'+item.id+'">'+
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
            id = null;
            special_price_pelanggan_id = null;
            $("#tambah_range_harga_khusus").val(numeral($('#tambah_range_harga_khusus').val()).value());
            $('#bt_simpan_tambah_range').attr('disabled',true);
            console.log($('#form_tambah_range_special_price')[0]);
            $.ajax({
                type:'post',
                url:'/specialprice/'+special_range_id+'/ranges',
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
                              '<button type="button" class="delete_range_button btn btn-danger btn-xs" data-special-price-pelanggan-id="'+r.uniq_special_price_pelanggan_id+'" data-uniq-id="'+r.uniq_id+'" data-id="'+r.id+'">'+
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
          special_price_pelanggan_id = null;
          id = $(this).data('id');
          uniq_id = $(this).data('uniq-id');
          special_price_pelanggan_id = $(this).data('special-price-pelanggan-id');
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
                  url: '/specialprice/'+special_price_pelanggan_id+'/ranges/'+uniq_id,
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
                    special_price_pelanggan_id = null;
                  }
              });
            } else {
              swal("Your imaginary file is safe!");
            }
          });
        });
    </script>

    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_tambah',function (){
            $("#tambah_harga_khusus").val(numeral($('#tambah_harga_khusus').val()).value());
            $('#bt_simpan_tambah').attr('disabled',true);
            console.log($('#form_tambah_spcprice')[0]);
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
                        $("#tambah_harga_khusus").val(numeral($('#tambah_harga_khusus').val()).format('$ 0,0'));
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
                            swal("Error !", "Gagal menyimpan !", "error");
                            // $('#modal_tambah').modal('hide');
                        }
                    }
                    $('#bt_simpan_tambah').removeAttr('disabled');
                },
                error:function(response){
                    swal("Error !", "Gagal menyimpan !", "error");
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
                url:'{{route('updatespecialprice')}}',
                data: new FormData($('#form_edit_spcprice')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        $("#edit_harga_khusus").val(numeral($('#edit_harga_khusus').val()).format('$ 0,0'));
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
                            swal("Error !", "Gagal menyimpan !", "error");
                            // $('#modal_edit').modal('hide');
                        }
                    }
                    $('#bt_simpan_edit').removeAttr('disabled');
                },
                error:function(){
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
                url:'{{route('deletespecialprice')}}',
                data: new FormData($('#form_hapus_spcprice')[0]),
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
