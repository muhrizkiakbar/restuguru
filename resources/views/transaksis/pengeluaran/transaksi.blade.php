@extends('layouts.app')
@push('style')

    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <body class="hold-transition skin-green sidebar-mini">
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
          <form id="formtrans">
          <div class="col-md-3">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Penerima</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body">

                      <div class="form-group">
                        <input type="text" class="form-control" id="namapelanggan" name="namapelanggan" placeholder="Nama Penerima">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="nomorhandphone" name="nomorhandphone" placeholder="Nomor Handphone">
                      </div>
                      <div class="form-group">
                        <select id="pelanggan" name="pelanggan" class="form-control select2" style="width:100%;" type="text"></select>
                      </div>
                      <div class="form-group">
                        <select id="supplier" name="supplier" class="form-control select2" style="width:100%;" type="text"></select>
                      </div>
                      <div class="form-group">
                            <select class="form-control select2"  id="jenispengeluaran" name="jenispengeluaran" style="width: 100%;">
                                @foreach ($jenispengeluarans as $key => $jenispengeluaran)
                                    <option value="{{encrypt($jenispengeluaran->id)}}">{{$jenispengeluaran->jenis_pengeluaran}}</option>
                                @endforeach
                            </select>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" id="submitpelanggan" class="btn btn-success btn-sm">Submit <i class="fa fa-chevron-circle-right"></i></button>
                </div>
            </div>
          </div>
          </form>

          <div class="col-md-9">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Pengeluaran <i class="fa  fa-shopping-cart"></i></h3>
              </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="no">No. Nota : </label><span id="nonota"></span>
                      </div>


                        <div class="form-group">
                          <label for="tanggal">Tanggal</label>
                          <input type="text" class="form-control" id="tanggal" readonly name="tanggal" style="max-width:100px;" value="{{$date}}" placeholder="Tanggal">
                        </div>

                    </div>
                  </div>
                  <div class="col-md-5">
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
                            <th>Pengeluaran</th>
                            <th style="width: 130px">Harga Satuan</th>
                            <th style="width: 60px">P</th>
                            <th style="width: 60px">L</th>
                            <th style="width: 60px">Kuantitas</th>
                            <th style="width: 170px">Keterangan</th>
                            <th  style="width: 130px">Subtotal</th>
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
                      <button type="button" class="btn btn-success btn-sm" data-tes="tes" data-toggle="modal" id="buttonmodal_add" disabled data-target="#modal_add"><i class="fa fa-plus"> </i> Item</button>
                      </div>
                </div>

                <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-6">
                                                     
                          </div>
                          <div class="col-md-3">
                              <label>Pembayaran / DP
                                  <input id="bayardp" name="bayardp" value="0,00"  class="form-control" type="text">
                              </label>                                  
                          </div>
                          <div class="col-md-3">
                              <label>Total
                                  <input id="total" name="total"  value="0,00"  class="form-control" readonly type="text">
                                  <input id="total2" name="total2"  value="0,00"  class="form-control" readonly type="hidden">
                              </label>                                  
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-6">
                                                     
                          </div>
                          <div class="col-md-3">    
                            <label>Pembayaran
                              <select class="form-control  pull-right"  id="pembayaran" name="pembayaran" style="width: 100%;">
                                  <option value="Cash">Cash</option>
                                  <option value="Transfer">Transfer</option>
                              </select>
                            </label>                     
                          </div>
                          <div class="col-md-3">
                                <label>Tagihan
                                    <input id="sisa" name="sisa"  value="0,00"  class="form-control" readonly type="text">
                                </label>  
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-6">
                                                     
                          </div>
                          <div class="col-md-3">
                                <label>
                                    <input type="radio" name="metode" id="metodelunas" value="lunas" class="minimal-red">
                                    Lunas 
                                </label>                 
                          </div>
                          <div class="col-md-3">
                                
                                              
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-6">
                                                     
                          </div>
                          <div class="col-md-3">
                                               
                          </div>
                          <div class="col-md-3">
                                
                                              
                          </div>
                      </div>
                  </div>
                <hr>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="btn-grp pull-right">                           
                            <button type="button" id="transaksibaru" class="btn btn-warning btn-sm"><i class="fa fa-cart-plus"> </i> Transaksi Baru</button>
                            <button type="button" id="submittransaksi" class="btn btn-success btn-sm"><i class="fa fa-check-circle"> </i> Simpan</button> 
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
                                          <label>Pengeluaran</label>
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
                                          <label>Pengeluaram</label>
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

            <div class="modal modal-danger fade" id="modal_delete">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Item</h4>
                            </div>
                            <div class="modal-body">
                                <form id="formdeleteuser" action="" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus item <span class="labelitem"></span>?
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Keluar</button>
                                <button type="button" id="deleteitem" class="btn btn-outline">Simpan</button>
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

      var jenismodal="";
    
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
      var hitung_luas=1;
      var tdid=0;
      var subtotalawal=0;
      var tdidnow=0;
      var subtotaldelete=0;

        Number.prototype.format = function(n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));
            
            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };


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

        $("#add_panjang").keydown(function (e) {
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

        $("#add_lebar").keydown(function (e) {
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
            var harga=($('#add_harga').maskMoney('unmasked')[0]);
            var panjang=($('#add_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#add_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#add_kuantitas').maskMoney('unmasked')[0]);
            
            if (this.value == 'cm') {
                
                
                // subtotal################
                
                // var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                // $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                satuan=this.value;
            }
            else if (this.value == 'm') {
                
              
                
                // var subtotal = ((panjang * lebar) * harga / 1000) * kuantitas;
                // $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                satuan=this.value;
                
            }
            else
            {
                satuan="pcs";
            }
        });

        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass   : 'iradio_minimal-red'
        });
    
        $('#add_produk').select2({
            tags: true,
            placeholder: "Pilih Bahan Baku.",
            minimumInputLength: 1,
            ajax: {
                url: '{{route('bahanbakucari')}}',
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
            tags: true,
            placeholder: "Pilih Bahan Baku.",
            minimumInputLength: 1,
            ajax: {
                url: '{{route('bahanbakucari')}}',
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

        $("#edit_harga").keydown(function (e) {
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

        $("#edit_kuantitas").keydown(function (e) {
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

        $("#edit_panjang").keydown(function (e) {
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

        $("#edit_lebar").keydown(function (e) {
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

        $('input[type=radio][name=r2edit]').on('ifClicked',function () {
            // alert("asd");
            var harga=($('#edit_harga').maskMoney('unmasked')[0]);
            var panjang=($('#edit_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#edit_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#edit_kuantitas').maskMoney('unmasked')[0]);
            
            if (this.value == 'cm') {
                
                
                // subtotal################
                
                // var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                // $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                satuan=this.value;
            }
            else if (this.value == 'm') {
                
               
                
                // var subtotal = ((panjang * lebar) * harga / 1000) * kuantitas;
                // $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                satuan=this.value;
                
            }
            else{
                satuan="pcs";
            }
        });
        
        $('#jenispengeluaran').select2();
        
        $('#pembayaran').select2();

        $('#pelanggan').select2({
            placeholder: "Pilih Karyawan.",
            minimumInputLength: 1,
            ajax: {
                url: '{{route('searchusers')}}',
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
        
        $('#supplier').select2({
            placeholder: "Pilih Supplier.",
            minimumInputLength: 1,
            ajax: {
                url: '{{route('suppliersearch')}}',
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

        $('#bayardp').maskMoney({thousands:'.', decimal:',',allowZero:true});
        $('#total').maskMoney({thousands:'.', decimal:',',allowZero:true}); 
        $('#total2').maskMoney({thousands:'.', decimal:',',allowZero:true}); 
        $('#sisa').maskMoney({thousands:'.', decimal:',',allowZero:true}); 

      });
      
        function diskonmethod(total2,diskon,total,pajak){
            if ($('#diskon').maskMoney('unmasked')[0]=="0,00"){
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
            if ($('#pajak').maskMoney('unmasked')[0]=="0,00")
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
                bayardp=$('#bayardp').maskMoney('unmasked')[0];
                sisa=total-bayardp;
                $('#bayardp').val(bayardp).trigger('mask.maskMoney');
                $('#sisa').val(sisa).trigger('mask.maskMoney');
            }
        }

    //   bagian form
        $('#pelanggan').on('select2:select', function (e) {      
            var id=e.params.data.id;
            $.ajax({
                async: true, 
                type:'get',
                url:'{{route('searchdetailusers')}}',
                data: 'id='+id,
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    $('#supplier').val('').trigger('change');            
                    $('#namapelanggan').val(response.nama);
                    $('#nomorhandphone').val(response.Telepon);
                },
            });
        });

        $('#supplier').on('select2:select', function (e) {
            var id=e.params.data.id;
            $.ajax({
                async: true, 
                type:'get',
                url:'{{route('suppliersearchdetail')}}',
                data: 'id='+id,
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    $('#pelanggan').val('').trigger('change');            
                    $('#namapelanggan').val(response.nama_supplier);
                    $('#nomorhandphone').val(response.telpon_supplier);
                },
            });
        });


        $('#jenispengeluaran').on('select2:select',function (e){
            var id=e.params.data.id;
            $.ajax({
                async: true, 
                type:'get',
                url:'{{route('jenispengeluaransearch')}}',
                data: 'id='+id,
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                     console.log(response);
                },
            });
        });

        $('#transaksibaru').click(function(){
            $('tbody').empty();
            $('#bayardp').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true}).removeAttr('disabled');
            $('#pembayaran').removeAttr('disabled');
            $('#sisa').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#total').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#metode').iCheck('enable');
            $('#metode').iCheck('uncheck');
            $('#namapelanggan').val("").removeAttr('disabled');
            $('#nomorhandphone').val("").removeAttr('disabled');
            $('#pelanggan').val('').trigger('change');
            $('#supplier').val('').trigger('change');
            $('#submitpelanggan').removeAttr('disabled');
            $('#pelanggan').removeAttr('disabled');
            $('#supplier').removeAttr('disabled');
            $('#jenispengeluaran').removeAttr('disabled');            
            $('#jenispengeluaran').select2('val',null);                        
            $('#buttonmodal_add').attr('disabled',true);
            $('#kepadalabel').text('');
            $('#handphonelabel').text('');    

             jenismodal="";
    
             total3=0;
             total2=0;
             total=0;
             diskon=0;
             namaproduk="";
             totalbeforediskon=0;
             totalbeforepajak=0;
             totalbeforedp=0;
             nominaldiskon=0;
             pajak=0;
             nominalpajak=0;
             sisa=0;
             bayardp=0;
             satuan="";
             hitung_luas=1;
             tdid=0;
             subtotalawal=0;
             tdidnow=0;
             subtotaldelete=0;       
        });

        $('#bayardp').keyup(function(){
            bayardpmethod(bayardp,total,total2,bayardp);
        });
        $('#bayardp').focus(function(){
            totalbeforedp=($('#total').maskMoney('unmasked')[0]);
        });
        
        $(document).on('click','#submitpelanggan',function (){
            var namapelanggan=$('#namapelanggan').val();
            var nomorhandphone=$('#nomorhandphone').val();
            // console.log(namapelanggan);
            if ((namapelanggan=="") || (nomorhandphone=="")){
                swal("Gagal", "Data Pelanggan Tidak Valid", "error");
            }
            else
            {
                $('#namapelanggan').attr('disabled',true);
                $('#nomorhandphone').attr('disabled',true);
                $('#pelanggan').attr('disabled',true);            
                $('#supplier').attr('disabled',true);            
                $('#handphonelabel').text('  '+$('#nomorhandphone').val());
                $('#kepadalabel').text('  '+$('#namapelanggan').val());

                var jenispengeluaran=$('#jenispengeluaran').val();

                $.ajax({
                    async: true, 
                    type:'get',
                    url:'{{route('jenispengeluaransearch')}}',
                    data: 'id='+jenispengeluaran,
                    dataType:'json',
                    async:false,
                    processData: false,
                    contentType: false,
                    success:function(response){
                        console.log(response.form_mode);
                        $('#buttonmodal_add').removeAttr('disabled');
                        // $('#buttonmodal_add').attr("data-mode",response.form_mode);
                        // $('#buttonmodal_add').data('tes',response.form_mode);
                        jenismodal=response.form_mode;
                        $('#submitpelanggan').attr('disabled',true);
                        $('#jenispengeluaran').attr('disabled',true);
                    },
                });

                
            }

            
        });

        $('#submittransaksi').click(function(){
            // $('input[name^="produk[]"]').each(function() {
            //     alert($(this).val());
            // });
            $('#bayardp').attr('disabled',true);
            $('#pembayaran').attr('disabled',true);
            $('#pajak').attr('disabled',true);
            $('#sisa').attr('disabled',true);
            $('#metode').iCheck('disable');
            $('#submittransaksi').attr('disabled',true);
            $('#buttonmodal_add').attr('disabled',true);
            var inputnamapelanggan=$('#namapelanggan').val();
            var inputjenispengeluaran=$('#jenispengeluaran').val();
            var inputnomorpelanggan=$('#nomorhandphone').val();
            var inputpelanggan=$('#pelanggan').val();            
            var inputsupplier=$('#supplier').val();            
            var inputdiskon=$('#diskon').maskMoney('unmasked')[0];
            var inputtotal=$('#total').maskMoney('unmasked')[0];
            var inputbayardp=$('#bayardp').maskMoney('unmasked')[0];
            var inputpembayaran=$('#pembayaran').val();
            var inputpajak=$('#pajak').maskMoney('unmasked')[0];
            var inputtanggal=$('#tanggal').val();
            var inputsisa=$('#sisa').maskMoney('unmasked')[0];
            var jsonprodukid=[];
            $('input[name^="produkid[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonprodukid.push(item);
            });
            var jsonproduk=[];
            $('input[name^="produk[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonproduk.push(item);
            });
            var jsonsatuan=[];
            $('input[name^="satuan[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonsatuan.push(item);
            });
            var jsonketerangan=[];
            $('input[name^="keterangan[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonketerangan.push(item);
            });
            var jsonharga=[];
            $('input[name^="harga[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonharga.push(item);
            });
            var jsonpanjang=[];
            $('input[name^="panjang[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonpanjang.push(item);
            });
            var jsonlebar=[];
            $('input[name^="lebar[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonlebar.push(item);
            });
            var jsonsubtotal=[];
            $('input[name^="subtotal[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonsubtotal.push(item);
            });
            var jsonkuantitas=[];
            $('input[name^="kuantitas[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonkuantitas.push(item);
            });

            var token = "{{ csrf_token() }}";

            if (inputbayardp > inputtotal){
                swal("Gagal", "Pembayaran DP lebih dari total.", "error");
            }
            else
            {
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'{{route('storetransaksipengeluaran')}}',
                    data: JSON.stringify({
                        inputnamapelanggan: inputnamapelanggan,
                        inputnomorpelanggan: inputnomorpelanggan,
                        inputpelanggan: inputpelanggan,
                        inputsupplier: inputsupplier,
                        inputtotal: inputtotal,
                        inputjenispengeluaran: inputjenispengeluaran,
                        inputbayardp: inputbayardp,
                        inputpembayaran: inputpembayaran,
                        inputsisa: inputsisa,
                        inputtanggal:inputtanggal,
                        jsonharga: jsonharga,
                        jsonpanjang: jsonpanjang,
                        jsonlebar: jsonlebar,
                        jsonproduk: jsonproduk,
                        jsonsatuan: jsonsatuan,
                        jsonkuantitas: jsonkuantitas,
                        jsonketerangan: jsonketerangan,
                        jsonsubtotal: jsonsubtotal,
                        _token : $('meta[name="csrf-token"]').attr('content')
                    }),
                    // data: new FormData($('#formtrans')[0]),
                    async:false,
                    processData: false,
                    contentType: 'application/json; charset=utf-8',
                    success:function(response){
                        if (response.status=="Success")
                        {
                            swal({
                                    title: "Berhasil",
                                    text: "Cetak transaksi ?",
                                    icon: "success",
                                    buttons: true,
                                    dangerMode: false,
                                    })
                                    .then((willPrint) => {
                                    if (willPrint) {
                                        var url = window.location.pathname + '/report/' + response.id;
                                        window.open(url, '_blank');
                                        $('tbody').empty();
                                        $('#bayardp').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true}).removeAttr('disabled');
                                        $('#pembayaran').removeAttr('disabled');
                                        $('#sisa').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
                                        $('#total').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
                                        $('#metode').iCheck('enable');
                                        $('#metode').iCheck('uncheck');
                                        $('#namapelanggan').val("").removeAttr('disabled');
                                        $('#nomorhandphone').val("").removeAttr('disabled');
                                        $('#pelanggan').val('').trigger('change');
                                        $('#submitpelanggan').removeAttr('disabled');
                                        $('#kepadalabel').text('');       
                                        $('#pelanggan').val('').trigger('change');
                                        $('#supplier').val('').trigger('change');
                                        $('#submitpelanggan').removeAttr('disabled');
                                        $('#pelanggan').removeAttr('disabled');
                                        $('#supplier').removeAttr('disabled');
                                        $('#jenispengeluaran').removeAttr('disabled');            
                                        $('#jenispengeluaran').select2('val',null);       
                                        $('#handphonelabel').text('');                                                                                
                                    } else {
                                        $('tbody').empty();
                                        $('#bayardp').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true}).removeAttr('disabled');
                                        $('#pembayaran').removeAttr('disabled');
                                        $('#sisa').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
                                        $('#total').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
                                        $('#metode').iCheck('enable');
                                        $('#metode').iCheck('uncheck');
                                        $('#namapelanggan').val("").removeAttr('disabled');
                                        $('#nomorhandphone').val("").removeAttr('disabled');
                                        $('#pelanggan').val('').trigger('change');
                                        $('#submitpelanggan').removeAttr('disabled');
                                        $('#kepadalabel').text('');
                                        $('#pelanggan').val('').trigger('change');
                                        $('#supplier').val('').trigger('change');
                                        $('#submitpelanggan').removeAttr('disabled');
                                        $('#pelanggan').removeAttr('disabled');
                                        $('#supplier').removeAttr('disabled');
                                        $('#jenispengeluaran').removeAttr('disabled');            
                                        $('#jenispengeluaran').select2('val',null);
                                        $('#handphonelabel').text('');           
                                    }
                                    });
                        }
                        else
                        {
                            swal("Gagal", "Gagal menyimpan transaksi !", "error");
                        }
                    },
                });
            }
        });

    // bagian form


        //bagian modal add

        $('#add_produk').on('select2:select', function (e) {
            // alert($('add_produk').select2('val'));
            
            var id=e.params.data.id;
            
            $('#add_produkid').val(id);
            var pelanggan=$('#pelanggan').val();
            console.log(id);
            namaproduk=e.params.data.text;
            // if (pelanggan==null)
            // {
            //     namaproduk=e.params.data.text;
            //     $.ajax({
            //         async: true, 
            //         type:'get',
            //         url:'{{route('produkharga')}}',
            //         data: 'id='+id,
            //         dataType:'json',
            //         async:false,
            //         processData: false,
            //         contentType: false,
            //         success:function(response){
            //             hitung_luas=response.hitung_luas;
            //             if (hitung_luas==1)
            //             {
            //                 $('#r2m').iCheck('uncheck');
            //                 $('#r2cm').iCheck('uncheck');
            //                 $('#r2m').iCheck('enable');
            //                 $('#r2cm').iCheck('enable');
            //                 $('#add_panjang').removeAttr('disabled');
            //                 $('#add_lebar').removeAttr('disabled');
            //             }
            //             else
            //             {
            //                 $('#r2m').iCheck('uncheck');
            //                 $('#r2cm').iCheck('uncheck');
            //                 $('#r2m').iCheck('disable');
            //                 $('#r2cm').iCheck('disable');
            //                 $('#add_panjang').attr('disabled',true);
            //                 $('#add_lebar').attr('disabled',true);
            //             }
                        
            //             $('#add_harga').val(response.harga_jual).trigger('mask.maskMoney');  
            //         },
            //     });
            // }
            // else
            // {
            //     // yang spesial price
            //     namaproduk=e.params.data.text;
            //     $.ajax({
            //         async: true, 
            //         type:'get',
            //         url:'{{route('priceprodukkhusus')}}',
            //         data: 'produkid='+id+'&pelanggan='+pelanggan,
            //         dataType:'json',
            //         async:false,
            //         processData: false,
            //         contentType: false,
            //         success:function(response){
            //             hitung_luas=response.hitung_luas;
            //             if (hitung_luas==1)
            //             {
            //                 $('#r2m').iCheck('uncheck');
            //                 $('#r2cm').iCheck('uncheck');
            //                 $('#r2m').iCheck('enable');
            //                 $('#r2cm').iCheck('enable');
            //                 $('#add_panjang').removeAttr('disabled');
            //                 $('#add_lebar').removeAttr('disabled');
            //             }
            //             else
            //             {
            //                 $('#r2m').iCheck('uncheck');
            //                 $('#r2cm').iCheck('uncheck');
            //                 $('#r2m').iCheck('disable');
            //                 $('#r2cm').iCheck('disable');
            //                 $('#add_panjang').attr('disabled',true);
            //                 $('#add_lebar').attr('disabled',true);
            //             }
                        
            //             $('#add_harga').val(response.harga_khusus).trigger('mask.maskMoney');  
            //         },
            //     });
            // }
        });

        $('#buttonmodal_add').click(function (){

            
            if (jenismodal=="mode_luas"){
                $('#add_panjang').removeAttr('disabled');
                $('#add_lebar').removeAttr('disabled');
                $('#r2m').iCheck('uncheck');
                $('#r2cm').iCheck('uncheck');
                $('#r2m').iCheck('enable');
                $('#r2cm').iCheck('enable');
                $('input[type=radio][name=r2]').on('ifChecked',function () {
                    // alert("asd");
                    if (this.value == 'cm') {
                        satuan=this.value;
                    }
                    else if (this.value == 'm') {
                        satuan=this.value;
                    }
                });
            }
            else if (jenismodal=="mode_pencairan"){
                $('#add_panjang').attr('disabled',true);
                $('#add_lebar').attr('disabled',true);
                $('#add_kuantitas').attr('disabled',true);               
                $('#r2m').iCheck('uncheck');
                $('#r2cm').iCheck('uncheck');
                $('#r2m').iCheck('disable');
                $('#r2cm').iCheck('disable');
            }
            else if (jenismodal=="mode_satuan"){
                $('#add_panjang').attr('disabled',true);
                $('#add_lebar').attr('disabled',true);
                $('#add_kuantitas').removeAttr('disabled');                
                $('#r2m').iCheck('uncheck');
                $('#r2cm').iCheck('uncheck');
                $('#r2m').iCheck('disable');
                $('#r2cm').iCheck('disable');
            }
            

            
            $('#add_produk').val('').trigger('change');   
            // $('#add_produk').select2().val('').trigger('change');                     
            $('#add_harga').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true}); 
            $('#add_subtotal').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#add_kuantitas').val('1.00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#add_panjang').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#add_lebar').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#add_subtotal').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
        });
        

        $('#additem').click(function(){

            var produk=$('#add_produk').val();
            var produkid=($('#add_produkid').val());
            var harga=$('#add_harga').maskMoney('unmasked')[0];
            var panjang=$('#add_panjang').maskMoney('unmasked')[0];
            var lebar=$('#add_lebar').maskMoney('unmasked')[0];
            var kuantitas=$('#add_kuantitas').maskMoney('unmasked')[0];
            var finishing=$('#add_finishing').val();
            var keterangan=$('#add_keterangan').val();
            var subtotal=$('#add_subtotal').maskMoney('unmasked')[0];
            
            if (isNaN(produkid)){
                console.log("id nya string");
                $('#add_produkid').val('');
                produkid=$('#add_produkid').val('');
            }   

            $('input[type=radio][name=r2]').on('ifChecked',function () {
                // alert("asd");
                if (this.value == 'cm') {
                    satuan=this.value;
                }
                else if (this.value == 'm') {
                    satuan=this.value;
                }
            });    


            total=($('#total').maskMoney('unmasked')[0]);
            total=(subtotal)+total;
            
            $('#total2').val(total).trigger('mask.maskMoney');
            
            $('#total').val(total).trigger('mask.maskMoney');
            tdid=tdid+1;
            console.log(namaproduk);
            $('#sisa').val(total).trigger('mask.maskMoney');
            $("tbody").append(
            '<tr id="'+tdid+'"><td>'+namaproduk+'<input type="hidden" readonly disabled id="produk[]" value="'+namaproduk+'" name="produk[]"><input type="hidden" readonly disabled id="namaproduk[]" value="'+namaproduk+'" name="namaproduk[]"><input type="hidden" readonly disabled id="satuan[]" value="'+satuan+'" name="satuan[]"><input type="hidden" readonly disabled id="produkid[]" value="'+produkid+'" name="produkid[]"></td><td>'+harga.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="harga[]" value="'+harga+'" name="harga[]"></td><td>'+panjang.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="panjang[]" value="'+panjang+'" name="panjang[]"></td><td>'+lebar.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="lebar[]" value="'+lebar+'" name="lebar[]"></td><td>'+kuantitas.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="kuantitas[]" value="'+kuantitas+'" name="kuantitas[]"></td><td style="width: 170px;word-break: break-all;">'+keterangan+'<input type="hidden" readonly disable id="keterangan[]" value="'+keterangan+'" name="keterangan[]"></td><td>'+subtotal.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="subtotal[]" value="'+subtotal+'" name="subtotal[]"></td><td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-satuan="'+satuan+'" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-namaproduk="'+namaproduk+'" data-subtotal="'+subtotal+'" data-tdid="'+tdid+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_edit"><i class="fa fa-edit"></i></button><button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-namaproduk="'+namaproduk+'" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-tdid="'+tdid+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-subtotal="'+subtotal+'" data-tdid="'+tdid+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td></tr>'
            );
            $('#submittransaksi').removeAttr('disabled');
            $('#modal_add').modal('hide');

        });

        $('#add_kuantitas').keyup(function(){
            // alert(satuan);
            var harga=($('#add_harga').maskMoney('unmasked')[0]);
            var panjang=($('#add_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#add_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#add_kuantitas').maskMoney('unmasked')[0]);
            
            if (hitung_luas==1){
                if (satuan =="cm") {
                    

                    // subtotal################
                    
                    var subtotal = harga * kuantitas;
                    
                    
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
                else
                {
                    

                    // subtotal################
                    
                    var subtotal = harga * kuantitas;
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
            }
            else
            {

                    var subtotal = (harga) * kuantitas;
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
            }
                
        });

        $('#add_harga').keyup(function(){
            // alert(satuan);
            var harga=($('#add_harga').maskMoney('unmasked')[0]);
            var panjang=($('#add_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#add_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#add_kuantitas').maskMoney('unmasked')[0]);
            
            if (hitung_luas==1){
                if (satuan =="cm") {
                    

                    // subtotal################
                    
                    var subtotal = harga * kuantitas;
                    
                    
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
                else
                {
                    
                    
                    var subtotal = harga * kuantitas;
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
            }
            else
            {

                    var subtotal = (harga) * kuantitas;
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
            }
                
        });
    
      //bagianmodal add
      
      //bagian modal edit
        
        $(document).on('click','.modal_edit',function () {

            if (jenismodal=="mode_luas"){
                $('#edit_panjang').removeAttr('disabled');
                $('edit_lebar').removeAttr('disabled');
                $('#r2editm').iCheck('uncheck');
                $('#r2editcm').iCheck('uncheck');
                $('#r2editm').iCheck('enable');
                $('#r2editcm').iCheck('enable');
                
                if ($(this).data('satuan')=="cm"){
                    $('#r2editcm').iCheck('check');
                    satuan="cm";
                }
                else if ($(this).data('satuan')=="m")
                {
                    $('#r2editm').iCheck('check');
                    satuan="m";
                }
                else
                {
                    satuan="";
                }
            }
            else if (jenismodal=="mode_pencairan"){
                $('#edit_panjang').attr('disabled',true);
                $('#edit_lebar').attr('disabled',true);
                $('#edit_kuantitas').attr('disabled',true);               
                $('#r2editm').iCheck('uncheck');
                $('#r2editcm').iCheck('uncheck');
                $('#r2editm').iCheck('disable');
                $('#r2editcm').iCheck('disable');
            }
            else if (jenismodal=="mode_satuan"){
                $('#edit_panjang').attr('disabled',true);
                $('#edit_lebar').attr('disabled',true);
                $('#edit_kuantitas').removeAttr('disabled');                
                $('#r2editm').iCheck('uncheck');
                $('#r2editcm').iCheck('uncheck');
                $('#r2editm').iCheck('disable');
                $('#r2editcm').iCheck('disable');
            }

            var data = {
                id: $(this).data('produk'),
                text: $(this).data('namaproduk')
            };
            
            subtotalawal=$(this).data('subtotal');

            var newOption = new Option(data.text, data.id, false, false);
            $('#edit_produk').append(newOption).trigger('change');
            

            // var $search = $('#edit_produk').data('select2').dropdown.$search || $('#edit_produk').data('select2').selection.$search;
            // $('#edit_produk').on("select2:selecting", function(e) {
            //     $search.val(e.params.args.data.text);
            // });

            console.log(data);
            tdidnow=$(this).data('tdid');     
            hitung_luas=$(this).data('hitungluas');
            // console.log($(this).data('hitungluas'));
            // if ($(this).data('hitungluas')==1){
            //     $('#r2editm').iCheck('uncheck');
            //     $('#r2editcm').iCheck('uncheck');
            //     $('#r2editm').iCheck('enabled');
            //     $('#r2editcm').iCheck('enabled');
            //     $('#edit_panjang').removeAttr('disabled');
            //     $('#edit_lebar').removeAttr('disabled');
            // }
            // else
            // {
            //     $('#r2editm').iCheck('uncheck');
            //     $('#r2editcm').iCheck('uncheck');
            //     $('#r2editm').iCheck('disable');
            //     $('#r2editcm').iCheck('disable');
            //     $('#edit_panjang').attr('disabled',true);
            //     $('#edit_lebar').attr('disabled',true);
            // }

            $('#edit_harga').val($(this).data('harga')).maskMoney({thousands:'.', decimal:',',allowZero:true}).trigger('mask.maskMoney'); 
            $('#edit_subtotal').val($(this).data('subtotal')).maskMoney({thousands:'.', decimal:',',allowZero:true}).trigger('mask.maskMoney');
            $('#edit_kuantitas').val($(this).data('kuantitas')).maskMoney({thousands:'.', decimal:',',allowZero:true}).trigger('mask.maskMoney');
            $('#edit_panjang').val($(this).data('panjang')).maskMoney({thousands:'.', decimal:',',allowZero:true}).trigger('mask.maskMoney');
            $('#edit_keterangan').val($(this).data('keterangan'));
            $('#edit_lebar').val($(this).data('lebar')).maskMoney({thousands:'.', decimal:',',allowZero:true}).trigger('mask.maskMoney');
            $('#edit_subtotal').val($(this).data('subtotal')).maskMoney({thousands:'.', decimal:',',allowZero:true}).trigger('mask.maskMoney');

        });

        $('#edit_produk').on('select2:select', function (e) {
            var id=e.params.data.id;
            $('#edit_produkid').val(id);
            namaproduk=e.params.data.text;            
            var pelanggan=$('#pelanggan').val();
            // if (pelanggan=="")
            // {
            //     $.ajax({
            //         async: true, 
            //         type:'get',
            //         url:'{{route('produkharga')}}',
            //         data: 'id='+id,
            //         dataType:'json',
            //         async:false,
            //         processData: false,
            //         contentType: false,
            //         success:function(response){
            //             hitung_luas=response.hitung_luas;
            //             if (hitung_luas==1)
            //             {
            //                 $('#r2editm').iCheck('uncheck');
            //                 $('#r2editcm').iCheck('uncheck');
            //                 $('#r2editm').iCheck('enabled');
            //                 $('#r2editcm').iCheck('enabled');
            //                 $('#edit_panjang').removeAttr('disabled');
            //                 $('#edit_lebar').removeAttr('disabled');
            //             }
            //             else
            //             {
            //                 $('#r2editm').iCheck('uncheck');
            //                 $('#r2editcm').iCheck('uncheck');
            //                 $('#r2editm').iCheck('disable');
            //                 $('#r2editcm').iCheck('disable');
            //                 $('#edit_panjang').attr('disabled',true);
            //                 $('#edit_lebar').attr('disabled',true);
            //             }
            //             $('#edit_harga').val(response.harga_jual).trigger('mask.maskMoney');  
            //         },
            //     });
            // }
            // else
            // {
            //     $.ajax({
            //         async: true, 
            //         type:'get',
            //         url:'{{route('priceprodukkhusus')}}',
            //         data: 'produkid='+id+'&pelanggan='+pelanggan,
            //         dataType:'json',
            //         async:false,
            //         processData: false,
            //         contentType: false,
            //         success:function(response){
            //             hitung_luas=response.hitung_luas;
            //             if (hitung_luas==1)
            //             {
            //                 $('#r2editm').iCheck('uncheck');
            //                 $('#r2editcm').iCheck('uncheck');
            //                 $('#r2editm').iCheck('enable');
            //                 $('#r2editcm').iCheck('enable');
            //                 $('#edit_panjang').removeAttr('disabled');
            //                 $('#edit_lebar').removeAttr('disabled');
            //             }
            //             else
            //             {
            //                 $('#r2editm').iCheck('uncheck');
            //                 $('#r2editcm').iCheck('uncheck');
            //                 $('#r2editm').iCheck('disable');
            //                 $('#r2editcm').iCheck('disable');
            //                 $('#edit_panjang').attr('disabled',true);
            //                 $('#edit_lebar').attr('disabled',true);
            //             }
                        
            //             $('#edit_harga').val(response.harga_khusus).trigger('mask.maskMoney');  
            //         },
            //     });
            // }

        });

        $('#edititem').click(function(){

            var produk=$('#edit_produk').val();

            var produkid=$('#edit_produkid').val();
            var harga=$('#edit_harga').maskMoney('unmasked')[0];
            var panjang=$('#edit_panjang').maskMoney('unmasked')[0];
            var lebar=$('#edit_lebar').maskMoney('unmasked')[0];
            var kuantitas=$('#edit_kuantitas').maskMoney('unmasked')[0];
            var finishing=$('#edit_finishing').val();
            var keterangan=$('#edit_keterangan').val();
            var subtotal=$('#edit_subtotal').maskMoney('unmasked')[0];
            

            $('input[type=radio][name=r2edit]').on('ifChecked',function () {
                // alert("asd");
                if (this.value == 'cm') {
                    satuan=this.value;
                }
                else if (this.value == 'm') {
                    satuan=this.value;
                }
            });    



            total=($('#total').maskMoney('unmasked')[0]);
            total=(subtotal)+(total-subtotalawal);
            
            $('#total2').val(total).trigger('mask.maskMoney');
            
            $('#total').val(total).trigger('mask.maskMoney');
            $('#sisa').val(total).trigger('mask.maskMoney');
            
            var isi='<td>'+namaproduk+'<input type="hidden" readonly disabled id="produk[]" value="'+namaproduk+'" name="produk[]"><input type="hidden" readonly disabled id="satuan[]" value="'+satuan+'" name="satuan[]"><input type="hidden" readonly disabled id="produkid[]" value="'+produkid+'" name="produkid[]"></td><td>'+harga.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="harga[]" value="'+harga+'" name="harga[]"></td><td>'+panjang.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="panjang[]" value="'+panjang+'" name="panjang[]"></td><td>'+lebar.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="lebar[]" value="'+lebar+'" name="lebar[]"></td><td>'+kuantitas.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="kuantitas[]" value="'+kuantitas+'" name="kuantitas[]"></td><td>'+keterangan+'<input type="hidden" readonly disable id="keterangan[]" value="'+keterangan+'" name="keterangan[]"></td><td>'+subtotal.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="subtotal[]" value="'+subtotal+'" name="subtotal[]"></td><td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-satuan="'+satuan+'" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-namaproduk="'+namaproduk+'" data-subtotal="'+subtotal+'" data-tdid="'+tdidnow+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_edit"><i class="fa fa-edit"></i></button><button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-tdid="'+tdidnow+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-subtotal="'+subtotal+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td>';
            $('#'+tdidnow+'').html(isi);
            $('#modal_edit').modal('hide');
        });

        $('#edit_kuantitas').keyup(function(){
            // alert(satuan);

            var harga=($('#edit_harga').maskMoney('unmasked')[0]);
            var panjang=($('#edit_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#edit_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#edit_kuantitas').maskMoney('unmasked')[0]);

            if (hitung_luas==1){
                if (satuan =="cm") {
                    

                    var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                    if (diskon!=0){
                        var diskonsubtotal = (subtotal * diskon) / 100;

                        subtotal = subtotal - diskonsubtotal;
                    }
                    $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
                else
                {
                    // var subtotal=0;

                    // subtotal################
                    
                    var subtotal = (harga ) * kuantitas;
                    
                    $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
            }
            else
            {
               
                // subtotal################
                
                var subtotal = (harga) * kuantitas;
                $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
            }
            
        });


      //bagian model edit

      //bagian modal delete

        $(document).on('click','.modal_delete',function () {

            subtotaldelete=($(this).data('subtotal'));  
            tdidnow=$(this).data('tdid');            
            // alert($(this).data('namaproduk'));
            $('.labelitem').text($(this).data('namaproduk'));
        });
        
        $('#deleteitem').click(function(){
            $('#'+tdidnow+'').remove();
            
            total=($('#total').maskMoney('unmasked')[0]);
            total=(total-subtotaldelete);
            if (total==0){
                $('#submittransaksi').attr('disabled',true);
            }
            sisa=($('#sisa').maskMoney('unmasked')[0]);
            sisa=(sisa-subtotaldelete);
            $('#total2').val(total).trigger('mask.maskMoney');
            $('#sisa').val(sisa).trigger('mask.maskMoney');
            $('#total').val(total).trigger('mask.maskMoney');

            $('#modal_delete').modal('hide');
        });

      // bagian modal delete
      
    </script>
    

    </body>
@endsection
