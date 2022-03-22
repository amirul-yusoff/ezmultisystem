<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\checkout;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MyJobController extends Controller
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
        $userID = $user->id;
        $data = User ::get();
        $myOrder = checkout::with('menu.getOwner')
        ->where(function($query) use($user) {
            return $query
            ->Where('rider_id', '=', NULL)
            ->orWhere('rider_id', '=', $user->id);
        })
        ->where('status','!=','Order sent to Merchant')->where('status','!=','Preparing order')->where('status','!=','Order Delivered')
        ->get();
        $myOrderHistory = checkout::with('menu.getOwner')->where('rider_id',$user->id)->where('status','=','Order Delivered')->get();

        //Order sent to Merchant
        //Preparing order
        //Waiting For pickup
        //Rider pickup
        //Order Delivered

        return view('my-jobs.index',compact('user','data','myOrder','myOrderHistory'));
    }

    public function acceptJobs($id)
    {
        $user = Auth::user();
        $data = User ::get();
        $myOrder = checkout::with('menu.getOwner')->where('id',$id)
        ->update([
            'status' => 'Rider going to pickup location',
            'rider_id'=> $user->id,
        ]);
        $myOrder = checkout::with('menu.getOwner')->where('id',$id)->where('status','!=','Order Delivered')->get();
        $myOrderHistory = checkout::with('menu.getOwner')->where('rider_id',$user->id)->where('status','=','Order Delivered')->get();
        return redirect()->back()->with('success', 'Preparing order');
        //Order sent to Merchant
        //Preparing order
        //Waiting For pickup
        //Rider going to pickup location
        //Rider pickup
        //Order Delivered

        return view('my-jobs.index',compact('user','data','myOrder','myOrderHistory'));

    }
    
    public function riderPickup($id)
    {
        $user = Auth::user();
        $data = User ::get();
        $myOrder = checkout::with('menu.getOwner')->where('id',$id)
        ->update([
            'status' => 'Rider pickup',
        ]);
        $myOrder = checkout::with('menu.getOwner')->where('id',$id)->get();
        $myOrderHistory = checkout::with('menu.getOwner')->where('rider_id',$user->id)->where('status','=','Order Delivered')->get();
        return redirect()->back()->with('success', 'Preparing order');
        //Order sent to Merchant
        //Preparing order
        //Waiting For pickup
        //Rider going to pickup location
        //Rider pickup
        //Order Delivered

        return view('my-jobs.index',compact('user','data','myOrder','myOrderHistory'));

    }

    public function itemDelivered($id)
    {
        $user = Auth::user();
        $data = User ::get();
        $myOrder = checkout::with('menu.getOwner')->where('id',$id)
        ->update([
            'status' => 'Order Delivered',
        ]);
        $myOrder = checkout::with('menu.getOwner')->where('id',$id)->get();
        $myOrderHistory = checkout::with('menu.getOwner')->where('user_id',$user->id)->where('status','=','Order Delivered')->get();
        return redirect()->back()->with('success', 'Preparing order');
        //Order sent to Merchant
        //Preparing order
        //Waiting For pickup
        //Rider going to pickup location
        //Rider pickup
        //Order Delivered

        return view('my-jobs.index',compact('user','data','myOrder','myOrderHistory'));

    }

    public function view()
    {
        $user = Auth::user();
        // dd("asda");
        return view('order.view',compact('user'));
    }
}
