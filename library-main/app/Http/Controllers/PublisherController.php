<?php

namespace App\Http\Controllers;

use App\Models\Publisher;

use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifs = Controller::getNotif();
        return view('admin.publishers.index', compact('notifs'));
    }

    public function api()
    {
        $publishers = Publisher::all();
        $datatables = datatables()->of($publishers)
            ->addColumn('date', function ($author) {
                return convert_date($author->created_at);
            })
            ->addIndexColumn();
        return $datatables->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
        ]);

        Publisher::create($request->all());
        return Redirect('publishers');
    }


    public function update(Request $request, Publisher $publisher)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
        ]);
        $publisher->update($request->all());
        return Redirect('publishers');
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return true;
    }
}
