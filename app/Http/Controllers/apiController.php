<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class apiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->user = Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUsers(){
        $data = User::all();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getDataFromOutside(Request $req){

        dd($req);
        $data = ["name"=>"amirul",
        "email"=>"amirul.yusoff@jatitinggi.com"];

        return response()->json([
            'data' => $data,
        ]);
    }

    public function registerUser(Request $dataFromUser){

        $input = $dataFromUser->all();
        $data = User::all();
        $isFailed = 0;
        $isUsernameDupliccate = 0;
        $isSuccess = 0;
        $isEmailDuplicate = 0;
        $isPhoneNumberDuplicate = 0;
        $errorMessage = [];

        //check if duplicate username
        foreach($data as $usernameCheck){
            if($usernameCheck['username'] == $dataFromUser['username']){
                $isUsernameDupliccate = 1;
                $errorMessage[]= 'duplicate: '.$dataFromUser['username'];
            }
            if($usernameCheck['email'] == $dataFromUser['email']){
                $isEmailDuplicate = 1;
                $errorMessage[]= 'duplicate: '.$dataFromUser['email'];
            }
            if($usernameCheck['phone_number'] == $dataFromUser['phone_number']){
                $isPhoneNumberDuplicate = 1;
                $errorMessage[]= 'duplicate: '.$dataFromUser['phone_number'];
            }

            if($isUsernameDupliccate == 1 || $isEmailDuplicate == 1  || $isPhoneNumberDuplicate == 1 ){
                $isFailed = 1;
                $isSuccess = 0;
            }else{
                $isSuccess = 1; 
            }

            
        }
        if($isSuccess == 1){

            $name = $input['first_name'].' '.$input['last_name'];
            User::create([
                'name' => $name,
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'username' => $input['username'],
                'phone_number' => $input['phone_number'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

        }

        return response()->json([
            'isFailed' => $isFailed,
            'isUsernameDupliccate' => $isUsernameDupliccate,
            'isSuccess' => $isSuccess,
            'isEmailDuplicate' => $isEmailDuplicate,
            'isPhoneNumberDuplicate' => $isPhoneNumberDuplicate,
            'errorMessage' => $errorMessage,
        ]);
    }

    public function loginUser(Request $dataFromUser){

        $input = $dataFromUser->all();
        $ifFailed = 1;
        $ifAccExist = 0;
        $isSuccess = 0;
        $errorMessage = [];
        $data = User::all();

        if(Auth::attempt(['phone_number' => $dataFromUser->phone_number, 'password' => $dataFromUser->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
            $isSuccess = 1;
            $ifFailed = 0;
            $ifAccExist = 1;
            // return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 

            foreach($data as $usernameCheck){
                if($dataFromUser->phone_number == $usernameCheck['phone_number']){
                    $ifAccExist = 1;

                }
            }
            // return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 

        return response()->json([
            'ifFailed' => $ifFailed,
            'isSuccess' => $isSuccess,
            'ifAccExist' => $ifAccExist,
            'errorMessage' => $errorMessage,
        ]);
    }
    
}
