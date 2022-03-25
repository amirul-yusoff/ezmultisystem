<?php

namespace App\Http\Controllers;

// use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\module;
use App\Models\User;
use App\Models\permissions;
use App\Models\users_has_pictures;
use App\Models\member_has_roles;
use App\Models\roles;
use Carbon\Carbon;

use Illuminate\Http\Request;

class AdminMembersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->storePath = public_path('\upload\Users\\');
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
        $members = User :: get();

        return view('members.admin',compact('user','members'));
    }

    public function view($id)
    {
        $user = Auth::user();
        $members = User ::with('getOneProfilePicture')->find($id);
        $haspic = 0;
        $profilePicture = "http://bootdey.com/img/Content/avatar/avatar1.png";
        if($members->getOneProfilePicture != NULL){
            $haspic = 1;
            $profilePicture = "/upload/Users/".$members->getOneProfilePicture->users_id."/".$members->getOneProfilePicture->hash.".".$members->getOneProfilePicture->extension;
        }

        return view('members.view',compact('user','members','profilePicture','haspic'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $members = User ::with('getOneProfilePicture')->find($id);
        $haspic = 0;
        $profilePicture = "http://bootdey.com/img/Content/avatar/avatar1.png";
        if($members->getOneProfilePicture != NULL){
            $haspic = 1;
            $profilePicture = "/upload/Users/".$members->getOneProfilePicture->users_id."/".$members->getOneProfilePicture->hash.".".$members->getOneProfilePicture->extension;
        }
        $permissions = permissions :: all();
        $allroles = roles :: where('is_deleted',0)->get();
        $currentRole = member_has_roles ::with('getRoleName')->where('member_id',$members->id)->get();

        return view('members.edit',compact('user','members','profilePicture','haspic','permissions','allroles','currentRole'));
    }

    public function update(Request $request,$id)
    {
        $user = Auth::user();
        $input = $request->all();
        $members = User :: find($id);

        $allroles = roles :: all();
        
        // $roleHasPermissions = member_has_roles :: all();
        // $createRoleHasPermissions = []; 
        // $permissions = (int)$input['permission'];
        // $createRoleHasPermissions['role_id'] = $roles->id;
        // $createRoleHasPermissions['member_id'] = $members;
        // $createInfo = member_has_roles::create($createRoleHasPermissions);

        if(array_key_exists('password',$input)){
            $input['password'] = $input['password'];
        }
        if(array_key_exists('roles',$input)){
            $createRole = [];
            member_has_roles :: where('member_id',$members->id)->delete();
            
            foreach($input['roles'] as $key => $roleData){
                $createRole['member_id'] = $members->id;
                $createRole['role_id'] = (int)$roleData;
                member_has_roles::create($createRole);
            }
        }
        if (array_key_exists('attachment', $input))
        {
            // dd($input);
            $file = $input['attachment'];
            $timenow = Carbon::now();
            //Renaming file name as hash of original file name + current time + random function. File duplicates not needed.
            $hashname = md5($file->getClientOriginalName().$timenow.rand());

            $store = new users_has_pictures;

            $store->users_id = $id;
            $store->description = 'This is Profile Picture';
            $store->category = 'This is Profile Picture';
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
        $members->update($input);

        return redirect()->back()->with('success', 'Member Profile updated successfully');
        // ->with('success','Member Profile updated successfully');
    }
    
    public function upload(Request $request,$id)
    {   
        dd("sadasd");
        $input = $request->all();
        if (array_key_exists('attachment', $input))
        {
            // dd($input);
            $file = $input['attachment'];
            $timenow = Carbon::now();
            //Renaming file name as hash of original file name + current time + random function. File duplicates not needed.
            $hashname = md5($file->getClientOriginalName().$timenow.rand());

            $store = new users_has_pictures;

            $store->users_id = $id;
            $store->description = 'This is Profile Picture';
            $store->category = 'This is Profile Picture';
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

    }
}
