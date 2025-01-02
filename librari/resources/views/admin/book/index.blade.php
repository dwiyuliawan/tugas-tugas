@extends('layouts.admin')
@section('header', 'Book')

@section('content')
	<div id="controller">
		<div class="row">
			<div class="col-md-5 offset-md-3">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-search"></i></span>
					</div>
					<input type="text" class="form-control" autocomplete="off" placeholder="Search from title" v-model="search">
				</div>
			</div>

			<div class="col-md-2">
				<button class="btn btn-primary" @click="addData()">Create New Book</button>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12" v-for="book in filteredList">
				<div class="info-box" v-on:click="editData(book)">
					<div class="info-box-content">
						<span class="info-box-text h3">@{{book.title}} (@{{book.qty}})</span>
						<span class="info-box-number">Rp. @{{formatNumber(book.price)}} <small></small></span>
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
							<h4 class="modal-title">Book</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							@csrf
							<input type="hidden" name="_method" value="PUT" v-if="editStatus">

							<div class="form-group">
								<label>ISBN</label>
								<input type="number" name="isbn" class="form-control" required="" :value="book.isbn">
							</div>
							<div class="form-group">
								<label>Title</label>
								<input type="text" name="title" class="form-control" required="" :value="book.title">
							</div>
							<div class="form-group">
								<label>Tahun</label>
								<input type="number" name="year" class="form-control" required="" :value="book.year">
							</div>
							<div class="form-group">
								<label>Author</label>
								<select name="author_id" class="form-control">
									@foreach($authors as $author)
									<option :selected="book.author_id == {{$author->id}}" value="{{$author->id}}">{{$author->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Publisher</label>
								<select name="publisher_id" class="form-control">
									@foreach($publishers as $publisher)
									<option :selected="book.publisher_id == {{$publisher->id}}" value="{{$publisher->id}}">{{$publisher->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Catalog</label>
								<select name="catalog_id" class="form-control">
									@foreach($catalogs as $catalog)
									<option :selected="book.catalog_id == {{$catalog->id}}" value="{{$catalog->id}}">{{$catalog->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Qty Stock</label>
								<input type="number" name="qty" class="form-control" required="" :value="book.qty">
							</div>
							<div class="form-group">
								<label>Harga Pinjam</label>
								<input type="number" name="price" class="form-control" required="" :value="book.price">
							</div>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default bg-danger" v-if="editStatus" v-on:click="deleteData(book.id)">Delete</button>
							<button type="submit" class="btn btn-primary">Save Change</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
<script type="text/javascript">
	var actionUrl = '{{url('books')}}';
	var apiUrl = '{{url('api/books')}}';

	var app = new Vue({
		el : '#controller',
		data : {
			books : [],
			search : '',
			actionUrl,
			book : {},
			editStatus : false,
		},
		mounted : function (){
			this.get_books();
		},
		methods: {
			get_books(){
				const _this = this;
				$.ajax({
					url : apiUrl,
					type : 'GET',
					success : function(data){
						_this.books = JSON.parse(data);
					},
					error : function(error){
						console.log(error);
					}
				});
			},
			formatNumber(number) {
			   return number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
			},
			addData(){
				this.book = {};
				this.actionUrl = '{{url('books')}}';
				this.editStatus = false;
				$('#modal-default').modal();
			},
			editData(book){
				this.book = book;
				this.actionUrl = '{{url('books')}}'+'/'+book.id;
				this.editStatus = true;
				$('#modal-default').modal();
			},
			deleteData(id){
				this.actionUrl = '{{url('books')}}'+'/'+id;
				if (confirm("Are You Sure")) {
					axios.post(this.actionUrl, {_method : 'DELETE'}).then(response => {
						location.reload();
					});
				}
			},
		},
		computed : {
			filteredList(){
				return this.books.filter(book => {
					return book.title.toLowerCase().includes(this.search.toLowerCase());
				});
			},
		}
	});
</script>
@endsection