<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:role list'])->only('AllRole');
        $this->middleware(['permission:create role'])->only('AddRole');
        $this->middleware(['permission:edit role'])->only('EditRole');
        $this->middleware(['permission:delete role'])->only('Destroy');
    }

    public function index(){
        $roles = Role::latest()->get();

        return view('role.index', compact('roles'));
    }

    public function AddRole(){
        $permissions = Permission::all();
        return view('role.addrole', compact('permissions'));
    }

    public function Store(Request $request){
        // return $request->all();
        $this->validate($request, [
            'name' =>'required|unique:roles',
            // 'permissions' =>'required',
        ]);

        $role = Role::create($request->only('name'));
        $role->syncPermissions($request->permissions);
        return redirect()->route('role');
    }

    public function EditRole($id){

        $permissions = Permission::all();
        $role = Role::with('permissions')->find($id);
        $data = $role->permissions()->pluck('id')->toArray();
        return view('role.edit', compact('role', 'permissions','data'));
    }

    public function UpdateRole(Request $request,$id){
        // $this->validate($request, [
        //     'name' =>"required|unique:roles",
        //     // 'permissions' =>'required',
        // ]);


        $role = Role::find($id);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('role');
    }
    public function Destroy($id){
        $role = Role::find($id);
        $role->delete();
        return redirect()->back();
    }
}
