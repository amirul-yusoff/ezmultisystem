<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\has_address;
use Illuminate\Support\Facades\Auth;
use Mail;

class MyAddressController extends Controller
{
    public function index()
    {
      $user = Auth::user();

      $data = has_address::where('user_id',$user->id)->where('is_deleted',0)->get();

      return view('my-address.index',compact('user','data'));
    }

    public function create()
    {
      $user = Auth::user();
      // $address = 'BTM 2nd Stage, Bengaluru, Karnataka 560076'; // Address
      // $apiKey = 'AIzaSyBnyn_vmBToXHsnDw5-7bhBzTVO1cDw6tw'; // Google maps now requires an API key.
      // // Get JSON results from this request
      // $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
      // $geo = json_decode($geo, true); // Convert the JSON to an array

      // if (isset($geo['status']) && ($geo['status'] == 'OK')) {
      //   $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
      //   $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
      // }
      // dd($geo, $latitude,$longitude);


      $data = has_address::where('user_id',$user->id)->where('is_deleted',0)->get();
      $url = 'my-address';

      return view('my-address.create',compact('user','data','url'));
    }

    public function store(Request $request)
    {
      $user = Auth::user();
      $input = $request->all();
      $address = $input['address_1'].$input['address_2'].$input['city'].','.$input['state'].','.$input['postcode'].','.$input['country'];

      $apiKey = 'AIzaSyBnyn_vmBToXHsnDw5-7bhBzTVO1cDw6tw'; // Google maps now requires an API key.
      // Get JSON results from this request
      $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
      $geo = json_decode($geo, true); // Convert the JSON to an array

      if (isset($geo['status']) && ($geo['status'] == 'OK')) {
        $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
        $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
        $input['latitude'] = $latitude;
        $input['longitude'] = $longitude;
        $input['user_id'] = $user->id;
      }else{
        return redirect()->back()->with('warning', 'System cannot find the address Please re-Enter the address');   
      }
      $createAddress = has_address::create($input);
      
      return redirect()->back()->with('success', 'Address Created');   
    }

    public function updateDefault(Request $request)
    {
      $id = $request->id;
      $user_id = $request->user_id;

      $reset = has_address::where('user_id',$user_id)->update(['is_default' => 0]);
      $update = has_address::where('id',$id)->update(['is_default' => 1]);
      return $update;

    }


}