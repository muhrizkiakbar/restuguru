@extends('layouts.app')
@push('style')


  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- Bootstrap Color Picker --> 
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  
  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- daterange picker -->
  <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/dark-hive/jquery-ui.css"> -->
  <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> -->
  <style>
    .ui-autocomplete {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    display: none;
    min-width: 160px;
    _width: 160px;
    padding: 4px 0;
    margin: 2px 0 0 0;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;

    .ui-menu-item {
        display: block;
        padding: 3px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;

        &.ui-state-focus, &.ui-state-active {
        color: #ffffff;
        text-decoration: none;
        background-color: #0088cc;
        border-radius: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        background-image: none;
        }
    }
    }

    .ui-helper-hidden-accessible { display:none; }
  </style>
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">

  <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
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
            <!-- form addrole         -->
        
        <div class="row">
          <!-- left column -->
          <div class="col-md-2">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Pelanggan</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body">

                      <div class="form-group">
                        <input type="text" class="form-control" id="namapelanggan" name="namapelanggan" placeholder="Nama Pelanggan">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="nomorhandphone" name="nomorhandphone" placeholder="Nomor Handphone">
                      </div>
                      <div class="form-group">
                        <select id="pelanggan" name="pelanggan" class="form-control select2" style="width:100%;" type="text"></select>
                      </div>

                      @csrf
                      
                    </div>
                  </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" id="submitpelanggan" class="btn btn-success btn-sm">Submit <i class="fa fa-chevron-circle-right"></i></button>
                </div>
            </div>
          </div>

          <div class="col-md-10">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Trolly <i class="fa  fa-shopping-cart"></i></h3>
              </div>

                <div class="row">
                  <div class="col-md-2">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="no">No. Nota : </label><span id="nonota"></span>
                      </div>


                        <div class="form-group">
                          <label for="tanggal">Tanggal</label>
                          <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{$date}}" placeholder="Tanggal">
                        </div>

                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="kepada">Kepada : </label><span id="kepadalabel"></span>
                      </div>

                      <div class="form-group">
                        <label for="nomor">Nomor Handphone : </label><span id="handphonelabel"></span>
                      </div>

                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-12">
                      <div class="box-body no-padding">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <th>Nama Barang</th>
                            <th style="width: 130px">Harga Satuan</th>
                            <th style="width: 60px">P</th>
                            <th style="width: 60px">L</th>
                            <th style="width: 60px">Kuantitas</th>
                            <th style="width: 170px">Finishing</th>
                            <th style="width: 170px">Keterangan</th>
                            <th  style="width: 130px">Sub Total</th>
                            <th style="width: 100px">Tool</th>
                          </thead>
                          <tbody>
                            
                            
                          </tbody>
                        </table>
                      </div>
                      
                  </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                <div class="row">
                      <div class="col-md-12">
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" id="buttonmodal_add" data-target="#modal_add"><i class="fa fa-plus"> </i> Item</button>
                      </div>
                </div>

                <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-6">
                                                     
                          </div>
                          <div class="col-md-3">
                              <label>Diskon %
                                  <input id="diskon" name="diskon" value="0.00" class="form-control" type="text">
                              </label>                                  
                          </div>
                          <div class="col-md-3">
                              <label>Total
                                  <input id="total" name="total"  value="0.00"  class="form-control" type="text">
                                  <input id="total2" name="total2"  value="0.00"  class="form-control" type="text">
                              </label>                                  
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-6">
                                                     
                          </div>
                          <div class="col-md-3">
                              <label>Pembayaran DP
                                  <input id="bayardp" name="bayardp" value="0.00"  class="form-control" type="text">
                              </label>                                  
                          </div>
                          <div class="col-md-3">
                            <label>Pembayaran
                              <select class="form-control  pull-right" value="0.00"  id="pembayaran" name="pembayaran" style="width: 100%;">
                                  <option value="Cash">Cash</option>
                                  <option value="Transfer">Transfer</option>
                              </select>
                            </label>           
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-9">
                                                     
                          </div>
                          <div class="col-md-3">
                                <label>
                                    <input type="radio" name="metode" value="lunas" class="minimal-red">
                                    Lunas
                                    <input type="radio" name="metode" value="dp" class="minimal-red">
                                    DP 50%     
                                </label>
                                              
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-6">
                                                     
                          </div>
                          <div class="col-md-3">
                                <label>Pajak %
                                    <input id="pajak" name="pajak"  value="0.00"  class="form-control" type="text">
                                </label>                     
                          </div>
                          <div class="col-md-3">
                                <label>Sisa
                                    <input id="sisa" name="sisa"  value="0.00"  class="form-control" type="text">
                                </label>  
                                              
                          </div>
                      </div>
                  </div>
                <hr>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="btn-grp pull-right">
                            <button type="button" id="cetaknota" class="btn btn-danger btn-sm"><i class="fa fa-print"> </i> Cetak</button>                              
                            <button type="button" id="transaksibaru" class="btn btn-info btn-sm"><i class="fa fa-cart-plus"> </i> Transaksi Baru</button>
                            <button type="button" id="submittransaksi" class="btn btn-success   btn-sm"><i class="fa fa-check-circle"> </i> Simpan</button> 
                        </div>
                            
                      </div>
                  </div>
                  
                </div>
            </div>
          </div>

          <div class="modal fade" id="modal_add">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Tambah Item</h4>
                      </div>
                      <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group ui-widget">
                                          <label>Produk</label>
                                          <select id="add_produk" name="add_produk" class="form-control select2" style="width:100%;" type="text"></select>
                                          <input id="add_produkid" name="add_produkid" class="form-control" type="hidden">

                                      </div>
                                      <div class="form-group">
                                          <label>Harga</label>
                                          <input id="add_harga" name="add_harga" class="form-control" type="text">
                                          {{csrf_field()}}
                                      </div>
                                      <div class="form-group">
                                          <label>P</label>
                                          <input id="add_panjang" name="add_panjang" class="form-control pull-right" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>L</label>
                                          <input id="add_lebar" name="add_lebar" class="form-control pull-right" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Satuan  :</label>
                                            <input type="radio" id="r2cm" name="r2" class="minimal-red" value="cm">
                                            Centimeter
                                            <input type="radio" id="r2m" name="r2" class="minimal-red" value="m">
                                            Meter
                                      </div>
                                      <div class="form-group">
                                          <label>Kuantitas</label>
                                          <input id="add_kuantitas" name="add_kuantitas" class="form-control pull-right" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Finishing</label>
                                          <select class="form-control select2" id="add_finishing" name="add_finishing" style="width: 100%;">
                                              <option value="Tanpa Finishing">Tanpa Finishing</option>
                                              <option value="Mata Ayam">Mata Ayam</option>
                                              <option value="Selongsong Atas Bawah">Selongsong Atas Bawah</option>
                                              <option value="Selongsong Kanan Kiri">Selongsong Kanan Kiri</option>
                                              <option value="Potong Pas">Potong Pas</option>
                                              <option value="Potong Perbagian">Potong Perbagian</option>
                                              <option value="Laminasi Glossy">Laminassy Glossy</option>
                                              <option value="Laminasi Dop">Laminasi Dop</option>
                                              <option value="Lainnya">Lainnya</option>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label>Keterangan</label>
                                          <textarea id="add_keterangan" name="add_keterangan" class="form-control pull-right" type="text"></textarea>
                                      </div>
                                      <div class="form-group">
                                          <label>Subtotal</label>
                                          <input id="add_subtotal" name="add_subtotal" class="form-control pull-right" type="text">
                                      </div>
                                      <!-- /.form-group -->
                                  </div>
                              </div>
                      </div>
                      <div class="modal-footer">
                          
                          <button type="button" class="btn btn-default pull-left" id="closeitem" data-dismiss="modal">Keluar</button>
                          <button type="button" id="additem" class="btn btn-success">Simpan</button>
                      </div>
                  </div>
                  <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
          </div>

          <div class="modal fade" id="modal_edit">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Item</h4>
                      </div>
                      <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group ui-widget">
                                          <label>Produk</label>
                                          <select id="edit_produk" name="edit_produk"  class="form-control select2" style="width:100%;" type="text"></select>
                                          <input id="edit_produkid" name="edit_produkid" readonly class="form-control" type="hidden">
                                          <input id="edit_subtotalawal" name="edit_subtotalawal" readonly class="form-control" type="hidden">
                                      </div>
                                      <div class="form-group">
                                          <label>Harga</label>
                                          <input id="edit_harga" name="edit_harga" class="form-control" type="text">
                                          {{csrf_field()}}
                                      </div>
                                      <div class="form-group">
                                          <label>P</label>
                                          <input id="edit_panjang" name="edit_panjang" class="form-control pull-right" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>L</label>
                                          <input id="edit_lebar" name="edit_lebar" class="form-control pull-right" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Satuan  :</label>
                                            <input type="radio" id="r2editcm" name="r2edit" class="minimal-red" value="cm">
                                            Centimeter
                                            <input type="radio" id="r2editm" name="r2edit" class="minimal-red" value="m">
                                            Meter
                                      </div>
                                      <div class="form-group">
                                          <label>Kuantitas</label>
                                          <input id="edit_kuantitas" name="edit_kuantitas" class="form-control pull-right" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Finishing</label>
                                          <select class="form-control select2" id="edit_finishing" name="edit_finishing" style="width: 100%;">
                                              <option value="Tanpa Finishing">Tanpa Finishing</option>
                                              <option value="Mata Ayam">Mata Ayam</option>
                                              <option value="Selongsong Atas Bawah">Selongsong Atas Bawah</option>
                                              <option value="Selongsong Kanan Kiri">Selongsong Kanan Kiri</option>
                                              <option value="Potong Pas">Potong Pas</option>
                                              <option value="Potong Perbagian">Potong Perbagian</option>
                                              <option value="Laminasi Glossy">Laminassy Glossy</option>
                                              <option value="Laminasi Dop">Laminasi Dop</option>
                                              <option value="Lainnya">Lainnya</option>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label>Keterangan</label>
                                          <textarea id="edit_keterangan" name="edit_keterangan" class="form-control pull-right" type="text"></textarea>
                                      </div>
                                      <div class="form-group">
                                          <label>Subtotal</label>
                                          <input id="edit_subtotal" name="edit_subtotal" class="form-control pull-right" type="text">
                                      </div>
                                      <!-- /.form-group -->
                                  </div>
                              </div>
                      </div>
                      <div class="modal-footer">
                          
                          <button type="button" class="btn btn-default pull-left" id="closeitem" data-dismiss="modal">Keluar</button>
                          <button type="button" id="edititem" class="btn btn-success">Simpan</button>
                      </div>
                  </div>
                  <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
          </div>

        </div>

        </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

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

    <script src="http://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>

    <!-- bootstrap datepicker -->
    <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>


    <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>
    <!-- <script src="{{asset('bower_components/jquery-number/jquery.number.js')}}"></script> -->

    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script>

      var total3=0;
      var total2=0;
      var total=0;
      var diskon=0;
      var namaproduk="";
      var totalbeforediskon=0;
      var totalbeforepajak=0;
      var totalbeforedp=0;
      var nominaldiskon=0;
      var pajak=0;
      var nominalpajak=0;
      var sisa=0;
      var bayardp=0;
      var satuan="";
      var tdid=0;
      var subtotalawal=0;
      var tdidnow=0;

      $(function(){

        $('input[name="tanggal"]').datepicker({
            format: "yyyy-mm-dd",
        });


        $("#add_harga").keydown(function (e) {
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

        $("#add_kuantitas").keydown(function (e) {
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

        $('input[type=radio][name=metode]').on('ifClicked',function () {
            // alert("asd");
            if (this.value == 'lunas') {
                sisa=0;
                $('#bayardp').val(total).trigger('mask.maskMoney');
                $('#sisa').val(sisa).trigger('mask.maskMoney');
            }
            else if (this.value == 'dp') {
                bayardp=total / 2;
                sisa=total-bayardp;
                $('#bayardp').val(bayardp).trigger('mask.maskMoney');
                $('#sisa').val(sisa).trigger('mask.maskMoney');
            }
        });

        $('input[type=radio][name=r2]').on('ifClicked',function () {
            // alert("asd");
            if (this.value == 'cm') {
                
                var harga=parseFloat($('#add_harga').val());
                var panjang=parseFloat($('#add_panjang').val());
                var lebar=parseFloat($('#add_lebar').val());
                var kuantitas=parseFloat($('#add_kuantitas').val());
                
                // subtotal################
                
                var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                satuan=this.value;
            }
            else if (this.value == 'm') {
                
                var harga=parseFloat($('#add_harga').val());
                var panjang=parseFloat($('#add_panjang').val());
                var lebar=parseFloat($('#add_lebar').val());
                var kuantitas=parseFloat($('#add_kuantitas').val());
                // var subtotal=0;
                
                var subtotal = ((panjang * lebar) * harga / 1000) * kuantitas;
                $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                satuan=this.value;
                
            }
        });

        

        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass   : 'iradio_minimal-red'
        });
    
        $('#add_produk').select2({
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

        $('#edit_produk').select2({
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

        $('#pelanggan').select2({
            placeholder: "Pilih Pelanggan.",
            minimumInputLength: 1,
            ajax: {
                url: '',
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
        
        $('#diskon').maskMoney({thousands:'', decimal:'.',allowZero:true}); 
        $('#total').maskMoney({thousands:'', decimal:'.',allowZero:true}); 
        $('#total2').maskMoney({thousands:'', decimal:'.',allowZero:true}); 
        $('#bayardp').maskMoney({thousands:'', decimal:'.',allowZero:true}); 
        $('#pajak').maskMoney({thousands:'', decimal:'.',allowZero:true}); 
        $('#sisa').maskMoney({thousands:'', decimal:'.',allowZero:true}); 

      });
      
        function diskonmethod(total2,diskon,total,pajak){
            if ($('#diskon').val()=="0.00"){
            nominaldiskon=0;
            total=total2 + nominaldiskon + nominalpajak;
            $('#bayardp').val('0').trigger('mask.maskMoney');
            $('#sisa').val('0').trigger('mask.maskMoney');
            return total;
            
            }
            else
            {
            nominaldiskon=(total2 * (diskon)) /100;
            total=total2 - nominaldiskon + nominalpajak;
            $('#bayardp').val('0').trigger('mask.maskMoney');
            $('#sisa').val('0').trigger('mask.maskMoney');
            return total;
                
            }
        }

        function pajakmethod(total2,diskon,total,pajak){
            if ($('#pajak').val()=="0.00")
            {
                nominalpajak=0;
                total=total2 + nominalpajak - nominaldiskon;
                $('#bayardp').val('0').trigger('mask.maskMoney');
                $('#sisa').val('0').trigger('mask.maskMoney');
                return total;
            }
            else
            {
                nominalpajak=(total2 * (pajak)) /100;
                total=total2 + nominalpajak - nominaldiskon;
                $('#bayardp').val('0').trigger('mask.maskMoney');
                $('#sisa').val('0').trigger('mask.maskMoney');
                return total;
                
            }
        }

        function bayardpmethod(bayardp,total,total2,bayardp){
            if (bayardp > total){
            bayardp=0;
            sisa=0;
            $('#bayardp').val(bayardp).trigger('mask.maskMoney');
            $('#sisa').val(sisa).trigger('mask.maskMoney');
            }
            else
            {
                bayardp=$('#bayardp').val();
                sisa=total-bayardp;
                $('#bayardp').val(bayardp).trigger('mask.maskMoney');
                $('#sisa').val(sisa).trigger('mask.maskMoney');
            }
        }

    //   bagian form
      $('#diskon').blur(function(){
          total2=parseFloat($('#total2').val());
          diskon=parseFloat($('#diskon').val());
          total=parseFloat($('#total').val());
          pajak=parseFloat($('#pajak').val());          
        //   var nominaldiskon=0;
          total=diskonmethod(total2,diskon,total,pajak);

          $('#total').val(total).trigger('mask.maskMoney');

      });
      $('#diskon').focus(function(){
          totalbeforediskon=parseFloat($('#total').val());
      });

      $('#pajak').blur(function(){
          total2=parseFloat($('#total2').val());
          diskon=parseFloat($('#diskon').val());
          pajak=parseFloat($('#pajak').val());
          total=parseFloat($('#total').val());

          total=pajakmethod(total2,diskon,total,pajak); 

          $('#total').val(total).trigger('mask.maskMoney');          
          
      });
      $('#pajak').focus(function(){
          totalbeforepajak=parseFloat($('#total').val());
      });

      $('#bayardp').keyup(function(){
        bayardpmethod(bayardp,total,total2,bayardp);
      });
      $('#bayardp').focus(function(){
        totalbeforedp=parseFloat($('#total').val());
      });


      $('#submittransaksi').click(function(){
          // $("tbody").append(
          //   '<p>'+$('input[name="produk[0]"]').val()+'</p>'
          // );
          $('input[name^="produk[]"]').each(function() {
            alert($(this).val());
          });
      });

    // bagian form


        //bagian modal add

        $('#add_produk').on('select2:select', function (e) {
            // alert($('add_produk').select2('val'));
            
            var id=e.params.data.id;
            $('#add_produkid').val(id);
            namaproduk=e.params.data.text;
            $.ajax({
                async: true, 
                type:'get',
                url:'{{route('produkharga')}}',
                data: 'id='+id,
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    $('#add_harga').val(response).trigger('mask.maskMoney');  
                },
            });

        });

        $('#buttonmodal_add').click(function (){
            $('input[type=radio][name=r2]').on('ifChecked',function () {
                // alert("asd");
                if (this.value == 'cm') {
                    satuan=this.value;
                }
                else if (this.value == 'm') {
                    satuan=this.value;
                }
            });
            $('#add_produk').val('').trigger('change');            
            $('#add_harga').val('0.00').maskMoney({thousands:'', decimal:'.',allowZero:true}); 
            $('#add_subtotal').val('0.00').maskMoney({thousands:'', decimal:'.',allowZero:true});
            $('#add_kuantitas').val('0.00').maskMoney({thousands:'', decimal:'.',allowZero:true});
            $('#add_panjang').val('0.00').maskMoney({thousands:'', decimal:'.',allowZero:true});
            $('#add_lebar').val('0.00').maskMoney({thousands:'', decimal:'.',allowZero:true});
            $('#add_subtotal').val('0.00').maskMoney({thousands:'', decimal:'.',allowZero:true});
        });
        

        $('#additem').click(function(){

            var produk=$('#add_produk').val();

            var produkid=$('#add_produkid').val();
            var harga=$('#add_harga').val();
            var panjang=$('#add_panjang').val();
            var lebar=$('#add_lebar').val();
            var kuantitas=$('#add_kuantitas').val();
            var finishing=$('#add_finishing').val();
            var keterangan=$('#add_keterangan').val();
            var subtotal=$('#add_subtotal').val();
            

            $('input[type=radio][name=r2]').on('ifChecked',function () {
                // alert("asd");
                if (this.value == 'cm') {
                    satuan=this.value;
                }
                else if (this.value == 'm') {
                    satuan=this.value;
                }
            });    


            total=parseFloat($('#total').val());
            total=parseFloat(subtotal)+total;
            
            $('#total2').val(total).trigger('mask.maskMoney');
            
            $('#total').val(total).trigger('mask.maskMoney');
            tdid=tdid+1;
            $("tbody").append(
            '<tr id="'+tdid+'"><td>'+namaproduk+'<input type="hidden" readonly disabled id="produk[]" value="'+produk+'" name="produk[]"><input type="hidden" readonly disabled id="produkid[]" value="'+produkid+'" name="produkid[]"></td><td>'+harga+'<input type="hidden" readonly disable id="harga[]" value="'+harga+'" name="harga[]"></td><td>'+panjang+'<input type="hidden" readonly disable id="panjang[]" value="'+panjang+'" name="panjang[]"></td><td>'+lebar+'<input type="hidden" readonly disable id="lebar[]" value="'+lebar+'" name="lebar[]"></td><td>'+kuantitas+'<input type="hidden" readonly disable id="kuantitas[]" value="'+kuantitas+'" name="kuantitas[]"></td><td>'+finishing+'<input type="hidden" readonly disable id="finishing[]" value="'+finishing+'" name="finishing[]"></td><td>'+keterangan+'<input type="hidden" readonly disable id="keterangan[]" value="'+keterangan+'" name="keterangan[]"></td><td>'+subtotal+'<input type="hidden" readonly disable id="subtotal[]" value="'+subtotal+'" name="subtotal[]"></td><td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-satuan="'+satuan+'" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-namaproduk="'+namaproduk+'" data-subtotal="'+subtotal+'" data-tdid="'+tdid+'" data-target="#modal_edit"><i class="fa fa-edit"></i></button><button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-tdid="'+tdid+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-subtotal="'+subtotal+'" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td></tr>'
            );

            $('#modal_add').modal('hide');
        });

        $('#add_kuantitas').keyup(function(){
            if ($('#r2').val() =="cm") {
                var harga=parseFloat($('#add_harga').val());
                var panjang=parseFloat($('#add_panjang').val());
                var lebar=parseFloat($('#add_lebar').val());
                var kuantitas=parseFloat($('#add_kuantitas').val());
                

                // subtotal################
                
                var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
            }
            else
            {
                var harga=parseFloat($('#add_harga').val());
                var panjang=parseFloat($('#add_panjang').val());
                var lebar=parseFloat($('#add_lebar').val());
                var kuantitas=parseFloat($('#add_kuantitas').val());
                // var subtotal=0;

                // subtotal################
                
                var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
            }
        });

      //bagianmodal add
      
      //bagian modal edit
        

        $(document).on('click','.modal_edit',function () {

            if ($(this).data('satuan')=="cm"){
                $('#r2editcm').iCheck('check');
            }
            else
            {
                $('#r2editm').iCheck('check');
            }
            
            var data = {
                id: $(this).data('produk'),
                text: $(this).data('namaproduk')
            };
            
            subtotalawal=$(this).data('subtotal');

            var newOption = new Option(data.text, data.id, false, false);
            $('#edit_produk').append(newOption).trigger('change');
            
            tdidnow=$(this).data('tdid');            

            $('#edit_harga').val($(this).data('harga')).maskMoney({thousands:'', decimal:'.',allowZero:true}); 
            $('#edit_subtotal').val($(this).data('subtotal')).maskMoney({thousands:'', decimal:'.',allowZero:true});
            $('#edit_kuantitas').val($(this).data('kuantitas')).maskMoney({thousands:'', decimal:'.',allowZero:true});
            $('#edit_panjang').val($(this).data('panjang')).maskMoney({thousands:'', decimal:'.',allowZero:true});
            $('#edit_keterangan').val($(this).data('keterangan'));
            $('#edit_lebar').val($(this).data('lebar')).maskMoney({thousands:'', decimal:'.',allowZero:true});
            $('#edit_subtotal').val($(this).data('subtotal')).maskMoney({thousands:'', decimal:'.',allowZero:true});

        });

        $('#edit_produk').on('select2:select', function (e) {
            
            var id=e.params.data.id;
            $('#edit_produkid').val(id);
            $.ajax({
                async: true, 
                type:'get',
                url:'{{route('produkharga')}}',
                data: 'id='+id,
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    $('#edit_harga').val(response).trigger('mask.maskMoney');  
                },
            });

        });

        $('#edititem').click(function(){

            var produk=$('#edit_produk').val();

            var produkid=$('#edit_produkid').val();
            var harga=$('#edit_harga').val();
            var panjang=$('#edit_panjang').val();
            var lebar=$('#edit_lebar').val();
            var kuantitas=$('#edit_kuantitas').val();
            var finishing=$('#edit_finishing').val();
            var keterangan=$('#edit_keterangan').val();
            var subtotal=$('#edit_subtotal').val();
            

            $('input[type=radio][name=r2edit]').on('ifChecked',function () {
                // alert("asd");
                if (this.value == 'cm') {
                    satuan=this.value;
                }
                else if (this.value == 'm') {
                    satuan=this.value;
                }
            });    



            total=parseFloat($('#total').val());
            total=parseFloat(subtotal)+(total-subtotalawal);
            
            $('#total2').val(total).trigger('mask.maskMoney');
            
            $('#total').val(total).trigger('mask.maskMoney');
            var isi='<td>'+namaproduk+'<input type="hidden" readonly disabled id="produk[]" value="'+produk+'" name="produk[]"><input type="hidden" readonly disabled id="produkid[]" value="'+produkid+'" name="produkid[]"></td><td>'+harga+'<input type="hidden" readonly disable id="harga[]" value="'+harga+'" name="harga[]"></td><td>'+panjang+'<input type="hidden" readonly disable id="panjang[]" value="'+panjang+'" name="panjang[]"></td><td>'+lebar+'<input type="hidden" readonly disable id="lebar[]" value="'+lebar+'" name="lebar[]"></td><td>'+kuantitas+'<input type="hidden" readonly disable id="kuantitas[]" value="'+kuantitas+'" name="kuantitas[]"></td><td>'+finishing+'<input type="hidden" readonly disable id="finishing[]" value="'+finishing+'" name="finishing[]"></td><td>'+keterangan+'<input type="hidden" readonly disable id="keterangan[]" value="'+keterangan+'" name="keterangan[]"></td><td>'+subtotal+'<input type="hidden" readonly disable id="subtotal[]" value="'+subtotal+'" name="subtotal[]"></td><td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-satuan="'+satuan+'" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-namaproduk="'+namaproduk+'" data-subtotal="'+subtotal+'" data-tdid="'+tdid+'" data-target="#modal_edit"><i class="fa fa-edit"></i></button><button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-tdid="'+tdid+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-subtotal="'+subtotal+'" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td>';
            $('#'+tdidnow+'').replaceWith(isi);

            // $("tbody").append(
            // '<tr id="'+tdid+'"><td>'+namaproduk+'<input type="hidden" readonly disabled id="produk[]" value="'+produk+'" name="produk[]"><input type="hidden" readonly disabled id="produkid[]" value="'+produkid+'" name="produkid[]"></td><td>'+harga+'<input type="hidden" readonly disable id="harga[]" value="'+harga+'" name="harga[]"></td><td>'+panjang+'<input type="hidden" readonly disable id="panjang[]" value="'+panjang+'" name="panjang[]"></td><td>'+lebar+'<input type="hidden" readonly disable id="lebar[]" value="'+lebar+'" name="lebar[]"></td><td>'+kuantitas+'<input type="hidden" readonly disable id="kuantitas[]" value="'+kuantitas+'" name="kuantitas[]"></td><td>'+finishing+'<input type="hidden" readonly disable id="finishing[]" value="'+finishing+'" name="finishing[]"></td><td>'+keterangan+'<input type="hidden" readonly disable id="keterangan[]" value="'+keterangan+'" name="keterangan[]"></td><td>'+subtotal+'<input type="hidden" readonly disable id="subtotal[]" value="'+subtotal+'" name="subtotal[]"></td><td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-satuan="'+satuan+'" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-namaproduk="'+namaproduk+'" data-subtotal="'+subtotal+'" data-tdid="'+tdid+'" data-target="#modal_edit"><i class="fa fa-edit"></i></button><button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-tdid="'+tdid+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-subtotal="'+subtotal+'" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td></tr>'
            // );

            $('#modal_edit').modal('hide');
        });
      //bagian model edit

      
    </script>
    

    </body>
@endsection
