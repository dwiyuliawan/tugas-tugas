@extends('layouts.admin')
@section('header', 'Member')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<div id="controller">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col d-flex justify-content-start">
                        <a href="#" @click="addData()" class="btn btn-primary ">Add New Member</a>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <select name="sex" class="form-select text-center">
                            <option value="0">Semua Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 10px">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Registration Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  -->
    <div class="modal fade" id="modal-default" aria-hidden="true" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form :action="actionUrl" method="POST" enctype="multipart/form-data" @submit="submitForm($event, data.id)">
                    @csrf
                    <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="!editStatus">Add New Member</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="editStatus">Edit Member</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" :value="data.name"
                                placeholder="Enter Name"
                                class="form-control" required>
                            <!-- <div v-if="validation.name" class="mt-2 alert alert-danger">
                                @{{validation.name[0]}}
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" :value="data.email"
                                placeholder="Enter Email"
                                class="form-control" required>
                            <!-- <div v-if="validation.email" class="mt-2 alert alert-danger">
                                @{{ validation.email[0] }}
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label>Sex</label>
                            <select class="form-select" name="gender" :value="data.gender" required>
                                <option value="" disabled>Select Sex</option>
                                <option value="L">Male</option>
                                <option value="P">Female</option>
                            </select>
                            <!-- <div v-if="validation.sex" class="mt-2 alert alert-danger">
                                @{{ validation.sex[0]}}
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="phone_number" :value="data.phone_number" placeholder="081xxxxxxxxx" pattern="[0-9]{10,14}"
                                class="form-control" required>
                            <!-- <div v-if="validation.phone_number" class="mt-2 alert alert-danger">
                                @{{ validation.phone_number[0] }}
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" :value="data.address" placeholder="Enter Address" class="form-control" required>
                            <!-- <div v-if="validation.address" class="mt-2 alert alert-danger">
                                @{{ validation.address[0] }}
                            </div> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Table Data Yajra -->
<script type="text/javascript">
	var actionUrl = '{{url('members')}}';
	var apiUrl = '{{url('api/members')}}';

	var columns = [
			{data : 'DT_RowIndex', class : 'text-center', orderable : true},
			{data : 'name', class : 'text-center', orderable : true},
			{data : 'email', class : 'text-center', orderable : false},
			{data : 'gender2', class : 'text-center', orderable : false},
			{data : 'phone_number', class : 'text-center', orderable : false},
			{data : 'address', class : 'text-center', orderable : false},
			{data : 'date', class : 'text-center', orderable : false},
			{render : function (index, row, data, meta) {
				return`
				<div class=" d-flex justify-content-center">
					<button href="#" class="btn btn-warning btn-sm mr-2" onclick="controller.editData(event, ${meta.row})"><i class="fa fa-pencil-alt"></i></button>
                	<button href="#" class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})"><i class="fa fa-trash"></i></button>
				</div>`;
			}, class : 'text-center', orderable : false},
		];

	// Vue Js
	var controller = new Vue({
		el : '#controller',
		data : {
			datas : [],
			data : {},
			apiUrl,
			actionUrl,
			editStatus : false,
		},
		mounted: function(){
			this.datatables();
		},
		methods: {
			datatables(){
				const _this = this;
				_this.table = $('#dataTable').DataTable({
					ajax : {
						url : _this.apiUrl,
						type : 'GET',
					},
					columns : columns,
				}).on('xhr', function(){
					_this.datas = _this.table.ajax.json().data;
				});
			},
			addData(){
				this.data = {};
				this.editStatus = false;
				this.actionUrl = '{{url('members')}}';
				$('#modal-default').modal();
			},
			editData(event, row){
				this.data = this.datas[row];
				this.editStatus = true;
				this.actionUrl = '{{url('members')}}'+'/'+this.data.id;
				$('#modal-default').modal();
			},
			deleteData(event, id){
				this.actionUrl = '{{url('members')}}'+'/'+id;
				if (confirm("Are You Sure")) {
					axios.post(this.actionUrl, {_method : 'DELETE'}).then(response => {
						location.reload();
					});
				}
			}
		}
	});

	// Pelulangan untuk Gender
	$('select[name=sex]').on('change', function(){
		sex = $('select[name=sex]').val();
		if (sex == 0) {
			controller.table.ajax.url(apiUrl).load();
		}else{
			controller.table.ajax.url(apiUrl + '?sex=' + sex).load();
		}
	});
</script>
@endsection