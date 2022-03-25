<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\has_address;
use App\Models\api;
use Illuminate\Support\Facades\Auth;
use Mail;

class MyAddressController extends Controller
{
    public function index()
    {
      $user = Auth::user();

      $data = has_address::where('user_id',$user->id)->where('is_deleted',0)->get();

      $addressFrom = 'No. 23 & 25, Jalan Temenggung 13/9, Bandar Mahkota Cheras, 43200 Kajang, Selangor';
      $addressTo   = 'Lingkaran Syed Putra, Mid Valley City, 59200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur';

      // Get distance in km
      // $distance = $this->getDistance($addressFrom, $addressTo, "K");
      // dd($distance);

      return view('my-address.index',compact('user','data'));
    }

    public function create()
    {
      $user = Auth::user();
      $data = has_address::where('user_id',$user->id)->where('is_deleted',0)->get();
      $url = 'my-address';

      return view('my-address.create',compact('user','data','url'));
    }

    public function store(Request $request)
    {
      $user = Auth::user();
      $input = $request->all();
      $address = $input['address_1'].$input['address_2'].$input['city'].','.$input['state'].','.$input['postcode'].','.$input['country'];

      $apiKey = api::where('id',1)->first();
      $apiKey =  $apiKey->key;
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

    function getDistance($addressFrom, $addressTo, $unit = ''){
      // Google API key
      $apiKey = api::where('id',1)->first();
      $apiKey =  $apiKey->key;
      
      // Change address format
      $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
      $formattedAddrTo     = str_replace(' ', '+', $addressTo);
      
      // Geocoding API request with start address
      $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
      $outputFrom = json_decode($geocodeFrom);
      if(!empty($outputFrom->error_message)){
          return $outputFrom->error_message;
      }
      
      // Geocoding API request with end address
      $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
      $outputTo = json_decode($geocodeTo);
      if(!empty($outputTo->error_message)){
          return $outputTo->error_message;
      }
      dd($outputFrom);
      // Get latitude and longitude from the geodata
      $latitudeFrom    = $geocodeFrom->results[0]->geometry->location->lat;
      $longitudeFrom    = $geocodeFrom->results[0]->geometry->location->lng;
      $latitudeTo        = $geocodeTo->results[0]->geometry->location->lat;
      $longitudeTo    = $geocodeTo->results[0]->geometry->location->lng;
      
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