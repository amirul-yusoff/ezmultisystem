<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\checkout;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MyInvoiceController extends Controller
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
        $data = User ::get();
        $myOrderHistory = checkout::with('menu.getOwner')
        ->where('user_id',$user->id)
        ->where(function($query) use($user) {
            return $query
            ->Where('user_id',$user->id)
            ->orWhere('merchant_id',$user->id)
            ->orWhere('rider_id',$user->id);
        })->where('status','=','Order Delivered')->get();

        
        return view('invoice.index',compact('user','data','myOrderHistory'));

    }

    public function view()
    {
        $user = Auth::user();
        // dd("asda");
        return view('order.view',compact('user'));
    }
}
