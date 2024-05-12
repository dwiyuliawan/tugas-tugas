@extends('layouts.admin')

@section('content')
<div id="controller">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                
                <div class="row justify-content-center mt-3">
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" v-model="searchQuery" placeholder="Cari...">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-auto">
                        <button type="button" @click="addData()" class="btn btn-primary" style="height: 45px">Create New Book</button>
                    </div>
                </div>
                <!-- /.row -->
                <hr>

                <div class="row">
                    <div v-for="book in filteredList" class="col-md-3 col-sm-6 col-12">
                        <div class="info-box" v-on:click="editData(event,book)">
                            <div class="info-box-content">
                                <span class="info-box-text">@{{ book.title }} (@{{ book.qty }})</span>
                                <span class="info-box-number">@{{formatRupiah(book.price) }}</span>
                            </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form :action="actionUrl" method="POST" @submit="submitForm($event, data.id)">
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input name="isbn" type="number" class="form-control" id="isbn" :value="book.isbn" required>
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control" id="title" :value="book.title" required>
                        </div>

                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <input name="year" type="number" class="form-control" id="year" :value="book.year" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Publisher</label>
                            <select class="form-control" name="publisher_id">
                                @foreach ($publishers as $publisher)
                                <option :selected="book.publisher_id == {{ $publisher->id }}" value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Author</label>
                            <select class="form-control" name="author_id">
                                @foreach ($authors as $author)
                                <option :selected="book.author_id == {{ $publisher->id }}" value="1">{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Catalog</label>
                            <select class="form-control" name="catalog_id">
                                @foreach ($catalogs as $catalog)
                                <option :selected="book.catalog_id == {{ $publisher->id }}" value="1">{{ $catalog->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="qty">Qty Stock</label>
                            <input name="qty" type="number" class="form-control" id="qty" :value="book.qty" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Harga Pinjam</label>
                            <input name="price" type="number" class="form-control" id="price" :value="book.price" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" v-if="editStatus" v-on:click="deleteData(event, book.id)">Delete</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ./ Modal -->
</div>
<!-- /#controller -->
@endsection

@section('js')
<script>
    var actionUrl = "{{ url('books') }}";
    var apiUrl = "{{ url('api/books') }}";

    var controller = new Vue({
        el: '#controller',
        data:{
            actionUrl,
            apiUrl,
            books:[],
            book: {},
            searchQuery: '',
            editStatus: false
        },
        mounted: function(){
            this.get_books();
        },
        methods: {
            get_books(){
                const _this = this;
                $.ajax({
                    url: apiUrl,
                    methods:'GET',
                    success: function(data){
                        _this.books = JSON.parse(data);
                    },
                    error: function(error){
                        console.log(error);
                    }
                });
            },
            formatRupiah(number) {
                // Menambahkan pemisah ribuan dan menggunakan dua digit desimal
                return `Rp. ${number.toString().replace(/\d(?=(\d{3})+(?!\d))/g, '.')}`;
            },
            addData() {
                this.editStatus = false;
                this.book = {};
                $('#modal').modal();
            },
            editData(event,book){
                this.editStatus = true;
                this.book = book;
                $('#modal').modal();
            },
            deleteData(event, id){ 
                axios
                .delete(this.actionUrl+'/'+id)
                .then(response => {
                    $('#modal').modal('hide');
                    this.get_books();
                })
                .catch(error => {
                    console.error('Error deleting data:', error);
                });
            },
            submitForm(event, id){
                event.preventDefault();
                var actionUrl = ! this.editStatus ? this.actionUrl : this.actionUrl+'/'+id;
                axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {
                    $('#modal').modal('hide');
                    this.span.ajax.reload();
                });
            }
        },
        computed: {
            filteredList() {
                // Menggunakan metode filter untuk menyaring item berdasarkan pencarian
                return this.books.filter(book => {
                    return book.title.toLowerCase().includes(this.searchQuery.toLowerCase());
                });
            }
        }
    });
</script>
@endsection