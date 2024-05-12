<?php


namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Member;
use App\Models\Catalog;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
    //public function index()
    //{
    //    //$member = Member::with('user')->get();
    //    //$publisers = Publisher::with('books')->get();
    //    //$books = Book::with('publisher')->get();
    //    //$authors = Author::with('books')->get();
    //    //$catalogs = Catalog::with('books')->get();
    //
    //    //NO 1
    //    $data1 = Member::select('*')
    //        ->join('users', 'users.member_id', '=', 'members.id')
    //        ->get();
    //
    //    //NO 2 
    //    $data2 = Member::select('*')
    //        ->leftjoin('users', 'users.member_id', '=', 'members.id')
    //        ->where('users.member_id', null)
    //        ->get();
    //
    //    //NO 3
    //    $data3 = Member::select('member_id', 'members.name', 'phone_number')
    //        ->leftjoin('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->where('member_id', null)
    //        ->get();
    //
    //    //NO 4
    //    $data4 = Member::select('member_id', 'members.name', 'phone_number')
    //        ->rightjoin('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->get();
    //
    //    //NO 5
    //    $data5 =
    //        Member::select('member_id', 'members.name', 'phone_number')
    //        ->join('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->groupBy('member_id')
    //        ->having(Member::raw('COUNT(member_id)'), '>', 1)
    //        ->get();
    //
    //    //NO 6
    //    $data6 = Member::select('name', 'phone_number', 'address', 'date_start', 'date_end')
    //        ->join('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->get();
    //
    //    //NO 7
    //    $data7 = Member::select('name', 'phone_number', 'address', 'date_start', 'date_end')
    //        ->join('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->whereMonth('date_end', 6)
    //        ->get();
    //
    //    //NO 8
    //    $data8 = Member::select('name', 'phone_number', 'address', 'date_start', 'date_end')
    //        ->join('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->whereMonth('date_start', 5)
    //        ->get();
    //
    //    //NO 9
    //    $data9 = Member::select('name', 'phone_number', 'address', 'date_start', 'date_end')
    //        ->join('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->whereMonth('date_start', 6)
    //        ->whereMonth('date_end', 6)
    //        ->get();
    //
    //    //NO 10
    //    $data10 = Member::select('name', 'phone_number', 'address', 'date_start', 'date_end')
    //        ->join('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->where('address', 'LIKE', '%Bandung%')
    //        ->get();
    //
    //    //NO 11
    //    $data11 = Member::select('members.id', 'name', 'phone_number', 'address', 'date_start', 'date_end')
    //        ->join('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->where('gender', 'p')
    //        ->where('address', 'LIKE', '%Bandung%')
    //        ->get();
    //
    //    //NO 12
    //    $data12 = Member::select('name', 'phone_number', 'address', 'date_start', 'date_end', 'isbn', 'transaction_details.qty')
    //        ->join('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
    //        ->join('books', 'books.id', '=', 'transaction_details.book_id')
    //        ->where('transaction_details.qty', '>', 1)
    //        ->get();
    //
    //    //NO 13
    //    $data13 = Member::select('name', 'phone_number', 'address', 'date_start', 'date_end', 'isbn', 'transaction_details.qty', 'title', 'price', Member::raw('SUM(price * transaction_details.qty) as total_price'))
    //        ->join('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
    //        ->join('books', 'books.id', '=', 'transaction_details.book_id')
    //        ->groupBy('name', 'phone_number', 'address', 'date_start', 'date_end', 'isbn', 'transaction_details.qty', 'title', 'price')
    //        ->get();
    //
    //    //NO 14
    //    $data14 = Member::select('members.name', 'members.phone_number', 'members.address', 'date_start', 'date_end', 'isbn', 'transaction_details.qty', 'title', 'price', 'publishers.name', 'authors.name', 'catalogs.name')
    //        ->join('transactions', 'transactions.member_id', '=', 'members.id')
    //        ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
    //        ->join('books', 'books.id', '=', 'transaction_details.book_id')
    //        ->join('publishers', 'publishers.id', '=', 'books.publisher_id')
    //        ->join('authors', 'authors.id', '=', 'books.author_id')
    //        ->join('catalogs', 'catalogs.id', '=', 'books.catalog_id')
    //        ->get();
    //
    //    //NO 15
    //    $data15 = catalog::select('catalogs.id', 'catalogs.name', 'books.title', 'catalogs.created_at', 'catalogs.updated_at')
    //        ->join('books', 'books.catalog_id', '=', 'catalogs.id')
    //        ->get();
    //
    //    //NO 16
    //    $data16 = Book::select('*')
    //        ->rightjoin('publishers', 'publishers.id', '=', 'books.publisher_id')
    //        ->get();
    //
    //    //NO 17
    //    $data17 = Book::select(Book::raw('sum(author_id = 5) as total'))
    //        ->get();
    //
    //    //NO 18
    //    $data18 = Book::select('*')
    //        ->where('price', '>', 10000)
    //        ->get();
    //
    //    //NO 19
    //    $data19 = Book::select('*')
    //        ->where('publisher_id', 1)
    //        ->where('qty', '>', 10)
    //        ->get();
    //
    //    //NO 20
    //    $data20 = Member::select('*')
    //        ->whereMonth('created_at', 6)
    //        ->get();
    //}

    public static function getNotif()
    {
        $currentDate = Carbon::now()->toDateString();
        $data = Member::select('transactions.id', 'name', Transaction::raw('DATEDIFF(transactions.date_end, transactions.date_start) as jarak_hari'))
            ->join('transactions', 'transactions.id', '=', 'members.id')
            ->where('date_end', '<', $currentDate)
            ->get();

        return $data;
    }

    public function dashboard()
    {
        $notifs = HomeController::getNotif();
        $tbook = Book::count();
        $tmember = Member::count();
        $ttransaction = Transaction::count();
        $tpublisher = Publisher::count();

        $data_donut = Book::select(Book::raw('COUNT(publisher_id) as total'))
            ->groupBy('publisher_id')
            ->get()
            ->pluck('total');
        $data_pie = Book::select(Book::raw('COUNT(catalog_id) as total'))
            ->groupBy('publisher_id')
            ->get()
            ->pluck('total');

        $lable_donut = Publisher::pluck('name')->toArray();
        $lable_pie = Catalog::pluck('name')->toArray();

        foreach (range(1, 12) as $month) {
            $data_monthstart[] = Transaction::whereMonth('date_start', $month)->count();
            $data_monthend[] = Transaction::whereMonth('date_end', $month)->count();
        };

        return view('home', compact('notifs', 'tbook', 'tmember', 'ttransaction', 'tpublisher', 'data_donut', 'lable_donut', 'data_pie', 'lable_pie', 'data_monthstart', 'data_monthend', 'data_pie'));
    }
}
