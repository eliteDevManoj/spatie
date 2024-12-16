<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request){

        $users = User::get();

        return view('admin.users.index', ['users' => $users]);
    }

    public function create(Request $request){
       
        $roles = Role::get();
       
        return view('admin.users.create', ['roles' => $roles]);
    }

    public function store(UserRequest $request){

        User::createFromRequest($request);

        return redirect()->route('users');
    }

    public function edit(Request $request){

        $request->validate([
            'id' => ['required', 'exists:users,id']
        ]);

        $user = User::where('id', $request->id)->first();

        $roles = Role::get();

        return view('admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\User $user
     */
    public function update(UserRequest $request, User $user){

        $user = User::where('id', $request->id)->first();

        $user->updateFromRequest($request);

        return redirect()->route('users.edit', ['id' => $user->id])->with('status', 'User updated!');
    }
}
