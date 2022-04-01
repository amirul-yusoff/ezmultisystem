<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\roles;
use App\Models\permissions;
use App\Models\role_has_permissions;
use App\Models\coupons;
use App\Models\member_has_roles;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        // dd('index');
        $user = Auth::user();
        $data = coupons :: all();

        return view('invoice.index',compact('user','data'));
    }
    
    public function create(Request $request)
    {
        $user = Auth::user();
        $url = 'coupons';

        return view('coupons.create',compact('user','url'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        // 2022-03-25 08:43:36
        $expiredDate = Carbon::createFromFormat('m-d-yy', $input['expiry_date'])->format('Y:m:d h:m:i');
        $input['expiry_date'] = $expiredDate;
        $input['created_by'] = $user->id;
        $create = coupons::create($input);

        return redirect('coupons')->with('success', 'Coupon Created Successfully');
    }
}
