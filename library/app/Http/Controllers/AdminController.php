<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Book;
use App\Models\Author;
use App\Models\Member;
use App\Models\Catalog;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() 
    {
        $total_anggota = Member::count();
        $total_buku = Book::count();
        $total_peminjam = Transaction::whereMonth('date_start', date('m'))->count();
        $total_penerbit = Publisher::count();

        $data_donut = Book::select(DB::raw("COUNT(publisher_id) as total"))->groupBy('publisher_id')->orderBy('publisher_id', 'asc')->pluck('total');
        $label_donut = Publisher::orderBy('publishers.id', 'asc')->join('books', 'books.publisher_id', '=', 'publishers.id')->groupBy('name')->pluck('name');

        $label_bar = ['Peminjaman', 'Pengembalian'];
        $data_bar = [];

        foreach ($label_bar as $key => $value) {
            $data_bar[$key]['label'] = $label_bar[$key];
            $data_bar[$key]['backgroundColor'] = $key == 0 ? 'rgba(60,141,188,0.9)' : 'rgba(210,214,222,1)';
            $data_month = [];

            foreach (range(1,12) as $month) {
                if ($key == 0) {
                    $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_start', $month)->first()->total;
                } else {
                    $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_end', $month)->first()->total;
                }
                
            }
            $data_bar[$key]['data'] = $data_month;
        }

        return view('admin.dashboard', compact('total_buku', 'total_anggota', 'total_peminjam', 'total_penerbit', 'data_donut', 'label_donut','data_bar'));
    }

    public function buku()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $catalogs = Catalog::all();

        return view('admin.book.book', compact('publishers','authors', 'catalogs'));
    }

    public function anggota()
    {
        return view('admin.member.member');
    }

    public function penerbit()
    {
        return view('admin.publisher.publisher');
    }

    public function peminjam()
    {
        return view('admin.transaction.transaction');
    }

    
}
