@extends('layouts.admin')
@section('header', 'Pengarang')

@section('css')
 <!-- DataTables -->
 <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<div id="controller">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Create new Pengarang</a>
                </div>

                <div class="card-body " >
                    <table id="data" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center" width="30px">No.</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Telepon</th>
                                <th class="text-center">Aksi</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($authors as $key => $author)
                            <tr>
                                <td class="text-center">{{ $key+1}}.</td>
                                <td>{{ $author->name}}</td>
                                <td>{{ $author->email}}</td>
                                <td >{{ $author->address}}</td>
                                <td class="text-center">{{ $author->phone_number}}</td>
                                <td class="text-center">
                                    <a href="#" @click="editData({{ $author }})" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#" @click="deleteData({{ $author->id }})" class="btn btn-danger btn-sm">Delete</a>
                                </td>    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" :action="actionUrl" autocomplete="off">
                    <div class="modal-header">

                        <h4 class="modal-title">Pengarang</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" :value="data.name" required="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" :value="data.email" required="">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="address" :value="data.address" required="">
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" class="form-control" name="phone_number" :value="data.phone_number" required="">
                        </div>
    
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script type="text/javascript">
  $(function () {
    $("#data").DataTable();
  });
</script>
<!-- CRUD VUE JS -->
    <script type="text/javascript">
        var controller = new Vue({
            el : '#controller',
            data : {
                data : {},
                actionUrl : '{{ url('authors')}}',
                editStatus : false
            },
            mounted: function () {
                
            },
            methods: {
                addData() {
                    this.data = {};
                    this.actionUrl = '{{ url('authors')}}';
                    this.editStatus = false;
                    $('#modal-default').modal();
                },
                editData(data) {
                    this.data = data;
                    this.actionUrl = '{{ url('authors')}}'+'/'+data.id;
                    this.editStatus = true;
                    $('#modal-default').modal();
                },
                deleteData(id) {
                    this.actionUrl = '{{ url('authors')}}'+'/'+id;
                    if (confirm("Apakah kamu yakin ingin menghapus data ini?")) {
                        axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                            location.reload();
                        });
                    }
                }
            }
        });
    </script>
@endsection