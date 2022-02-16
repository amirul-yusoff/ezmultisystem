<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

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
        $this->user = Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function dashboard()
    {
        $user = Auth::user();
        // return view('home');
        // return view('adminlte');
        return view('dashboard',compact('user'));
    }

    public function first_page(Request $request)
    {
        $user = Auth::user();
        // return $request->route()->uri();
        return view('first_page',compact('user'));
    }

    public function second_page()
    {
        $user = Auth::user();
        return view('second_page',compact('user'));
    }
}
