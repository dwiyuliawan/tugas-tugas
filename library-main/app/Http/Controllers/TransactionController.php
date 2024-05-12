<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $notifs = Controller::getNotif();

        return view('admin.transactions.index', compact('notifs'));
    }

    public function api(Request $request)
    {
        if ($request->status) {
            $transactions = Transaction::select(
                'transactions.id',
                'date_start',
                'date_end',
                'members.name',
                Transaction::raw('DATEDIFF(transactions.date_end, transactions.date_start) as jarak_hari'), // Calculate difference in days
                'status',
                TransactionDetail::raw('SUM(price * transaction_details.qty) as total_price'),
                TransactionDetail::raw('SUM(transaction_details.qty) as total_qty') // Calculate total quantity
            )
                ->join('members', 'members.id', '=', 'transactions.member_id')
                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id') // Corrected the join condition
                ->join('books', 'books.id', '=', 'transaction_details.book_id')
                ->groupBy('transactions.id', 'date_start', 'date_end', 'members.name', 'status') // Group by relevant fields
                ->where('status', $request->status)
                ->get();
        } elseif ($request->date_start) {
            $transactions = Transaction::select(
                'transactions.id',
                'date_start',
                'date_end',
                'members.name',
                Transaction::raw('DATEDIFF(transactions.date_end, transactions.date_start) as jarak_hari'), // Calculate difference in days
                'status',
                TransactionDetail::raw('SUM(price * transaction_details.qty) as total_price'),
                TransactionDetail::raw('SUM(transaction_details.qty) as total_qty') // Calculate total quantity
            )
                ->join('members', 'members.id', '=', 'transactions.member_id')
                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id') // Corrected the join condition
                ->join('books', 'books.id', '=', 'transaction_details.book_id')
                ->groupBy('transactions.id', 'date_start', 'date_end', 'members.name', 'status') // Group by relevant fields
                ->whereDate('date_start', $request->date_start)
                ->get();
        } else {
            $transactions = Transaction::select(
                'transactions.id',
                'date_start',
                'date_end',
                'members.name',
                Transaction::raw('DATEDIFF(transactions.date_end, transactions.date_start) as jarak_hari'), // Calculate difference in days
                'status',
                TransactionDetail::raw('SUM(price * transaction_details.qty) as total_price'),
                TransactionDetail::raw('SUM(transaction_details.qty) as total_qty') // Calculate total quantity
            )
                ->join('members', 'members.id', '=', 'transactions.member_id')
                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id') // Corrected the join condition
                ->join('books', 'books.id', '=', 'transaction_details.book_id')
                ->groupBy('transactions.id', 'date_start', 'date_end', 'members.name', 'status') // Group by relevant fields
                ->get();
        }

        $datatables = datatables()->of($transactions)
            ->addColumn('total_price', function ($transaction) {
                return convert_price($transaction->total_price);
            })
            ->addColumn('action', function ($transaction) {
                return '<a href="/transactions/' . $transaction->id . '/edit" class="btn btn-success">Edit</a>' .
                    '<a href="/transactions/' . $transaction->id . '/show" class="btn btn-primary">Detail</a>' .
                    '<button class="btn btn-danger" onclick="controller.deleteData(event,' . $transaction->id . ')">Delete</button>';
            })
            ->addIndexColumn();

        return $datatables->make(true);
    }

    public function create()
    {
        $notifs = Controller::getNotif();
        $members = Member::all();
        $books = Book::all();

        return view('admin.transactions.create', compact('notifs', 'members', 'books'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'member_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        // Memulai transaksi database
        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'member_id' => $validateData['member_id'],
                'date_start' => $validateData['date_start'],
                'date_end' => $validateData['date_end'],
                'status' => 'Borrowed'
            ]);

            $transaction_id = $transaction->getAttribute('id');
            foreach ($request->book_id as $bookid) {
                TransactionDetail::create([
                    'transaction_id' => $transaction_id,
                    'book_id' => $bookid,
                    'qty' => 1
                ]);

                // Mengurangi jumlah stok buku
                $book = Book::findOrFail($bookid);
                $book->qty -= 1;
                $book->save();
            }


            // Commit transaksi jika berhasil
            DB::commit();
            return Redirect('transactions');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            return Redirect()->back();
        }
    }

    public function edit(Request $request, Transaction $transaction, TransactionDetail $transactionDetail)
    {

        $notifs = Controller::getNotif();
        $transactions = Transaction::all();
        $transactionDetails = TransactionDetail::all();
        $members = Member::all();
        $books = Book::all();

        return view('admin.transactions.edit', compact('notifs', 'transactions', 'transaction', 'transactionDetails', 'transactionDetail', 'members', 'books'));
    }

    public function update(Request $request, Transaction $transaction, TransactionDetail $transactionDetail)
    {
        $validateData = $request->validate([
            'member_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'status' => 'nullable',
        ]);


        // Mulai transaksi database
        DB::beginTransaction();

        try {

            $transaction->update($validateData);

            // Perbarui detail transaksi yang ada
            $transaction->transactionDetails()->delete(); // Hapus detail transaksi yang ada sebelumnya


            foreach ($request->book_id as $bookid) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'book_id' => $bookid,
                    'qty' => 1
                ]);

                if ($request->status == "Finished") {
                    // Menambah jumlah stok buku
                    $book = Book::findOrFail($bookid);
                    $book->qty += 1;
                    $book->save();
                } else {
                    // Mengurangi jumlah stok buku
                    $book = Book::findOrFail($bookid);
                    $book->qty -= 1;
                    $book->save();
                }
            }

            // Commit transaksi jika berhasil
            DB::commit();
            return Redirect('transactions');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            return redirect()->back();
        }
    }

    public function show(Transaction $transaction)
    {
        $notifs = Controller::getNotif();
        $trx_member = $transaction->with('member')->where('transactions.id', $transaction['id'])->first();
        $trx_books = TransactionDetail::select('books.title')
            ->join('books', 'books.id', '=', 'transaction_details.book_id')
            ->where('transaction_id', $transaction['id'])
            ->get();

        return view('admin.transactions.show', compact('notifs', 'trx_books', 'trx_member'));
    }

    public function destroy(Transaction $transaction)
    {

        $transaction->transactionDetails()->Delete();
        $transaction->delete();

        return true;
    }
}
