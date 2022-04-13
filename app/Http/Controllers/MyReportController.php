<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\checkout;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Http\Request;

class MyReportController extends Controller
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
        $data = User ::get();
        $myOrderHistory = checkout::with('menu.getOwner')
        ->where('user_id',$user->id)
        ->where(function($query) use($user) {
            return $query
            ->Where('user_id',$user->id)
            ->orWhere('merchant_id',$user->id)
            ->orWhere('rider_id',$user->id);
        })->where('status','=','Order Delivered')->get();

        
        return view('report.index',compact('user','data','myOrderHistory'));

    }

    public function view()
    {
        $user = Auth::user();
        // dd("asda");
        return view('order.view',compact('user'));
    }

    public function generatePDF($id)
    {
        $user = Auth::user();
        $myInvoice = checkout::with('menu.getOwner')->where('id',$id)->first();
        // $grandTotal = checkout::with('menu.getOwner')->where('id',$id)->sum('price');
        // dd($id,$myInvoice);
        // dd("asda");
        // return view('report.generatePDF',compact('user'));
        $myOrderHistory = checkout::with('menu.getOwner')
        ->where('user_id',$user->id)
        ->where(function($query) use($user) {
            return $query
            ->Where('user_id',$user->id)
            ->orWhere('merchant_id',$user->id)
            ->orWhere('rider_id',$user->id);
        })->where('status','=','Order Delivered')->get();
        $grandTotal = checkout::with('menu.getOwner')
        ->where('user_id',$user->id)
        ->where(function($query) use($user) {
            return $query
            ->Where('user_id',$user->id)
            ->orWhere('merchant_id',$user->id)
            ->orWhere('rider_id',$user->id);
        })->where('status','=','Order Delivered')->sum('price');
        // dd($grandTotal);
        
        $pdf = PDF::loadView('report.generatePDF', compact('user','myOrderHistory','grandTotal','myInvoice'));
        // return $pdf->download('itsolutionstuff.pdf');
        return $pdf->stream('xcc.pdf');
    }
}
