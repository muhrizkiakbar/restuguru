@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
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
                                <h3 class="box-title">Manajemen Hak Akses</h3>
                            </div>
                            <div class="box-body">
                                <a href="{{route('addrole')}}" class="btn btn-primary" >
                                    Tambah
                                </a>
                                <hr>
                                <div class="table-responsive">
                                    <table id="tableaja" class="table">
                                        <thead>
                                        <tr>
                                            <th>Name Role</th>
                                            <th>Display Role</th>
                                            <th>Description</th>
                                            <th width="50px">Edit</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal -->

                @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Sukses</h4>
                    {{session('success')}}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Gagal</h4>
                    {{session('error')}}
                </div>
                @endif

                <div class="modal modal-danger fade" id="modal_delete">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Hak Akses</h4>
                            </div>
                            <div class="modal-body">
                                <form id="formdelete" action="#" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus hak akses <span class="label"></span>?
                                    <input id="delid" name="delid" type="hidden">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                <button type="button" id="simpandel" class="btn btn-outline">Save changes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
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

    <!-- sweet alert -->
    <script src="{{asset('bower_components/sweetalert/sweetalert.min.js')}}"></script>

    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{--<script src="{{asset('dist/js/demo.js')}}"></script>--}}
    <!-- Page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tableaja').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('datarole')}}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'display_name', name: 'nama' },
                    { data: 'description', name: 'description' },
                    {data:'edit'}
                ]
            });
        });
    </script>


    <script type="text/javascript">
        $(document).on('click','.modal_delete',function () {
            $('#simpandel').removeAttr('disabled');
            $('#delid').val($(this).data('id'));
            $('.label').text($(this).data('name'));
        });
    </script>

    <script type="text/javascript">
        $(document).on('click','#simpandel',function (){
            $('#simpandel').attr('disabled',true);

            $.ajax({
                type:'post',
                url:'{{route('destroyrole')}}',
                data: new FormData($('#formdelete')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                        if (response=="Success"){
                            swal("Success !", "Berhasil menghapus !", "success");
                            $('#modal_delete').modal('hide');
                            oTable.ajax.reload();
                        }
                        else{
                            swal("Eror !", "Gagal menghapus !", "error");
                            $('#modal_delete').modal('hide');
                        }
                },
            });
        });
    </script>
    </body>
@endsection
