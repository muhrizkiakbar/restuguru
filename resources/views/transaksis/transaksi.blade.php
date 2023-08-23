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

          <div class="col-md-10">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Penjualan <i class="fa  fa-shopping-cart"></i></h3>
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
                  <div class="col-md-12 ">
                      <div class="box-body no-padding table-responsive">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <th>Nama Barang</th>
                            <th style="width: 130px">Harga Satuan</th>
                            <th style="width: 60px">P</th>
                            <th style="width: 60px">L</th>
                            <th style="width: 60px">Kuantitas</th>
                            <th style="width: 170px">Finishing</th>
                            <th style="width: 170px">Keterangan</th>
                            <th style="width: 60px">Diskon</th>
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
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" id="buttonmodal_add" disabled data-target="#modal_add"><i class="fa fa-plus"> </i> Item</button>
                      </div>
                </div>

                <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-6">
                                                     
                          </div>
                          <div class="col-md-3">
                              <label>Diskon %
                                  <input id="diskon" name="diskon" value="0" placeholder="0,00%" class="form-control" type="text">
                              </label>                                  
                          </div>
                          <div class="col-md-3">
                              <label>Total
                                  <input id="total" name="total" disabled value="0" placeholder="Rp 0" class="form-control mata-uang" type="text">
                                  <input id="total2" name="total2" disabled hidden value="" placeholder="Rp 0" type="text">
                                  <input id="total3" name="total3" disabled hidden value="" placeholder="Rp 0" type="text">
                              </label>                                  
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-6">
                                                     
                          </div>
                          <div class="col-md-3">
                              <label>Bayar
                                  <input id="bayardp" name="bayardp" value="0" placeholder="Rp 0" class="form-control mata-uang" type="text">
                              </label>                                  
                          </div>
                          <div class="col-md-3">
                            <label>Pembayaran
                              <select class="form-control  pull-right"  id="pembayaran" name="pembayaran" style="width: 100%;">
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
                                    <input type="radio" name="metode" id="metodelunas" value="lunas" class="minimal-red">
                                    Lunas
                                    <input type="radio" name="metode" id="metodedp" value="dp" class="minimal-red">
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
                                    <input id="pajak" name="pajak"  value="0" placeholder="0,00%" class="form-control" type="text">
                                </label>                     
                          </div>
                          <div class="col-md-3">
                                <label>Sisa
                                    <input id="sisa" name="sisa"  value="0" placeholder="Rp 0" class="form-control mata-uang" disabled type="text">
                                </label>  
                                              
                          </div>
                      </div>
                  </div>
                <hr>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="btn-grp pull-right">                           
                            <button type="button" id="transaksibaru" class="btn btn-warning btn-sm"><i class="fa fa-cart-plus"> </i> Transaksi Baru</button>
                            <button type="button" id="submittransaksi" disabled class="btn btn-success btn-sm"><i class="fa fa-check-circle"> </i> Simpan</button> 
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
                                          <select id="add_produk" name="add_produk" class="form-control select2" style="width:100%;" type="text">
                                                @foreach ($produks as $produk)
                                                <option value="{{$produk->id}}">{{$produk->nama_produk}}</option>
                                                @endforeach
                                          </select>
                                          <input id="add_produkid" name="add_produkid" class="form-control" type="hidden">

                                      </div>
                                      <div class="form-group">
                                          <label>Harga</label>
                                          <input id="add_harga" name="add_harga" class="form-control mata-uang" type="text">
                                          {{csrf_field()}}
                                      </div>
                                      <div class="form-group">
                                          <label>P</label>
                                          <input id="add_panjang" name="add_panjang" class="form-control pull-right addbesaran" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>L</label>
                                          <input id="add_lebar" name="add_lebar" class="form-control pull-right addbesaran" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Satuan  :</label>
                                            <input type="radio" id="r2cm" name="r2" class="minimal-red" value="CENTIMETER">
                                            Centimeter
                                            <input type="radio" id="r2m" name="r2" class="minimal-red" value="METER">
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
                                              <option value="Laminasi Glossy">Laminassy Glossy</option>
                                              <option value="Laminasi Doff">Laminasi Doff</option>
                                              <option value="Finishing">Finishing</option>
                                              <option value="Lainnya">Lainnya</option>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label>Keterangan</label>
                                          <textarea id="add_keterangan" name="add_keterangan" class="form-control pull-right" type="text"></textarea>
                                      </div>
                                      <div class="form-group">
                                          <label>Diskon %</label>
                                          <input id="add_diskon" name="add_diskon" class="form-control pull-right" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Subtotal</label>
                                          <input id="add_subtotal" name="add_subtotal" readonly class="form-control pull-right mata-uang" type="text">
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
                                          <select id="edit_produk" name="edit_produk"  class="form-control select2" disabled=true style="width:100%;" type="text">
                                                @foreach ($produks as $produk))
                                                    <option value="{{$produk->id}}">{{$produk->nama_produk}}</option>
                                                @endforeach
                                          </select>
                                          <input id="edit_produkid" name="edit_produkid" readonly class="form-control" type="hidden">
                                          <input id="edit_subtotalawal" name="edit_subtotalawal" readonly class="form-control" type="hidden">
                                      </div>
                                      <div class="form-group">
                                          <label>Harga</label>
                                          <input id="edit_harga" name="edit_harga" class="form-control mata-uang" type="text">
                                          {{csrf_field()}}
                                      </div>
                                      <div class="form-group">
                                          <label>P</label>
                                          <input id="edit_panjang" name="edit_panjang" class="form-control pull-right editbesaran" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>L</label>
                                          <input id="edit_lebar" name="edit_lebar" class="form-control pull-right editbesaran" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Satuan  :</label>
                                            <input type="radio" id="r2editcm" name="r2edit" class="minimal-red" value="CENTIMETER">
                                            Centimeter
                                            <input type="radio" id="r2editm" name="r2edit" class="minimal-red" value="METER">
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
                                              <option value="Laminasi Glossy">Laminassy Glossy</option>
                                              <option value="Laminasi Doff">Laminasi Doff</option>
                                              <option value="Finishing">Finishing</option>
                                              <option value="Lainnya">Lainnya</option>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label>Keterangan</label>
                                          <textarea id="edit_keterangan" name="edit_keterangan" class="form-control pull-right" type="text"></textarea>
                                      </div>
                                      <div class="form-group">
                                          <label>Diskon %</label>
                                          <input id="edit_diskon" name="edit_diskon" class="form-control pull-right" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Subtotal</label>
                                          <input id="edit_subtotal" name="edit_subtotal" readonly class="form-control pull-right mata-uang" type="text">
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

    <script src="{{asset('bower_components/jquery-ui/jquery-ui-new.js')}}"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>

    <!-- bootstrap datepicker -->
    <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>


    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

    <!-- sweet alert -->
    <script src="{{asset('bower_components/sweetalert/sweetalert.min.js')}}"></script>

    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script>
//custom format
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
    //
    //number format
        Number.prototype.format = function(n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));
            
            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };
    //
//
//def variable        
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
        var satuandasar="";
        var luas=1;
        var hargasatuan=0;
        var kuantitas=0;
        var range_prices = [];
//
//function
    //hitung luas
        function hitungluas(panjang, lebar, dasar, perubahan){
            if ( dasar==perubahan ){
                return panjang * lebar;
            }else if ( (dasar=='CENTIMETER') && (perubahan=='METER') ){
                return (panjang * 100) * (lebar * 100);
            }else if ( (dasar=='METER') && (perubahan=='CENTIMETER') ){
                return (panjang / 100) * (lebar / 100);
            }
        }
    //
    //hitung subtotal
        function hitungsubtotal(harga, luas, kuantitas){
            return (harga * luas) * kuantitas;
        }
    //
    //hitung diskonitem
        function diskonitem(subtotal, besardiskon){
            return subtotal - (subtotal * (besardiskon/100) );
        }
    //
    //function tampilan panjang lebar di tabel
        function tampilanpl(nilai){
            if (nilai == 0){
                return '-';
            }else{
                return numeral(nilai).format('0[.]00');
            } 
        }
    //
    //function diskon akhir
        function hitungdiskonpajak(total, pajak, diskon){
            var hitungdiskon = total * (diskon/100);
            var totalpotongdiskon = total - hitungdiskon;
            var hitungpajak = totalpotongdiskon * (pajak/100);
            return totalpotongdiskon + hitungpajak;
        }
    //
    //function hitung sisa
        function hitungsisa (total, bayardp, metodebayar){
            return total - bayardp;
        }
    //function check range price
        function isInRange(start_value, end_value, given_value) {
          if (end_value == 0) return true ;

          if (given_value >= start_value && given_value <= end_value)
            return true
          else
            return false
          end
        }
    //
    //function metode
        function metodepembayaran(metodepembayaran){
            total=numeral($('#total').val()).value();
            if (metodepembayaran == "lunas"){
                return total;
            }else if (metodepembayaran == "dp"){
                return total/2;
            }else{
                return numeral($('#bayardp').val()).value();
            }
        };
        function pajakmethod(total2,diskon,total,pajak){
            if ($('#pajak').val()=="0")
            {
                nominalpajak=0;
                total=total2 + nominalpajak - nominaldiskon;
                // $('#bayardp').val('0').trigger('mask.maskMoney');
                // $('#sisa').val('0').trigger('mask.maskMoney');
                return total;
            }
            else
            {
                nominalpajak=(total2 * (pajak)) /100;
                total=total2 + nominalpajak - nominaldiskon;
                // $('#bayardp').val('0').trigger('mask.maskMoney');
                // $('#sisa').val('0').trigger('mask.maskMoney');
                return total;
                
            }
        }

        function unformat(value)
        {
            value=value.replace('.','');

            value=value.replace(',','.');

            return value;
        }

        function bayardpmethod(bayardp,total,total2,bayardp){
            if (bayardp > total){
            bayardp=0;
            sisa=0;
            $('#bayardp').val(bayardp.format(2, 3, '.', ','));
            $('#sisa').val(sisa.format(2, 3, '.', ','));
            }
            else
            {
                bayardp=$('#bayardp').val();
                sisa=total-bayardp;
                $('#bayardp').val(bayardp.format(2, 3, '.', ','));
                $('#sisa').val(sisa.format(2, 3, '.', ','));
            }
        }
//
//on load
        $(function(){
            numeral.locale('idr');

            $("input.mata-uang").keyup(function(){
                $(this).val(numeral($(this).val()).format('$ 0,0'));
            });

            $("input.addbesaran").focus(function(){
                $(this).val(0);
            });

            $("#add_panjang").blur(function(){
                var panjang=numeral($('#add_panjang').val()).value();
                var lebar=numeral($('#add_lebar').val()).value();
                luas=hitungluas(panjang,lebar,satuandasar,$('input[name=r2]:checked').val());
                hargasatuan=numeral($('#add_harga').val()).value();
                kuantitas=numeral($('#add_kuantitas').val()).value();
                var besardiskon=numeral($('#add_diskon').val()).value();
                $('#add_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, (luas == undefined) ? 1 : luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
                
            });

            $("#add_lebar").blur(function(){
                var panjang=numeral($('#add_panjang').val()).value();
                var lebar=numeral($('#add_lebar').val()).value();
                luas=hitungluas(panjang,lebar,satuandasar,$('input[name=r2]:checked').val());
                hargasatuan=numeral($('#add_harga').val()).value();
                kuantitas=numeral($('#add_kuantitas').val()).value();
                var besardiskon=numeral($('#add_diskon').val()).value();
                $('#add_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, (luas == undefined) ? 1 : luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
                
            });
            
            $("#add_harga").blur(function(){
                var panjang=numeral($('#add_panjang').val()).value();
                var lebar=numeral($('#add_lebar').val()).value();
                luas=hitungluas(panjang,lebar,satuandasar,$('input[name=r2]:checked').val());
                hargasatuan=numeral($('#add_harga').val()).value();
                kuantitas=numeral($('#add_kuantitas').val()).value();
                var besardiskon=numeral($('#add_diskon').val()).value();
                $('#add_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, (luas == undefined) ? 1 : luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
                
            });

            $("input.addbesaran").blur(function(){
                $(this).val(numeral($(this).val()).format('0[.]00'));
                var panjang=numeral($('#add_panjang').val()).value();
                var lebar=numeral($('#add_lebar').val()).value();
                luas=hitungluas(panjang,lebar,satuandasar,$('input[name=r2]:checked').val());
                hargasatuan=numeral($('#add_harga').val()).value();
                kuantitas=numeral($('#add_kuantitas').val()).value();
                var besardiskon=numeral($('#add_diskon').val()).value();
                $('#add_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
                
            });

            $("#edit_harga").blur(function(){
                var panjang=numeral($('#edit_panjang').val()).value();
                var lebar=numeral($('#edit_lebar').val()).value();
                luas=hitungluas(panjang,lebar,satuandasar,$('input[name=r2edit]:checked').val());
                hargasatuan=numeral($('#edit_harga').val()).value();
                kuantitas=numeral($('#edit_kuantitas').val()).value();
                var besardiskon=numeral($('#edit_diskon').val()).value();
                $('#edit_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, (luas == undefined) ? 1 : luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
                
            });

            $("input.editbesaran").focus(function(){
                $(this).val(0);
            });

            $("input.editbesaran").blur(function(){
                $(this).val(numeral($(this).val()).format('0[.]00'));
                var panjang=numeral($('#edit_panjang').val()).value();
                var lebar=numeral($('#edit_lebar').val()).value();
                luas=hitungluas(panjang,lebar,satuandasar,$('input[name=r2edit]:checked').val());
                hargasatuan=numeral($('#edit_harga').val()).value();
                kuantitas=numeral($('#edit_kuantitas').val()).value();
                var besardiskon=numeral($('#edit_diskon').val()).value();
                $('#edit_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
                
            });

            $('input[name="tanggal"]').datepicker({
                format: "yyyy-mm-dd",
            });
            
            $('input[type=radio][name=r2]').on('ifClicked',function () {
                // alert("asd");
                var panjang=numeral($('#add_panjang').val()).value();
                var lebar=numeral($('#add_lebar').val()).value();
                luas=hitungluas(panjang,lebar,satuandasar,this.value);
                hargasatuan=numeral($('#add_harga').val()).value();
                kuantitas=numeral($('#add_kuantitas').val()).value();
                var besardiskon=numeral($('#add_diskon').val()).value();
                $('#add_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
            });

            $('input[type=radio][name=r2]').on('ifChecked',function () {
                // alert("asd");
                var panjang=numeral($('#add_panjang').val()).value();
                var lebar=numeral($('#add_lebar').val()).value();
                luas=hitungluas(panjang,lebar,satuandasar,this.value);
                hargasatuan=numeral($('#add_harga').val()).value();
                kuantitas=numeral($('#add_kuantitas').val()).value();
                var besardiskon=numeral($('#add_diskon').val()).value();
                $('#add_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
            });

            $("#add_kuantitas").keyup(function(){
                hargasatuan=numeral($('#add_harga').val()).value();
                kuantitas=numeral($('#add_kuantitas').val()).value();
                var besardiskon=numeral($('#add_diskon').val()).value();

                $(this).val(numeral($(this).val()).format('0'));
                if (range_prices == []) {
                  for (let index in range_prices) {
                    if (isInRange(range_prices[index]['nilai_awal'],range_prices[index]['nilai_akhir'],$(this).val())) {
                      $('#add_harga').val(numeral(range_prices[index]['harga_khusus']).format('$ 0,0'))
                      break;
                    }
                    $('#add_harga').val(numeral(range_prices.at(-1)['harga_khusus']).format('$ 0,0'))
                  }
                }

                $('#add_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, (luas == undefined) ? 1 : luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
            });

            $("#add_diskon").blur(function(){
                $(this).val(numeral($(this).val()).format('0[.]00'));
                hargasatuan=numeral($('#add_harga').val()).value();
                kuantitas=numeral($('#add_kuantitas').val()).value();
                var besardiskon=numeral($('#add_diskon').val()).value();
                $('#add_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, (luas == undefined) ? 1 : luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
            });

            $("#add_diskon").focus(function(){
                $(this).val(0);
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
                total=numeral($('#total').val()).value();
                if ($(this).val() == "lunas"){
                    $('#bayardp').val(numeral(total).format('$ 0,0'));
                }else if ($(this).val() == "dp"){
                    $('#bayardp').val(numeral(total/2).format('$ 0,0'));
                }
                bayardp=numeral($('#bayardp').val()).value();
                $('#sisa').val(numeral(hitungsisa(total, bayardp, $(this).val())).format('$ 0,0'));
            });

            $('input[type=radio][name=metode]').on('ifChecked',function () {
                total=numeral($('#total').val()).value();
                if ($(this).val() == "lunas"){
                    $('#bayardp').val(numeral(total).format('$ 0,0'));
                }else if ($(this).val() == "dp"){
                    $('#bayardp').val(numeral(total/2).format('$ 0,0'));
                }
                bayardp=numeral($('#bayardp').val()).value();
                $('#sisa').val(numeral(hitungsisa(total, bayardp, $(this).val())).format('$ 0,0'));
            });

            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
            });
        
            $('#add_produk').select2();

            $('#edit_produk').select2();

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

            $('input[type=radio][name=r2edit]').on('ifClicked',function () {
                var panjang=numeral($('#edit_panjang').val()).value();
                var lebar=numeral($('#edit_lebar').val()).value();
                luas=hitungluas(panjang,lebar,satuandasar,this.value);
                hargasatuan=numeral($('#edit_harga').val()).value();
                kuantitas=numeral($('#edit_kuantitas').val()).value();
                var besardiskon=numeral($('#edit_diskon').val()).value();
                $('#edit_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
            });

            $('input[type=radio][name=r2edit]').on('ifChecked',function () {
                var panjang=numeral($('#edit_panjang').val()).value();
                var lebar=numeral($('#edit_lebar').val()).value();
                luas=hitungluas(panjang,lebar,satuandasar,this.value);
                hargasatuan=numeral($('#edit_harga').val()).value();
                kuantitas=numeral($('#edit_kuantitas').val()).value();
                var besardiskon=numeral($('#edit_diskon').val()).value();
                $('#edit_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
            });

            $("#edit_kuantitas").keyup(function(){
                $(this).val(numeral($(this).val()).format('0'));
                if (range_prices.length != 0) {
                  for (let index in range_prices) {
                    if (isInRange(range_prices[index]['nilai_awal'],range_prices[index]['nilai_akhir'],$(this).val())) {
                      $('#edit_harga').val(numeral(range_prices[index]['harga_khusus']).format('$ 0,0'))
                      break;
                    }
                    $('#edit_harga').val(numeral(range_prices.at(-1)['harga_khusus']).format('$ 0,0'))
                  }
                }
                hargasatuan=numeral($('#edit_harga').val()).value();
                kuantitas=numeral($('#edit_kuantitas').val()).value();
                var besardiskon=numeral($('#edit_diskon').val()).value();
                $('#edit_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
            });

            $("#edit_diskon").blur(function(){
                $(this).val(numeral($(this).val()).format('0[.]00'));
                hargasatuan=numeral($('#edit_harga').val()).value();
                kuantitas=numeral($('#edit_kuantitas').val()).value();
                var besardiskon=numeral($('#edit_diskon').val()).value();
                $('#edit_subtotal').val(
                    numeral(diskonitem(hitungsubtotal(hargasatuan, luas, kuantitas), besardiskon)).format('$ 0,0')
                );
                console.log(luas, hargasatuan, kuantitas, besardiskon);
            });

            $("#edit_diskon").focus(function(){
                $(this).val("");
            });

            $('#pelanggan').select2({
                placeholder: "Pilih Pelanggan.",
                minimumInputLength: 1,
                ajax: {
                    url: '{{route('pelanggancari')}}',
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

            // console.log(hitungsisa(100000,20000,0)[1]);
            
        });
//
//bagian form
    //pencarian pelanggan
        $('#pelanggan').on('select2:select', function (e) {
                
            var id=e.params.data.id;
            $.ajax({
                async: true, 
                type:'get',
                url:'{{route('pelanggandetail')}}',
                data: 'id='+id,
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                        $('#namapelanggan').val(response.nama_perusahaan);
                        $('#nomorhandphone').val(response.telpon_pelanggan);
                },
            });
        });
    //
    //submit pelanggan
        $('#submitpelanggan').click(function(){
            var namapelanggan=$('#namapelanggan').val();
            var nomorhandphone=$('#nomorhandphone').val();
            console.log(namapelanggan);
            if ((namapelanggan=="") || (nomorhandphone=="")){
                swal("Gagal", "Data Pelanggan Tidak Valid", "error");
            }
            else
            {
                var inputpelanggan=$('#pelanggan').val();
                if (inputpelanggan != null)
                {
                    var url = "{{url('/jatuhtempo/cari')}}";
                    $.get(url,{ pelanggan: inputpelanggan }, function(response) {
                        console.log(response);
                        if (response > 0)
                        {
                            swal({
                                    title: "Perhatian",
                                    text: "Pelanggan yang dipilih belum melakukan pelunasan, lanjutkan ?",
                                    icon: "error",
                                    buttons: true,
                                    dangerMode: true,
                                    })
                                    .then((willcontinue) => {
                                        if (willcontinue)
                                        {
                                            $('#namapelanggan').attr('disabled',true);
                                            $('#nomorhandphone').attr('disabled',true);
                                            $('#pelanggan').attr('disabled',true);            
                                            $('#handphonelabel').text('  '+$('#nomorhandphone').val());
                                            $('#kepadalabel').text('  '+$('#namapelanggan').val());

                                            $('#buttonmodal_add').removeAttr('disabled');
                                            $('#submitpelanggan').attr('disabled',true);
                                        }
                                        else
                                        {
                                            $('tbody').empty();
                                            //$('#diskon').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true}).removeAttr('disabled');
                                            $('#pembayaran').removeAttr('disabled');
                                            $('#pajak').val(0);
                                            $('#bayardp').val(0);
                                            $('#sisa').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
                                            $('#total').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
                                            $('#metodedp').iCheck('enable');
                                            $('#metodedp').iCheck('uncheck');
                                            $('#metodelunas').iCheck('enable');
                                            $('#metodelunas').iCheck('uncheck'); 
                                            $('#namapelanggan').val("").removeAttr('disabled');
                                            $('#nomorhandphone').val("").removeAttr('disabled');
                                            $('#pelanggan').val('').trigger('change');
                                            $('#submitpelanggan').removeAttr('disabled');
                                            $('#pelanggan').removeAttr('disabled');
                                            $('#buttonmodal_add').attr('disabled',true);
                                            $('#kepadalabel').text('');
                                            $('#handphonelabel').text(''); 
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
                                        }

                                    });
                        }
                        else
                        {
                            $('#namapelanggan').attr('disabled',true);
                            $('#nomorhandphone').attr('disabled',true);
                            $('#pelanggan').attr('disabled',true);            
                            $('#handphonelabel').text('  '+$('#nomorhandphone').val());
                            $('#kepadalabel').text('  '+$('#namapelanggan').val());

                            $('#buttonmodal_add').removeAttr('disabled');
                            $('#submitpelanggan').attr('disabled',true);
                        }

                    }).
                    fail(function(){
                
                    });
                }
                else
                {
                    // console.log('a');
                    $('#namapelanggan').attr('disabled',true);
                    $('#nomorhandphone').attr('disabled',true);
                    $('#pelanggan').attr('disabled',true);            
                    $('#handphonelabel').text('  '+$('#nomorhandphone').val());
                    $('#kepadalabel').text('  '+$('#namapelanggan').val());

                    $('#buttonmodal_add').removeAttr('disabled');
                    $('#submitpelanggan').attr('disabled',true);
                }
                
            }

            
        });
    //
    //tombol transaksi baru
        $('#transaksibaru').click(function(){
            $('tbody').empty();
            $('#diskon').val('0').removeAttr('disabled');
            $('#bayardp').val('0').removeAttr('disabled');
            $('#pembayaran').removeAttr('disabled');
            $('#pajak').val('0').removeAttr('disabled');
            $('#sisa').val('0');
            $('#total').val('0');
            $('#total2').val('0');
            $('#total3').val('0');
            $('#metodelunas').iCheck('enable');
            $('#metodelunas').iCheck('uncheck');
            $('#metodedp').iCheck('enable');
            $('#metodedp').iCheck('uncheck');
            $('#namapelanggan').val("").removeAttr('disabled');
            $('#nomorhandphone').val("").removeAttr('disabled');
            $('#pelanggan').val('').trigger('change');
            $('#submitpelanggan').removeAttr('disabled');
            $('#kepadalabel').text('');
            $('#handphonelabel').text('');  
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
                satuandasar="";
                luas=1;
                hargasatuan=0;
                kuantitas=0;           
        });
    //

        $('#diskon').blur(function(){
            $(this).val(numeral($(this).val()).format('0[.]00'));
            total2=numeral($('#total2').val()).value();
            diskon=numeral($('#diskon').val()).value();
            pajak=numeral($('#pajak').val()).value();
            $('#total').val(numeral(hitungdiskonpajak(total2, pajak, diskon)).format('$ 0,0'));
            total=numeral($('#total').val()).value();
            $('#bayardp').val(numeral(metodepembayaran($('input[name=metode]:checked').val())).format('$ 0,0'));
            bayardp=numeral($('#bayardp').val()).value();
            $('#sisa').val(numeral(hitungsisa(total, bayardp)).format('$ 0,0'));
        });

        $('#diskon').focus(function(){
            $(this).val(0);
        });

        $('#pajak').blur(function(){
            $(this).val(numeral($(this).val()).format('0[.]00'));
            total2=numeral($('#total2').val()).value();
            diskon=numeral($('#diskon').val()).value();
            pajak=numeral($('#pajak').val()).value();
            $('#total').val(numeral(hitungdiskonpajak(total2, pajak, diskon)).format('$ 0,0'));
            total=numeral($('#total').val()).value();
            $('#bayardp').val(numeral(metodepembayaran($('input[name=metode]:checked').val())).format('$ 0,0'));
            bayardp=numeral($('#bayardp').val()).value();
            $('#sisa').val(numeral(hitungsisa(total, bayardp)).format('$ 0,0')); 
        });

        $('#pajak').focus(function(){
            $(this).val(0);
        });

        $('#bayardp').keyup(function(){
            $(this).val(numeral($(this).val()).format('$ 0,0'));
            total2=numeral($('#total2').val()).value();
            diskon=numeral($('#diskon').val()).value();
            pajak=numeral($('#pajak').val()).value();
            $('#total').val(numeral(hitungdiskonpajak(total2, pajak, diskon)).format('$ 0,0'));
            total=numeral($('#total').val()).value();
            bayardp=numeral($('#bayardp').val()).value();
            $('#sisa').val(numeral(hitungsisa(total, bayardp)).format('$ 0,0'));
        });

        $('#bayardp').blur(function(){
            $(this).val(numeral($(this).val()).format('$ 0,0'));
            total2=numeral($('#total2').val()).value();
            diskon=numeral($('#diskon').val()).value();
            pajak=numeral($('#pajak').val()).value();
            $('#total').val(numeral(hitungdiskonpajak(total2, pajak, diskon)).format('$ 0,0'));
            total=numeral($('#total').val()).value();
            bayardp=numeral($('#bayardp').val()).value();
            $('#sisa').val(numeral(hitungsisa(total, bayardp)).format('$ 0,0'));
        });        

        $('#bayardp').focus(function(){
            $('#metodelunas').iCheck('uncheck');
            $('#metodedp').iCheck('uncheck');
            $(this).val(0);
        });

        $('#submittransaksi').click(function(){
            // $('input[name^="produk[]"]').each(function() {
            //     alert($(this).val());
            // });
            $('#diskon').attr('disabled',true);
            $('#bayardp').attr('disabled',true);
            $('#pembayaran').attr('disabled',true);
            $('#pajak').attr('disabled',true);
            $('#sisa').attr('disabled',true);
            $('#metodedp').iCheck('disable');
            $('#metodelunas').iCheck('disable');
            $('#submittransaksi').attr('disabled',true);
            $('#buttonmodal_add').attr('disabled',true);
            var inputnamapelanggan=$('#namapelanggan').val();
            var inputnomorpelanggan=$('#nomorhandphone').val();
            var inputpelanggan=$('#pelanggan').val();            
            var inputdiskon=numeral($('#diskon').val()).value();
            var inputtotal=numeral($('#total').val()).value();
            var inputbayardp=numeral($('#bayardp').val()).value();
            var inputpembayaran=$('#pembayaran').val();
            var inputpajak=numeral($('#pajak').val()).value();
            var inputtanggal=$('#tanggal').val();
            var inputsisa=numeral($('#sisa').val()).value();
            var jsonprodukid=[];
            $('input[name^="produkid[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonprodukid.push(item);
            });
            var jsonsatuan=[];
            $('input[name^="satuan[]"]').each(function() {
                item = {}
                if ($(this).val() == 'cm'){
                    item ["value"] = 'CENTIMETER';
                }else if ($(this).val() == 'm'){
                    item ["value"] = 'METER';
                }else{
                    item ["value"] = $(this).val();
                }
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
            var jsondiskon=[];
            $('input[name^="diskonnow[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsondiskon.push(item);
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
            var jsonfinishing=[];
            $('input[name^="finishing[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonfinishing.push(item);
            });
            // var produkid=$("#input[name='produkid']").val();
            // var harga=$("#input[name='harga']").val();
            // var panjang=$("#input[name='panjang']").val();
            // var lebar=$("#input[name='lebar']").val();
            // var kuantitas=$("#input[name='kuantitas']").val();
            // var finishing=$("#input[name='finishing']").val();            
            // var diskonnow=$("#input[name='diskonnow']").val();
            // var keterangan=$("#input[name='keterangan']").val();
            // var subtotal=$("#input[name='subtotal']").val();
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
                    url:'{{route('storetransaksi')}}',
                    data: JSON.stringify({
                        inputnamapelanggan: inputnamapelanggan,
                        inputnomorpelanggan: inputnomorpelanggan,
                        inputpelanggan: inputpelanggan,
                        inputdiskon: inputdiskon,
                        inputtotal: inputtotal,
                        inputbayardp: inputbayardp,
                        inputpembayaran: inputpembayaran,
                        inputpajak: inputpajak,
                        inputsisa: inputsisa,
                        inputtanggal:inputtanggal,
                        jsonharga: jsonharga,
                        jsonpanjang: jsonpanjang,
                        jsonlebar: jsonlebar,
                        jsonsatuan: jsonsatuan,
                        jsonkuantitas: jsonkuantitas,
                        jsonfinishing: jsonfinishing,
                        jsondiskon: jsondiskon,
                        jsonketerangan: jsonketerangan,
                        jsonsubtotal: jsonsubtotal,
                        jsonprodukid: jsonprodukid,
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
                                        $('#diskon').val('0').removeAttr('disabled');
                                        $('#bayardp').val('0').removeAttr('disabled');
                                        $('#pembayaran').removeAttr('disabled');
                                        $('#pajak').val('0').removeAttr('disabled');
                                        $('#sisa').val('0');
                                        $('#total').val('0');
                                        $('#total2').val('0');
                                        $('#total3').val('0');
                                        $('#metodedp').iCheck('enable');
                                        $('#metodedp').iCheck('uncheck');
                                        $('#metodelunas').iCheck('enable');
                                        $('#metodelunas').iCheck('uncheck');
                                        $('#namapelanggan').val("").removeAttr('disabled');
                                        $('#nomorhandphone').val("").removeAttr('disabled');
                                        $('#pelanggan').val('').trigger('change');
                                        $('#submitpelanggan').removeAttr('disabled');
                                        $('#pelanggan').removeAttr('disabled');
                                        $('#kepadalabel').text('');
                                        $('#handphonelabel').text('');                                                                                
                                        location.reload();  
                                    } else {
                                        $('tbody').empty();
                                        $('#diskon').val('0').removeAttr('disabled');
                                        $('#bayardp').val('0').removeAttr('disabled');
                                        $('#pembayaran').removeAttr('disabled');
                                        $('#pajak').val('0').removeAttr('disabled');
                                        $('#sisa').val('0');
                                        $('#total').val('0');
                                        $('#total2').val('0');
                                        $('#total3').val('0');
                                        $('#pelanggan').removeAttr('disabled');
                                        $('#metodedp').iCheck('enable');
                                        $('#metodedp').iCheck('uncheck');
                                        $('#metodelunas').iCheck('enable');
                                        $('#metodelunas').iCheck('uncheck');
                                        $('#namapelanggan').val("").removeAttr('disabled');
                                        $('#nomorhandphone').val("").removeAttr('disabled');
                                        $('#pelanggan').val('').trigger('change');
                                        $('#submitpelanggan').removeAttr('disabled');
                                        $('#kepadalabel').text('');
                                        $('#handphonelabel').text('');               
                                        location.reload();  

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
    //pencarian produk
    $('#add_produk').on('select2:select', function (e) {
        // alert($('add_produk').select2('val'));
        // console.log(e.params.data.id);
        // var id=e.params.data.id;
        var id=e.params.data.id;
        $('#add_produkid').val(id);
        var pelanggan=$('#pelanggan').val();
        console.log(pelanggan);
        if (pelanggan==null)
        {
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
                    hitung_luas=response.hitung_luas;
                    $('#add_harga').val('0'); 
                    $('#add_diskon').val('0'); 
                    $('#add_subtotal').val('0');
                    $('#add_kuantitas').val('0');
                    $('#add_panjang').val('0');
                    $('#add_lebar').val('0');
                    if (hitung_luas==1)
                    {
                        luas=0;
                        $('#r2m').iCheck('uncheck');
                        $('#r2cm').iCheck('uncheck');
                        $('#r2m').iCheck('enable');
                        $('#r2cm').iCheck('enable');
                        $('#add_panjang').removeAttr('disabled');
                        $('#add_lebar').removeAttr('disabled');
                        satuandasar = response.satuan.toUpperCase();
                    }
                    else
                    {
                        luas = 1;
                        $('#r2m').iCheck('uncheck');
                        $('#r2cm').iCheck('uncheck');
                        $('#r2m').iCheck('disable');
                        $('#r2cm').iCheck('disable');
                        $('#add_panjang').attr('disabled',true);
                        $('#add_lebar').attr('disabled',true);
                        satuan = response.satuan.toUpperCase();
                    }
                    
                    $('#add_harga').val(numeral(response.harga_jual).format('$ 0,0'));  
                },
            });
        }
        else
        {
            // yang spesial price
          range_prices = [];
          namaproduk=e.params.data.text;
          $.ajax({
              async: true, 
              type:'get',
              url:'{{route('priceprodukkhusus')}}',
              data: 'produkid='+id+'&pelanggan='+pelanggan,
              dataType:'json',
              async:false,
              processData: false,
              contentType: false,
              success:function(response){
                range_prices = response.range_prices;
                default_price = {};
                default_price['nilai_awal'] = 0;
                default_price['nilai_akhir'] = 0;
                default_price['harga_khusus'] = response.harga_jual;
                range_prices.push(default_price);
                hitung_luas=response.hitung_luas;
                $('#add_harga').val('0'); 
                $('#add_diskon').val('0'); 
                $('#add_subtotal').val('0');
                $('#add_kuantitas').val('0');
                $('#add_panjang').val('0');
                $('#add_lebar').val('0');
                if (hitung_luas==1)
                {
                    luas=0;
                    $('#r2m').iCheck('uncheck');
                    $('#r2cm').iCheck('uncheck');
                    $('#r2m').iCheck('enable');
                    $('#r2cm').iCheck('enable');
                    $('#add_panjang').removeAttr('disabled');
                    $('#add_lebar').removeAttr('disabled');
                    satuandasar = response.satuan.toUpperCase();
                }
                else
                {
                    luas=1;
                    $('#r2m').iCheck('uncheck');
                    $('#r2cm').iCheck('uncheck');
                    $('#r2m').iCheck('disable');
                    $('#r2cm').iCheck('disable');
                    $('#add_panjang').attr('disabled',true);
                    $('#add_lebar').attr('disabled',true);
                    satuan = response.satuan.toUpperCase();
                }
                
                $('#add_harga').val(numeral(response.harga_jual).format('$ 0,0'));  
              },
          });
        }
    });
    //
    //tombol +item
        $('#buttonmodal_add').click(function (){
            
            range_prices = [];

            $('#r2m').iCheck('uncheck');
            $('#r2cm').iCheck('uncheck');
            $('#r2m').iCheck('enable');
            $('#r2cm').iCheck('enable');
            

            $('#add_panjang').removeAttr('disabled');
            $('#add_lebar').removeAttr('disabled');
            $('#add_produk').val('').trigger('change');            
            $('#add_harga').val('0'); 
            $('#add_diskon').val('0'); 
            $('#add_subtotal').val('0');
            $('#add_kuantitas').val('0');
            $('#add_panjang').val('0');
            $('#add_lebar').val('0');
        });
    //
    //button simpan tambah item
        $('#additem').click(function(){
            
            if ($('#add_produk').val() == null){
              swal("Gagal", "Produk Belum Dipilih atau subtotal 0 !", "error");
            }
            else if ($('#add_kuantitas').val() == 0) {
              swal("Gagal", "Kuantitas belum diisi !", "error");
            }
            else{
                if (hitung_luas == 1) {
                  radio_satuan = $('#r2cm').is(':checked') || $('#r2m').is(':checked')
                  if ( radio_satuan != true ) {
                    swal("Gagal", "Pilih jenis satuan !", "error");
                    return
                  }
                }
                var produk=$('#add_produk').val();
                var produkid=$('#add_produkid').val();
                var harga=numeral($('#add_harga').val()).value();
                var panjang=numeral($('#add_panjang').val()).value();
                var lebar=numeral($('#add_lebar').val()).value();
                var kuantitas=numeral($('#add_kuantitas').val()).value();
                var finishing=$('#add_finishing').val();
                var keterangan=$('#add_keterangan').val();
                var subtotal=numeral($('#add_subtotal').val()).value();
                var diskonnow=numeral($('#add_diskon').val()).value()/100;
                satuan = $('input[name=r2]:checked').val();

                if (satuan == 'METER'){
                    satuan = 'm';
                }else if (satuan == 'CENTIMETER'){
                    satuan = 'cm';
                }else{
                    satuan = '';
                }

                console.log(produk, produkid, harga, panjang, lebar, luas, kuantitas, subtotal, diskonnow, satuan);

                total=numeral($('#total3').val()).value();
                total=(subtotal)+total;
                $('#total2').val(numeral(total).format('$ 0,0'));
                $('#total3').val(numeral(total).format('$ 0,0'));
                $('#total').val(numeral(total).format('$ 0,0'));
                $('#diskon').val(0);
                $('#pajak').val(0);
                $('#bayardp').val(numeral(0).format('$ 0,0'));
                tdid=tdid+1;
                $('#sisa').val(numeral(total).format('$ 0,0'));
                $("tbody").append(
                '<tr id="'+tdid+'">'+
                '<td>'+namaproduk+'<input type="hidden" readonly disabled id="produk[]" value="'+produk+'" name="produk[]"><input type="hidden" readonly disabled id="satuan[]" value="'+satuan+'" name="satuan[]"><input type="hidden" readonly disabled id="produkid[]" value="'+produkid+'" name="produkid[]"></td>'+
                '<td>'+numeral(harga).format('$ 0,0')+'<input type="hidden" readonly disable id="harga[]" value="'+harga+'" name="harga[]"></td>'+
                '<td>'+tampilanpl(panjang)+' '+satuan+'<input type="hidden" readonly disable id="panjang[]" value="'+panjang+'" name="panjang[]"></td>'+
                '<td>'+tampilanpl(lebar)+' '+satuan+'<input type="hidden" readonly disable id="lebar[]" value="'+lebar+'" name="lebar[]"></td>'+
                '<td>'+numeral(kuantitas).format('0')+'<input type="hidden" readonly disable id="kuantitas[]" value="'+kuantitas+'" name="kuantitas[]"></td>'+
                '<td>'+finishing+'<input type="hidden" readonly disable id="finishing[]" value="'+finishing+'" name="finishing[]"></td>'+
                '<td style="width: 170px;word-break: break-all;">'+keterangan+'<input type="hidden" readonly disable id="keterangan[]" value="'+keterangan+'" name="keterangan[]"></td>'+
                '<td>'+numeral(diskonnow).format('0.00%')+'<input type="hidden" readonly disable id="diskonnow[]" value="'+diskonnow+'" name="diskonnow[]"></td>'+
                '<td>'+numeral(subtotal).format('$ 0,0')+'<input type="hidden" readonly disable id="subtotal[]" value="'+subtotal+'" name="subtotal[]"></td>'+
                '<td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" '+
                    'data-produkid="'+produkid+'" '+
                    'data-satuan="'+satuan+'" '+
                    'data-diskon="'+diskonnow+'" '+
                    'data-produk="'+produk+'" '+
                    'data-harga="'+harga+'" '+
                    'data-panjang="'+panjang+'" '+
                    'data-lebar="'+lebar+'" '+
                    'data-kuantitas="'+kuantitas+'" '+
                    'data-finishing="'+finishing+'" '+
                    'data-keterangan="'+keterangan+'" '+
                    'data-namaproduk="'+namaproduk+'" '+
                    'data-subtotal="'+subtotal+'" '+
                    'data-tdid="'+tdid+'" '+
                    'data-hitungluas="'+hitung_luas+'" '+
                    'data-target="#modal_edit"><i class="fa fa-edit"></i></button><button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-namaproduk="'+namaproduk+'" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-tdid="'+tdid+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-subtotal="'+subtotal+'" data-tdid="'+tdid+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td></tr>'
                );
                $('#submittransaksi').removeAttr('disabled');
                $('#metodelunas').iCheck('uncheck');
                $('#metodedp').iCheck('uncheck');
                $('#modal_add').modal('hide');
            }
            
        });
    //
//

//bagian modal edit
    //tombol edit
        $(document).on('click','.modal_edit',function () {
            var data = {
                id: $(this).data('produk'),
                text: $(this).data('namaproduk')
            };
            range_prices = [];
            subtotalawal=$(this).data('subtotal');
            // var $search = $('#edit_produk').data('select2').dropdown.$search || $('#edit_produk').data('select2').selection.$search;
            // $('#edit_produk').on("select2:selecting", function(e) {
            //     $search.val(e.params.args.data.text);
            // });
            $('#edit_produk').val($(this).data('produk')).trigger('change');
            $('#edit_produkid').val($(this).data('produk')).trigger('change');
            tdidnow=$(this).data('tdid');     
            hitung_luas=$(this).data('hitungluas');
            console.log($(this).data('satuan'));
            if ($(this).data('hitungluas')==1){

                $('#r2editm').iCheck('uncheck');
                $('#r2editcm').iCheck('uncheck');
                if ($(this).data('satuan')=="cm"){
                    $('#r2editm').iCheck('uncheck');
                    $('#r2editcm').iCheck('check');   
                }
                else if ($(this).data('satuan')=="m")
                {
                    $('#r2editcm').iCheck('uncheck');
                    $('#r2editm').iCheck('check');
                    // $('#r2editm').prop('checked',true).iCheck('update');
                }
                else
                {
                    satuan="";
                }
                $('#r2editm').iCheck('enable');
                $('#r2editcm').iCheck('enable');
                $('#edit_panjang').removeAttr('disabled');
                $('#edit_lebar').removeAttr('disabled');
            }
            else
            {
                
                $('#r2editm').iCheck('uncheck');
                $('#r2editcm').iCheck('uncheck');
                $('#r2editm').iCheck('disable');
                $('#r2editcm').iCheck('disable');
                $('#edit_panjang').attr('disabled',true);
                $('#edit_lebar').attr('disabled',true);
            }
            
            $('#edit_harga').val(numeral($(this).data('harga')).format('$ 0,0')); 
            $('#edit_subtotal').val(numeral($(this).data('subtotal')).format('$ 0,0'));
            $('#edit_kuantitas').val(numeral($(this).data('kuantitas')).format('0'));
            $('#edit_diskon').val(numeral($(this).data('diskon')*100).format('0[.]00'));
            $('#edit_panjang').val(numeral($(this).data('panjang')).format('0[.]00'));
            $('#edit_lebar').val(numeral($(this).data('lebar')).format('0[.]00'));
            $('#edit_keterangan').val($(this).data('keterangan'));

        });
    //
    //pencarian edit produk
        $('#edit_produk').on('select2:select', function (e) {
            var id=e.params.data.id;
            $('#edit_produkid').val(id);
            var pelanggan=$('#pelanggan').val();
            if (pelanggan==null)
            {
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
                        range_prices = response.range_prices;
                        default_price = {};
                        default_price['nilai_awal'] = 0;
                        default_price['nilai_akhir'] = 0;
                        default_price['harga_khusus'] = response.harga_jual;
                        range_prices.push(default_price);
                        hitung_luas=response.hitung_luas;
                        $('#edit_harga').val('0'); 
                        $('#edit_diskon').val('0'); 
                        $('#edit_subtotal').val('0');
                        $('#edit_kuantitas').val('1');
                        $('#edit_panjang').val('0');
                        $('#edit_lebar').val('0');
                        if (hitung_luas==1)
                        {
                            luas=0;
                            $('#r2editm').iCheck('uncheck');
                            $('#r2editcm').iCheck('uncheck');
                            $('#r2editm').iCheck('enable');
                            $('#r2editcm').iCheck('enable');
                            $('#edit_panjang').removeAttr('disabled');
                            $('#edit_lebar').removeAttr('disabled');
                            satuandasar = response.satuan.toUpperCase();
                        }
                        else
                        {
                            luas=1;
                            $('#r2editm').iCheck('uncheck');
                            $('#r2editcm').iCheck('uncheck');
                            $('#r2editm').iCheck('disable');
                            $('#r2editcm').iCheck('disable');
                            $('#edit_panjang').attr('disabled',true);
                            $('#edit_lebar').attr('disabled',true);
                            satuandasar = response.satuan.toUpperCase();
                        }
                        $('#edit_harga').val(numeral(response.harga_jual).format('$ 0,0'));  
                    },
                });
            }
            else
            {
                namaproduk=e.params.data.text;
                $.ajax({
                    async: true, 
                    type:'get',
                    url:'{{route('priceprodukkhusus')}}',
                    data: 'produkid='+id+'&pelanggan='+pelanggan,
                    dataType:'json',
                    async:false,
                    processData: false,
                    contentType: false,
                    success:function(response){
                        range_prices = response.range_prices;
                        default_price = {};
                        default_price['nilai_awal'] = 0;
                        default_price['nilai_akhir'] = 0;
                        default_price['harga_khusus'] = response.harga_jual;
                        range_prices.push(default_price);
                        hitung_luas=response.hitung_luas;
                        $('#edit_harga').val('0'); 
                        $('#edit_diskon').val('0'); 
                        $('#edit_subtotal').val('0');
                        $('#edit_kuantitas').val('1');
                        $('#edit_panjang').val('0');
                        $('#edit_lebar').val('0');
                        if (hitung_luas==1)
                        {
                            luas=0;
                            $('#r2editm').iCheck('uncheck');
                            $('#r2editcm').iCheck('uncheck');
                            $('#r2editm').iCheck('enable');
                            $('#r2editcm').iCheck('enable');
                            $('#edit_panjang').removeAttr('disabled');
                            $('#edit_lebar').removeAttr('disabled');
                            satuandasar = response.satuan.toUpperCase();
                        }
                        else
                        {
                            luas=1;
                            $('#r2editm').iCheck('uncheck');
                            $('#r2editcm').iCheck('uncheck');
                            $('#r2editm').iCheck('disable');
                            $('#r2editcm').iCheck('disable');
                            $('#edit_panjang').attr('disabled',true);
                            $('#edit_lebar').attr('disabled',true);
                            satuandasar = response.satuan.toUpperCase();
                        }
                        
                        $('#edit_harga').val(numeral(response.harga_jual).format('$ 0,0'));  
                    },
                });
            }

        });
    //
    //tombol simpan edit
        $('#edititem').click(function(){
            if ($('#edit_kuantitas').val() == 0) {
              return swal("Gagal", "Kuantitas belum diisi !", "error");
            }
            if (hitung_luas == 1) {
              radio_satuan = $('#r2editcm').is(':checked') || $('#r2editm').is(':checked')
              if ( radio_satuan != true ) {
                swal("Gagal", "Pilih jenis satuan !", "error");
                return
              }
            }

            var produk=$('#edit_produk').val();
            var produkid=$('#edit_produkid').val();
            var harga=numeral($('#edit_harga').val()).value();
            var panjang=numeral($('#edit_panjang').val()).value();
            var lebar=numeral($('#edit_lebar').val()).value();
            var kuantitas=numeral($('#edit_kuantitas').val()).value();
            var finishing=$('#edit_finishing').val();
            var keterangan=$('#edit_keterangan').val();
            var subtotal=numeral($('#edit_subtotal').val()).value();
            var diskonnow=numeral($('#edit_diskon').val()).value()/100;
            satuan = $('input[name=r2edit]:checked').val();

            if (satuan == 'METER'){
                satuan = 'm';
            }else if (satuan == 'CENTIMETER'){
                satuan = 'cm';
            }else{
                satuan = '';
            }    
            console.log(produk, produkid, harga, panjang, lebar, luas, kuantitas, subtotal, diskonnow, satuan);

            total=numeral($('#total3').val()).value();
            total=(subtotal)+(total-subtotalawal);
            
            $('#total2').val(numeral(total).format('$ 0,0'));
            $('#total3').val(numeral(total).format('$ 0,0'));
            
            $('#total').val(numeral(total).format('$ 0,0'));
            $('#sisa').val(numeral(total).format('$ 0,0'));
            
            var isi=    '<td>'+namaproduk+'<input type="hidden" readonly disabled id="produk[]" value="'+produk+'" name="produk[]"><input type="hidden" readonly disabled id="satuan[]" value="'+satuan+'" name="satuan[]"><input type="hidden" readonly disabled id="produkid[]" value="'+produkid+'" name="produkid[]"></td>'+
                        '<td>'+numeral(harga).format('$ 0,0')+'<input type="hidden" readonly disable id="harga[]" value="'+harga+'" name="harga[]"></td>'+
                        '<td>'+tampilanpl(panjang)+' '+satuan+'<input type="hidden" readonly disable id="panjang[]" value="'+panjang+'" name="panjang[]"></td>'+
                        '<td>'+tampilanpl(lebar)+' '+satuan+'<input type="hidden" readonly disable id="lebar[]" value="'+lebar+'" name="lebar[]"></td>'+
                        '<td>'+numeral(kuantitas).format('0')+'<input type="hidden" readonly disable id="kuantitas[]" value="'+kuantitas+'" name="kuantitas[]"></td>'+
                        '<td>'+finishing+'<input type="hidden" readonly disable id="finishing[]" value="'+finishing+'" name="finishing[]"></td>'+
                        '<td>'+keterangan+'<input type="hidden" readonly disable id="keterangan[]" value="'+keterangan+'" name="keterangan[]"></td>'+
                        '<td>'+numeral(diskonnow).format('0.00%')+'<input type="hidden" readonly disable id="diskonnow[]" value="'+diskonnow+'" name="diskonnow[]"></td>'+
                        '<td>'+numeral(subtotal).format('$ 0,0')+'<input type="hidden" readonly disable id="subtotal[]" value="'+subtotal+'" name="subtotal[]"></td>'+
                        '<td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-satuan="'+satuan+'" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-namaproduk="'+namaproduk+'" data-subtotal="'+subtotal+'" data-tdid="'+tdidnow+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_edit"><i class="fa fa-edit"></i></button><button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-tdid="'+tdidnow+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-subtotal="'+subtotal+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td>';
            $('#'+tdidnow+'').html(isi);
            $('#modal_edit').modal('hide');
        });
    //
//

      //bagian modal delete

        $(document).on('click','.modal_delete',function () {

            subtotaldelete=parseFloat($(this).data('subtotal'));  
            tdidnow=$(this).data('tdid');            
            // alert($(this).data('namaproduk'));
            $('.labelitem').text($(this).data('namaproduk'));
        });
        
        $('#deleteitem').click(function(){
            $('#'+tdidnow+'').remove();
            
            total=numeral($('#total3').val()).value();
            total=(total-subtotaldelete);
            if (total==0){
                $('#submittransaksi').attr('disabled',true);
            }
            sisa=numeral($('#sisa').val()).value();
            sisa=(sisa-subtotaldelete);
            $('#total2').val(numeral(total).format('$ 0,0'));
            $('#total3').val(numeral(total).format('$ 0,0'));
            $('#sisa').val(numeral(total).format('$ 0,0'));
            $('#total').val(numeral(total).format('$ 0,0'));
            $('#diskon').val(0);
            $('#pajak').val(0);
            $('#bayardp').val(numeral(0).format('$ 0,0'));

            $('#modal_delete').modal('hide');
        });

      // bagian modal delete
      
    </script>
    

    </body>
@endsection
