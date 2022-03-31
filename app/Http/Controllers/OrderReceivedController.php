<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\checkout;
use App\Models\prepare_to_pickup;
use App\Models\pickup_to_acceptjob;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class OrderReceivedController extends Controller
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
        $myOrder = checkout::with('menu.getOwner','geDefaultAddress')->where('merchant_id',$user->id)
        ->where(function($query) {
            return $query
            ->Where('status', '=', 'Order sent to Merchant')
            ->orWhere('status', '=', 'Preparing order');
        })->get();
        $myOrderHistory = checkout::with('menu.getOwner','geDefaultAddress')->where('merchant_id',$user->id)->where('status','!=','Order sent to Merchant')->where('status','!=','Preparing order')->get();

        //Order sent to Merchant
        //Preparing order
        //Waiting For pickup
        //Rider pickup
        //Order Delivered

        return view('order-received.index',compact('user','data','myOrder','myOrderHistory'));
    }

    public function prepareOrder($id)
    {
        $user = Auth::user();
        $data = User ::get();
        $myOrder = checkout::with('menu.getOwner')->where('id',$id)
        ->update([
            'status' => 'Preparing order',
        ]);
        $myOrder = checkout::with('menu.getOwner','geDefaultAddress')->where('id',$id)->get();
        $myOrderHistory = checkout::with('menu.getOwner')->where('merchant_id',$user->id)->where('status','=','Order Delivered')->get();

        $prepareToPickup['checkout_id'] = $id;
        $prepareToPickup['user_id'] = $user->id;
        $prepareToPickupCreate = prepare_to_pickup::create($prepareToPickup);

        return redirect()->back()->with('success', 'Preparing order');
        //Order sent to Merchant
        //Preparing order
        //Waiting For pickup
        //Rider pickup
        //Order Delivered

        return view('order-received.index',compact('user','data','myOrder','myOrderHistory'));

    }

    public function pickupReady($id)
    {
        $user = Auth::user();
        $data = User ::get();
        $myOrder = checkout::with('menu.getOwner','geDefaultAddress')->where('id',$id)
        ->update([
            'status' => 'Waiting For pickup',
        ]);
        $myOrder = checkout::with('menu.getOwner')->where('id',$id)->get();
        $myOrderHistory = checkout::with('menu.getOwner','geDefaultAddress')->where('merchant_id',$user->id)->where('status','=','Order Delivered')->get();

        $pickupToAcceptjob['checkout_id'] = $id;
        $pickupToAcceptjob['user_id'] = $user->id;
        $pickupToAcceptjobCreate = pickup_to_acceptjob::create($pickupToAcceptjob);
        return redirect()->back()->with('success', 'Preparing order');

        //Order sent to Merchant
        //Preparing order
        //Waiting For pickup
        //Rider pickup
        //Order Delivered

        return view('order-received.index',compact('user','data','myOrder','myOrderHistory'));

    }

    public function view()
    {
        $user = Auth::user();
        // dd("asda");
        return view('order.view',compact('user'));
    }

    public function reject(Request $request)
    {
        $input = $request->all();
        dd( $input);
        $user = Auth::user();
        // dd("asda");
        return view('order.view',compact('user'));
    }
}
