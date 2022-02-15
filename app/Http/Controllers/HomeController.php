<?php

namespace App\Http\Controllers;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        return view('adminlte');
    }

    public function first_page(Request $request)
    {
        // return $request->route()->uri();
        return view('first_page');
    }

    public function second_page()
    {
        return view('second_page');
    }
}
