@extends('layouts.admin')

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
 <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/min/dropzone.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css')}}">
@endsection

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
                            <h3 class="card-title">Create New Transaction</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('transactions') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Member</label>
                                    <select class="form-control" name="member_id">
                                        @foreach ($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="date_start">Date start</label>
                                            <input type="date" id="tanggal" class="form-control" name="date_start">          
                                        </div>
                                        <div class="col-md-6">
                                            <label for="date_start">Date end</label>
                                            <input type="date" id="tanggal" class="form-control" name="date_end">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Book</label>
                                    <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="book_id[]">
                                        @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-primary float-right" type="submit">Save</button>
                            </form>
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

@section('js')
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Initialize Select2 -->
<script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>

@endsection