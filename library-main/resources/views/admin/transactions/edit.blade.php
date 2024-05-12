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
                            <h3 class="card-title">Edit transaction</h3>
                        </div>
                        <form action="{{ url('transactions/'.$transaction->id) }}" method="post">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Member</label>
                                    <select class="form-control" name="member_id">
                                        @foreach ($members as $member)
                                        <option value="{{ $member->id }}" {{ $transaction->member_id === $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="date_start">Date start</label>
                                            <input type="date" id="tanggal" class="form-control" name="date_start" value="{{ $transaction->date_start }}">          
                                        </div>
                                        <div class="col-md-6">
                                            <label for="date_start">Date end</label>
                                            <input type="date" id="tanggal" class="form-control" name="date_end" value="{{ $transaction->date_end }}">
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
                                <div class="form-group" v-if="editStatus">
                                    <label for="status">Status</label>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Finished"  {{ $transaction->status === 'Finished' ? 'checked' : '' }}>
                                    <label class="form-check-label">Finished</label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Borrowed" {{ $transaction->status === 'Borrowed' ? 'checked' : '' }}>
                                    <label class="form-check-label">Borrowed</label>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary float-right" type="submit">Update</button>
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