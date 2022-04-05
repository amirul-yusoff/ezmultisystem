<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\menu;
use App\Models\coupons;
use App\Models\checkout;
use App\Models\checkout_payment;
use App\Models\checkout_to_prepare;
use App\Models\menu_has_pictures;
use App\Models\has_address;
use App\Models\module;
use Carbon\Carbon;
use PDF;
use DateTime;
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
        $menu = menu :: with('getOneMenuPicture','getOwner','geDefaultAddress')->where('is_deleted',0)->where('status','=','Pending For Approval')->get();
        $myCurrentAddress = has_address::where('user_id',$user->id)->where('is_default',1)->first();
        $haspic = 0;
        $MenuPicture = "http://bootdey.com/img/Content/avatar/avatar1.png";
        // if($menu->getOneMenuPicture != NULL){
        //     $haspic = 1;
        //     $MenuPicture = "/upload/Menu/".$menu->getOneMenuPicture->menu_id."/".$menu->getOneMenuPicture->hash.".".$menu->getOneMenuPicture->extension;
        // }

        return view('home.index',compact('user','menu','members','myCurrentAddress'));
    }

    public function cart()
    {
        $user = Auth::user();

        return view('my-menu.cart',compact('user'));
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        
        $userDefaultAddress = has_address::where('user_id',$user->id)->where('is_default',1)->first();

        //echeck the discount
        if($input['promo_code'] == NULL){
            $promocode = NULL;
        }else{
            $coupon = coupons::where('coupon_code',$input['promo_code'])
            ->where('expiry_date','>=',Carbon::now())
            ->first();
            if($coupon == NULL){
                $promocode = NULL;
            }else{
                $promocode = $coupon;
            }
        }

        return view('checkout.index',compact('user','userDefaultAddress','promocode'));
    }

    public function payment(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $day = Carbon::now()->format('d');
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        // $checkoutID = Carbon::now()->todatetimeString().'-'.$user->id;
        $checkoutID = rand(10000,99999).$month.$user->id.$day;
        $this->validate($request, [
            'type_payment' => 'required',
        ]);

        $userDefaultAddress = has_address::where('user_id',$user->id)->where('is_default',1)->first();

        $checkouttable = [];
        $totalPrice = 0;
        if(session('cart') != NULL){
            // dd(session('cart'));
            foreach(session('cart') as $key=>$checkoutDetails){
                // dd($checkoutDetails['merchant_id']);
                $checkouttable['checkout_id'] = $checkoutID;
                $checkouttable['user_id'] =  $user->id;
                $checkouttable['merchant_id'] =  $checkoutDetails['merchant_id'];
                $checkouttable['menu_id'] = $checkoutDetails['menu_id'];
                $checkouttable['price'] = (float)$checkoutDetails['price'];
                $checkouttable['quantity'] = $checkoutDetails['quantity'];
                $checkouttable['type_payment'] = $input['type_payment'];
                $checkouttable['is_paid'] = 1;
                $checkouttable['status'] = 'Order sent to Merchant';
                $checkouttable['address_id'] = $userDefaultAddress->id;
                $totalPrice = (float)$checkoutDetails['price'] + (float)$totalPrice;
                $checkouttableCreate = checkout::create($checkouttable);

                $chekoutToPrepared['checkout_id'] = $checkoutID;
                $chekoutToPrepared['user_id'] = $user->id;
                $chekoutToPreparedCreate = checkout_to_prepare::create($chekoutToPrepared);
                //Order sent to Merchant
                //Preparing order
                //Rider pickup
                //Order Delivered
            }
        }
        //check promo code

        $checkoutPayment = [];
        $checkoutPayment['checkout_id'] = $checkoutID;
        $checkoutPayment['total_price'] = $input['total_price'];
        $checkoutPayment['total_price_all'] = $input['total_price_calculate_all'];
        $checkoutPayment['discount'] = $input['discount'];
        $checkoutPayment['tax'] = $input['tax'];
        $checkoutPayment['service'] = $input['service'];
        $checkoutPayment['is_paid'] = 1;
        $checkoutPayment['created_by'] = $user->id;
        $checkoutPayment['paid_method'] = $input['type_payment'];
        $createcheckout_payment = checkout_payment::create($checkoutPayment);

        
        session()->forget('cart');
        return redirect('my-order')->with('success', 'Menu Updated Successfully');

        return view('order.index',compact('user'));
    }

    public function addToCart($id)
    {
        $product = menu :: with('getOneMenuPicture')->where('id',$id)->first();
          
        $cart = session()->get('cart', []);
        // dd($product);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            if($product->getOneMenuPicture == NULL){
                $image = NULL;
            }else{
                $image = "/upload/Menu/".$product->getOneMenuPicture->menu_id."/".$product->getOneMenuPicture->hash.".".$product->getOneMenuPicture->extension;
            }
            $cart[$id] = [
                "menu_id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $image,
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function removeCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }


}
