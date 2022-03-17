<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\permissions;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PermissionsController extends Controller
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
        if (in_array("Permissions", $listPermission) || in_array("Super Admin", $listPermission)){
        $viewPage = 1;
        }
        else{
            return abort(401);
        }
        $members = User :: get();
        $permissions = permissions :: where('is_deleted',0)->get();

        return view('permissions.index',compact('user','members','permissions','editButton','viewButton','deleteButton','viewPage'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $permissions = permissions :: all();
        $currentDate = Carbon::now()->toDateString();
        $url = 'permissions';

        return view('permissions.create',compact('user','permissions','currentDate','url'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions',
        ]);
        $input = $request->all();
        $input['name'] = $input["name"];
        $input['guard_name'] = 'web';
        $input['created_at'] = Carbon::now();
        $input['created_by'] = Auth::user()->id;
        $permissions = permissions::create($input);

        return redirect('permissions')->with('success', 'Created');
    }

    public function show($id)
    {
        $user = Auth::user();
        $members = User :: find($id);
        $permissions = permissions :: find($id);

        return view('permissions.show',compact('user','members','permissions'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $members = User :: find($id);
        $permissions = permissions :: find($id);

        return view('permissions.edit',compact('user','members','permissions'));
    }

    public function update(Request $request,$id)
    {
        $user = Auth::user();
        $permissions = permissions :: find($id);
        $input = $request->all();
        $input['updated_at'] = Carbon::now();

        $permissions->update($input);

        return redirect('permissions')->with('success', 'Permissions updated successfully');
        // ->with('success','Member Profile updated successfully');
    }
    
    public function destroy(Request $request, $id)
    {
        $input = $request->all();
        $permissions = permissions :: find($id);
        $input['is_deleted'] = '1';
        $permissions->update($input);

        return redirect()->back()->with('success', 'Role Deleted Successfully');
    }

    public function view()
    {
        $user = Auth::user();

        return view('permissions.view',compact('user'));
    }
}
