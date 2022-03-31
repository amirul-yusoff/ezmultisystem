<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\module;

use Illuminate\Http\Request;

class dashboardController extends Controller
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
        $member = User::get();

        return view('dashboard.index',compact('user','member'));
    }

    public function listproduct()
    {
        $user = Auth::user();
        $member = User::get();
        return view('product.list',compact('products','member'));
    }

    public function updateStatus(Request $request)
    {
        $isactive = $request->is_active;
        $id = $request->user_id;
        $updateUser = User :: find($id)->update([
            'is_active' => $isactive,
        ]);

        return response()->json(['success'=>'Status change successfully.']); 
        dd('sad');
        $user = Auth::user();
        $user->is_active = $request->is_active; 
        $user->save(); 
        return response()->json(['success'=>'Status change successfully.']); 
    }

}
