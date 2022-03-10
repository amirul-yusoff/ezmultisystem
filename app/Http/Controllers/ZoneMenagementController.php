<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\menu;
use App\Models\menu_has_pictures;
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
        $members = User :: get();
        $zone = zone :: where('is_deleted',0)->get();
        
        return view('zone-menagement.index',compact('user','zone','members'));
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
        //
        return view('zone-menagement.create',compact('url','user'));
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
        $input['created_by'] = $user->id;
        $input['created_at'] = $timenow;
        $zone = zone::create($input);

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
        $zone = zone :: find($id);

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
        $zone = zone ::find($id);

        return view('zone-menagement.edit',compact('user','zone'));
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
