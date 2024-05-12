<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Catalog;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifs = Controller::getNotif();
        $publishers = Publisher::all();
        $authors = Author::all();
        $catalogs = Catalog::all();

        return view('admin.books.index', compact('notifs', 'publishers', 'authors', 'catalogs'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'isbn' => ['required'],
            'title' => ['required'],
            'year' => ['required'],
            'publisher_id' => ['required'],
            'author_id' => ['required'],
            'catalog_id' => ['required'],
            'qty' => ['required'],
            'price' => ['required'],
        ]);
        Book::create($request->all());
        return Redirect('books');
    }

    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'isbn' => ['required'],
            'title' => ['required'],
            'year' => ['required'],
            'publisher_id' => ['required'],
            'author_id' => ['required'],
            'catalog_id' => ['required'],
            'qty' => ['required'],
            'price' => ['required'],
        ]);
        $book->update($request->all());
        return Redirect('books');
    }

    public function api()
    {
        $books = Book::all();
        return json_encode($books);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return true;
    }
}
