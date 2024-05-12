@extends('layouts.admin')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-md-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detail transaction</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-2">Member :</dt>
                                <dd class="col-sm-10">{{ $trx_member->member['name'] }}</dd>
                                <dt class="col-sm-2">Date :</dt>
                                <dd class="col-sm-10">{{ $trx_member->date_start }} <span style="font-weight: bold;">sd</span> {{ $trx_member->date_end }}</dd>
                                <dt class="col-sm-2">Book :</dt>
                                <dd class="col-sm-10">
                                    <div class="card">
                                        <div class="card-body table-responsive p-0" style="max-height:200px;">
                                            <table class="table table-head-fixed text-nowrap">
                                                <tbody>
                                                    @foreach ($trx_books as $trx_book)
                                                        <tr>
                                                            <td>{{ $trx_book->title }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </dd>
                                <dt class="col-sm-2">Status :</dt>
                                <dd class="col-sm-10">{{ $trx_member->status }}</dd>
                            </dl>
                            <a href="{{ url('transactions') }}" class="btn btn-primary float-right">Close</a>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

</div>
<!-- /.content-wrapper -->
@endsection