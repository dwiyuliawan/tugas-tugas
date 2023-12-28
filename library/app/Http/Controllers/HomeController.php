<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Member;
use App\Models\Catalog;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $members = Member::with('user')->get();
        // $books = Book::with('publisher')->get();
        // $publishers = Publisher::with('books')->get();
        // $books = Book::with('author')->get();
        // $author = Author::all();
        // $author = Author::with('books')->get();
        // $books = Book::with('catalog')->get();
        // $catalog = Catalog::all();
        // $catalog = Catalog::with('books')->get();

        // no 1
        // $data1 = Member::select('*')
        //     ->join('users', 'users.member_id', '=', 'members.id')
        //     ->get();

        // //no 2
        // $data2 = Member::select('*')
        //     ->leftJoin('users', 'users.member_id', '=', 'members.id')
        //     ->where('users.member_id', NULL)
        //     ->get();

        //     //no 3
        // $data3 = Transaction::select('members.id', 'members.name')
        //     ->rightJoin('members', 'members.id', '=', 'transactions.member_id')
        //     ->where('transactions.member_id', NULL)
        //     ->get();

        // $data4 = Member::select('members.id', 'members.name', 'members.phone_number')
        //     ->join('transactions', 'transactions.member_id', '=', 'members.id')
        //     ->orderBy('members.id', 'asc')
        //     ->get();

        // $data5 = Member::select('transactions.member_id', 'members.id', 'members.name', 'members.phone_number')
        //     ->join('transactions', 'transactions.member_id', '=', 'members.id')
        //     ->orderBy('transactions.member_id', 'asc')
        //     ->where('transactions.member_id', '>', '1')
        //     ->get();

        // $data6 = Member::select('members.name', 'members.phone_number', 'members.address','transactions.date_start','transactions.date_end')
        //     ->join('transactions', 'transactions.member_id','=','members.id')
        //     ->get();

        //     $data7 = Member::select('members.name', 'members.phone_number', 'members.address','transactions.date_start','transactions.date_end')
        //     ->join('transactions', 'transactions.member_id','=','members.id')
        //     ->whereMonth('transactions.date_end','06')
        //     ->get();

        //     $data8 = Member::select('members.name', 'members.phone_number', 'members.address','transactions.date_start','transactions.date_end')
        //     ->join('transactions', 'transactions.member_id','=','members.id')
        //     ->whereMonth('transactions.date_start','06')
        //     ->get();

        //     $data9 = Member::select('members.name', 'members.phone_number', 'members.address','transactions.date_start','transactions.date_end')
        //     ->join('transactions', 'transactions.member_id','=','members.id')
        //     ->whereMonth('transactions.date_start','12')
        //     ->whereMonth('transactions.date_end','12')
        //     ->get();

        //     $data10 = Member::select('members.name', 'members.phone_number', 'members.address','transactions.date_start','transactions.date_end')
        //     ->join('transactions', 'transactions.member_id','=','members.id')
        //     ->where('members.address','LIKE','%n%')
        //     ->get();

        //     $data11 = Member::select('members.name', 'members.phone_number', 'members.address','transactions.date_start','transactions.date_end','books.isbn','books.qty')
        //     ->join('transactions', 'transactions.member_id','=','members.id')
        //     ->join('transaction_details', 'transaction_details.transaction_id','=','transactions.id')
        //     ->join('books', 'books.id','=','transaction_details.book_id')
        //     ->where('members.address','LIKE','%n%')
        //     ->where('members.gender', 'LIKE', '%P%')
        //     ->get();

        //     $data12 = Member::select('members.name', 'members.phone_number', 'members.address','transactions.date_start','transactions.date_end','books.isbn','transaction_details.qty',DB::raw('COUNT(transactions.id) as jumlah_transaksi'))
        //         ->join ('transactions', 'transactions.member_id','=','members.id')
        //         ->join ('transaction_details', 'transaction_details.transaction_id','=','transactions.id')
        //         ->join('books', 'books.id','=','transaction_details.book_id')
        //         // ->where('transaction_details.qty', '>', '3')
        //         ->groupBy('members.id','members.name')
        //         ->havingRaw('COUNT(transactions.id)>3')
        //         ->get();

        //     $data13 = Member::select('members.name', 'members.phone_number', 'members.address','transactions.date_start','transactions.date_end','books.isbn','transaction_details.qty','books.title', 'books.price', DB::raw('(transaction_details.qty * books.price) as total'))
        //     ->join('transactions', 'transactions.member_id','=','members.id')
        //     ->join('transaction_details', 'transaction_details.transaction_id','=','transactions.id')
        //     ->join('books', 'books.id','=','transaction_details.book_id')
        //     ->get();

        //     $data14 = Member::select('members.name as nama anggota', 'members.phone_number as telepon', 'members.address as alamat','transactions.date_start as tanggal pinjam','transactions.date_end as tanggal kembali','books.isbn','transaction_details.qty','books.title as judul', 'publishers.name as nama pengarang','catalogs.name as nama katalog')
        //     ->join ('transactions', 'transactions.member_id','=','members.id')
        //     ->join ('transaction_details', 'transaction_details.transaction_id','=','transactions.id')
        //     ->join('books', 'books.id','=','transaction_details.book_id')
        //     ->join('publishers', 'publishers.id','=','books.publisher_id')
        //     ->join('catalogs', 'catalogs.id','=','books.catalog_id')
        //     ->get();

        //     $data15 = Catalog::select('catalogs.id','catalogs.name as nama katalog', 'books.title as judul buku')
        //         ->  RIGHTJOIN('books', 'books.catalog_id', '=', 'catalogs.id')
        //         ->get();

        //     $data16 = Book::select('*')
        //     ->RIGHTJOIN('publishers', 'publishers.id','=','books.publisher_id')
        //     ->get();

        //     $data17 = Book::select('publisher_id',DB::raw('COUNT(publisher_id) as Total'))
        //         ->where('publisher_id','LIKE','14')
        //         ->GROUPBY('publisher_id')
        //         ->get();

        //     $data18 = Book::select('*')
        //         ->where('price','>','15000')
        //         ->get();

        //     $data19 = Book::select('publishers.name','books.qty')
        //         ->RIGHTJOIN('publishers','publishers.id','=','books.publisher_id')
        //         ->where('books.qty','>','15')
        //         ->get();

        //     $data20 = Member::select('*')
        //         ->LeftJoin('users','users.member_id','=','Members.id')
        //         ->where('users.member_id',NULL)
        //         ->get();

        return view('home');
    }
}
