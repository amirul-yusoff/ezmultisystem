<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\roles;
use App\Models\permissions;
use App\Models\role_has_permissions;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class RolesController extends Controller
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
        $roles = roles :: with('getPermissions.getPermissionsName')->where('is_deleted',0)->get();
        // dd($roles);
        $members = User :: all();

        return view('roles.index',compact('user','roles','members'));
    }
    
    public function create(Request $request)
    {
        $user = Auth::user();
        $roles = roles :: all();
        $currentDate = Carbon::now()->toDateString();
        $url = 'roles';
        $permissions = permissions :: where('is_deleted',0)->get();

        return view('roles.create',compact('user','roles','currentDate','url','permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
        ]);
        $input = $request->all();
        $input['name'] = $input["name"];
        $input['guard_name'] = 'web';
        $input['created_at'] = Carbon::now();
        $input['created_by'] = Auth::user()->id;
        $roleHasPermissions = role_has_permissions :: all();
        $roles = roles::create($input);

        // $createRoleHasPermissions = []; 
        // $permissions = (int)$input['permission'];
        // $createRoleHasPermissions['role_id'] = $roles->id;
        // $createRoleHasPermissions['permission_id'] = $permissions;
        // $createInfo = role_has_permissions::create($createRoleHasPermissions);
        if(array_key_exists('permission',$input)){
            $createPermission = [];
            
            foreach($input['permission'] as $key => $permissionData){
                $createPermission['permission_id'] = (int)$permissionData;
                $createPermission['role_id'] = $roles->id;
                role_has_permissions::create($createPermission);
            }
        }

        return redirect('roles')->with('success', 'Role Created Successfully');
    }

    public function show($id)
    {
        $user = Auth::user();
        $members = User :: find($id);
        $roles = roles :: with('getPermissions.getPermissionsName')->where('is_deleted',0)->find($id);
        // dd($roles);
        // $roles = roles :: find($id);

        return view('roles.show',compact('user','members','roles'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $members = User :: find($id);
        $roles = roles :: find($id);
        $permissions = permissions :: where('is_deleted',0)->get();
        $currentRole = role_has_permissions :: with('getPermissionsName')->where('role_id',$roles->id)->get();
        // dd($currentRole);

        return view('roles.edit',compact('user','members','roles','permissions','currentRole'));
    }

    public function update(Request $request,$id)
    {
        $user = Auth::user();
        $roles = roles :: find($id);
        $input = $request->all();
        $input['updated_at'] = Carbon::now();

        if(array_key_exists('permission',$input)){
            $createPermission = [];
            role_has_permissions :: where('role_id',$roles->id)->delete();
            
            foreach($input['permission'] as $key => $permissionData){
                $createPermission['permission_id'] = (int)$permissionData;
                $createPermission['role_id'] = $roles->id;
                role_has_permissions::create($createPermission);
            }
        }

        $roles->update($input);

        return redirect('roles')->with('success', 'Role Updated Successfully');
        // ->with('success','Member Profile updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $input = $request->all();
        $roles = roles :: find($id);
        $input['is_deleted'] = '1';
        $roles->update($input);

        return redirect()->back()->with('success', 'Role Deleted Successfully');
    }

    public function view()
    {
        $user = Auth::user();

        return view('roles.view',compact('user'));
    }
}
