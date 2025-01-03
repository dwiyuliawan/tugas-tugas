<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can('index peminjaman')) {
            $notifs = getNotif();
            return view('admin.transaction.index', compact('notifs'));
        }else{
            return abort('403');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notifs = getNotif();
        $members = Member::all();
        $books = Book::where('qty', '!=', 0)->get();
        return view('admin.transaction.create', compact('notifs', 'members', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'member_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        //mulai transaksi
        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'member_id' => $validateData['member_id'],
                'date_start' => $validateData['date_start'],
                'date_end' => $validateData['date_end'],
                'status' => 'Borrowed',
            ]);

            //Insert Data TransactionDetail
            $transaction_id = $transaction->getAttribute('id');
            foreach ($request->book_id as $bookid)  {
                TransactionDetail::create([
                    'transaction_id' => $transaction_id,
                    'book_id' => $bookid,
                    'qty' => 1,
                ]);

                //Mengurangi jumlah buku
                $book = Book::findOrFail($bookid);
                $book->qty -= 1;
                $book->save();
            }

            //Commit transaksi jika berhasil
            DB::commit();
            return redirect('transactions');
        } catch (\Exception $e) {
            //Roolback transaksi jika terjadi kesalahan
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $notifs = getNotif();
        $trx_member = $transaction->with('member')->where('transactions.id', $transaction['id'])->first();
        $trx_books = TransactionDetail::select('books.title')
            ->join('books', 'books.id', '=', 'transaction_details.book_id')
            ->where('transaction_id', $transaction['id'])
            ->get();

        return view('admin.transaction.show', compact('notifs', 'trx_books', 'trx_member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        if ($transaction->status == 'Finished') {
            return redirect()->back()->with('warning', 'Buku yang sudah di kembalikan tidak bisa di edit');
        }else{
            $idmember = $transaction->member_id;
            $notifs = getNotif();
            $members = Member::select('members.name','members.id')->where('members.id', $idmember)->get();
            $trx_books = TransactionDetail::select('books.title','books.id')
            ->join('books', 'books.id', '=', 'transaction_details.book_id')
            ->where('transaction_id', $transaction['id'])
            ->get();
        }

        return view('admin.transaction.edit', compact('notifs', 'transaction', 'members', 'trx_books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        if ($transaction->status == 'Borrowed') {
            foreach($transaction->transactionDetails as $transaction_detail){
                $book = Book::findOrFail($transaction_detail->book_id);
                $book->qty += 1;
                $book->save();
                $transaction->transactionDetails()->Delete();
                $transaction->delete();
            }
        }else{
            $transaction->transactionDetails()->Delete();
            $transaction->delete();
        }

        return true;
    }

    public function api(Request $request)
    {
        if ($request->date_start) {
            $transactions = Transaction::select('transactions.id','date_start', 'date_end', 'members.name', 'status', 
            Transaction::raw('DATEDIFF(transactions.date_end, transactions.date_start) as jarak_hari'),
            TransactionDetail::raw('SUM(price * transaction_details.qty) as total_price'),
            TransactionDetail::raw('SUM(transaction_details.qty) as total_qty')
            )
            ->join('members', 'members.id', '=', 'transactions.member_id')
            ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('books', 'books.id', '=', 'transaction_details.book_id')
            ->groupBy('transactions.id','date_start', 'date_end', 'members.name', 'status')
            ->whereDate('date_start', $request->date_start)
            ->get();
        }elseif($request->status){
            $transactions = Transaction::select('transactions.id','date_start', 'date_end', 'members.name', 'status', 
            Transaction::raw('DATEDIFF(transactions.date_end, transactions.date_start) as jarak_hari'),
            TransactionDetail::raw('SUM(price * transaction_details.qty) as total_price'),
            TransactionDetail::raw('SUM(transaction_details.qty) as total_qty')
            )
            ->join('members', 'members.id', '=', 'transactions.member_id')
            ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('books', 'books.id', '=', 'transaction_details.book_id')
            ->groupBy('transactions.id','date_start', 'date_end', 'members.name', 'status')
            ->where('status', $request->status)
            ->get();
        } else{
            $transactions = Transaction::select('transactions.id','date_start', 'date_end', 'members.name', 'status', 
                Transaction::raw('DATEDIFF(transactions.date_end, transactions.date_start) as jarak_hari'),
                TransactionDetail::raw('SUM(price * transaction_details.qty) as total_price'),
                TransactionDetail::raw('SUM(transaction_details.qty) as total_qty')
            )
            ->join('members', 'members.id', '=', 'transactions.member_id')
            ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('books', 'books.id', '=', 'transaction_details.book_id')
            ->groupBy('transactions.id','date_start', 'date_end', 'members.name', 'status')
            ->get();
        }


        $datatables = datatables()->of($transactions)
        ->addColumn('total_price', function($transaction) {
            return convert_price($transaction->total_price);
        })
        ->addColumn('action', function($transaction) {
            return 
            '<a href="/transactions/' .$transaction->id . '/edit" class="btn btn-success">Edit</a>'.
            '<a href="/transactions/' .$transaction->id . '/show" class="btn btn-primary">Detail</a>'.
            '<button class="btn btn-danger" onclick="controller.deleteData(event,' .$transaction->id.')">Delete</button>';
        })
        ->addIndexColumn();

        return $datatables->make(true);
    }
}
