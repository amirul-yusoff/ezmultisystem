<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\menu;
use App\Models\user_has_zones;
use App\Models\merchant_has_zones;
use App\Models\rider_has_zones;
use App\Models\zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ZoneMenagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->storePath = public_path('\upload\Menu\\');
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    public function index()
    {
        $user = Auth::user();
        $listPermission = User :: getAllPermissions($user->id);
        $editButton = 0;
        $viewButton = 0;
        $deleteButton = 0;
        $viewPage = 0;
        if (in_array("Edit", $listPermission) || in_array("Super Admin", $listPermission)){
        $editButton = 1;
        }
        if (in_array("View", $listPermission) || in_array("Super Admin", $listPermission)){
        $viewButton = 1;
        }
        if (in_array("Delete", $listPermission) || in_array("Super Admin", $listPermission)){
        $deleteButton = 1;
        }
        if (in_array("Zone Menagement", $listPermission) || in_array("Super Admin", $listPermission)){
        $viewPage = 1;
        }
        else{
            return abort(401);
        }
        $members = User :: get();
        $zone = zone :: with('getUser.getUserZone','getMerchant.getMerchantZone','getRider.getRiderZone')->where('is_deleted',0)->get();
        
        return view('zone-menagement.index',compact('user','zone','members','editButton','viewButton','deleteButton','viewPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url = 'zone-menagement';
        $user = Auth::user();
        $member = User ::get();
        $merchant = User ::where('user_group','=','3')->get();
        $rider = User ::where('user_group','=','4')->get();
        //
        return view('zone-menagement.create',compact('url','user','member','merchant','rider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $timenow = Carbon::now();
        $user = Auth::user();
        $url = 'zone-menagement';
        $input = $request->all();
        // dd($input['zone']);
        $input['created_by'] = $user->id;
        $input['created_at'] = $timenow;
        $userHasZones = user_has_zones :: all();
        $merchantHasZones = merchant_has_zones :: all();
        $riderHasZones = rider_has_zones :: all();
        $zone = zone::create($input);
        if(array_key_exists('user',$input)){
            $createUser = [];
            
            foreach($input['user'] as $key => $UserData){
                $createUser['user_id'] = (int)$UserData;
                $createUser['zone_id'] = $zone->id;
                user_has_zones::create($createUser);
            }
        }
        if(array_key_exists('merchant',$input)){
            $createMerchant = [];
            
            foreach($input['merchant'] as $key => $MerchantData){
                $createMerchant['user_id'] = (int)$MerchantData;
                $createMerchant['zone_id'] = $zone->id;
                merchant_has_zones::create($createMerchant);
            }
        }
        if(array_key_exists('rider',$input)){
            $createRider = [];
            
            foreach($input['rider'] as $key => $RiderData){
                $createRider['user_id'] = (int)$RiderData;
                $createRider['zone_id'] = $zone->id;
                rider_has_zones::create($createRider);
            }
        }

        return redirect('zone-menagement')->with('success', 'Zone Menagement Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        // $zone = zone :: find($id);
        $zone = zone :: with('getUser.getUserZone','getMerchant.getMerchantZone','getRider.getRiderZone')->where('is_deleted',0)->find($id);

        return view('zone-menagement.show',compact('user','zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $member = User ::get();
        $merchant = User ::where('user_group','=','3')->get();
        $rider = User ::where('user_group','=','4')->get();
        $zone = zone ::find($id);
        $currentUser = user_has_zones :: with('getUserZone')->where('zone_id',$zone->id)->get();
        $currentMerchant = merchant_has_zones :: with('getMerchantZone')->where('zone_id',$zone->id)->get();
        $currentRider = rider_has_zones :: with('getRiderZone')->where('zone_id',$zone->id)->get();
// dd($currentUser);
        return view('zone-menagement.edit',compact('user','zone','member','currentUser','merchant','currentMerchant','rider','currentRider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = Auth::user();
        $timenow = Carbon::now();
        $zone = zone :: find($id);
        $input = $request->all();
        $input['updated_by'] = $user->id;
        $input['updated_at'] = $timenow;

        if(array_key_exists('user',$input)){
            $createUser = [];
            user_has_zones :: where('zone_id',$zone->id)->delete();
            
            foreach($input['user'] as $key => $UserData){
                $createUser['user_id'] = (int)$UserData;
                $createUser['zone_id'] = $zone->id;
                user_has_zones::create($createUser);
            }
        }
        if(array_key_exists('merchant',$input)){
            $createMerchant = [];
            merchant_has_zones :: where('zone_id',$zone->id)->delete();
            
            foreach($input['merchant'] as $key => $MerchantData){
                $createMerchant['user_id'] = (int)$MerchantData;
                $createMerchant['zone_id'] = $zone->id;
                merchant_has_zones::create($createMerchant);
            }
        }
        if(array_key_exists('rider',$input)){
            $createRider = [];
            rider_has_zones :: where('zone_id',$zone->id)->delete();
            
            foreach($input['rider'] as $key => $RiderData){
                $createRider['user_id'] = (int)$RiderData;
                $createRider['zone_id'] = $zone->id;
                rider_has_zones::create($createRider);
            }
        }

        $zone->update($input);

        return redirect('zone-menagement')->with('success', 'Zone Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $id = $input['id'];
        $zone = zone :: find($id);
        $input['is_deleted'] = '1';
        $zone->update($input);

        return redirect()->back()->with('success', 'Zone Deleted Successfully');
    }

    public function approved(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        $menu = menu :: find($id);
        $input['status'] = 'Request Approved';
        $menu->update($input);
        
        return redirect()->back()->with('success', 'Approved Menu Successfully');
    }
    
    public function rejected(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        $menu = menu :: find($id);
        $input['status'] = 'Request Rejected';
        $menu->update($input);

        return redirect()->back()->with('success', 'Rejected Menu Successfully');
    }
    
    public function reapproved(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        $menu = menu :: find($id);
        $input['status'] = 'Pending For Approval';
        $menu->update($input);

        return redirect()->back()->with('success', 'Re-Approve Menu Successfully');
    }

    public function approvedMenu()
    {
        $user = Auth::user();
        $members = User :: get();
        $menu = menu :: with('getOneMenuPicture')->where('is_deleted',0)->where('status','=','Request Approved')->get();
        
        return view('zone-menagement.approved',compact('user','members','menu','haspic','MenuPicture'));
    }
    
    public function rejectedMenu()
    {
        $user = Auth::user();
        $members = User :: get();
        $menu = menu :: with('getOneMenuPicture')->where('is_deleted',0)->where('status','=','Request Rejected')->get();
        
        return view('zone-menagement.rejected',compact('user','members','menu','haspic','MenuPicture'));
    }
}
