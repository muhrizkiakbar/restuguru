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
                                      data-toggle="modal" 
                                      data-target="#modal_edit">
                                      <i class="fa fa-edit"></i>
                                    </button>
                                    <button 
                                      type="button" 
                                      class="modal_delete btn btn-danger btn-sm" 
                                      data-toggle="modal" 
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
                                    <input id="diskon" name="diskon" value="{{ $transaksi->diskon }}" placeholder="0,00%" class="form-control val-percentage" type="text">
                                </label>                                  
                            </div>
                            <div class="col-md-3">
                                <label>Total
                                    <input id="total" name="total" disabled value="{{ $transaksi->total_harga }}" placeholder="Rp 0" class="form-control val-currency" type="text">
                                    <input id="total2" name="total2" disabled hidden value="{{ $transaksi->total_harga }}" type="text">
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
                                    <input id="bayardp" name="bayardp" value="{{ $transaksi->jumlah_pembayaran }}" placeholder="Rp 0" class="form-control val-currency" type="text">
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
                                      <input id="pajak" name="pajak"  value="{{ $transaksi->pajak }}" placeholder="0,00%" class="form-control val-percentage" type="text">
                                  </label>                     
                            </div>
                            <div class="col-md-3">
                                  <label>Sisa
                                      <input id="sisa" name="sisa"  value="{{ $transaksi->sisa_tagihan }}" placeholder="Rp 0" class="form-control val-currency" disabled type="text">
                                  </label>  
                                                
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
                                    <input id="add_harga" name="add_harga" class="form-control val-currency" type="text">
                                    <!-- {{csrf_field()}} -->
                                </div>
                                <div class="form-group">
                                    <label>P</label>
                                    <input id="add_panjang" name="add_panjang" class="form-control pull-right val-metric" type="text">
                                </div>
                                <div class="form-group">
                                    <label>L</label>
                                    <input id="add_lebar" name="add_lebar" class="form-control pull-right val-metric" type="text">
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
                                    <input id="add_kuantitas" name="add_kuantitas" class="form-control pull-right val-metric" type="text">
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
                                    <input id="add_diskon" name="add_diskon" class="form-control pull-right val-percentage" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Subtotal</label>
                                    <input id="add_subtotal" name="add_subtotal" readonly class="form-control pull-right val-currency" type="text">
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
                                          <input id="edit_harga" name="edit_harga" class="form-control val-currency edit-input" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>P</label>
                                          <input id="edit_panjang" name="edit_panjang" class="form-control pull-right val-metric edit-input" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>L</label>
                                          <input id="edit_lebar" name="edit_lebar" class="form-control pull-right val-metric edit-input" type="text">
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
                                          <input id="edit_kuantitas" name="edit_kuantitas" class="form-control pull-right edit-input" type="text">
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
                                          <input id="edit_diskon" name="edit_diskon" class="form-control pull-right edit-input val-percentage" type="text">
                                      </div>
                                      <div class="form-group">
                                          <label>Subtotal</label>
                                          <input id="edit_subtotal" name="edit_subtotal" readonly class="form-control pull-right val-currency" type="text">
                                      </div>
                                      <!-- /.form-group -->
                                  </div>
                              </div>
                      </div>
                      <div class="modal-footer">
                          
                          <button type="button" class="btn btn-default pull-left" id="closeitem" data-dismiss="modal">Keluar</button>
                          <button type="button" id="edititem" class="btn btn-success" disabled>Simpan</button>
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

      $('.val-currency').blur(function() {$(this).val(convert.toIDR($(this).val())) });
      $('.val-percentage').blur(function() {$(this).val(convert.toFixed($(this).val()) + ' %');});
      $('.val-metric').blur(function() { $(this).val(convert.toFixed($(this).val())) });

      $('.val-percentage, .val-currency, .val-metric').focus(function() { $(this).val('') });
      console.log(transaction);
    </script>

    <script>
      var appendTr = function(data) {
        var prefix = (data.metric === 'METER') ? 'm' : 'cm';
        var w = (data.width !== 0) ? (convert.toFixed(data.width) + ' ' + prefix ) : '-';
        var l = (data.length !== 0) ? (convert.toFixed(data.length) + ' ' + prefix ) : '-';
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
                  data-toggle="modal" \
                  data-target="#modal_edit">\
                  <i class="fa fa-edit"></i>\
                </button>\
                <button \
                  type="button" \
                  class="modal_delete btn btn-danger btn-sm" \
                  data-toggle="modal" \
                  data-target="#modal_delete">\
                  <i class="fa fa-trash"></i>\
                </button>\
              </div>\
            </td>\
          </tr>'
        )
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
        payment: function(a, d, t, pay) {
          var aDiscount = a - (a * d);
          var aTax = aDiscount + (aDiscount * t);
          var debt = aTax - pay;
          return {
            aFinal: aTax,
            debt: (debt < 0) ? 0 : debt
          }
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
        transaction: {
          discount: $('#diskon'),
          paidOff: $('#bayardp'),
          tax: $('#pajak'),
          amount: $('#total'),
          pmentMethod: $('#pembayaran'),
          paidOffMethod: $('input[name="metode"]'),
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
        })

      });

      input.modalAddItem.saveButton.click(function() {
        var rowId = transaction.purchased.after.items.length + 1
        var amount = 0
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
        setHtml.tBody(appendTr(addItem));
        transaction.purchased.after.items.push(addItem);
        // console.log(addItem);
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

      input.transaction.paidOffMethod.change(function() {
        input.transaction.paidOff.val(
          ($(this).val() == 'lunas') ? input.transaction.amount.val() : convert.toIDR(
            convert.toNumber(input.transaction.amount.val()) / 2
          )
        ).trigger('change');
      })

      input.transaction.discount.blur(function() {
        var result = calculate.payment(
          transaction.purchased.after.amountItems,
          $(this).val().split(' ')[0]/100,
          input.transaction.tax.val().split(' ')[0]/100,
          convert.toNumber(input.transaction.paidOff.val())
        )
        input.transaction.amount.val(convert.toIDR(result.aFinal));
        input.transaction.debit.val(convert.toIDR(result.debt));
      })

      input.transaction.tax.blur(function() {
        var result = calculate.payment(
          transaction.purchased.after.amountItems,
          input.transaction.discount.val().split(' ')[0]/100,
          $(this).val().split(' ')[0]/100,
          convert.toNumber(input.transaction.paidOff.val())
        )
        input.transaction.amount.val(convert.toIDR(result.aFinal));
        input.transaction.debit.val(convert.toIDR(result.debt));
      })

      input.transaction.paidOff.on('change blur', function() {
        var result = calculate.payment(
          transaction.purchased.after.amountItems,
          input.transaction.discount.val().split(' ')[0]/100,
          input.transaction.tax.val().split(' ')[0]/100,
          convert.toNumber($(this).val())
        )
        input.transaction.amount.val(convert.toIDR(result.aFinal));
        input.transaction.debit.val(convert.toIDR(result.debt));
      })

      input.transaction.amount.on('change', function() {
        var result = calculate.payment(
          transaction.purchased.after.amountItems,
          input.transaction.discount.val().split(' ')[0]/100,
          input.transaction.tax.val().split(' ')[0]/100,
          convert.toNumber(input.transaction.paidOff.val())
        )
        input.transaction.amount.val(convert.toIDR(result.aFinal));
        input.transaction.debit.val(convert.toIDR(result.debt));
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
          console.log(transaction);
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
            success:function(response){
              console.log('ok');
            }
          })
        }
      })


      
      // $('.select2').select2();

      // $(function(){
      //   numeral.locale('idr');
      //   $('#sisa, #bayardp, #total').each(function() {
      //     $(this).val(
      //       numeral(this.value).format(idr)
      //     );
      //   });
      //   $('.td-currency').each(function() {
      //     $(this).text(
      //       numeral($(this).text()).format(idr)
      //     );
      //   });
      //   $('.td-units').each(function() {
      //     var satuanText = ($(this).closest('tr').data('satuan')) === 'METER' ? 'm' : ($(this).closest('tr').data('satuan')) === 'CENTIMETER' ? 'cm' : '';
      //     var valueBefore = $(this).text();
      //     $(this).text(
      //       (satuanText != '') ? numeral(valueBefore).format(toFixed2) + " " + satuanText : '-'
      //     );
      //   });
      //   $('.td-discount').each(function() {
      //     $(this).text(
      //       numeral($(this).text()).format(toFixed2) + " %"
      //     );
      //   });
      // });

      // $('.mata-uang').on('change keyup', function() {
      //   $(this).val(
      //     numeral(this.value).format(idr)
      //   )
      // });

      // $('.percentage').blur(function() {
      //   $(this).val(
      //     numeral(this.value).format(toFixed2)
      //   )
      // });

      // $('.percentage').focus(function() {
      //   $(this).val('');
      // })

      // var data = {};
      // $('.modal_edit').on('click', function() {
      //   var tr = $(this).closest('tr');
      //   data = {
      //     ...data,
      //     rowId: tr.data('row_id'),
      //     produkId: tr.data('produk_id'),
      //     namaProduk: tr.data('nama_produk'),
      //     satuan: tr.data('satuan'),
      //     diskon: tr.data('diskon'),
      //     harga: tr.data('harga'),
      //     panjang: tr.data('panjang'),
      //     lebar: tr.data('lebar'),
      //     kuantitas: tr.data('kuantitas'),
      //     finishing: tr.data('finishing'),
      //     keterangan: tr.data('keterangan'),
      //     subtotal: tr.data('subtotal'),
      //   }

      //   $.ajax({
      //     async: false,
      //     type: 'get',
      //     url: produkUrl,
      //     data: produkData(data.produkId, pelanggan),
      //     dataType: 'json',
      //     success: function(response) {
      //       var hitung_luas = (response.hitung_luas == 0) ? false : true;
      //       var baseUnit = response.satuan
      //       data = {...data, hitung_luas, baseUnit};
      //     }
      //   });
      // })

      // $('#modal_edit').on('shown.bs.modal', function() {
      //   var input = {
      //     i: $('#edit_produk'),
      //     h: $('#edit_harga'),
      //     p: $('#edit_panjang'),
      //     l: $('#edit_lebar'),
      //     rUnit: $('input[name="r2edit"]'),
      //     rCM: $('#r2editcm'),
      //     rM: $('#r2editm'),
      //     q: $('#edit_kuantitas'),
      //     f: $('#edit_finishing'),
      //     k: $('#edit_keterangan'),
      //     d: $('#edit_diskon'),
      //     sT: $('#edit_subtotal')
      //   }

      //   var calculate = {
      //     modal: {
      //         subtotal: function(
      //         p, l, metric, metric, 
      //         price, q, d ) {
      //           return calcSubtotal(
      //             calcLuas(
      //               numeral(input.p.val()).value(),
      //               numeral(input.l.val()).value(),
      //               $('input[name="r2edit"]:checked').val(),
      //               $('#editBaseUnit').val()
      //             ),
      //             data.hitung_luas,
      //             numeral(input.h.val()).value(),
      //             numeral(input.q.val()).value(),
      //             numeral(input.d.val()).value()
      //           )
      //       }
      //     }
      //   }
      //   setHtml.modal.price(input.h, data.harga)
      //   setHtml.modal.units(
      //     input.p, input.l, input.rCM, input.rM, 
      //     data.panjang, data.lebar, data.satuan, data.hitung_luas
      //   )
      //   input.q.val(data.kuantitas);
      //   input.f.val(data.finishing);
      //   input.k.val(data.keterangan);
      //   input.d.val(data.diskon);
      //   input.sT.val(data.subtotal).trigger('change');
      //   $('.edit-input').on('change', function() {
      //     $('#edititem').prop('disabled', false);
      //   })

      //   $('.editbesaran').add(input.q).focus(function() { $(this).val(0) });

      //   $('.editbesaran').keyup(function() {
      //     $(this).val(numeral(this.value).format(toFixed2));
      //     input.sT.val(
      //       numeral(
      //         calculate.modal.subtotal(
      //           numeral(input.p.val()).value(),
      //           numeral(input.l.val()).value(),
      //           $('input[name="r2edit"]:checked').val(),
      //           data.baseUnit, 
      //         )
      //       ).format(idr));
      //   })

      //   input.h.add(input.q).add(input.d).keyup(function() {
      //     input.sT.val(numeral(calculate.subtotal()).format(idr));
      //   })

      //   input.rUnit.click(function() {
      //     input.sT.val(numeral(calculate.subtotal()).format(idr));
      //   });

      //   input.i.on('select2:select', function (e) {
      //     $.ajax({
      //       async: false,
      //       type: 'get',
      //       url: produkUrl,
      //       data: produkData(e.params.data.id, pelanggan),
      //       dataType: 'json',
      //       success: function(response) {
      //         var hitung_luas = (response.hitung_luas == 0) ? false : true;
      //         var baseUnit = response.satuan;
      //         var harga = response.harga_jual;
      //         data = {...data, hitung_luas, baseUnit};
      //         setHtml.modal.price(input.h, harga);
      //         setHtml.modal.units(
      //           input.p, input.l, input.rCM, input.rM, 
      //           0, 0, baseUnit, hitung_luas
      //         );
      //       }
      //     });
      //   })

      //   $('#edititem').click(function() {
          
      //   })        
      // })
    </script>

    </body>
@endsection
