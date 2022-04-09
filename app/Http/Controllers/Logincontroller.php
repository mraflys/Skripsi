<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Logincontroller extends Controller
{

    protected function index()
    {
       
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
 
        if (Auth::attempt($credentials)) {
            dd('berhasil');
            // Authentication passed...
            // return redirect()->intended('dashboard');
        }else{
            dd('tidak');
        }
    }
}
