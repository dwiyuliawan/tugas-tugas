<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MemberController extends Controller
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
        return view('admin.member.index', compact('notifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
        return redirect('members');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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
        return redirect('members');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect('members');
    }

    public function api(Request $request)
    {
        $gender = $request->sex;
        if ($gender) {
            $members = Member::where('gender', $gender)->get();
        }else{
            $members = Member::all();
        }
        $datatables = datatables()->of($members)
        ->addColumn('date', function($member){
            return convert_date($member->created_at);
        })
        ->addColumn('gender2', function($member){
            return $member->gender == 'L' ? 'Laki-Laki' : 'Perempuan';
        })->addIndexColumn();
        
        return $datatables->make(true);
    }
}
