<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\menu;
use App\Models\menu_has_pictures;
use App\Models\module;
use Carbon\Carbon;

use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function first_page(Request $request)
    {
        $user = Auth::user();
        // return $request->route()->uri();
        return view('first_page',compact('user'));
    }

    public function second_page()
    {
        $user = Auth::user();
        return view('second_page',compact('user'));
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

        return view('home.index',compact('user','menu','members'));
    }


}
