<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
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
}
