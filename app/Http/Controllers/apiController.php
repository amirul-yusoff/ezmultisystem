<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($dataFromUser->all(), [
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $user = User::where('phone_number', $dataFromUser->phone_number)->first();

        if ($user) {
            $ifAccExist = 1;

             if(Auth::attempt(['phone_number' => $dataFromUser->phone_number, 'password' => $dataFromUser->password])){ 
                $isSuccess = 1;
                $isSuccess = 1;
                $ifFailed = 0;
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [
                    "message" => "manage to login",
                    'token' => $token,
                    'ifFailed'=>$ifFailed,
                    'ifAccExist'=>$ifAccExist,
                    'isSuccess'=>$isSuccess,
                ];
                return response($response, 200);
            } else {
                $response = [
                    "message" => "Password mismatch",
                    'ifFailed'=>$ifFailed,
                    'ifAccExist'=>$ifAccExist,
                    'isSuccess'=>$isSuccess,
                ];
                return response($response, 422);
            }
        } else {
            $response = [
                "message" =>'User does not exist',
                'ifFailed'=>$ifFailed,
                'ifAccExist'=>$ifAccExist,
                'isSuccess'=>$isSuccess,
            ];
            return response($response, 422);
        }


        if(Auth::attempt(['phone_number' => $dataFromUser->phone_number, 'password' => $dataFromUser->password])){ 
            $user = Auth::user(); 
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            $response = [
                'token' => $token
            ];
            return response($response, 200);
        } 
        else{ 

            foreach($data as $usernameCheck){
                if($dataFromUser->phone_number == $usernameCheck['phone_number']){
                    $ifAccExist = 1;

                }
            }
            // return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 

        return response()->json($input,200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    /////////https://www.toptal.com/laravel/passport-tutorial-auth-user-access
    public function logins (Request $request) {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('phone_number', $request->phone_number)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }
    
}
