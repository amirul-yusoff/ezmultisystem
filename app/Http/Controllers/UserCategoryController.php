<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_category;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserCategoryController extends Controller
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
        $members = User :: where('user_group','=','1')->get();
        $data = user_category :: all();

        return view('user-category.index',compact('user','members','data'));
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        $input['created_by'] = $user->id;
        $userCategoryCreate = user_category::create($input);

        return redirect()->back()->with('success', 'User Category Created');
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
        $myData = user_category::where('id',$id)->update($inputUpdate);

        return redirect()->back()->with('success', 'User Category Updated');
    }
}
