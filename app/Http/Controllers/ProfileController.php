<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Validator;

class ProfileController extends Controller
{

    public function userProfileInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
       $userProfile = new  Profile();
       $userProfile->user_id = $request->user_id;
       $userProfile->phone = $request->phone;
       $userProfile->address = $request->address;
       $userProfile->gender = $request->gender;
       if($userProfile->save()){
            $result = [
                'message' => 'User profile updated successfully.',
                'userProfile' => $userProfile,
                'response' => 'success',
            ];
        }else{
            $result = [
                'message' => 'User profile not Found.',
                'userProfile' => [],
                'response' => 'error',
            ];
        }
        return response()->json($result);
    }

   
}
