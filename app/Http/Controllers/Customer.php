<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Customer extends Controller
{
    public function customerLogout(){
        Auth::logout();
        return back()->with('error', 'You Are Logout');
    }
    public function customerlogin(){
        return view('livewire.frontend.user-login');
    }
    public function customerloginpost(Request $request){

        $this->validate($request,[
            'email' => 'required|max:255|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {

            return redirect('/')->withSuccess('You have Successfully loggedin');

        }else{
            return back()->with('invalid','Invalid Email Or Password');
        }
    }
}
