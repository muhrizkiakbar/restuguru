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
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
<link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">

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
                  <form id="formprice">
                    <div class="col-xs-5">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Input Harga Pelanggan</h3>
                            </div>
                            <div class="box-body">
                              <div class="row">
                                <div class="col-xs-12" style="padding-bottom: 15px;">
                                      {{csrf_field()}}
                                      <div class="row">
                                          <div class="col-md-12">
                                              @foreach ($jenispelanggans as $jenispelanggan)
                                                <div class="form-group">
                                                  <input type="checkbox" name="jenispelanggan_ids[]" value="{{($jenispelanggan->id)}}" class="flat-red checkbox">
                                                  <label for="">{{$jenispelanggan->jenis_pelanggan}}</label>
                                                </div>
                                              @endforeach
                                          </div>
                                      </div>
                                </div>
                                <div class="col-xs-12" style="padding-bottom: 10px;">
                                      <button type="button" id="modal_tambah_produk" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                        Tambah Produk
                                      </button>
                                      <button type="button" id="bt_reset" class="btn">
                                        Reset
                                      </button>
                                      <button type="button" id="bt_simpan_special_price"  class="btn btn-success pull-right" disabled>Simpan</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Harga Jenis Pelanggan</h3>
                            </div>
                            <div class="box-body">
                              <div class="table-responsive">
                                  <table id="tabel_spcprice" class="table">
                                      <thead>
                                      <tr>
                                          <th>Produk</th>
                                          <th>Harga</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody></tbody>
                                  </table>
                              </div>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>

                <!-- modal tambah pelanggan -->
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
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="pilih_pelanggan">Pilih Produk</label>
                                                <select class="form-control select2" placeholder="Produk" name="pilih_produk" id="pilih_produk" style="width: 100%;">
                                                    <option disabled selected value="0">Pilih Produk</option>
                                                    @foreach ($produks as $produk)
                                                        <option value="{{($produk->id)}}">{{$produk->nama_produk}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input id="harga_khusus" name="harga_khusus" placeholder="Harga" class="form-control pull-right" type="text">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                {{-- Tombol Simpan-Batal --}}
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="bt_tambah_pelanggan" class="btn btn-success">Simpan</button>
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
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
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
    </script>

    <script type="text/javascript">
        $(function() {
            // Mask Money
            $("#harga_khusus").keyup(function(){
                $(this).val(numeral($(this).val()).format('$ 0,0'));
            });

            $('#pilih_produk').select2({
                placeholder: "Pilih Produk."
            });

            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            })
        });
        function cleanInputModal(){
          $('.checkbox').iCheck('uncheck');
          $("#harga_khusus").val(numeral(0).format('$ 0,0'));
          $("#pilih_produk").val(0).trigger('change');
          $('tbody').html("");
          $('#bt_simpan_special_price').attr('disabled', true);
        }

        function renderItem(data){
          return '<tr id="'+data.produk_id+'">'+
              '<input type="hidden" readonly disabled id="produk_ids[]" value="'+data.produk_id+'" name="produk_ids[]">'+
              '<input type="hidden" readonly disabled id="hargakhusus[]" value="'+data.harga_khusus+'" name="hargakhusus[]">'+
              '<td>'+data.nama_produk+'</td>'+
              '<td>'+numeral(data.harga_khusus).format('$ 0,0')+'</td>'+
              '<td>'+
                '<div class="btn-group">'+
                  '<button type="button" class="produk_delete btn btn-danger btn-sm" data-toggle="modal" data-id="'+data.produk_id+'" >'+
                    '<i class="fa fa-trash"></i>'+
                  '</button>'+
                '</div>'+
              '</td>'+
            '</tr>'
        }
    </script>

    {{-- javascript reset --}}
    <script type="text/javascript">
        $(document).on('click','#bt_reset',function (){
          cleanInputModal()
        });
    </script>

    {{-- javascript simpan price --}}
    <script type="text/javascript">
        $(document).on('click','#bt_simpan_special_price',function (){
            if ($('tbody').children().length == 0 || $('input:checkbox:checked').length < 1) {
              return swal({
                  icon: "error",
                  title: "Error!",
                  text: "Data belum lengkap !",
                  type: "error"
                  })
            }
            var jsonhargakhusus = [];
            $('input[name^="hargakhusus[]"]').each(function() {
                jsonhargakhusus.push($(this).val());
            });
            var jsonproduk_ids = [];
            $('input[name^="produk_ids[]"]').each(function() {
                jsonproduk_ids.push($(this).val());
            });
            var jsonjenispelanggan_ids=[];
            $('input:checkbox:checked').each(function() {
                jsonjenispelanggan_ids.push($(this).val());
            });
          $.ajax({
              url:'{{route('create_price_khusus_jenis_pelanggans')}}',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'post',
              data: JSON.stringify({
                "_token": "{{ csrf_token() }}",
                harga_khusus: jsonhargakhusus,
                produk_ids: jsonproduk_ids,
                jenispelanggan_ids: jsonjenispelanggan_ids 
              }),
              async:false,
              processData: false,
              contentType: 'application/json; charset=utf-8',
              success:function(response){
                swal("Price jenis pelanggan berhasil disimpan.", {
                  icon: "success",
                });
                cleanInputModal()
              },
              error:function(e){
                console.log(e)
              },
          });
        });
    </script>

    {{-- javascript simpan tambah --}}
    <script type="text/javascript">
        $(document).on('click','#bt_tambah_pelanggan',function (){
            var produk_id = $('#pilih_produk').val()
            var nama_produk = $('#pilih_produk option:selected').text()
            var harga_khusus = numeral($('#harga_khusus').val()).value();
            var produk = {
              produk_id: produk_id,
              nama_produk: nama_produk,
              harga_khusus: harga_khusus,
            }
            $("tbody").append(
              renderItem(produk)
            )
            $('#modal_tambah').modal('hide');
            $('#bt_simpan_special_price').removeAttr('disabled')

            $('#pilih_produk').val(0).trigger('change')
            $('#harga_khusus').val('')
        });
    </script>

    {{-- javascript hapus pelanggan --}}
    <script type="text/javascript">
        $(document).on('click','.produk_delete',function (){
          var id = String($(this).data('id'))
          $('#'+id+'').remove();
          if ($('tbody').children().length == 0) {
            $('#bt_simpan_special_price').attr('disabled', true)
          }
        });
    </script>

</body>
@endsection
