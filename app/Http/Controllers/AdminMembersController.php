<?php

namespace App\Http\Controllers;

// use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\module;
use App\Models\User;

use Illuminate\Http\Request;

class AdminMembersController extends Controller
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
        $members = User :: get();

        return view('members.admin',compact('user','members'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $members = User :: find($id);

        return view('members.edit',compact('user','members'));
    }
}
