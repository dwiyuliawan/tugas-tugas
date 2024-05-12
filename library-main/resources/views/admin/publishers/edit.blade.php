@extends('layouts.admin')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Crete Catalog</h1>
                </div><!-- /.col -->
                <div class="col-sm-6"></div>
            </div><!-- /.row -->

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Publisher</h3>
                        </div>
                        <form action="{{ url('publishers/'.$publisher->id) }}" method="put">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Masukan Nama" required value="{{ $publisher->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" type="text" class="form-control" id="email" placeholder="Masukan Email" required value="{{ $publisher->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone number</label>
                                    <input name="phone_number" type="text" class="form-control" id="phone_number" placeholder="Masukan Phone number" required value="{{ $publisher->phone_number }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Phone number</label>
                                    <input name="address" type="text" class="form-control" id="address" placeholder="Masukan Phone number" required value="{{ $publisher->address }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

</div>
<!-- /.content-wrapper -->
@endsection