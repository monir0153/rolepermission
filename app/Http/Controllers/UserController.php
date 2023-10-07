<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:user list'])->only('AllUser');
        $this->middleware(['permission:create user'])->only('AddUser');
        $this->middleware(['permission:edit user'])->only('EditUser');
        $this->middleware(['permission:delete user'])->only('DeleteUser');
    }

    public function dashboard(){
        return view('dashboard');
    }
    public function AllUser(){
        $users = User::with('roles')->get();
        // return $users;
        return view('user', compact('users'));
    }
    public function AddUser(){
        $roles = Role::all();
        return view('adduser',compact('roles'));
    }
    public function StoreUser(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'role' => ['required']
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->roles);

        return redirect()->route('user.index');
    }
    public function EditUser($id){
        $user = User::find($id);
        $roles = Role::all();
        $data = $user->roles()->pluck('id')->toArray();
        return view('edituser',compact('user','roles','data'));
    }
    public function UpdateUser(Request $request, $id){
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string', 'email','max:255'],
            'password' => ['confirmed'],
            'role' => ['required']
        ]);
        $user = User::find($id);

         $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->syncRoles($request->role);
        
        if($request->has('password')){
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        

        return redirect()->route('user.index');
    }

    public function DeleteUser($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
