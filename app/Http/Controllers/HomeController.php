<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\menu;
use App\Models\checkout;
use App\Models\menu_has_pictures;
use App\Models\has_address;
use App\Models\module;
use Carbon\Carbon;
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
        $menu = menu :: with('getOneMenuPicture','getOwner')->where('is_deleted',0)->where('status','=','Pending For Approval')->get();
        $haspic = 0;
        $MenuPicture = "http://bootdey.com/img/Content/avatar/avatar1.png";
        // if($menu->getOneMenuPicture != NULL){
        //     $haspic = 1;
        //     $MenuPicture = "/upload/Menu/".$menu->getOneMenuPicture->menu_id."/".$menu->getOneMenuPicture->hash.".".$menu->getOneMenuPicture->extension;
        // }

        return view('home.index',compact('user','menu','members'));
    }

    public function cart()
    {
        $user = Auth::user();

        return view('my-menu.cart',compact('user'));
    }

    public function checkout()
    {
        $user = Auth::user();
        $userDefaultAddress = has_address::where('user_id',$user->id)->where('is_default',1)->first();

        //echeck the discount

        return view('checkout.index',compact('user','userDefaultAddress'));
    }

    public function payment(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $checkoutID = Carbon::now()->todatetimeString().'-'.$user->id;
        $this->validate($request, [
            'type_payment' => 'required',
        ]);
        $userDefaultAddress = has_address::where('user_id',$user->id)->where('is_default',1)->first();

        $checkouttable = [];
        if(session('cart') != NULL){
            // dd(session('cart'));
            foreach(session('cart') as $key=>$checkoutDetails){
                // dd($checkoutDetails['merchant_id']);
                $checkouttable['checkout_id'] = $checkoutID;
                $checkouttable['user_id'] =  $user->id;
                $checkouttable['merchant_id'] =  $checkoutDetails['merchant_id'];
                $checkouttable['menu_id'] = $checkoutDetails['menu_id'];
                $checkouttable['price'] = $checkoutDetails['price'];
                $checkouttable['quantity'] = $checkoutDetails['quantity'];
                $checkouttable['type_payment'] = $input['type_payment'];
                $checkouttable['is_paid'] = 1;
                $checkouttable['status'] = 'Order sent to Merchant';
                $checkouttable['address_id'] = $userDefaultAddress->id;
                
                $checkouttableCreate = checkout::create($checkouttable);
                //Order sent to Merchant
                //Preparing order
                //Rider pickup
                //Order Delivered
            }
        }
        
        $user = Auth::user();

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
