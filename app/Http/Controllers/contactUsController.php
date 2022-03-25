<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class contactUsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->user = Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        // return view('adminlte');
        return view('contact-us.index');
    }
    
}
