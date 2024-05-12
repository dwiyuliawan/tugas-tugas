<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role('admin')) {
            # code...
            $notifs = Controller::getNotif();
            $catalogs = Catalog::with('books')->get();
        }

        return view('admin.catalogs.index', compact('notifs', 'catalogs'));
    }

    public function create()
    {
        $notifs = Controller::getNotif();
        return view('admin.catalogs.create', compact('notifs'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required']
        ]);

        Catalog::create($request->all());
        return Redirect('catalogs');
    }

    public function edit(Catalog $catalog)
    {
        $notifs = Controller::getNotif();
        return view('admin.catalogs.edit', compact('notifs', 'catalog'));
    }

    public function update(Request $request, Catalog $catalog)
    {
        $this->validate($request, [
            'name' => ['required']
        ]);

        $catalog->update($request->all());
        return Redirect('catalogs');
    }

    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return Redirect('catalogs');
    }
}
