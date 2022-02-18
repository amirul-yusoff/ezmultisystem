<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileController extends Controller
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
    
    public function index()
    {
        $user = Auth::user();
        // return view('home');
        // return view('adminlte');
        $data = User ::get();
        return view('profile.index',compact('user','data'));
    }

    public function view()
    {
        $user = Auth::user();
        // return view('home');
        // return view('adminlte');
        return view('profile.view',compact('user'));
    }
}
