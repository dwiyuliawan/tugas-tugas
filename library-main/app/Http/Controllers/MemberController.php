<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $notifs = Controller::getNotif();
        return view('admin.members.index', compact('notifs'));
    }



    public function api(Request $request)
    {
        if ($request->gender) {
            $members = Member::where('gender', $request->gender)->get();
        } else {
            $members = Member::all();
        }

        $datatables = datatables()->of($members)
            ->addColumn('date', function ($member) {
                return convert_date($member->created_at);
            })
            ->addIndexColumn();

        return $datatables->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'gender' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'email' => ['required'],
        ]);

        Member::create($request->all());
        return Redirect('members');
    }

    public function update(Request $request, Member $member)
    {
        $this->validate($request, [
            'name' => ['required'],
            'gender' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'email' => ['required'],
        ]);
        $member->update($request->all());
        return Redirect('members');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return true;
    }
}
