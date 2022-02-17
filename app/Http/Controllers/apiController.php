<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class apiController extends Controller
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
    public function getUsers(){
        $data = User::all();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getDataFromOutside(Request $req){

        dd($req);
        $data = ["name"=>"amirul",
        "email"=>"amirul.yusoff@jatitinggi.com"];

        return response()->json([
            'data' => $data,
        ]);
    }
    
}
