<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(){

        if(!Auth::check()){

            return redirect()->route('login');
        }

        $permissions = Permission::get();

        return view('admin.permissions.index', ['permissions' => $permissions]);
    }

    public function create(){

        if(!Auth::check()){

            return redirect()->route('login');
        }
        
        return view('admin.permissions.create');
    }

    public function add(Request $request){

        $request->validate([
            'name' => ['required', 'unique:permissions']
        ]);

        Permission::create([
            'name' => strtolower(trim($request->name))
        ]);

        return redirect()->route('permissions');
    }

    public function delete(Request $request){

        $request->validate([
            'permission' => ['required', 'exists:permissions,name']
        ]);

        $roles = Role::get();

        foreach($roles as $eachRole){

            $eachRole->revokePermissionTo($request->permission);
        }

        Permission::where('name', $request->permission)->delete();

        return redirect()
                ->route('permissions')
                ->with('status', 'Permissions deleted!');
    }

    public function view(Request $request){

       $request->validate([
        'id' => ['required', 'exists:permissions,id'] 
       ]);

       $permission = Permission::where('id', $request->id)->first();

       return view('admin.permissions.edit', ['permission' => $permission]);
    }

    public function update(Request $request){

        $request->validate([
            'id' => 'required|exists:permissions,id',
            'permission' => [
                'required',
                Rule::unique('permissions', 'name')->ignore($request->id)  
            ],
        ]);

        $permission = Permission::where('id', $request->id)->first();

        $permission->update([
            'name' => $request->permission
        ]);

        return redirect()->route('permissions.view', ['id' => $permission->id])->with(
            'status', 'Permission updated!'
        );
    }
}
