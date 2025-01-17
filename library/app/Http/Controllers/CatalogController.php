<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
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
        $notifs = getNotif();
        $catalogs = Catalog::with('books')->get();
        return view('admin.catalog.index', compact('catalogs', 'notifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notifs = getNotif();

        return view('admin.catalog.create', compact('notifs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
        ]);
        Catalog::create($request->all());
        return redirect('catalogs');
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalog $catalog)
    {
        $notifs = getNotif();

        return view('admin.catalog.edit', compact('catalog', 'notifs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catalog $catalog)
    {
        $this->validate($request, [
            'name' => ['required'],
        ]);

        $catalog->update($request->all());
        return redirect('catalogs');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return redirect('catalogs');
    }
}
