@extends('layouts.admin')
@section('header', 'Penerbit')

@section('css')

@endsection

@section('content')
<div id="controller">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Create new Penerbit</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr bgcolor="yellow">
                                <th style="width: 10px">No.</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Telepon</th>
                                <th colspan=2 class="text-center">Aksi</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($publishers as $key => $publisher)
                            <tr>
                                <td class="text-center">{{ $key+1}}</td>
                                <td>{{ $publisher->name}}</td>
                                <td>{{ $publisher->email}}</td>
                                <td >{{ $publisher->address}}</td>
                                <td class="text-center">{{ $publisher->phone_number}}</td>
                                <td><a href="#" @click="editData({{ $publisher }})" class="btn btn-warning btn-sm">Edit</a></td>
                                <td><a href="#" @click="deleteData({{ $publisher->id }})" class="btn btn-danger btn-sm">Delete</a></td>     
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
    <script type="text/javascript">
        var controller = new Vue({
            el : '#controller',
            data : {
                data : {},
                actionUrl : '{{ url('publishers')}}',
                editStatus : false
            },
            mounted: function () {
                
            },
            methods: {
                addData() {
                    this.data = {};
                    this.actionUrl = '{{ url('publishers')}}';
                    this.editStatus = false;
                    $('#modal-default').modal();
                },
                editData(data) {
                    this.data = data;
                    this.actionUrl = '{{ url('publishers')}}'+'/'+data.id;
                    this.editStatus = true;
                    $('#modal-default').modal();
                },
                deleteData(id) {
                    this.actionUrl = '{{ url('publishers')}}'+'/'+id;
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