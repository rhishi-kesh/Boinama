<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    public function adminloginshow(){
        return view("auth/login");
    }
    public function adminloginsPOST(Request $request){
        $validated = $request->validate([
            'email' => 'required|max:255|email',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 0])) {
            return redirect('/admin/dashboard');
        } else {
            return back()->with('error','Invalid Email Or Password');
        }

    }
    public function adminlogout(){
        Auth::guard('admin')->logout();
        return redirect('admin');
    }
}
