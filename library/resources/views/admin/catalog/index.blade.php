@extends('layouts.admin')
@section('header', 'Katalog')

@section('css')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                    <a href="{{ url('catalogs/create')}}" class="btn btn-sm btn-primary pull-right">Create new katalog</a>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table id="datatable" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th class="text-center">Total Buku</th>
                            <th class="text-center">Create</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">
                                <th>
                                    <th>
                                         Aksi
                                    </th>
                                </th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($catalogs as $key => $catalog)
                        <tr>
                            <td>{{ $key+1}}.</td>
                            <td>{{ $catalog->name}}</td>
                            <td class="text-center">{{ count($catalog->books)}}</td>
                            <td class="text-center">{{date('H:i:s - d/m/Y', strtotime($catalog->created_at)) }}</td>
                            <td class="text-center"><span class="tag tag-success">{{date('H:i:s - d/m/Y', strtotime($catalog->updated_at)) }}</span></td>
                            <td>
                                <td class="text-right">
                                    <a href="{{ url('catalogs/'. $catalog->id. '/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ url('catalogs', ['id' => $catalog->id])}}" method="post">
                                        <input class="btn btn-danger btn-sm" type="submit" value="Delete" onclick="return confirm('apakah kamu yakin ingin menghapus data ini?')">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection

@section('js')

  @endsection