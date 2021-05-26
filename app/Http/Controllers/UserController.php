<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }

        $data = $request->only(['name', 'email',  'password']);
        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = 10; //member
        $data['status'] = 1; //active account
        $user = User::create($data);
        if($user){
             $result['response'] = 'success';
             $result['message'] = 'Account created successfully';
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Account create failed. Try again';
        }
        return response()->json($result);
    }
    public function login(Request $request)
    {
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }

        if (Auth::attempt($request->only(['email', 'password']))) {
            if (Auth::user()->role_id == 10 && Auth::user()->status == 1) {
                $result = [
                    'user' => Auth::user(),
                    'token' => Auth::user()->createToken('TTNetwork')->accessToken,
                ];
            } else {
                $result = [
                    'message' => 'Your account is not activated yet.Please check your email and activate your account.',
                    'error' => 'inActive',
                    'response' => 'error',
                ];
            }
        } else {
            $result = [
                'message' => 'Incorrect Email and/or Password! Please enter valid email and/or password',
                'error' => 'invalidUser',
                'response' => 'error',
            ];
        }
        return response()->json($result);
    }
    public function getUsers(){
        $users = User::all();
        if($users){
            $result = [
                'message' => 'Users Found.',
                'users' => $users,
                'response' => 'success',
            ];
        }else{
            $result = [
                'message' => 'Users not Found.',
                'users' => [],
                'response' => 'error',
            ];
        }
        return response()->json($result);
    }
    public function assignRoleToUser(Request $request){
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $user = User::find($request->user_id);
        if($user){
            $user->role_id = $request->role_id;
            if($user->save()){
                $result = [
                    'message' => 'Assigned role to user successfully.',
                    'user' => $user,
                    'response' => 'success',
                ];
            }else{
                $result = [
                    'message' => 'Role assign failed. try again',
                    'user' => [],
                    'response' => 'error',
                ];
            }
           
        }else{
            $result = [
                'message' => 'User not Found with this Id =  '.$request->user_id,
                'user' => [],
                'response' => 'error',
            ];
        }
        return response()->json($result);
    }
    public function DeleteRoleFromUser(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $user = User::find($request->user_id);
        if($user){
            $user->role_id = null;
            if($user->save()){
                $result = [
                    'message' => 'User role deleted successfully.',
                    'user' => $user,
                    'response' => 'success',
                ];
            }else{
                $result = [
                    'message' => 'Role delete failed. try again',
                    'user' => [],
                    'response' => 'error',
                ];
            }
           
        }else{
            $result = [
                'message' => 'User not Found with this Id =  '.$request->user_id,
                'user' => [],
                'response' => 'error',
            ];
        }
        return response()->json($result);
    }
}
