<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_category;
use App\Models\user_has_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AllUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $members = User :: with('getUserCategory.getcategoryName')->where('user_group','=','2')->where('status','=','Pending For Approval')->get();

        return view('all-users.index',compact('user','members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $members = User ::  with('getUsersCategory.getusercategoryName')->find($id);

        return view('all-users.show',compact('user','members'));
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
        $members = User :: with('getUsersCategory.getusercategoryName')->find($id);
        $userCategoryList = user_category :: all();
        // dd($members);
        
        return view('all-users.edit',compact('user','members','userCategoryList'));
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
        $members = User :: find($id);
        $input = $request->all();

        //user_has_category
        $inputUserHasCategory['user_id'] = $id;
        $inputUserHasCategory['category_id'] = $input['user_category'];
        $inputUserHasCategory['updated_by'] = $user->id;

        //findPrev
        $deletePrevCategory = user_has_category::where('user_id',$id)->delete();

        //create
        $create = user_has_category::create($inputUserHasCategory);

        $members->update($input);

        return redirect('all-users')->with('success', 'Pending User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $input = $request->all();
        $members = User :: find($id);
        $input['is_deleted'] = '1';
        $members->update($input);

        return redirect()->back()->with('success', 'Pending User Deleted Successfully');
    }

    public function approved(Request $request, $id)
    {
        $input = $request->all();
        $members = User :: find($id);
        $input['status'] = 'Request Approved';
        $members->update($input);

        return redirect()->back()->with('success', 'Pending User has been Approved');
    }

    public function rejected(Request $request, $id)
    {
        $input = $request->all();
        $members = User :: find($id);
        $input['status'] = 'Block';
        $members->update($input);

        return redirect()->back()->with('success', 'Pending User has been Blocked');
    }
}