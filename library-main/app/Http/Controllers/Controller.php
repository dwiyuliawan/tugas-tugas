<?php


namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;

use App\Models\Member;

use App\Models\Transaction;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function getNotif()
    {
        $currentDate = Carbon::now()->toDateString();
        $data = Member::select('transactions.id', 'members.name', Transaction::raw("DATEDIFF('$currentDate',transactions.date_end) AS hari"))
            ->join('transactions', 'transactions.id', '=', 'members.id')
            ->where('date_end', '<', $currentDate)
            ->where('status', 'Borrowed')
            ->get();

        return $data;
    }

    public function run()
    {
        //$role = Role::create(['name' => 'admin']);
        //$permission = Permission::create(['name' => 'index peminjaman']);
        //
        //$role->givePermissionTo($permission);
        //$permission->assignRole($role);
        //
        //$role->revokePermissionTo($permission);

        //$user = auth()->user()->roles;
        //
        //$users = User::role('writer')->get(); // Returns only users with the role 'writer'
        //$nonEditors = User::withoutRole('editor')->get(); // Returns only users without the role 'editor'

        //$user = auth()->user();
        //$user->assignRole('admin');
        //return $user;
    }
}
