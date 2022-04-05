<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\rider_category;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RiderCategoryController extends Controller
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
        $members = User :: where('user_group','=','2')->get();
        $data = rider_category :: all();

        return view('rider-category.index',compact('user','members','data'));
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        $input['created_by'] = $user->id;
        $riderCategoryCreate = rider_category::create($input);
        return redirect()->back()->with('success', 'Rider Category Created');
    }

    public function edit(Request $request)
    {
        $input = $request->all();
        $user =  Auth::user();
        $inputUpdate['updated_by'] = $user->id;
        $inputUpdate['category_name'] = $input['category_name'];
        $inputUpdate['description'] = $input['description'];
        $inputUpdate['rate_percentages'] = $input['rate_percentages'];
        $id = $input['id'];
        $myData = rider_category::where('id',$id)
        ->update($inputUpdate);

        return redirect()->back()->with('success', 'Rider Category Updated');
    }
}
