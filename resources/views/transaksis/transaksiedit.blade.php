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
            <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Penjualan <i class="fa  fa-shopping-cart"></i></h3>
                </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="box-body">

                        <div class="form-group">
                          <label for="no">No. Nota : </label><span id="nonota"> {{ $transaksi->id }}</span>
                        </div>


                          <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" class="form-control" id="tanggal" readonly name="tanggal" style="max-width:100px;" value="{{ $transaksi->tanggal }}" placeholder="Tanggal">
                          </div>

                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="box-body">

                        <div class="form-group">
                          <label for="kepada">Kepada : </label><span id="kepadalabel"> {{ $transaksi->nama_pelanggan }}</span>
                        </div>

                        <div class="form-group">
                          <label for="nomor">Nomor Handphone : </label><span id="handphonelabel"> {{ $transaksi->hp_pelanggan }}</span>
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
                            @foreach ($transaksi->sub_penjualans()->get() as $key=>$data)
                              <tr>
                                <td>{{ $data->produk->nama_produk }}</td>
                                <td class="td-currency">{{ $data->harga_satuan }}</td>
                                <td class="td-units">{{ $data->panjang }} @if ($data->satuan === "CENTIMETER") cm @elseif ($data->satuan === "METER") m @endif</td>
                                <td class="td-units">{{ $data->lebar }} @if ($data->satuan === "CENTIMETER") cm @elseif ($data->satuan === "METER") m @endif</td>
                                <td>{{ $data->banyak }}</td>
                                <td>{{ $data->finishing }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td class="td-discount">{{ $data->diskon }}</td>
                                <td class="td-currency">{{ $data->subtotal }}</td>
                                <td>
                                  <div class="btn-group">
                                    <button 
                                      type="button" 
                                      class="modal_edit btn btn-success btn-sm" 
                                      data-toggle="modal" 
                                      data-produkid="{{ $data->produk->id }}" 
                                      data-satuan="{{ $data->satuan }}" 
                                      data-diskon="{{ $data->diskon }}" 
                                      data-produk="{{ $data->produk->id }}" 
                                      data-harga="{{ $data->harga_satuan }}" 
                                      data-panjang="{{ $data->panjang }}" 
                                      data-lebar="{{ $data->lebar }}" 
                                      data-kuantitas="{{ $data->banyak }}" 
                                      data-finishing="{{ $data->finishing }}" 
                                      data-keterangan="{{ $data->keterangan }}" 
                                      data-namaproduk="{{ $data->produk->nama_produk }}" 
                                      data-subtotal="{{ $data->subtotal }}" 
                                      data-tdid="1" 
                                      data-hitungluas="{{ $data->produk->hitungluas }}" 
                                      data-target="#modal_edit">
                                      <i class="fa fa-edit"></i>
                                    </button>
                                    <button 
                                      type="button" 
                                      class="modal_delete btn btn-danger btn-sm" 
                                      data-toggle="modal" 
                                      data-namaproduk="X BANNER FLEXY 280 (60X160) HIRES" 
                                      data-produk="4" 
                                      data-harga="85000" 
                                      data-panjang="0" 
                                      data-lebar="0" 
                                      data-tdid="1" 
                                      data-kuantitas="1" 
                                      data-finishing="Tanpa Finishing" 
                                      data-keterangan="" 
                                      data-subtotal="85000" 
                                      data-hitungluas="0" 
                                      data-target="#modal_delete">
                                      <i class="fa fa-trash"></i>
                                    </button>
                                  </div>
                                </td>
                              </tr>
                            @endforeach
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
                                    <input id="diskon" name="diskon" value="{{ $transaksi->diskon }}" placeholder="0,00%" class="form-control" type="text">
                                </label>                                  
                            </div>
                            <div class="col-md-3">
                                <label>Total
                                    <input id="total" name="total" disabled value="{{ $transaksi->total_harga }}" placeholder="Rp 0" class="form-control mata-uang" type="text">
                                    <input id="total2" name="total2" disabled hidden value="{{ $transaksi->total_harga }}" placeholder="Rp 0" type="text">
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
                                    <input id="bayardp" name="bayardp" value="{{ $transaksi->jumlah_pembayaran }}" placeholder="Rp 0" class="form-control mata-uang" type="text">
                                </label>                                  
                            </div>
                            <div class="col-md-3">
                              <label>Pembayaran
                                <select class="form-control  pull-right"  id="pembayaran" name="pembayaran" style="width: 100%;">
                                    @if ($transaksi->metode_pembayaran === "Cash")
                                      <option value="Cash" selected>Cash</option>
                                      <option value="Transfer">Transfer</option>
                                    @elseif ($transaksi->metode_pembayaran === "Transfer")
                                      <option value="Cash" >Cash</option>
                                      <option value="Transfer" selected>Transfer</option>
                                    @else
                                      <option value="Cash" >Cash</option>
                                      <option value="Transfer">Transfer</option>
                                    @endif
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
                                      <input id="pajak" name="pajak"  value="{{ $transaksi->pajak }}" placeholder="0,00%" class="form-control" type="text">
                                  </label>                     
                            </div>
                            <div class="col-md-3">
                                  <label>Sisa
                                      <input id="sisa" name="sisa"  value="{{ $transaksi->sisa_tagihan }}" placeholder="Rp 0" class="form-control mata-uang" disabled type="text">
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
                                          </select>
                                          <input id="add_produkid" name="add_produkid" class="form-control" type="hidden">

                                      </div>
                                      <div class="form-group">
                                          <label>Harga</label>
                                          <input id="add_harga" name="add_harga" class="form-control mata-uang" type="text">
                                          <!-- {{csrf_field()}} -->
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
                                          <select id="edit_produk" name="edit_produk"  class="form-control select2" style="width:100%;" type="text">
                                                
                                          </select>
                                          <input id="edit_produkid" name="edit_produkid" readonly class="form-control" type="hidden">
                                          <input id="edit_subtotalawal" name="edit_subtotalawal" readonly class="form-control" type="hidden">
                                      </div>
                                      <div class="form-group">
                                          <label>Harga</label>
                                          <input id="edit_harga" name="edit_harga" class="form-control mata-uang" type="text">
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

        <!--
          <p>{{ $transaksi->id }}</p>       
          <p>{{ $transaksi->nama_perusahaan }}</p>       
          <p>{{ $transaksi->hp_pelanggan }}</p>       
          <p>{{ $transaksi->tanggal }}</p>       
          <p>{{ $transaksi->total_harga }}</p>       
          <p>{{ $transaksi->diskon }}</p>       
          <p>{{ $transaksi->metode_pembayaran }}</p>       
          <p>{{ $transaksi->jumlah_pembayaran }}</p>       
          <p>{{ $transaksi->sisa_tagihan }}</p>
          <p>{{ $transaksi->pajak }}</p>
                 
          <p>=======</p>

          @foreach ($transaksi->sub_penjualans()->get() as $key=>$data)
            <p>{{ $data->produk->nama_produk }}</p>
            <p>{{ $data->harga_satuan }}</p>
            <p>{{ $data->panjang }}</p>
            <p>{{ $data->lebar }}</p>
            <p>{{ $data->satuan }}</p>
            <p>{{ $data->banyak }}</p>
            <p>{{ $data->subtotal }}</p>
            <p>{{ $data->diskon }}</p>
            <p>{{ $data->finishing }}</p>
            <p>{{ $data->subtotal }}</p>
            <p>{{ $data->keterangan }}</p>
          @endforeach
        -->
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


    <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script>
    <!-- <script src="{{asset('bower_components/jquery-number/jquery.number.js')}}"></script> -->

    <!-- sweet alert -->
    <script src="{{asset('bower_components/sweetalert/sweetalert.min.js')}}"></script>

    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script>
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

      $(function(){
        numeral.locale('idr');
        $('#sisa, #bayardp, #total').each(function() {
          $(this).val(
            numeral(this.value).format('$ 0,0')
          );
        });
        $('.td-currency').each(function() {
          $(this).text(
            numeral($(this).text()).format('$ 0,0')
          );
        });
        $('.td-units').each(function() {
          var satuanText = $(this).text().split(' ');
          $(this).text(
            numeral(satuanText[0]).format('0[.]00') + " " + satuanText[2]
          );
        });
        $('.td-discount').each(function() {
          $(this).text(
            numeral($(this).text()).format('0[.]00') + " %"
          );
        });
      })
    </script>

    </body>
@endsection
