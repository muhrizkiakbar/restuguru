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
                <h3 class="box-title">Cari Transaksi</h3>
                
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>

              </div>
              <!-- /.box-header -->
              <!-- form start -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body">
                    <form action="{{route('angsuranpengeluaran')}}" method="post">
                      <div class="form-group">
                        <input type="text" class="form-control" id="nonota" name="nonota" value="{{$nonota}}" placeholder="Nomor Nota">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="namapelanggan" name="namapelanggan" value="{{$namapelanggan}}" placeholder="Nama Pelanggan">
                      </div>
                      @csrf
                      <div class="form-group">
                        <select id="pelanggan" name="pelanggan" class="form-control select2" style="width:100%;" type="text"></select>
                      </div>
                      <div class="form-group">
                            <select class="form-control " id="pembayaran2" name="pembayaran2" style="width: 100%;">
                                
                                @if ($pembayaran=="semua")
                                    <option value="semua" selected>Semua Metode Pembayaran</option>
                                @else
                                    <option value="semua">Semua Metode Pembayaran</option>
                                @endif
                                @if ($pembayaran=="Cash")
                                    <option value="Cash" selected>Cash</option>
                                @else
                                    <option value="Cash">Cash</option>
                                @endif
                                @if ($pembayaran=="Transfer")
                                    <option value="Transfer" selected>Transfer</option>
                                @else
                                    <option value="Transfer">Transfer</option>
                                @endif
                                
                            </select>
                        </label> 
                      </div>

                      <div class="form-group">
                            <select class="form-control " id="jenispengeluaran" name="jenispengeluaran" style="width: 100%;">
                                <option value="semua">Semua Jenis</option>
                                @foreach ($datajenispengeluarans as $key => $datajenispengeluaran)
                                    @if ($datajenispengeluaran->id == $jenispengeluaran)
                                        <option value="{{encrypt($datajenispengeluaran->id)}}" selected >{{$datajenispengeluaran->jenis_pengeluaran}}</option>
                                    @else
                                        <option value="{{encrypt($datajenispengeluaran->id)}}" >{{$datajenispengeluaran->jenis_pengeluaran}}</option>
                                    @endif                                    
                                @endforeach 
                                
                            </select>
                        </label> 
                      </div>

                      <div class="form-group">
                        <input type="text" class="form-control" id="tanggal" readonly name="tanggal" value="{{date('d-m-Y',strtotime($tanggal))}}" placeholder="Tanggal">
                      </div>
                      <div class="form-group">
                            <select class="form-control  pull-right" id="periode" name="periode" style="width: 100%;">
                                @if ($periode=="semua")
                                    <option value="semua" selected>Semua</option>
                                @else
                                    <option value="semua" >Semua</option>
                                @endif

                                @if ($periode=="hari")
                                    <option value="hari" selected>Hari</option>
                                @else
                                    <option value="hari" >Hari</option>
                                @endif

                                @if ($periode=="bulan")
                                    <option value="bulan" selected>Bulan</option>
                                @else
                                    <option value="bulan" >Bulan</option>
                                @endif

                                @if ($periode=="tahun")
                                    <option value="tahun" selected>Tahun</option>
                                @else
                                    <option value="tahun" >Tahun</option>
                                @endif

                            </select>
                      </div>
                      </form>  
                                 

                      
                    </div>
                  </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" id="submitpelanggan" class="btn btn-success btn-sm">Submit <i class="fa fa-chevron-circle-right"></i></button>
                </div>
            </div>
          </div>
          </form>

          <div class="col-md-9">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Angsuran Transaksi Pengeluaran <i class="fa  fa-shopping-cart"></i></h3>
              </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>No. Nota</th>
                                <th>Nama Penerima</th>
                                <th>Telp.</th>
                                <th>Tanggal</th>
                                <th>DP</th>
                                <th>Pembayaran</th>
                                <th>Sisa</th>
                                <th>Total</th>
                                <th>Jenis Pengeluaran</th>
                                <th>Tool</th>
                                <th>Cabang</th>
                                <th>Pembuat</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($datas as $key=>$data)
                            <tr id="{{$data->id}}">
                                <td><a href="/transaksi/pengeluaran/report/{{encrypt($data->id)}}" target="_blank">#{{$data->id}}</a></td>
                                <td>{{$data->namapenerima}}</td>
                                <td>{{$data->hppenerima}}</td>
                                <td>{{date("d-m-Y",strtotime($data->tanggal_pengeluaran))}} {{date("H:i:s",strtotime($data->created_at))}}</td>
                                <td id="pembayaran{{$data->id}}">Rp. {{number_format(floatval($data->pembayaran_pengeluaran),0,',','.')}}</td>
                                <td>{{$data->metode_pembayaran}}</td>
                                @if ($data->sisa_pengeluaran!=0)
                                    <td id="sisa{{$data->id}}"><span class="badge bg-red">
                                    Rp. {{number_format(floatval($data->sisa_pengeluaran),0,',','.')}}
                                    </span></td>
                                @else
                                    <td id="sisa{{$data->id}}">Rp. {{number_format(floatval($data->sisa_pengeluaran),0,',','.')}}</td>                 
                                @endif
                                <td>{{$data->jenis_pengeluaran}}</td>                                
                                <td>Rp. {{number_format(floatval($data->total_pengeluaran),0,',','.')}}</td>
                                <td style="width: 150px;min-width:140px;">
                                    <div class="btn-group">
                                        <button type="button" id="showtombol{{$data->id}}" class="modal_show btn btn-primary btn-xs" data-toggle="modal" data-id="{{encrypt($data->id)}}" data-idsisa="sisa{{$data->id}}" data-nonota="{{$data->id}}" data-sisa="{{ $data->sisa_pengeluaran}}" data-pembayaran="{{$data->pembayaran_pengeluaran}}"  data-target="#modal_show"><i class="fa fa-eye"></i></button>
                                        <button type="button" class="buttonprint btn btn-danger btn-xs" data-id="{{encrypt($data->id)}}"><i class="fa fa-print"></i></button>                                        
                                        <button type="button" id="simpantombol{{$data->id}}" class="modal_add btn btn-success btn-xs" data-toggle="modal"  data-id="{{encrypt($data->id)}}" data-nonota="{{$data->id}}" data-sisa="{{$data->sisa_pengeluaran}}" data-total="{{$data->total_pengeluaran}}" data-pembayaran="{{$data->pembayaran_pengeluaran}}"  data-target="#modal_add"><i class="fa fa-plus"></i> Angsuran</button>
                                    </div>
                                </td>
                                <td>{{$data->Nama_Cabang}}</td> 
                                <td>{{$data->username}}</td>                                                               
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{$datas->appends(['nonota'=>($nonota),'jenispengeluaran'=>$jenispengeluaran,'namapelanggan'=>($namapelanggan),'pelanggan'=>($pelanggan),'pembayaran'=>$pembayaran,'tanggal'=>$tanggal,'periode'=>$periode])->links()}}
                    </ul>
                </div>
            </div>
          </div>

            <div class="modal fade " id="modal_show">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Data Angsuran</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Nota Angsuran</th>
                                        <th>Tanggal</th>
                                        <th>Nominal Angsuran</th>
                                        <th>Pembayaran</th>
                                        <th>Nota Pengeluaran</th>
                                        <th>Cabang</th>
                                        <th>Pembuat</th>
                                        <th>Tool</th>                                        
                                    </thead>
                                    <tbody  id="showdata">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                            <div class="pull-right">
                                Sisa : Rp. <label id="sisatagihanlabel"></label>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade " id="modal_add">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Angsuran</h4>
                        </div>
                        <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                      No. Nota Penjualan : #<label><span id="nonotapenjualan"></span></label>
                                      </div>
                                      <div class="form-group">
                                      Sisa Tagihan : Rp. <label><span id="sisaangsuranlabel"></span></label>
                                      </div>
                                      <div class="form-group">
                                          <label>Nominal</label>
                                          <input id="add_nominal" name="add_nominal" class="form-control mata-uang" type="text">
                                          {{csrf_field()}}
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Pembayaran</label>
                                            <select class="form-control"  id="pembayaran" name="pembayaran" style="width: 100%;">
                                                <option value="Cash">Cash</option>
                                                <option value="Transfer">Transfer</option>
                                            </select>
                                      </div>
                                      <!-- /.form-group -->
                                  </div>
                              </div>
                        </div>
                        <div class="modal-footer">
                            <div class="pull-right">
                                Total Tagihan : Rp. <label id="totaltagihanlabel"></label>
                                <button type="button" id="simpanangsuran" class="btn btn-success">Simpan</button>
                                
                            </div>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                            
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
                                <h4 class="modal-title">Hapus Angsuran</h4>
                            </div>
                            <div class="modal-body">
                                <form id="formdeleteangsuran" action="" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus angsuran #<span class="labelnoangsuran"></span> ?
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Keluar</button>
                                <button type="button" id="deleteangsuran" class="btn btn-outline">Simpan</button>
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

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>


    <!-- <script src="{{asset('bower_components/jquery-maskmoney/jquery.maskMoney.js')}}"></script> -->
    <!-- <script src="{{asset('bower_components/jquery-number/jquery.number.js')}}"></script> -->

    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script>
        var idtrans='';
        var idbaris='';
        var idsisa='';
        var idtombol='';

        var dataid=0;
        var datasisa=0;
        var datanonota=0;
        var datatotal=0;
        var datanominal=0;

        function gotoreport(protocol,url,id){
            var url2 = protocol+'//'+url + '/transaksi/pengeluaran/angsuran/report/' + id;
            window.open(url2, '_blank');
        }

        function gotoreport2(protocol,url,id){
            var url2 = protocol+'//'+url + '/transaksi/pengeluaran/angsuran/report/detail/' + id;
            window.open(url2, '_blank');
        }

        /**
        * Number.prototype.format(n, x, s, c)
        * 
        * @param integer n: length of decimal
        * @param integer x: length of whole part
        * @param mixed   s: sections delimiter
        * @param mixed   c: decimal delimiter
        */
        Number.prototype.format = function(n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));
            
            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };

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

            // $('#add_nominal').maskMoney({thousands:'.', decimal:',',allowZero:true}); 
            
            numeral.locale('idr');


            $('input[name="tanggal"]').datepicker({
                format: "dd-mm-yyyy",
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
            
        });
      

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
        
        $("input.mata-uang").keyup(function(){
                $(this).val(numeral($(this).val()).format('$ 0,0'));
        });

        $(document).on('click','.modal_show',function () {
            $("#showdata").empty();
            $("#sisatagihanlabel").text($(this).data('sisa').format(2, 3, '.', ','));
            idbaris=$(this).data('id');
            datanonota=$(this).data('nonota');
            datasisa=$(this).data('sisa');
            datapembayaran=$(this).data('pembayaran');

            $.ajax({
                async: true, 
                type:'get',
                url:'{{route('showangsuranpengeluaran')}}',
                data: 'id='+idbaris,
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    console.log( response );
                    $.each( response, function( key, value ) {
                        
                        $("#showdata").append(
                            '<tr id="show'+response[key]['id']+'"><td>#'+response[key]['id']+'</td><td>'+response[key]['tanggal_angsuran']+'</td><td>Rp. '+response[key]['nominal_angsuran'].format(2, 3, '.', ',')+'</td><td>'+response[key]['metode_pembayaran']+'</td><td><a href="/transaksi/report/'+idtrans+'" target="_blank">#'+response[key]['transaksipengeluaran_id']+'</a></td><td>'+response[key]['Nama_Cabang']+'</td><td>'+response[key]['username']+'</td><td><div class="btn-group"><button type="button" class="deletebutton btn btn-danger btn-xs" data-toggle="modal"  data-id="'+response[key]['id']+'" data-target="#modal_delete" data-nominal="'+response[key]['nominal_angsuran']+'"><i class="fa fa-trash"></i></button><button type="button" class="printbutton2 btn btn-success btn-xs" data-toggle="modal"  data-id="'+response[key]['id3']+'"  data-nominal="'+response[key]['nominal_angsuran']+'"><i class="fa fa-print"></i></button></div></td></tr>'
                        );
                    });
                    // $('.labelnota').text(response.nonota);
                    // $('.labelpelanggan').text(response.nama_pelanggan);
                    // idbaris=response.nonota;
                },
            });          
            // alert($(this).data('namaproduk'));
        });

        $(document).on('click','.modal_add',function () {
            $('simpanangsuran').removeAttr('disabled');
            $("#nonotapenjualan").text($(this).data('nonota'));
            $("#totaltagihanlabel").text($(this).data('total').format(2, 3, '.', ','));
            $("#sisaangsuranlabel").text($(this).data('sisa').format(2, 3, '.', ','));            
            idtrans=$(this).data('id');
            idbaris=$(this).data('nonota');
            datatotal=parseFloat($(this).data('total'));
            datasisa=parseFloat($(this).data('sisa'));
            datanonota=$(this).data('nonota');
            datapembayaran=parseFloat($(this).data('pembayaran'));

            // console.log('idtrans = '+idtrans);
            // console.log('idbaris = '+idbaris);
            // console.log('datatotal = '+datatotal);
            // console.log('datasisa = '+datasisa);
            // console.log('datanonota = '+datanonota);
            $('#add_nominal').val('0');
        });

        
        $(document).on('click','#simpanangsuran',function (){
            $('simpanangsuran').attr('disabled',true);
            var token=$('input[name="_token"]').val();
            var nominal=(numeral($('#add_nominal').val()).value());
            var metode=$('#pembayaran').val();
            
            if (nominal==0){
                swal("Error !", "Nominal tidak boleh kosong !", "error");
            }
            else if (nominal > datasisa)
            {
                swal("Error !", "Nominal lebih dari sisa tagihan !", "error");                
            }
            else
            {
                // console.log(datasisa);
                // console.log(nominal);
                // console.log(metode);
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'{{route('storeangsuranpengeluaran')}}',
                    data: JSON.stringify({
                        idtrans:idtrans,
                        nominal:nominal,
                        metode:metode
                    }),
                    dataType:'json',
                    async:false,
                    processData: false,
                    contentType: false,
                    success:function(response){
                            // console.log(response['msg']);
                            if (response['msg']=="success"){
                                swal("Berhasil !", "Berhasil mennyimpan angsuran !", "success");
                                datasisa=datasisa-nominal;
                                datapembayaran=datapembayaran+nominal;
                                $('#simpantombol'+datanonota).data('pembayaran',datapembayaran);
                                $('#simpantombol'+datanonota).data('sisa',datasisa);
                                $('#showtombol'+datanonota).data('sisa',datasisa);
                                $('#showtombol'+datanonota).data('pembayaran',datapembayaran);
                                console.log(datasisa);
                                if (datasisa>0){
                                    $('#pembayaran'+datanonota).html('Rp. '+datapembayaran.format(0, 3, '.', ','));
                                    $('#sisa'+datanonota).html('<span class="badge bg-red">Rp. '+datasisa.format(2, 3, '.', ',')+'</span>');
                                }
                                else
                                {
                                    $('#sisa'+datanonota).empty();
                                    $('#'+datanonota).remove();
                                    $('#sisa'+datanonota).text('Rp. '+datasisa.format(2, 3, '.', ','));                                    
                                }
                                console.log(datasisa)
                                // datasisa=0;
                                $('#modal_add').modal('hide');
                            }
                            else{
                                swal("Error !", "Gagal menyimpan angsuran !", "error");
                                $('#modal_add').modal('hide');
                            }
                    },
                    error:function(response){
                                swal("Error !", "Gagal menyimpan angsuran !", "error");
                                $('#modal_add').modal('hide');
                    }
                });
            }
            
        });
        $(document).on('click','.deletebutton',function () {
            $('#deleteangsuran').removeAttr('disabled');
            idtrans=$(this).data('id');
            $(".labelnoangsuran").text($(this).data('id'));
            datanominal=$(this).data('nominal');
        });
        
        $(document).on('click','#deleteangsuran',function (){
            $('#deleteangsuran').attr('disabled',true);
            var token=$('input[name="_token"]').val();
            var sisatagihan=datasisa+datanominal;
            datapembayaran=datapembayaran-datanominal;
            var sisapembayaran=datapembayaran;            
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'{{route('destroyangsuranpengeluaran')}}',
                data: JSON.stringify({idtrans:idtrans,_token:token}),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                        // console.log(response['msg']);
                        if (response['msg']=="success"){
                            swal("Berhasil !", "Berhasil menghapus angsuran !", "success");
                            $('#show'+idtrans+'').remove();
                            $('#sisatagihanlabel').text(sisatagihan.format(2, 3, '.', ','));
                            datasisa=sisatagihan;
                            $('#sisa'+datanonota).html('<span class="badge bg-red">Rp. '+sisatagihan.format(2, 3, '.', ',')+'</span>');
                            $('#pembayaran'+datanonota).html('Rp. '+sisapembayaran.format(0, 3, '.', ','));
                            $('#showtombol'+datanonota).data('sisa',datasisa);
                            $('#simpantombol'+datanonota).data('sisa',datasisa);
                            $('#showtombol'+datanonota).data('pembayaran',sisapembayaran);
                            $('#simpantombol'+datanonota).data('pembayaran',sisapembayaran);
                            $('#modal_delete').modal('hide');
                        }
                        else{

                            swal("Error !", "Gagal menghapus angsuran !", "error");
                            $('#modal_delete').modal('hide');
                            
                        }
                },
                error:function(response){
                            swal("Error !", "Gagal menghapus angsuran !", "error");
                            $('#modal_delete').modal('hide');
                }
            });
            

        });

        $(document).on('click','.buttonprint',function () {
            id=$(this).data('id');
            gotoreport(location.protocol,document.domain,id);
        });

        $(document).on('click','.printbutton2',function () {
            id=$(this).data('id');
            gotoreport2(location.protocol,document.domain,id);
        });
      // bagian modal delete
      
    </script>
    

    </body>
@endsection
