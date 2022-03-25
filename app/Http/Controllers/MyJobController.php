<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\checkout;
use App\Models\has_address;
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
        $myCurrentAddress = has_address::where('user_id',$user->id)->where('is_default',1)->first();
        $myOrder = checkout::with('menu.getOwner')
        ->where(function($query) use($user) {
            return $query
            ->Where('rider_id', '=', NULL)
            ->orWhere('rider_id', '=', $user->id);
        })
        ->where('status','!=','Order sent to Merchant')
        ->where('status','!=','Order Delivered')
        ->where('status','!=','Preparing order')
        ->get();
        // dd($myOrder);
        $myOrderHistory = checkout::with('menu.getOwner','geDefaultAddress')->where('rider_id',$user->id)->where('status','=','Order Delivered')->get();

        //Order sent to Merchant
        //Preparing order
        //Waiting For pickup
        //Rider pickup
        //Order Delivered

        return view('my-jobs.index',compact('user','data','myOrder','myOrderHistory','myCurrentAddress'));
    }

    public function acceptJobs($id)
    {
        $user = Auth::user();
        $data = User ::get();
        $myCurrentAddress = has_address::where('user_id',$user->id)->where('is_default',1)->first();
        $myOrder = checkout::with('menu.getOwner')->where('id',$id)
        ->update([
            'status' => 'Rider going to pickup location',
            'rider_id'=> $user->id,
        ]);
        $myOrder = checkout::with('menu.getOwner','geDefaultAddress')->where('id',$id)->where('status','!=','Order Delivered')->get();
        $myOrderHistory = checkout::with('menu.getOwner')->where('rider_id',$user->id)->where('status','=','Order Delivered')->get();
        return redirect()->back()->with('success', 'Preparing order');
        //Order sent to Merchant
        //Preparing order
        //Waiting For pickup
        //Rider going to pickup location
        //Rider pickup
        //Order Delivered

        return view('my-jobs.index',compact('user','data','myOrder','myOrderHistory','myCurrentAddress'));

    }
    
    public function riderPickup($id)
    {
        $user = Auth::user();
        $data = User ::get();
        $myCurrentAddress = has_address::where('user_id',$user->id)->where('is_default',1)->first();
        $myOrder = checkout::with('menu.getOwner')->where('id',$id)
        ->update([
            'status' => 'Rider pickup',
        ]);
        $myOrder = checkout::with('menu.getOwner','geDefaultAddress')->where('id',$id)->get();
        $myOrderHistory = checkout::with('menu.getOwner')->where('rider_id',$user->id)->where('status','=','Order Delivered')->get();
        return redirect()->back()->with('success', 'Preparing order');
        //Order sent to Merchant
        //Preparing order
        //Waiting For pickup
        //Rider going to pickup location
        //Rider pickup
        //Order Delivered

        return view('my-jobs.index',compact('user','data','myOrder','myOrderHistory','myCurrentAddress'));

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

    function getDistance($addressFrom, $addressTo, $unit = ''){
        // Google API key
        $apiKey = api::where('id',1)->first();
        $apiKey =  $apiKey->key;
        
        // Change address format
        // $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
        // $formattedAddrFrom    = str_replace(',', '+', $formattedAddrFrom);
        // $formattedAddrFrom    = str_replace('++', '+', $formattedAddrFrom);
        // $formattedAddrTo     = str_replace(' ', '+', $addressTo);
        // dd($formattedAddrFrom);
        // // Geocoding API request with start address
        // $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&key='.$apiKey);
        // $outputFrom = json_decode($geocodeFrom);
        // if(!empty($outputFrom->error_message)){
        //     return $outputFrom->error_message;
        // }
        // dd($geocodeFrom);
        
        // // Geocoding API request with end address
        // $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
        // $outputTo = json_decode($geocodeTo);
        // if(!empty($outputTo->error_message)){
        //     return $outputTo->error_message;
        // }
        // dd($geocodeFrom);
        // Get latitude and longitude from the geodata
        
        $latitudeFrom    = $addressFrom->latitude;
        $longitudeFrom    = $addressFrom->longitude;
        $latitudeTo        = $addressTo->latitude;
        $longitudeTo    = $addressTo->longitude;
        // dd($latitudeFrom,$longitudeFrom,$latitudeTo,$longitudeTo);
        
        // Calculate distance between latitude and longitude
        $theta    = $longitudeFrom - $longitudeTo;
        $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = $dist * 60 * 1.1515;
        
        // Convert unit and return distance
        $unit = strtoupper($unit);
        if($unit == "K"){
            return round($miles * 1.609344, 2).' km';
        }elseif($unit == "M"){
            return round($miles * 1609.344, 2).' meters';
        }else{
            return round($miles, 2).' miles';
        }
    }
}
