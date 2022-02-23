<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\roles;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RolesController extends Controller
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
        $roles = roles :: all();

        return view('roles.index',compact('user','roles'));
    }

    public function store(Request $request)
    {
        return redirect('roles')->with('success', 'Created');
    }

    public function view()
    {
        $user = Auth::user();

        return view('roles.view',compact('user'));
    }
}
