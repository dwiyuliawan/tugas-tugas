@extends('layouts.admin')
@section('header', 'Publisher')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div id="controller">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Create New Publisher</a>
				</div>

				<div class="card-body">
					<table id="example1" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th style="width: 30px;">No</th>
								<th class="text-center">Name</th>
								<th class="text-center">Email</th>
								<th class="text-center">Phone Number</th>
								<th class="text-center">Address</th>
								<th class="text-center">Tanggal</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($publishers as $key => $publisher)
							<tr>
								<td class="text-center">{{$key+1}}</td>
								<td>{{$publisher->name}}</td>
								<td class="text-center">{{$publisher->email}}</td>
								<td class="text-center">{{$publisher->phone_number}}</td>
								<td>{{$publisher->address}}</td>
								<td class="text-center">{{convert_date($publisher->created_at)}}</td>
								<td class="text-right">
									<a href="#" @click="editData({{$publisher}})" class="btn btn-warning btn-sm">Edit</a>
									<a href="#" @click="deleteData({{$publisher->id}})" class="btn btn-danger btn-sm">Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- modal untuk crud -->
	<div class="modal fade" id="modal-default">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" :action="actionUrl" autocomplete="off">
					<div class="modal-header">
						<h4 class="modal-title">Publisher</h4>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						@csrf
						<input type="hidden" name="_method" value="PUT" v-if="editStatus">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" :value="data.name" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" class="form-control" :value="data.email" required>
						</div>
						<div class="form-group">
							<label>Phone Number</label>
							<input type="number" name="phone_number" class="form-control" :value="data.phone_number" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" name="address" class="form-control" :value="data.address" required>
						</div>
					</div>

					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save Change</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script type="text/javascript">
	$(function (){
		$('#example1').DataTable();
	});

	var controller = new Vue({
		el : '#controller',
		data : {
			data : {},
			editStatus : false,
			actionUrl : '{{url('publishers')}}',
		},
		mounted : function(){

		},
		methods : {
			addData(){
				this.data = {};
				this.actionUrl = '{{url('publishers')}}';
				this.editStatus = false;
				$('#modal-default').modal();
			},
			editData(data){
				this.data = data;
				this.editStatus = true;
				this.actionUrl = '{{url('publishers')}}'+'/'+data.id;
				$('#modal-default').modal();
			},
			deleteData(id){
				this.actionUrl = '{{url('publishers')}}'+'/'+id;
				if (confirm("Are You Sure")) {
					axios.post(this.actionUrl, {_method : 'DELETE'}).then(response => {
						location.reload();
					});
				}
			}
		}
	});
</script>
@endsection