<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $user = User::where('id',15)->first();
        return view('home',compact('user'));
    }


    public function home() {
     $user = User::where('id',15)->first();
        return view('home',compact('user'));
    }


  public function radio() {
    return view('radio');
     }


  public function breakdown() {
    return view('breakdown');
}


  public function social() {
    return view('social');
}



  public function about() {
    return view('about');
}

}
