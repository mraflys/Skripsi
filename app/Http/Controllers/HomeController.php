<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FaceDataset;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $faceDataset = FaceDataset::where('id_user', Auth::user()->id)->get();
        $id = Auth::user()->id;
        if(Auth::user()->role == 'administrator'){
            return view('home');
        }else{
            if(count($faceDataset) < 5){
                return view('absent.dataset-absent', compact('faceDataset','id'));
            }else{
                return view('home');
            }
        }
    }
}
