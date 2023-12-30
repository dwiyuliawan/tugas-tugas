@extends('layouts.admin')
@section('header', 'Katalog')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create new Katalog</h3>
            </div>

            <form action="{{ url('catalogs')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                         <label>Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="Input nama" required="">
                    </div>
                </div>

                <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection