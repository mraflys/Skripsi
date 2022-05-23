<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class AbsentController extends Controller
{
    public function index()
    {
        // $user = User::find(Auth::user()->id);
        dd(Auth::user()->photo);

        if(Auth::user()->photo == null){
            return view('home');
        }

        

        return view('home');
    }
}
