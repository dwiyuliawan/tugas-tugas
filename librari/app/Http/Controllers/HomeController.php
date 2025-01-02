<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
        //Notifikasi
        $notifs = getNotif();

        $total_books = Book::count();
        $total_members = Member::count();
        $total_publishers = Publisher::count();
        $total_transactions = Transaction::count();
        // $total_transaction = Transaction::whereMonth('date_end', date('m'))->count();

        $label_donut = Catalog::orderBy('catalog_id', 'asc')->join('books', 'books.catalog_id', '=', 'catalogs.id')->groupBy('catalogs.name')->pluck('catalogs.name');
        $data_donut = Book::select(DB::raw("COUNT(catalog_id) as total"))->groupBy('catalog_id')->orderBy('catalog_id', 'asc')->pluck('total');

        $label_bar = ['Peminjaman' , 'Pengembalian'];
        $data_bar = [];

        foreach ($label_bar as $key => $value) {
            $data_bar[$key]['Label'] = $label_bar[$key];
            $data_bar[$key]['backgroundColor'] = $key == 0 ? 'rgba(60,141,188,0.9)' : 'rgba(210,214,222,1)' ;
            $data_month = [];

            foreach (range(1,12) as $month) {
                if ($key == 0) {
                    $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_start', $month)->first()->total;
                }else {
                    $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_end', $month)->first()->total;
                }
                $data_bar[$key]['data'] = $data_month;
            }
        }

        $label_chart = ['Peminjaman', 'Pengembalian'];
        $data_chart = [];

        foreach ($label_chart as $key => $value) {
            $data_chart[$key]['label'] = $label_chart[$key];
            $data_chart[$key]['backgroundColor'] = $key == 0 ? 'rgb(179, 255, 179)' : 'rgba(210,214,222,1)';
            $data_month = [];

            foreach (range(1,12) as $month) {
                if ($key == 0) {
                    $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_start', $month)->first()->total;
                }else {
                    $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_end', $month)->first()->total;
                }
                $data_chart[$key]['data'] = $data_month;
            }
        }

        return view('home', compact('total_books', 'total_members', 'total_publishers', 'total_transactions','label_donut', 'data_donut', 'data_bar', 'data_chart', 'notifs'));
    }
}
