@extends('layouts.admin')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div id="controller">
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">      
                                <div class="row">
                                    <div class="col-md-8">
                                        <a href="{{ url('transactions/create') }}" type="button" class="btn btn-primary">
                                            Create New transaction
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- Date -->
                                        <input type="date" id="tanggal" class="form-control" name="filter_date_start">        
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" name="filter_status">
                                            <option value="0">Semua status</option>
                                            <option value="Finished">Finished</option>
                                            <option value="Borrowed">Borrowed</option>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Date start</th>
                                            <th class="text-center">Date end</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Lama peminjam</th>
                                            <th class="text-center">Total books</th>
                                            <th class="text-center">Total bayar</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->   
    </div>
    <!-- /.content-wrapper -->
</div><!-- /controller -->

@endsection

@section('js')

<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- Table Column -->
<script>
    var actionUrl = '{{ url('transactions') }}';
    var apiUrl = '{{ url('api/transactions') }}';

    var columns = [
        {data: 'DT_RowIndex', class: 'text-center', orderable: true},
        {data: 'date_start', class: 'text-center', orderable: true},
        {data: 'date_end', class: 'text-center', orderable: true},
        {data: 'name', class: 'text-center', orderable: true},
        {data: 'jarak_hari', class: 'text-center', orderable: true},
        {data: 'total_qty', class: 'text-center', orderable: true},
        {data: 'total_price', class: 'text-center', orderable: true},
        {data: 'status', class: 'text-center', orderable: true},
        {data: 'action', class: 'text-center', orderable: true},
    ];
</script>

<!-- function CRUD axios -->
<script src="{{ asset('js/data.js')}}"></script>

<!-- function input date -->
<script>
    $(document).ready(function() {
        // Mengatur tanggal awal
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        
        today = yyyy + '-' + mm + '-' + dd;
        $("#tanggal").val(0);
    });
</script>

<!-- function filter date_start -->
<script>
    $('input[name=filter_date_start]').on('change', function(){
        filter_date_start = $('input[name=filter_date_start]').val();

        if(filter_date_start == '0'){
            controller.table.ajax.url(apiUrl).load();
        }else{
            controller.table.ajax.url(apiUrl+'?date_start='+filter_date_start).load();
        }
    });
</script>

<!-- function filter status -->
<script>
    $('select[name=filter_status]').on('change', function(){
        filter_status = $('select[name=filter_status]').val();
        
        if(filter_status == '0'){
            controller.table.ajax.url(apiUrl).load();
        }else{
            controller.table.ajax.url(apiUrl+'?status='+filter_status).load();
        }
    });
</script>

@endsection

