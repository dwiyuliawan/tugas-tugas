<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function test_spatie()
    {
        // Untuk Membuat Role dan Permission di database
            // $role = Role::create(['name' => 'admin']);
            // $permission = Permission::create(['name' => 'index peminjaman']);

            // $role->givePermissionTo($permission);
            // $permission->assignRole($role);

        // Untuk melihat user yang sedang login
            // $user = auth()->user();
            // return $user;

        //Untuk melihat semua user yang sudah dan belum terdaftar
                // $user = User::with('roles')->get();
                // return $user;

        // Menjadikan user menjadi Admin berdasarkan ID
            // $user = User::where('id', 1)->first();
            // $user ->assignRole('admin');
            // return $user;

        // Menjadikan user menjadi Admin bersasarkan auth / ketika sudah login
            // $user = auth()->user();
            // $user->assignRole('admin');
            // return $user;

        // Delete user Yang menjadi Admin
            // $user = auth()->user();
            // $user->removeRole('admin');

            // $user = User::where('id', 1)->first();
            // $user->removeRole('admin');
            // return $user;
    }
}
