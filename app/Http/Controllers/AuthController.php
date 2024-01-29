<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $req){
        $cred = $req->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt($cred)){
            return redirect()->back();
        }
        if(auth()->user()->role == 'admin'){
            return redirect()->route('home.admin');
        }
        if(auth()->user()->role == 'pustakawan'){
            return redirect()->route('home');
        }
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
