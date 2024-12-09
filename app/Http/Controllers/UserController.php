<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request){

        if(!Auth::check()){

            return redirect()->route('login');
        }

        $users = User::get();

        return view('admin.users.index', ['users' => $users]);
    }

    public function create(Request $request){
       
        if(!Auth::check()){

            return redirect()->route('login');
        }

        $roles = Role::get();
       
        return view('admin.users.create', ['roles' => $roles]);
    }

    public function store(Request $request){

        $request->validate([
            'email' => ['required', 'unique:users'],
            'role' => ['required', 'exists:roles,name'],
            'profile_image' => [ 'nullable','mimes:jpg,jpeg,png']
        ]);

        /** if request contain file */

        $profileImage = NULL;

        if($request->hasFile('profile_image')) {

            $profileImage = $request->file('profile_image')->store('profiles', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => 'Welcome@123#',
            'profile_image' => $profileImage
        ]);

        if($request->has('role')){

            $user->assignRole($request->role);
        }

        return redirect()->route('users');
    }

    public function edit(Request $request){

        if(!Auth::check()){

            return redirect()->route('login');
        }

        $request->validate([
            'id' => ['required', 'exists:users,id']
        ]);

        $user = User::where('id', $request->id)->first();

        $roles = Role::get();

        return view('admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request){

        $request->validate([
            'id' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($request->id)
            ],
            'role' => ['required', 'exists:roles,name'],
            'profile_image' => [ 'nullable','mimes:jpg,jpeg,png'] 
        ]);

        $user = User::where('id', $request->id)->first();

        $profileImage = NULL;

        if($request->hasFile('profile_image')) {

            $profileImage = $request->file('profile_image')->store('profiles', 'public');

            $existProfileImage = storage_path('app/public/').$user->profile_image;
            if (isset($user->profile_image) && file_exists($existProfileImage)) {
                
                unlink($existProfileImage);
            }
        }

        $user->update([
            'name' => $request->has('name') ? $request->name : NULL,
            'email' => $request->email,
            'profile_image' => $profileImage
        ]);

        $user->syncRoles($request->role);

        return redirect()->route('users.edit', ['id' => $user->id])->with('status', 'User updated!');
    }
}
