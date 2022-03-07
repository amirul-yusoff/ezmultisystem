<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PendingMerchantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $members = User :: where('user_group','=','3')->get();

        return view('pending-merchants.index',compact('user','members'));
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
        $members = User :: find($id);

        return view('pending-merchants.show',compact('user','members'));
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
        $members = User :: find($id);
        
        return view('pending-merchants.edit',compact('user','members'));
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

        $members->update($input);

        return redirect('pending-merchants')->with('success', 'Pending Merchant Updated Successfully');
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

        return redirect()->back()->with('success', 'Pending Merchant Deleted Successfully');
    }

    public function approved(Request $request, $id)
    {
        $input = $request->all();
        $members = User :: find($id);
        $input['status'] = 'Request Approved';
        $members->update($input);

        return redirect()->back()->with('success', 'Pending Merchant has been Approved');
    }

    public function rejected(Request $request, $id)
    {
        $input = $request->all();
        $members = User :: find($id);
        $input['status'] = 'Request Rejected';
        $members->update($input);

        return redirect()->back()->with('success', 'Pending Merchant has been Rejected');
    }
}
