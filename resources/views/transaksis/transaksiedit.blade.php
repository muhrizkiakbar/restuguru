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
                        <input type="text" class="form-control" disabled id="namapelanggan" name="namapelanggan" placeholder="Nama Pelanggan">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" disabled id="nomorhandphone" name="nomorhandphone" placeholder="Nomor Handphone">
                      </div>
                      <div class="form-group">
                        <select id="pelanggan" name="pelanggan" disabled class="form-control select2" style="width:100%;" type="text"></select>
                      </div>



                    </div>
                  </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" id="submitpelanggan" disabled class="btn btn-success btn-sm">Submit <i class="fa fa-chevron-circle-right"></i></button>
                </div>
            </div>
          </div>
          </form>

          <div class="col-md-10">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Penjualan <i class="fa  fa-shopping-cart"></i></h3>
              </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="no">No. Nota : </label><span id="nonota"> {{$transaksi->nomor_nota}}</span>
                      </div>


                        <div class="form-group">
                          <label for="tanggal">Tanggal</label>
                          <input type="text" class="form-control" id="tanggal" readonly name="tanggal" disabled style="max-width:100px;" value="{{$transaksi->tanggal}}" placeholder="Tanggal">
                        </div>

                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="kepada">Kepada : </label><span id="kepadalabel">{{$transaksi->nama_pelanggan}}</span>
                      </div>
                      <div class="form-group">
                        <label for="nomor">Nomor Handphone : </label><span id="handphonelabel">{{$transaksi->hp_pelanggan}}</span>
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
                            @foreach ($datas as $key2 => $data)
                            <tr id="{{$key2}}">
                                <td>{{$data->nama_produk}}<input type="hidden" readonly disabled id="produk[]" value="{{$data->nama_produk}}" name="produk[]"><input type="hidden" readonly disabled id="produkid[]" value="{{$data->produk_id}}" name="produkid[]"><input type="hidden" readonly disabled id="subtransid[]" value="{{$data->id}}" name="subtransid[]"><input type="hidden" readonly disabled id="satuan[]" value="{{$data->satuan}}" name="satuan[]"></td>
                                <td>{{number_format(floatval($data->harga_satuan),2,',','.')}}<input type="hidden" readonly disable id="harga[]" value="{{$data->harga_satuan}}" name="harga[]"></td>
                                <td>{{number_format(floatval($data->panjang),2,',','.')}}<input type="hidden" readonly disable id="panjang[]" value="{{$data->panjang}}" name="panjang[]"></td>
                                <td>{{number_format(floatval($data->lebar),2,',','.')}}<input type="hidden" readonly disable id="lebar[]" value="{{$data->lebar}}" name="lebar[]"></td>
                                <td>{{number_format(floatval($data->banyak),2,',','.')}}<input type="hidden" readonly disable id="kuantitas[]" value="{{$data->banyak}}" name="kuantitas[]"></td>
                                <td>{{$data->finishing}}<input type="hidden" readonly disable id="finishing[]" value="{{$data->finishing}}" name="finishing[]"></td>
                                <td style="width: 170px;word-break: break-all;">{{$transaksi->keterangan}}<input type="hidden" readonly disable id="keterangan[]" value="{{$data->keterangan}}" name="keterangan[]"></td>
                                <td>{{number_format(floatval($data->diskon),2,',','.')}}<input type="hidden" readonly disable id="diskonnow[]" value="{{$data->diskon}}" name="diskonnow[]"></td>
                                <td>{{number_format(floatval($data->subtotal),2,',','.')}}<input type="hidden" readonly disable id="subtotal[]" value="{{$data->subtotal}}" name="subtotal[]"></td>
                                @if ($data->satuan==null)
                                <td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-subpenjualan="{{$data->id}}" data-satuan="3" data-diskon="{{$data->diskon}}" data-produk="{{$data->produk_id}}" data-harga="{{$data->harga_satuan}}" data-panjang="{{$data->panjang}}" data-lebar="{{$data->lebar}}" data-kuantitas="{{$data->banyak}}" data-finishing="{{$data->finishing}}" data-keterangan="{{$data->keterangan}}" data-namaproduk="{{$data->nama_produk}}" data-subtotal="{{$data->subtotal}}" data-tdid="{{$key2}}" data-hitungluas="0" data-target="#modal_edit"><i class="fa fa-edit"></i></button>
                                <button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-subpenjualan="{{$data->id}}" data-namaproduk="{{$data->nama_produk}}" data-produk="{{$data->produk_id}}" data-harga="{{$data->harga}}" data-panjang="{{$data->panjang}}" data-lebar="{{$data->lebar}}" data-tdid="{{$key2}}" data-kuantitas="{{$data->banyak}}" data-finishing="{{$data->finishing}}" data-keterangan="{{$data->keterangan}}" data-subtotal="{{$data->subtotal}}" data-tdid="{{$key2}}" data-hitungluas="1" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td>
                                @else
                                <td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-subpenjualan="{{$data->id}}" data-satuan="{{$data->satuan}}" data-diskon="{{$data->diskon}}" data-produk="{{$data->produk_id}}" data-harga="{{$data->harga_satuan}}" data-panjang="{{$data->panjang}}" data-lebar="{{$data->lebar}}" data-kuantitas="{{$data->banyak}}" data-finishing="{{$data->finishing}}" data-keterangan="{{$data->keterangan}}" data-namaproduk="{{$data->nama_produk}}" data-subtotal="{{$data->subtotal}}" data-tdid="{{$key2}}" data-hitungluas="1" data-target="#modal_edit"><i class="fa fa-edit"></i></button>
                                <button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-subpenjualan="{{$data->id}}" data-namaproduk="{{$data->nama_produk}}" data-produk="{{$data->produk_id}}" data-harga="{{$data->harga}}" data-panjang="{{$data->panjang}}" data-lebar="{{$data->lebar}}" data-tdid="{{$key2}}" data-kuantitas="{{$data->banyak}}" data-finishing="{{$data->finishing}}" data-keterangan="{{$data->keterangan}}" data-subtotal="{{$data->subtotal}}" data-tdid="{{$key2}}" data-hitungluas="1" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td>
                                @endif
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
                                  <input id="diskon" name="diskon" class="form-control" type="text">
                              </label>
                          </div>
                          <div class="col-md-3">
                              <label>Total
                                  <input id="total" name="total" class="form-control" readonly type="text">
                                  <input id="transaksiid" name="transaksiid" value="{{encrypt($transaksi->id)}}" class="form-control" readonly type="hidden">
                                  <input id="total2" name="total2"  class="form-control" readonly type="hidden">
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
                                  <input id="bayardp" name="bayardp"  class="form-control" type="text">
                              </label>
                          </div>
                          <div class="col-md-3">
                            <label>Pembayaran
                              <select class="form-control  pull-right"  id="pembayaran" name="pembayaran" style="width: 100%;">
                                @if ($transaksi->metode_pembayaran=="Cash")
                                  <option value="Cash" selected>Cash</option>
                                @else
                                  <option value="Cash">Cash</option>
                                @endif
                                @if ($transaksi->metode_pembayaran=="Transfer")
                                  <option value="Transfer" selected>Transfer</option>
                                @else
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
                                    <input id="pajak" name="pajak" class="form-control" type="text">
                                </label>
                          </div>
                          <div class="col-md-3">
                                <label>Sisa
                                    <input id="sisa" name="sisa" readonly  class="form-control"  type="text">
                                </label>

                          </div>
                      </div>
                  </div>
                <hr>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="btn-grp pull-right">
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
                                          <label>Diskon</label>
                                          <input id="add_diskon" name="add_diskon" class="form-control pull-right" type="text">
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
                                          <label>Diskon</label>
                                          <input id="edit_diskon" name="edit_diskon" class="form-control pull-right" type="text">
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

      var total3=0;
      var total2={{$transaksi->total_harga}};
      var total={{$transaksi->total_harga}};
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
      var tdid={{$count}};
      var subtotalawal=0;
      var tdidnow=0;
      var subtotaldelete=0;
      var diskon4={{$transaksi->diskon}};
      var total4={{$transaksi->total_harga}};
      var bayardp4={{$transaksi->jumlah_pembayaran}};
      var pajak4={{$transaksi->pajak}};
      var sisa4={{$transaksi->sisa_tagihan}};
      var pelanggan=""+"{{$transaksi->pelanggan_id}}";
      var subpenjualan=0;

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

        $("#add_diskon").keydown(function (e) {
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

                var subtotal = ((panjang * lebar) * harga) * kuantitas;
                $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                satuan=this.value;
            }
            else if (this.value == 'm') {


                var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
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
            // alert("asd");]
            var harga=($('#edit_harga').maskMoney('unmasked')[0]);
            var panjang=($('#edit_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#edit_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#edit_kuantitas').maskMoney('unmasked')[0]);

            if (this.value == 'cm') {

                
                // subtotal################

                var subtotal = ((panjang * lebar) * harga) * kuantitas;
                $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                satuan=this.value;
            }
            else if (this.value == 'm') {

                var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                satuan=this.value;

            }
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

        $('#diskon').val((diskon4)).maskMoney({thousands:'.', decimal:',',allowZero:true});
        $('#total').val((total4)).maskMoney({thousands:'.', decimal:',',allowZero:true});
        $('#total2').val((total4)).maskMoney({thousands:'.', decimal:',',allowZero:true});
        $('#bayardp').val((bayardp4)).maskMoney({thousands:'.', decimal:',',allowZero:true});
        $('#pajak').val((pajak4)).maskMoney({thousands:'.', decimal:',',allowZero:true});
        $('#sisa').val((sisa4)).maskMoney({thousands:'.', decimal:',',allowZero:true});
        

        $('#diskon').val(diskon4).trigger('mask.maskMoney');
        $('#total').val(total4).trigger('mask.maskMoney');
        $('#total2').val(total4).trigger('mask.maskMoney');
        $('#bayardp').val(bayardp4).trigger('mask.maskMoney');
        $('#pajak').val(pajak4).trigger('mask.maskMoney');
        $('#sisa').val(sisa4).trigger('mask.maskMoney');

      });
      
        function backtopagelist(protocol,url){
            var url2 = protocol+'//'+url + '/transaksi/list';
            console.log(url2);
            window.location=url2;
        }
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



        $('#diskon').blur(function(){
            total2=($('#total2').maskMoney('unmasked')[0]);
            diskon=($('#diskon').maskMoney('unmasked')[0]);
            total=($('#total').maskMoney('unmasked')[0]);
            pajak=($('#pajak').maskMoney('unmasked')[0]);
            //   var nominaldiskon=0;
            total=diskonmethod(total2,diskon,total,pajak);

            $('#total').val(total).trigger('mask.maskMoney');
            $('#sisa').val(total).trigger('mask.maskMoney');      
            $('#metodelunas').iCheck('uncheck');
            $('#metodedp').iCheck('uncheck');
        });
        $('#diskon').focus(function(){
            totalbeforediskon=($('#total').maskMoney('unmasked')[0]);
        });

        $('#pajak').blur(function(){
            total2=($('#total2').maskMoney('unmasked')[0]);
            diskon=($('#diskon').maskMoney('unmasked')[0]);
            pajak=($('#pajak').maskMoney('unmasked')[0]);
            total=($('#total').maskMoney('unmasked')[0]);

            total=pajakmethod(total2,diskon,total,pajak);

            $('#total').val(total).trigger('mask.maskMoney');
            $('#metodelunas').iCheck('uncheck');
            $('#metodedp').iCheck('uncheck');
            $('#sisa').val(total).trigger('mask.maskMoney');
        });
        $('#pajak').focus(function(){
            totalbeforepajak=($('#total').maskMoney('unmasked')[0]);
        });

        $('#bayardp').keyup(function(){
            bayardpmethod(bayardp,total,total2,bayardp);
        });
        $('#bayardp').focus(function(){
            totalbeforedp=($('#total').maskMoney('unmasked')[0]);
        });

        $('#submitpelanggan').click(function(){
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
                $('#handphonelabel').text('  '+$('#nomorhandphone').val());
                $('#kepadalabel').text('  '+$('#namapelanggan').val());

                $('#buttonmodal_add').removeAttr('disabled');
                $('#submitpelanggan').attr('disabled',true);
            }


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
            $('#metode').iCheck('disable');
            $('#submittransaksi').attr('disabled',true);
            $('#buttonmodal_add').attr('disabled',true);
            var inputtransaksiid=$('#transaksiid').val();
            var inputnamapelanggan=$('#namapelanggan').val();
            var inputnomorpelanggan=$('#nomorhandphone').val();
            var inputpelanggan=$('#pelanggan').val();
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
            var jsonsatuan=[];
            $('input[name^="satuan[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonsatuan.push(item);
            });
            var jsonsubtransid=[];
            $('input[name^="subtransid[]"]').each(function() {
                item = {}
                item ["value"] = $(this).val();
                jsonsubtransid.push(item);
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
                    url:'{{route('updatetransaksi')}}',
                    data: JSON.stringify({
                        inputnamapelanggan: inputnamapelanggan,
                        inputnomorpelanggan: inputnomorpelanggan,
                        inputpelanggan: inputpelanggan,
                        inputdiskon: inputdiskon,
                        inputtransaksiid: inputtransaksiid,
                        inputtotal: inputtotal,
                        inputbayardp: inputbayardp,
                        inputpembayaran: inputpembayaran,
                        inputpajak: inputpajak,
                        inputsisa: inputsisa,
                        inputtanggal:inputtanggal,
                        jsonharga: jsonharga,
                        jsonpanjang: jsonpanjang,
                        jsonlebar: jsonlebar,
                        jsonkuantitas: jsonkuantitas,
                        jsonfinishing: jsonfinishing,
                        jsondiskon: jsondiskon,
                        jsonketerangan: jsonketerangan,
                        jsonsubtransid: jsonsubtransid,
                        jsonsubtotal: jsonsubtotal,
                        jsonsatuan: jsonsatuan,
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
                            swal("Berhasil", "Berhasil mengedit transaksi !", "success");
                            setTimeout(backtopagelist(location.protocol,document.domain), 3000);

                        }
                        else
                        {
                            swal("Gagal", "Gagal mengedit transaksi !", "error");
                            setTimeout(backtopagelist(location.protocol,document.domain), 3000);
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
            console.log(pelanggan);
            if ((pelanggan==null) || (pelanggan==""))
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
                        if (hitung_luas==1)
                        {
                            $('#r2m').iCheck('uncheck');
                            $('#r2cm').iCheck('uncheck');
                            $('#r2m').iCheck('enable');
                            $('#r2cm').iCheck('enable');
                            $('#add_panjang').removeAttr('disabled');
                            $('#add_lebar').removeAttr('disabled');
                        }
                        else
                        {
                            $('#r2m').iCheck('uncheck');
                            $('#r2cm').iCheck('uncheck');
                            $('#r2m').iCheck('disable');
                            $('#r2cm').iCheck('disable');
                            $('#add_panjang').attr('disabled',true);
                            $('#add_lebar').attr('disabled',true);
                        }

                        $('#add_harga').val(response.harga_jual).trigger('mask.maskMoney');
                    },
                });
            }
            else
            {
                // yang spesial price
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
                        hitung_luas=response.hitung_luas;
                        if (hitung_luas==1)
                        {
                            $('#r2m').iCheck('uncheck');
                            $('#r2cm').iCheck('uncheck');
                            $('#r2m').iCheck('enable');
                            $('#r2cm').iCheck('enable');
                            $('#add_panjang').removeAttr('disabled');
                            $('#add_lebar').removeAttr('disabled');
                        }
                        else
                        {
                            $('#r2m').iCheck('uncheck');
                            $('#r2cm').iCheck('uncheck');
                            $('#r2m').iCheck('disable');
                            $('#r2cm').iCheck('disable');
                            $('#add_panjang').attr('disabled',true);
                            $('#add_lebar').attr('disabled',true);
                        }

                        $('#add_harga').val(response.harga_khusus).trigger('mask.maskMoney');
                    },
                });
            }
        });

        $('#buttonmodal_add').click(function (){

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

            $('#add_panjang').removeAttr('disabled');
            $('#add_lebar').removeAttr('disabled');
            $('#add_produk').val('').trigger('change');
            $('#add_harga').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#add_diskon').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#add_subtotal').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#add_kuantitas').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#add_panjang').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#add_lebar').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#add_subtotal').val('0,00').maskMoney({thousands:'.', decimal:',',allowZero:true});
        });


        $('#additem').click(function(){

            var produk=$('#add_produk').val();

            var produkid=$('#add_produkid').val();
            var harga=($('#add_harga').maskMoney('unmasked')[0]);
            var panjang=($('#add_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#add_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#add_kuantitas').maskMoney('unmasked')[0]);
            var finishing=$('#add_finishing').val();
            var keterangan=$('#add_keterangan').val();
            var subtotal=($('#add_subtotal').maskMoney('unmasked')[0]);
            var diskonnow=($('#add_diskon').maskMoney('unmasked')[0]);

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
            $('#sisa').val(total).trigger('mask.maskMoney');
            $("tbody").append(
            '<tr id="'+tdid+'"><td>'+namaproduk+'<input type="hidden" readonly disabled id="produk[]" value="'+produk+'" name="produk[]"><input type="hidden" readonly disabled id="produkid[]" value="'+produkid+'" name="produkid[]"><input type="hidden" readonly disabled id="subtransid[]" value="'+subpenjualan+'" name="subtransid[]"><input type="hidden" readonly disabled id="satuan[]" value="'+satuan+'" name="satuan[]"></td><td>'+harga.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="harga[]" value="'+harga+'" name="harga[]"></td><td>'+panjang.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="panjang[]" value="'+panjang+'" name="panjang[]"></td><td>'+lebar.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="lebar[]" value="'+lebar+'" name="lebar[]"></td><td>'+kuantitas.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="kuantitas[]" value="'+kuantitas+'" name="kuantitas[]"></td><td>'+finishing+'<input type="hidden" readonly disable id="finishing[]" value="'+finishing+'" name="finishing[]"></td><td>'+keterangan+'<input type="hidden" readonly disable id="keterangan[]" value="'+keterangan+'" name="keterangan[]"></td><td>'+diskonnow.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="diskonnow[]" value="'+diskonnow+'" name="diskonnow[]"></td><td>'+subtotal.format(2, 3, '.', ',')+'<input type="hidden" readonly disable id="subtotal[]" value="'+subtotal+'" name="subtotal[]"></td><td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-satuan="'+satuan+'" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-namaproduk="'+namaproduk+'" data-subtotal="'+subtotal+'" data-tdid="'+tdidnow+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_edit"><i class="fa fa-edit"></i></button><button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-tdid="'+tdidnow+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-subtotal="'+subtotal+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td></tr>'
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
            var diskon=($('#add_diskon').maskMoney('unmasked')[0]);

            if (hitung_luas==1){
                if (satuan =="cm") {
                    

                    // subtotal################

                    var subtotal = ((panjang * lebar) * harga) * kuantitas;
                    if (diskon!=0){
                        var diskonsubtotal = (subtotal * diskon) / 100;

                        subtotal = subtotal - diskonsubtotal;
                    }

                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
                else if (satuan=="m")
                {

                    // subtotal################

                    var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                    if (diskon!=0){
                        var diskonsubtotal = (subtotal * diskon) / 100;

                        subtotal = subtotal - diskonsubtotal;
                    }
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
                else
                {

                    satuan="cm";
                    console.log(satuan);
                    var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                    if (diskon!=0){
                        var diskonsubtotal = (subtotal * diskon) / 100;

                        subtotal = subtotal - diskonsubtotal;
                    }

                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                
                }
            }
            else
            {


                    var subtotal = (harga) * kuantitas;
                    if (diskon!=0){
                        var diskonsubtotal = (subtotal * diskon) / 100;

                        subtotal = subtotal - diskonsubtotal;
                    }
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
            }

        });

        $('#add_diskon').blur(function(){
            // alert(satuan);
            var harga=($('#add_harga').maskMoney('unmasked')[0]);
            var panjang=($('#add_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#add_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#add_kuantitas').maskMoney('unmasked')[0]);
            var diskon=($('#add_diskon').maskMoney('unmasked')[0]);

            if (hitung_luas==1){
                if (satuan =="cm") {
                    
                    // subtotal################

                    var subtotal = ((panjang * lebar) * harga ) * kuantitas;
                    var diskonsubtotal = (subtotal * diskon) / 100;

                    subtotal = subtotal - diskonsubtotal;
                    // console.log(subtotal);

                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
                else
                {
                  
                    // subtotal################

                    var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                    var diskonsubtotal = (subtotal * diskon) / 100;
                    subtotal = subtotal - diskonsubtotal;
                    // console.log(subtotal);

                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
            }
            else
            {

                    // subtotal################

                    var subtotal = (harga) * kuantitas;
                    var diskonsubtotal = (subtotal * diskon) / 100;
                    subtotal = subtotal - diskonsubtotal;
                    $('#add_subtotal').val(subtotal).trigger('mask.maskMoney');
            }
        });
      //bagianmodal add

      //bagian modal edit

        $(document).on('click','.modal_edit',function () {
            $('#edit_produk').val($(this).data('namaproduk'));
            $('#edit_produkid').val($(this).data('produk'));

            if ($(this).data('satuan')=="cm"){
                $('#r2editcm').iCheck('check');
                satuan="cm";
            }
            else if ($(this).data('satuan')=="m")
            {
                $('#r2editm').iCheck('check');
                satuan="m";
            }
            var data = {
                id: $(this).data('produk'),
                text: $(this).data('namaproduk')
            };
            subpenjualan=$(this).data('subpenjualan');
            subtotalawal=$(this).data('subtotal');

            var newOption = new Option(data.text, data.id, false, false);
            $('#edit_produk').append(newOption).trigger('change');

            tdidnow=$(this).data('tdid');
            console.log(subtotalawal);
            // console.log($(this).data('hitungluas'));
            hitung_luas=$(this).data('hitungluas');
            if ($(this).data('hitungluas')==1){
                $('#r2editm').iCheck('uncheck');
                $('#r2editcm').iCheck('uncheck');
                $('#r2editm').iCheck('enabled');
                $('#r2editcm').iCheck('enabled');
                $('#edit_panjang').removeAttr('disabled');
                $('#edit_lebar').removeAttr('disabled');
            }
            else if ($(this).data('hitungluas')==0)
            {
                $('#r2editm').iCheck('uncheck');
                $('#r2editcm').iCheck('uncheck');
                $('#r2editm').iCheck('disable');
                $('#r2editcm').iCheck('disable');
                $('#edit_panjang').attr('disabled',true);
                $('#edit_lebar').attr('disabled',true);
            }

            $('#edit_harga').val(($(this).data('harga'))).maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#edit_subtotal').val(($(this).data('subtotal'))).maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#edit_kuantitas').val(($(this).data('kuantitas'))).maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#edit_diskon').val(($(this).data('diskon'))).maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#edit_panjang').val(($(this).data('panjang'))).maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#edit_keterangan').val($(this).data('keterangan'));
            $('#edit_lebar').val(($(this).data('lebar'))).maskMoney({thousands:'.', decimal:',',allowZero:true});
            $('#edit_subtotal').val(($(this).data('subtotal'))).maskMoney({thousands:'.', decimal:',',allowZero:true});

        });

        $('#edit_produk').on('select2:select', function (e) {
            var id=e.params.data.id;
            $('#edit_produkid').val(id);
            if ((pelanggan=="") || (pelanggan==null))
            {
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
                        if (hitung_luas==1)
                        {
                            $('#r2editm').iCheck('uncheck');
                            $('#r2editcm').iCheck('uncheck');
                            $('#r2editm').iCheck('enabled');
                            $('#r2editcm').iCheck('enabled');
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
                        $('#edit_harga').val(response.harga_jual).trigger('mask.maskMoney');
                    },
                });
            }
            else
            {
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
                        hitung_luas=response.hitung_luas;
                        if (hitung_luas==1)
                        {
                            $('#r2editm').iCheck('uncheck');
                            $('#r2editcm').iCheck('uncheck');
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

                        $('#edit_harga').val(response.harga_khusus).trigger('mask.maskMoney');
                    },
                });
            }

        });

        $('#edititem').click(function(){

            var produk=$('#edit_produk').val();

            var produkid=$('#edit_produkid').val();
            var harga=($('#edit_harga').maskMoney('unmasked')[0]);
            var panjang=($('#edit_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#edit_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#edit_kuantitas').maskMoney('unmasked')[0]);
            var finishing=$('#edit_finishing').val();
            var keterangan=$('#edit_keterangan').val();
            var subtotal=($('#edit_subtotal').maskMoney('unmasked')[0]);
            var diskonnow=($('#edit_diskon').maskMoney('unmasked')[0]);


            $('input[type=radio][name=r2edit]').on('ifChecked',function () {
                // alert("asd");
                if (this.value == 'cm') {
                    satuan=this.value;
                }
                else if (this.value == 'm') {
                    satuan=this.value;
                }
            });

            

            console.log(harga);

            total=($('#total').maskMoney('unmasked')[0]);
            total=(subtotal)+(total-subtotalawal);

            $('#total2').val(total).trigger('mask.maskMoney');

            $('#total').val(total).trigger('mask.maskMoney');
            $('#sisa').val(total).trigger('mask.maskMoney');

            var isi='<td>'+namaproduk+'<input type="hidden" readonly disabled id="produk[]" value="'+produk+'" name="produk[]"><input type="hidden" readonly disabled id="produkid[]" value="'+produkid+'" name="produkid[]"><input type="hidden" readonly disabled id="subtransid[]" value="'+subpenjualan+'" name="subtransid[]"><input type="hidden" readonly disabled id="satuan[]" value="'+satuan+'" name="satuan[]"></td><td>'+harga+'<input type="hidden" readonly disable id="harga[]" value="'+harga+'" name="harga[]"></td><td>'+panjang+'<input type="hidden" readonly disable id="panjang[]" value="'+panjang+'" name="panjang[]"></td><td>'+lebar+'<input type="hidden" readonly disable id="lebar[]" value="'+lebar+'" name="lebar[]"></td><td>'+kuantitas+'<input type="hidden" readonly disable id="kuantitas[]" value="'+kuantitas+'" name="kuantitas[]"></td><td>'+finishing+'<input type="hidden" readonly disable id="finishing[]" value="'+finishing+'" name="finishing[]"></td><td>'+keterangan+'<input type="hidden" readonly disable id="keterangan[]" value="'+keterangan+'" name="keterangan[]"></td><td>'+diskonnow+'<input type="hidden" readonly disable id="diskonnow[]" value="'+diskonnow+'" name="diskonnow[]"></td><td>'+subtotal+'<input type="hidden" readonly disable id="subtotal[]" value="'+subtotal+'" name="subtotal[]"></td><td><div class="btn-group"><button type="button" class="modal_edit btn btn-success btn-sm" data-toggle="modal" data-satuan="'+satuan+'" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-namaproduk="'+namaproduk+'" data-subtotal="'+subtotal+'" data-tdid="'+tdidnow+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_edit"><i class="fa fa-edit"></i></button><button type="button" class="modal_delete btn btn-danger btn-sm" data-toggle="modal" data-produk="'+produk+'" data-harga="'+harga+'" data-panjang="'+panjang+'" data-lebar="'+lebar+'" data-tdid="'+tdidnow+'" data-kuantitas="'+kuantitas+'" data-finishing="'+finishing+'" data-keterangan="'+keterangan+'" data-subtotal="'+subtotal+'" data-hitungluas="'+hitung_luas+'" data-target="#modal_delete"><i class="fa fa-trash"></i></button></div></td>';
            $('#'+tdidnow+'').html(isi);
            $('#modal_edit').modal('hide');
        });

        $('#edit_kuantitas').keyup(function(){
            // alert(satuan);
            var harga=($('#edit_harga').maskMoney('unmasked')[0]);
            var panjang=($('#edit_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#edit_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#edit_kuantitas').maskMoney('unmasked')[0]);
            var diskon=($('#edit_diskon').maskMoney('unmasked')[0]);

            if (hitung_luas==1){
                if (satuan =="cm") {
                    


                    // subtotal################

                    var subtotal = ((panjang * lebar) * harga ) * kuantitas;
                    if (diskon!=0){
                        var diskonsubtotal = (subtotal * diskon) / 100;

                        subtotal = subtotal - diskonsubtotal;
                    }
                    $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
                else if (satuan=="m")
                {
                    // var subtotal=0;

                    // subtotal################

                    var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                    if (diskon!=0){
                        var diskonsubtotal = (subtotal * diskon) / 100;

                        subtotal = subtotal - diskonsubtotal;
                    }
                    $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
                else
                {
                    // subtotal################

                    var subtotal = ((panjang * lebar) * harga) * kuantitas;
                    if (diskon!=0){
                        var diskonsubtotal = (subtotal * diskon) / 100;

                        subtotal = subtotal - diskonsubtotal;
                    }
                    $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                
                }
            }
            else
            {
                // subtotal################

                var subtotal = (harga) * kuantitas;
                if (diskon!=0){
                        var diskonsubtotal = (subtotal * diskon) / 100;

                        subtotal = subtotal - diskonsubtotal;
                    }
                $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
            }

        });

        $('#edit_diskon').keyup(function(){
            // alert(satuan);
            var harga=($('#edit_harga').maskMoney('unmasked')[0]);
            var panjang=($('#edit_panjang').maskMoney('unmasked')[0]);
            var lebar=($('#edit_lebar').maskMoney('unmasked')[0]);
            var kuantitas=($('#edit_kuantitas').maskMoney('unmasked')[0]);
            var diskon=($('#edit_diskon').maskMoney('unmasked')[0]);

            if (hitung_luas==1){
                if (satuan =="cm") {
                    

                    // subtotal################

                    var subtotal = ((panjang * lebar) * harga) * kuantitas;
                    var diskonsubtotal = (subtotal * diskon) / 100;

                    subtotal = subtotal - diskonsubtotal;
                    $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
                else
                {
                    

                    var subtotal = ((panjang * lebar) * harga / 10000) * kuantitas;
                    var diskonsubtotal = (subtotal * diskon) / 100;
                    subtotal = subtotal - diskonsubtotal;
                    console.log(subtotal)
                    $('#edit_subtotal').val(subtotal).trigger('mask.maskMoney');
                }
            }
            else
            {
               

                var subtotal = (harga) * kuantitas;
                    // alert(subtotal);
                var diskonsubtotal = (subtotal * diskon) / 100;
                subtotal = subtotal - diskonsubtotal;
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
