<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard(Request $request){

        if(Auth::check()){

            $user = Auth::user();

            $userRoles = $user->getRoleNames();

            $roles = Role::get();

            $permissions = Permission::get();

            $users = User::get();

            return view('admin.dashboard', [
                'user' => $user,
                'userRoles' => $userRoles,
                'roles' => $roles,
                'permissions' => $permissions,
                'users' => $users
            ]);
        }

        return redirect()->route('login');
    }
}
