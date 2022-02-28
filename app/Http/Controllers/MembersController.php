<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\roles;
use App\Models\permissions;
use App\Models\role_has_permissions;
use App\Models\member_has_roles;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class MembersController extends Controller
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
        $roles = roles :: all();
        $members = User :: all();

        return view('roles.index',compact('user','roles','members'));
    }
    
    public function create(Request $request)
    {
        $user = Auth::user();
        $roles = roles :: all();
        $currentDate = Carbon::now()->toDateString();
        $url = 'roles';
        $permissions = permissions :: all();

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

        $createRoleHasPermissions = []; 
        $permissions = (int)$input['permission'];
        // dd($roles->id, $input['permission'], $permissions);
        $createRoleHasPermissions['role_id'] = $roles->id;
        $createRoleHasPermissions['permission_id'] = $permissions;
        $createInfo = role_has_permissions::create($createRoleHasPermissions);

        return redirect('roles')->with('success', 'Role Created Successfully');
    }

    public function show($id)
    {
        $user = Auth::user();
        $members = User :: find($id);
        $roles = roles :: find($id);

        return view('roles.show',compact('user','members','roles'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $members = User :: find($id);
        $roles = roles :: find($id);

        return view('roles.edit',compact('user','members','roles'));
    }

    public function update(Request $request,$id)
    {
        $user = Auth::user();
        $roles = roles :: find($id);
        $input = $request->all();
        $input['updated_at'] = Carbon::now();

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
