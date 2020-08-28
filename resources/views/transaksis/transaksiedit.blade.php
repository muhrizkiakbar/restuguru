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
                  <h3 class="box-title">Edit Penjualan <i class="fa  fa-shopping-cart"></i></h3>
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
                              <tr id="{{$loop->iteration}}">
                                <td>{{ $data->produk->nama_produk }}</td>
                                <td class="text-currency">{{ $data->harga_satuan }}</td>
                                <td class="text-metric">{{ $data->panjang == '0' ? '-' : $data->panjang }} {{$data->satuan == 'METER' ? 'm' : $data->satuan == 'CENTIMETER' ? 'cm' : ''}}</td>
                                <td class="text-metric">{{ $data->lebar == '0' ? '-' : $data->lebar }} {{$data->satuan == 'METER' ? 'm' : $data->satuan == 'CENTIMETER' ? 'cm' : ''}}</td>
                                <td>{{ $data->banyak }}</td>
                                <td>{{ $data->finishing }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td class="text-percentage">{{ $data->diskon }}</td>
                                <td class="text-currency">{{ $data->subtotal }}</td>
                                <td>
                                  <div class="btn-group">
                                    <button 
                                      type="button" 
                                      class="modal_edit btn btn-success btn-sm"
                                      data-id="{{$loop->iteration}}">
                                      <i class="fa fa-edit"></i>
                                    </button>
                                    <button 
                                      type="button" 
                                      class="modal_delete btn btn-danger btn-sm" 
                                      data-toggle="modal" 
                                      data-target="#modal_delete"
                                      data-id="{{$loop->iteration}}">
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
                  <br>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Pembayaran DP : &nbsp;</label><span class="text-currency"> 70452</span>
                      </div>
                      <div class="table-responsive no-padding">
                        <table class="table table-striped">
                          <tr class="tr">
                            <th>Pembayaran Angsuran</th>
                            <th>Tanggal</th>
                          </tr>
                          @if ($angsurans->isEmpty())
                            <tr>
                              <td colspan="2" class="text-center">Tidak ada angsuran</td>
                            </tr>
                          @endif
                          @foreach ($angsurans as $key => $value)
                          <tr>
                            <td class="text-currency">{{$value->nominal_angsuran}}</td>
                            <td>{{$value->tanggal_angsuran}}</td>
                          </tr>
                          @endforeach
                        </table>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                            <label>Diskon %
                                <input id="diskon" name="diskon" value="{{ $transaksi->diskon }}" placeholder="0,00%" class="form-control val-percentage" type="text" autocomplete="off">
                            </label>                                  
                        </div>
                        <div class="col-md-6">
                            <label>Total
                                <input id="total" name="total" disabled value="{{ $transaksi->total_harga }}" placeholder="Rp 0" class="form-control val-currency" type="text">
                                <input id="total2" name="total2" disabled hidden value="{{ $transaksi->total_harga }}" type="text">
                            </label>                                  
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <label>Bayar
                                <input id="bayardp" name="bayardp" value="{{ $transaksi->jumlah_pembayaran }}" placeholder="Rp 0" class="form-control val-currency" type="text" autocomplete="off">
                            </label>                                  
                        </div>
                        <div class="col-md-6">
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
                      <div class="row">
                        <div class="col-md-6">
                              <label for="">Kembali
                                <input id="kembali" type="text" class="form-control val-currency" disabled>
                              </label>
                              
                        </div>
                        <div class="col-md-6">
                              <label>
                                  <input type="radio" name="metode" id="metodelunas" value="lunas" class="minimal-red">
                                  Lunas
                                  <input type="radio" name="metode" id="metodedp" value="dp" class="minimal-red">
                                  DP 50%     
                              </label>
                                            
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                              <label>Pajak %
                                  <input id="pajak" name="pajak"  value="{{ $transaksi->pajak }}" placeholder="0,00%" class="form-control val-percentage" type="text" autocomplete="off">
                              </label>                     
                        </div>
                        <div class="col-md-6">
                              <label>Sisa
                                  <input id="sisa" name="sisa"  value="{{ $transaksi->sisa_tagihan }}" placeholder="Rp 0" class="form-control val-currency" disabled type="text">
                              </label>  
                                            
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                    <div class="row">
                        <div class="col-md-12">
                          <div class="btn-grp pull-right">                           
                              <!--button type="button" id="transaksibaru" class="btn btn-warning btn-sm"><i class="fa fa-cart-plus"> </i> Transaksi Baru</!--button-->
                              <button type="button" id="submittransaksi" class="btn btn-success btn-sm"><i class="fa fa-check-circle"> </i> Simpan</button> 
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
                                  @foreach ($produks as $produk))
                                    <option value="{{$produk->id}}">{{$produk->nama_produk}}</option>
                                  @endforeach
                                  </select>
                                  <input id="add_produkid" name="add_produkid" class="form-control" type="hidden">

                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input id="add_harga" name="add_harga" class="form-control val-currency" type="text" autocomplete="off">
                                    <!-- {{csrf_field()}} -->
                                </div>
                                <div class="form-group">
                                    <label>P</label>
                                    <input id="add_panjang" name="add_panjang" class="form-control pull-right val-metric" type="text" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>L</label>
                                    <input id="add_lebar" name="add_lebar" class="form-control pull-right val-metric" type="text" autocomplete="off">
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
                                    <input id="add_kuantitas" name="add_kuantitas" class="form-control pull-right val-quantity" type="text" autocomplete="off">
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
                                    <input id="add_diskon" name="add_diskon" class="form-control pull-right val-percentage" type="text" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Subtotal</label>
                                    <input id="add_subtotal" name="add_subtotal" disabled class="form-control pull-right val-currency" type="text">
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
                                          <select id="edit_produk" name="edit_produk"  class="form-control select2 edit-input" style="width:100%;" type="text">
                                            @foreach ($produks as $produk))
                                              <option value="{{$produk->id}}">{{$produk->nama_produk}}</option>
                                            @endforeach
                                          </select>
                                          <input id="edit_produkid" name="edit_produkid" readonly class="form-control" type="hidden">
                                          <input id="edit_subtotalawal" name="edit_subtotalawal" readonly class="form-control" type="hidden">
                                      </div>
                                      <div class="form-group">
                                          <label>Harga</label>
                                          <input id="edit_harga" name="edit_harga" class="form-control val-currency edit-input" type="text" autocomplete="off">
                                      </div>
                                      <div class="form-group">
                                          <label>P</label>
                                          <input id="edit_panjang" name="edit_panjang" class="form-control pull-right val-metric edit-input" type="text" autocomplete="off">
                                      </div>
                                      <div class="form-group">
                                          <label>L</label>
                                          <input id="edit_lebar" name="edit_lebar" class="form-control pull-right val-metric edit-input" type="text" autocomplete="off">
                                      </div>
                                      <div class="form-group">
                                          <label>Satuan  :</label>
                                            <input type="radio" id="r2editcm" name="r2edit" class="minimal-red edit-input" value="CENTIMETER">
                                            Centimeter
                                            <input type="radio" id="r2editm" name="r2edit" class="minimal-red edit-input" value="METER">
                                            Meter
                                          <input type="hidden" id="editBaseUnit" value="">
                                      </div>
                                      <div class="form-group">
                                          <label>Kuantitas</label>
                                          <input id="edit_kuantitas" name="edit_kuantitas" class="form-control pull-right edit-input val-quantity" type="text" autocomplete="off">
                                      </div>
                                      <div class="form-group">
                                          <label>Finishing</label>
                                          <select class="form-control select2 edit-input" id="edit_finishing" name="edit_finishing" style="width: 100%;">
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
                                          <textarea id="edit_keterangan" name="edit_keterangan" class="form-control pull-right edit-input" type="text"></textarea>
                                      </div>
                                      <div class="form-group">
                                          <label>Diskon %</label>
                                          <input id="edit_diskon" name="edit_diskon" class="form-control pull-right edit-input val-percentage" type="text" autocomplete="off">
                                      </div>
                                      <div class="form-group">
                                          <label>Subtotal</label>
                                          <input id="edit_subtotal" name="edit_subtotal" disabled class="form-control pull-right val-currency" type="text">
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
      numeral.locale('idr');
      $('.select2').select2();
      $('input[name="tanggal"]').datepicker({
        format: "yyyy-mm-dd",
      });
    </script>

    <script>
      var transaction = {
        id: '{{ $transaksi->id }}',
        customerId: '{{$transaksi->pelanggan_id}}',
        customerName: '{{ $transaksi->nama_pelanggan }}',
        contact: '{{ $transaksi->hp_pelanggan }}',
        purchased: {
          before: {
            date: '{{ $transaksi->tanggal }}',
            items: [
              @foreach ($transaksi->sub_penjualans()->get() as $key=>$data)
                {
                  rowId: '{{$loop->iteration}}',
                  id: '{{encrypt($data->id)}}',
                  productId: '{{ $data->produk->id }}',
                  productName: '{{ $data->produk->nama_produk }}',
                  metric: '{{ $data->satuan }}',
                  discount: '{{ $data->diskon }}',
                  price: '{{ $data->harga_satuan }}',
                  width: '{{ $data->panjang }}',
                  length: '{{ $data->lebar }}',
                  quantity: '{{ $data->banyak }}',
                  finishing: '{{ $data->finishing }}',
                  info: '{{ $data->keterangan }}',
                  totalPrice: '{{ $data->subtotal }}'
                },
              @endforeach
            ],
            amount: '{{ $transaksi->total_harga }}',
            discount: '{{ $transaksi->diskon }}',
            tax: '{{ $transaksi->pajak }}',
            paidOff: '{{ $transaksi->jumlah_pembayaran }}',
            pmentMethod: '{{$transaksi->metode_pembayaran}}',
            debit: '{{ $transaksi->sisa_tagihan }}'
          },
          after: {
            date: '{{ $transaksi->tanggal }}',
            items: [
              @foreach ($transaksi->sub_penjualans()->get() as $key=>$data)
                {
                  rowId: '{{$loop->iteration}}',
                  id: '{{encrypt($data->id)}}',
                  productId: '{{ $data->produk->id }}',
                  productName: '{{ $data->produk->nama_produk }}',
                  metric: '{{ $data->satuan }}',
                  discount: '{{ $data->diskon }}',
                  price: '{{ $data->harga_satuan }}',
                  width: '{{ $data->panjang }}',
                  length: '{{ $data->lebar }}',
                  quantity: '{{ $data->banyak }}',
                  finishing: '{{ $data->finishing }}',
                  info: '{{ $data->keterangan }}',
                  totalPrice: '{{ $data->subtotal }}'
                },
              @endforeach
            ],
            amountItems: '{{ $transaksi->total_harga }}',
            amount: '{{ $transaksi->total_harga }}',
            discount: '{{ $transaksi->diskon }}',
            tax: '{{ $transaksi->pajak }}',
            paidOff: '{{ $transaksi->jumlah_pembayaran }}',
            pmentMethod: '{{$transaksi->metode_pembayaran}}',
            debit: '{{ $transaksi->sisa_tagihan }}'
          }
        }
      };

      var convert = {
        toIDR : function(value) {return numeral(value).format('$ 0,0')},
        toFixed : function(value) {return numeral(value).format('0[.]00')},
        toNumber : function(value) {return numeral(value).value()}
      }

      var ajaxParams = {
        url: (transaction.customerId == '') ? '{{route('produkharga')}}' : '{{route('priceprodukkhusus')}}',
        data: function(product) {
          return (transaction.customerId == '') ? 'id='+product : 'produkid='+product+'&pelanggan='+transaction.customerId;
        }
      }

      $('.text-currency').each(function() {$(this).text(convert.toIDR($(this).text())) });
      $('.text-percentage').each(function() {$(this).text(convert.toFixed($(this).text()) + ' %') });
      $('.text-metric').each(function() {
        var value = $(this).text().split(' ');
        (value[0] !== '-') ? $(this).text(convert.toFixed(value[0]) + ' ' +value[1]) : $(this).text('-')
      });
      $('.val-currency').each(function() {$(this).val(convert.toIDR($(this).val())) });
      $('.val-percentage').each(function() {$(this).val(convert.toFixed($(this).val()) + ' %') });
      $('.val-metric').each(function() { $(this).val(convert.toFixed($(this).val())) });
      $('.val-quantity').each(function() { $(this).val(convert.toNumber($(this).val())) });

      $('.val-currency').blur(function() {$(this).val(convert.toIDR($(this).val())) });
      $('.val-percentage').blur(function() {$(this).val(convert.toFixed($(this).val()) + ' %');});
      $('.val-metric').blur(function() { $(this).val(convert.toFixed($(this).val())) });
      $('.val-quantity').blur(function() { $(this).val(convert.toNumber($(this).val().replace(/[.,\s]/g,''))) });

      $('.val-percentage, .val-currency, .val-metric, .val-quantity').focus(function() { $(this).val('') });
    </script>

    <script>
      var appendTr = function(data, event) {
        var prefix = (data.metric === 'METER') ? 'm' : 'cm';
        var w = (data.width !== 0) ? (convert.toFixed(data.width) + ' ' + prefix ) : '-';
        var l = (data.length !== 0) ? (convert.toFixed(data.length) + ' ' + prefix ) : '-';
        if (event == 'add') {
          return (
            '<tr id="'+data.rowId+'">\
              <td>'+data.productName+'</td>\
              <td class="td-currency">'+convert.toIDR(data.price)+'</td>\
              <td class="td-units">'+w+'</td>\
              <td class="td-units">'+l+'</td>\
              <td>'+data.quantity+'</td>\
              <td>'+data.finishing+'</td>\
              <td>'+data.info+'</td>\
              <td class="td-discount">'+convert.toFixed(data.discount)+' %</td>\
              <td class="td-currency">'+convert.toIDR(data.totalPrice)+'</td>\
              <td>\
                <div class="btn-group">\
                  <button \
                    type="button" \
                    class="modal_edit btn btn-success btn-sm" \
                    data-id="'+data.rowId+'">\
                    <i class="fa fa-edit"></i>\
                  </button>\
                  <button \
                    type="button" \
                    class="modal_delete btn btn-danger btn-sm" \
                    data-toggle="modal" \
                    data-target="#modal_delete" \
                    data-id="'+data.rowId+'">\
                    <i class="fa fa-trash"></i>\
                  </button>\
                </div>\
              </td>\
            </tr>'
          )
        } else if (event == 'edit') {
          return (
            '<td>'+data.productName+'</td>\
             <td class="td-currency">'+convert.toIDR(data.price)+'</td>\
             <td class="td-units">'+w+'</td>\
             <td class="td-units">'+l+'</td>\
             <td>'+data.quantity+'</td>\
             <td>'+data.finishing+'</td>\
             <td>'+data.info+'</td>\
             <td class="td-discount">'+convert.toFixed(data.discount)+' %</td>\
             <td class="td-currency">'+convert.toIDR(data.totalPrice)+'</td>\
             <td>\
               <div class="btn-group">\
                 <button \
                   type="button" \
                   class="modal_edit btn btn-success btn-sm" \
                   data-id="'+data.rowId+'">\
                   <i class="fa fa-edit"></i>\
                 </button>\
                 <button \
                   type="button" \
                   class="modal_delete btn btn-danger btn-sm" \
                   data-toggle="modal" \
                   data-target="#modal_delete" \
                   data-id="'+data.rowId+'">\
                   <i class="fa fa-trash"></i>\
                 </button>\
               </div>\
             </td>'
          )
        }
      }

      var calculate = {
        area: function(w, l, standartPrefix, prefix) {
          if (prefix !== standartPrefix) {
            if (prefix == 'METER' && standartPrefix == 'CENTIMETER') {
              w = w * 100;
              l = l * 100;
            } else if (prefix == 'CENTIMETER' && standartPrefix == 'METER') {
              w = w / 100;
              l = l / 100;
            }
          };
          return w * l;
        },
        totalPrice: function(p, d, q, a, isArea) {
          t = (isArea) ? a * p * q : p * q;
          return t - (t * d)
        },
        payment: function(a, d, t) {
          var aDiscount = a - (a * d);
          var aTax = aDiscount + (aDiscount * t);
          return aTax;
        },
        paidOff: function(a, method) {
          if (method == 'lunas') {
            return a;
          } else if (method == 'dp') {
            return a/2;
          } else {
            return 0;
          }
        },
        debt: function(a, p) {
          var debt = p - a;
          return (debt < 0) ? debt * -1 : 0;
        },
        ret: function(a, p) {
          var ret = p - a;
          return (ret < 0) ? 0 : ret;
        }
      }

      var input = {
        modalAddItem: {
          selectProduct: $('#add_produk'),
          price: $('#add_harga'),
          width: $('#add_panjang'),
          length: $('#add_lebar'),
          metric: {
            allPrefixes: $('input[name="r2"]'),
            prefixes: {
              m: $('#r2m'),
              cm: $('#r2cm'),
            }
          },
          quantity: $('#add_kuantitas'),
          selectFinishing: $('#add_finishing'),
          info: $('#add_keterangan'),
          discount: $('#add_diskon'),
          totalPrice: $('#add_subtotal'),
          saveButton: $('#additem'),
          cBlur: $('#add_harga, #add_panjang, #add_lebar, #add_kuantitas, #add_diskon'),
          reset: function() {
            for(var i in this) {
              if (this[i][0] !== undefined) {
                if (this[i][0].type == 'select-one') {
                  this[i].prop('selectedIndex', 0).trigger('change');
                }
                else if (this[i][0].type == 'textarea') {
                  this[i].val('').trigger('change');
                }
                else if (this[i][0].type == 'text') {
                  if (this[i][0].id == 'add_panjang' || this[i][0].id == 'add_lebar') {
                    this[i].prop('disabled', true);
                  }
                  this[i].val(0).trigger('change');
                }
              }
            }
            this.metric.allPrefixes.each(function() {
              $(this).prop('disabled', true);
              $(this).prop('checked', false);
            });
          }
        },
        modalEditItem: {
          selectProduct: $('#edit_produk'),
          price: $('#edit_harga'),
          width: $('#edit_panjang'),
          length: $('#edit_lebar'),
          metric: {
            allPrefixes: $('input[name="r2edit"]'),
            prefixes: {
              m: $('#r2editm'),
              cm: $('#r2editcm'),
            }
          },
          quantity: $('#edit_kuantitas'),
          selectFinishing: $('#edit_finishing'),
          info: $('#edit_keterangan'),
          discount: $('#edit_diskon'),
          totalPrice: $('#edit_subtotal'),
          saveButton: $('#edititem'),
          cBlur: $('#edit_harga, #edit_panjang, #edit_lebar, #edit_kuantitas, #edit_diskon'),
          reset: function() {
            for(var i in this) {
              if (this[i][0] !== undefined) {
                if (this[i][0].type == 'select-one') {
                  this[i].prop('selectedIndex', 0).trigger('change');
                }
                else if (this[i][0].type == 'textarea') {
                  this[i].val('').trigger('change');
                }
                else if (this[i][0].type == 'text') {
                  if (this[i][0].id == 'edit_panjang' || this[i][0].id == 'edit_lebar') {
                    this[i].prop('disabled', true);
                  }
                  this[i].val(0).trigger('change');
                }
              }
            }
            this.metric.allPrefixes.each(function() {
              $(this).prop('disabled', true);
              $(this).prop('checked', false);
            });
          }
        },
        transaction: {
          discount: $('#diskon'),
          paidOff: $('#bayardp'),
          tax: $('#pajak'),
          amount: $('#total'),
          pmentMethod: $('#pembayaran'),
          paidOffMethod: $('input[name="metode"]'),
          ret: $('#kembali'),
          debit: $('#sisa'),
          save: $('#submittransaksi')
        }
      }

      var setHtml = {
        modalItem: {
          metric: function(iW, iL, iCM, iM, m, isArea, w, l) {
            if (isArea) {
              iW.add(iL).add(iCM).add(iM).prop('disabled', false);
              iW.val(w);
              iL.val(l);
              if (m == "CENTIMETER") {
                iCM.prop('checked', true);
              } else if (m == "METER") {
                iM.prop('checked', true);
              }
            } else {
              iCM.add(iM).prop('checked', false);
              iW.add(iL).val(0);
              iW.add(iL).add(iCM).add(iM).prop('disabled', true);
            }
          },
        },
        tBody: function(row) {
          if (row == undefined) { return }
          $('tbody').append(row);
        }
      }
      
      var getHtml = {
        modalAddItem: {
          selectedProductName: function() { return $('#add_produk option:selected').text() },
          selectedProductId: function() { return $('#add_produk option:selected').val() },
          price: function() { return convert.toNumber($('#add_harga').val()) },
          width: function() { return convert.toNumber($('#add_panjang').val()) },
          length: function() { return convert.toNumber($('#add_lebar').val()) },
          prefix: function() { return ($('input[name="r2"]:checked').val() == undefined) ? '' : $('input[name="r2"]:checked').val() },
          quantity: function() { return convert.toNumber($('#add_kuantitas').val()) },
          selectedFinishing: function() { return $('#add_finishing option:selected').text() },
          info: function() { return $('#add_keterangan').val() },
          discount: function() { return convert.toNumber($('#add_diskon').val()) },
          totalPrice: function() { return convert.toNumber($('#add_subtotal').val()) },
        },
        modalEditItem: {
          selectedProductName: function() { return $('#edit_produk option:selected').text() },
          selectedProductId: function() { return $('#edit_produk option:selected').val() },
          price: function() { return convert.toNumber($('#edit_harga').val()) },
          width: function() { return convert.toNumber($('#edit_panjang').val()) },
          length: function() { return convert.toNumber($('#edit_lebar').val()) },
          prefix: function() { return ($('input[name="r2edit"]:checked').val() == undefined) ? '' : $('input[name="r2edit"]:checked').val() },
          quantity: function() { return convert.toNumber($('#edit_kuantitas').val()) },
          selectedFinishing: function() { return $('#edit_finishing option:selected').text() },
          info: function() { return $('#edit_keterangan').val() },
          discount: function() { return convert.toNumber($('#edit_diskon').val()) },
          totalPrice: function() { return convert.toNumber($('#edit_subtotal').val()) },
        }
      }

      
    </script>

    <script>
      var addItem = {};

      $('#modal_add').on('shown.bs.modal', function() {
        input.modalAddItem.reset();
        var isArea, prefix;
        input.modalAddItem.selectProduct.on('select2:select', function(e) {
          $.ajax({
            async: false,
            type: 'get',
            url: ajaxParams.url,
            data: ajaxParams.data(e.params.data.id),
            dataType: 'json',
            success: function(response) {
              var price = response.harga_jual;
              prefix = response.satuan;
              isArea = (response.hitung_luas == '0') ? false : true;
              input.modalAddItem.price.val(convert.toIDR(price));
              setHtml.modalItem.metric(
                input.modalAddItem.width, 
                input.modalAddItem.length,
                input.modalAddItem.metric.prefixes.cm,
                input.modalAddItem.metric.prefixes.m,
                prefix, isArea, 
                getHtml.modalAddItem.width(), 
                getHtml.modalAddItem.length()
              );
              input.modalAddItem.totalPrice.val(convert.toIDR(
                calculate.totalPrice(price, 
                  getHtml.modalAddItem.discount(),
                  getHtml.modalAddItem.quantity(),
                  calculate.area(
                    getHtml.modalAddItem.width(), 
                    getHtml.modalAddItem.length(), 
                    prefix, getHtml.modalAddItem.prefix()), 
                  isArea
                )
              ));
            }
          });
        });

        input.modalAddItem.cBlur.blur(function() {
          input.modalAddItem.totalPrice.val(convert.toIDR(
            calculate.totalPrice(
              getHtml.modalAddItem.price(), 
              getHtml.modalAddItem.discount(),
              getHtml.modalAddItem.quantity(),
              calculate.area(
                getHtml.modalAddItem.width(), 
                getHtml.modalAddItem.length(), 
                prefix, getHtml.modalAddItem.prefix()), 
              isArea
            )
          ));
        });

        input.modalAddItem.metric.allPrefixes.click(function() {
          input.modalAddItem.totalPrice.val(convert.toIDR(
            calculate.totalPrice(
              getHtml.modalAddItem.price(), 
              getHtml.modalAddItem.discount(),
              getHtml.modalAddItem.quantity(),
              calculate.area(
                getHtml.modalAddItem.width(), 
                getHtml.modalAddItem.length(), 
                prefix, getHtml.modalAddItem.prefix()), 
              isArea
            )
          ));
        });

      });

      input.modalAddItem.saveButton.click(function() {
        var rowId = parseInt(
          transaction.purchased.after.items[
            transaction.purchased.after.items.length - 1
          ].rowId
        ) + 1;
        var amount = 0;
        addItem.rowId = rowId.toString();
        addItem.productId = getHtml.modalAddItem.selectedProductId();
        addItem.productName = getHtml.modalAddItem.selectedProductName();
        addItem.metric = getHtml.modalAddItem.prefix();
        addItem.discount = (getHtml.modalAddItem.discount() * 100).toString();
        addItem.price = getHtml.modalAddItem.price().toString();
        addItem.width = getHtml.modalAddItem.width().toString();
        addItem.length = getHtml.modalAddItem.length().toString();
        addItem.quantity = getHtml.modalAddItem.quantity().toString();
        addItem.finishing = getHtml.modalAddItem.selectedFinishing();
        addItem.info = getHtml.modalAddItem.info();
        addItem.totalPrice = getHtml.modalAddItem.totalPrice().toString();
        setHtml.tBody(appendTr(addItem, 'add'));
        transaction.purchased.after.items.push(addItem);
        addItem = {};
        $('#modal_add').modal('hide');
        input.modalAddItem.reset();
        transaction.purchased.after.items.forEach(function(v,k) {
          amount += parseFloat(v.totalPrice);
        });
        transaction.purchased.after.amountItems = amount;
        input.transaction.amount.val(convert.toIDR(amount)).trigger('change');
      });

      $('#modal_add').on('hide.bs.modal', function() {
        input.modalAddItem.reset();
      })
    </script>

    <script>
      var eR = undefined;
      $(document).on('click', '.modal_edit', function() {
        eR = $(this).data('id');
        input.modalEditItem.reset();
        $('#modal_edit').modal('show');
      });

      $('#modal_edit').on('show.bs.modal', function() {
        var item = {};
        transaction.purchased.after.items.forEach(function(v,k) {
          if (v.rowId == eR) {
            item = v;
          }
        });
        var isArea, prefix;
        $.ajax({
          async: false,
          type: 'get',
          url: ajaxParams.url,
          data: ajaxParams.data(item.productId),
          dataType: 'json',
          success: function(response) {
            input.modalEditItem.selectProduct.val(
              item.productId
            ).trigger('change');
            input.modalEditItem.price.val(
              convert.toIDR(item.price)
            );
            input.modalEditItem.quantity.val(item.quantity);
            input.modalEditItem.selectFinishing.val(item.finishing).trigger('change');
            input.modalEditItem.info.val(item.info);
            input.modalEditItem.discount.val(convert.toFixed(item.discount) + ' %');
            prefix = response.satuan;
            isArea = (response.hitung_luas == '0') ? false : true;
            setHtml.modalItem.metric(
              input.modalEditItem.width, 
              input.modalEditItem.length,
              input.modalEditItem.metric.prefixes.cm,
              input.modalEditItem.metric.prefixes.m,
              item.metric, isArea, 
              item.width, 
              item.length
            );
            input.modalEditItem.totalPrice.val(convert.toIDR(item.totalPrice));
          }
        });
        input.modalEditItem.selectProduct.on('select2:select', function(e) {
          $.ajax({
            async: false,
            type: 'get',
            url: ajaxParams.url,
            data: ajaxParams.data(e.params.data.id),
            dataType: 'json',
            success: function(response) {
              var price = response.harga_jual;
              prefix = response.satuan;
              isArea = (response.hitung_luas == '0') ? false : true;
              input.modalEditItem.price.val(convert.toIDR(price));
              setHtml.modalItem.metric(
                input.modalEditItem.width, 
                input.modalEditItem.length,
                input.modalEditItem.metric.prefixes.cm,
                input.modalEditItem.metric.prefixes.m,
                prefix, isArea, 
                getHtml.modalEditItem.width(), 
                getHtml.modalEditItem.length()
              );
              input.modalEditItem.totalPrice.val(convert.toIDR(
                calculate.totalPrice(price, 
                  getHtml.modalEditItem.discount(),
                  getHtml.modalEditItem.quantity(),
                  calculate.area(
                    getHtml.modalEditItem.width(), 
                    getHtml.modalEditItem.length(), 
                    prefix, getHtml.modalEditItem.prefix()), 
                  isArea
                )
              ));
            }
          });
        });
        input.modalEditItem.cBlur.blur(function() {
          input.modalEditItem.totalPrice.val(convert.toIDR(
            calculate.totalPrice(
              getHtml.modalEditItem.price(), 
              getHtml.modalEditItem.discount(),
              getHtml.modalEditItem.quantity(),
              calculate.area(
                getHtml.modalEditItem.width(), 
                getHtml.modalEditItem.length(), 
                prefix, getHtml.modalEditItem.prefix()), 
              isArea
            )
          ));
        });
        input.modalEditItem.metric.allPrefixes.click(function() {
          input.modalEditItem.totalPrice.val(convert.toIDR(
            calculate.totalPrice(
              getHtml.modalEditItem.price(), 
              getHtml.modalEditItem.discount(),
              getHtml.modalEditItem.quantity(),
              calculate.area(
                getHtml.modalEditItem.width(), 
                getHtml.modalEditItem.length(), 
                prefix, getHtml.modalEditItem.prefix()), 
              isArea
            )
          ));
        });
      });

      input.modalEditItem.saveButton.click(function() {
        var editItem = {};
        var amount = 0;
        editItem.rowId = eR.toString();
        editItem.productName = getHtml.modalEditItem.selectedProductName();
        editItem.metric = getHtml.modalEditItem.prefix();
        editItem.discount = (getHtml.modalEditItem.discount() * 100).toString();
        editItem.productId = getHtml.modalEditItem.selectedProductId();
        editItem.price = getHtml.modalEditItem.price().toString();
        editItem.width = getHtml.modalEditItem.width().toString();
        editItem.length = getHtml.modalEditItem.length().toString();
        editItem.quantity = getHtml.modalEditItem.quantity().toString();
        editItem.finishing = getHtml.modalEditItem.selectedFinishing();
        editItem.info = getHtml.modalEditItem.info();
        editItem.totalPrice = getHtml.modalEditItem.totalPrice().toString();
        $('#'+eR).html(appendTr(editItem, 'edit'));
        transaction.purchased.after.items[eR-1] = editItem;
        $('#modal_edit').modal('hide');
        input.modalEditItem.reset();
        transaction.purchased.after.items.forEach(function(v,k) {
          amount += parseFloat(v.totalPrice);
        });
        transaction.purchased.after.amountItems = amount;
        input.transaction.amount.val(convert.toIDR(amount)).trigger('change');
        eR = undefined;
      });

      $('#modal_edit').on('hide.bs.modal', function() {
        input.modalEditItem.reset();
      })
    </script>

    <script>
      input.transaction.paidOffMethod.change(function() {
        input.transaction.paidOff.val(
          ($(this).val() == 'lunas') ? input.transaction.amount.val() : convert.toIDR(
            convert.toNumber(input.transaction.amount.val()) / 2
          )
        ).trigger('change');
      });

      input.transaction.discount.add(
        input.transaction.tax
      ).add(
        input.transaction.amount
      ).on('change blur', function() {
        var result = calculate.payment(
          transaction.purchased.after.amountItems,
          input.transaction.discount.val().split(' ')[0]/100,
          input.transaction.tax.val().split(' ')[0]/100
        );
        var method;
        input.transaction.paidOffMethod.each(function(i) {
          if ($(this).prop('checked')) {
            method = $(this).val();
          }
        })
        var pay = calculate.paidOff(
          result,
          method
        );
        input.transaction.amount.val(convert.toIDR(result));
        input.transaction.paidOff.val(
          convert.toIDR(pay)
        );
        input.transaction.debit.val(
          convert.toIDR(
            calculate.debt(result, pay)
          )
        )
        input.transaction.ret.val(
          convert.toIDR(
            calculate.ret(result, pay)
          )
        )
      });

      input.transaction.paidOff.on('change blur', function() {
        input.transaction.debit.val(
          convert.toIDR(
            convert.toIDR(
              calculate.debt(
                convert.toNumber(input.transaction.amount.val()),
                convert.toNumber($(this).val())
              )
            )
          )
        );
        input.transaction.ret.val(
          convert.toIDR(
            convert.toIDR(
              calculate.ret(
                convert.toNumber(input.transaction.amount.val()),
                convert.toNumber($(this).val())
              )
            )
          )
        )
      })

      input.transaction.save.click(function() {
        var token = "{{ csrf_token() }}";
        transaction.purchased.after.amount = convert.toNumber(input.transaction.amount.val()).toString();
        transaction.purchased.after.discount = convert.toNumber(input.transaction.discount.val()).toString();
        transaction.purchased.after.paidOff = convert.toNumber(input.transaction.paidOff.val()).toString();
        transaction.purchased.after.debit = convert.toNumber(input.transaction.debit.val()).toString();
        transaction.purchased.after.tax = convert.toNumber(input.transaction.tax.val()).toString();
        transaction.purchased.after.pmentMethod = $('#pembayaran :selected').val();
        if (transaction.purchased.after.paidOff > transaction.purchased.after.amount) {
          swal("Gagal", "Pembayaran DP lebih dari total.", "error");
        } else {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'{{route('updatetransaksi', ['id'=> encrypt($transaksi->id)])}}',
            data: JSON.stringify(transaction),
            async: false,
            processData: false,
            contentType: 'application/json; charset=utf-8',
            success: function(response){
              swal("Berhasil !", "Berhasil mengubah transaksi !", "success")
              .then(function(value) {
                window.location = '{{route('transaksilist')}}'
              })
            },
            error: function(response) {
              swal("Error !", "Gagal mengubah transaksi !", "error");
            }
          })
        }
      })
    </script>

    <script>
      var deleteRow = undefined;
      $(document).on('click', '.modal_delete', function() {
        deleteRow = $(this).data('id');
      })
      $('#deleteitem').click(function() {
        var amount = 0;
        transaction.purchased.after.items.forEach(function(v,k) {
          if (v.rowId == deleteRow) {
            transaction.purchased.after.items.splice(k, 1);
          }
        });
        transaction.purchased.after.items.forEach(function(v,k) {
          amount += parseFloat(v.totalPrice);
        });
        transaction.purchased.after.amountItems = amount;
        input.transaction.amount.val(convert.toIDR(amount)).trigger('change');
        $('#modal_delete').modal('hide');
        $('tr#'+deleteRow).remove();
        deleteRow = undefined;
      })
    </script>

    </body>
@endsection
