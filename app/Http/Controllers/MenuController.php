<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\menu;
use App\Models\menu_has_pictures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MenuController extends Controller
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
        $menu = menu :: with('getOneMenuPicture')->where('is_deleted',0)->where('status','=','Pending For Approval')->get();
        $haspic = 0;
        $MenuPicture = "http://bootdey.com/img/Content/avatar/avatar1.png";
        // if($menu->getOneMenuPicture != NULL){
        //     $haspic = 1;
        //     $MenuPicture = "/upload/Menu/".$menu->getOneMenuPicture->menu_id."/".$menu->getOneMenuPicture->hash.".".$menu->getOneMenuPicture->extension;
        // }

        return view('menu.index',compact('user','menu','members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url = 'menu';
        $user = Auth::user();
        //
        return view('menu.create',compact('url','user'));
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
        $user = Auth::user();
        $input = $request->all();
        $input['user_id'] = $user->id;
        $input['created_by'] = $user->id;
        $input['status'] = 'Pending For Approval';
        $menu = menu::create($input);
        
        if (array_key_exists('attachment', $input))
        {
            // dd($input);
            $file = $input['attachment'];
            $timenow = Carbon::now();
            //Renaming file name as hash of original file name + current time + random function. File duplicates not needed.
            $hashname = md5($file->getClientOriginalName().$timenow.rand());

            $store = new menu_has_pictures;

            $store->menu_id = $menu->id;
            $store->description = 'This is Menu Picture';
            $store->category = 'This is Menu Picture';
            $store->filename = $file->getClientOriginalName();
            $store->hash = $hashname;
            $store->extension = $file->getClientOriginalExtension();
            $store->mimetype = $file->getMimeType();
            $store->size = $file->getSize();
            $store->upload_by = Auth::user()->id;
            
            $store->path = $file->move($this->storePath.$menu->id.'/', $hashname.'.'.$file->getClientOriginalExtension())
            ->getPathname();
            $store->save();

            return redirect()->back()->with('success', 'File uploaded');

        } 

        return redirect()->back()->with('success', 'Member Profile updated successfully');
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
        $menu = menu :: find($id);
        $haspic = 0;
        $MenuPicture = "http://bootdey.com/img/Content/avatar/avatar1.png";
        if($menu->getOneMenuPicture != NULL){
            $haspic = 1;
            $MenuPicture = "/upload/Menu/".$menu->getOneMenuPicture->users_id."/".$menu->getOneMenuPicture->hash.".".$menu->getOneMenuPicture->extension;
        }

        return view('menu.show',compact('user','menu','MenuPicture','haspic'));
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
        $members = User ::with('getOneProfilePicture')->find($id);
        $menu = menu ::with('getOneMenuPicture')->find($id);
        $haspic = 0;
        $menuPicture = "http://bootdey.com/img/Content/avatar/avatar1.png";
        if($menu->getOneMenuPicture != NULL){
            $haspic = 1;
            $menuPicture = "/upload/Menu/".$menu->getOneMenuPicture->menu_id."/".$menu->getOneMenuPicture->hash.".".$menu->getOneMenuPicture->extension;
        }

        return view('menu.edit',compact('user','menu','menuPicture','haspic'));
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
        // $members = User :: find($id);
        $menu = menu :: find($id);
        $input = $request->all();

        if (array_key_exists('attachment', $input))
        {
            // dd($input);
            $file = $input['attachment'];
            $timenow = Carbon::now();
            //Renaming file name as hash of original file name + current time + random function. File duplicates not needed.
            $hashname = md5($file->getClientOriginalName().$timenow.rand());

            $store = new menu_has_pictures;

            $store->menu_id = $id;
            $store->description = 'This is Menu Picture';
            $store->category = 'This is Menu Picture';
            $store->filename = $file->getClientOriginalName();
            $store->hash = $hashname;
            $store->extension = $file->getClientOriginalExtension();
            $store->mimetype = $file->getMimeType();
            $store->size = $file->getSize();
            $store->upload_by = Auth::user()->id;
            
            $store->path = $file->move($this->storePath.$id.'/', $hashname.'.'.$file->getClientOriginalExtension())
            ->getPathname();
            $store->save();

            return redirect()->back()->with('success', 'File uploaded');

        } 
        $timenow = Carbon::now();
        $input['updated_at'] = $timenow;
        $input['updated_by'] = $user->id;

        $menu->update($input);

        return redirect('menu')->with('success', 'Menu Updated Successfully');
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
        $id = $input['id'];
        $menu = menu :: find($id);
        $input['is_deleted'] = '1';
        $menu->update($input);

        return redirect()->back()->with('success', 'Menu Deleted Successfully');
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
        $haspic = 0;
        $MenuPicture = "http://bootdey.com/img/Content/avatar/avatar1.png";
        // if($menu->getOneMenuPicture != NULL){
        //     $haspic = 1;
        //     $MenuPicture = "/upload/Menu/".$menu->getOneMenuPicture->users_id."/".$menu->getOneMenuPicture->hash.".".$menu->getOneMenuPicture->extension;
        // }

        return view('menu.approved',compact('user','members','menu','haspic','MenuPicture'));
    }
    
    public function rejectedMenu()
    {
        $user = Auth::user();
        $members = User :: get();
        $menu = menu :: with('getOneMenuPicture')->where('is_deleted',0)->where('status','=','Request Rejected')->get();
        $haspic = 0;
        $MenuPicture = "http://bootdey.com/img/Content/avatar/avatar1.png";
        // if($menu->getOneMenuPicture != NULL){
        //     $haspic = 1;
        //     $MenuPicture = "/upload/Menu/".$menu->getOneMenuPicture->users_id."/".$menu->getOneMenuPicture->hash.".".$menu->getOneMenuPicture->extension;
        // }

        return view('menu.rejected',compact('user','members','menu','haspic','MenuPicture'));
    }
}
