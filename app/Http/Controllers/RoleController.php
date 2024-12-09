<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        
        if(!Auth::check()){

            return redirect()->route('login');
        }

        $roles = Role::get();

        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function create(){

        if(!Auth::check()){

            return redirect()->route('login');
        }
        
        return view('admin.roles.create');
    }

    public function add(Request $request){

        $request->validate([
            'name' => ['required', 'unique:roles']
        ]);

        Role::create(['name' => strtolower(trim($request->name))]);

        return redirect()->route('roles');
    }

    public function view(Request $request){

        $permissions = [];

        $role = Role::where('id', $request->id)->first();

        if(isset($role->name) && isset($role->permissions)){

            $roleHasPermissions = [];
            foreach($role->permissions as $eachRolePermission){
    
                $roleHasPermissions[] = $eachRolePermission->name;
            }

            $allPermissions = Permission::get();

            foreach($allPermissions as $eachPermission){

                if(in_array($eachPermission->name, $roleHasPermissions)){

                    $permissions[] = ['name' => $eachPermission->name, 'roleHasPermission' => true];
                }
                else{

                    $permissions[] = ['name' => $eachPermission->name, 'roleHasPermission' => false];
                }
            }
        }

        return view('admin.roles.permissions', ['role' => $role, 'permissions' => $permissions]);

    }

    public function update(Request $request){

        $request->validate([
            'id' => 'required|exists:roles,id',
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($request->id)  
            ],
        ]);

        $role = Role::where('id', $request->id)->first();

        $role->update([
            'name' => strtolower(trim($request->name))
        ]);
        
        $rolePermissions = $request->role_permissions;
       
        if(isset($role->permissions)){

            $role->revokePermissionTo($role->permissions);
        }

        $role->syncPermissions($rolePermissions);

        return redirect()
                ->route('roles.view', ['id' => $role->id])
                ->with('status', 'Role permissions updated!');
    }

    public function delete(Request $request){

        $request->validate([
            'role' => ['required', 'exists:roles,name']
        ]);

        $role = Role::where('name', $request->role)->first();

        /** if role has permissions remove permissions from the role first */
        if(count($role->permissions) > 0){

            $permissions = $role->permissions->pluck('name');
            foreach($permissions as $eachPermission){

                $role->revokePermissionTo($eachPermission);
            }
        }

        $usersWithRole = User::with('roles')->get()->filter( 
            fn($user) => $user->roles->where('name', $role->name)->isNotEmpty() 
        );

        foreach($usersWithRole as $eachUser){
            
            $eachUser->removeRole($role->name);
        }

        $role->delete();

        return redirect()
                ->route('roles')
                ->with('status', 'Role deleted!');
    }
}
