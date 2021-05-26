<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Validator;
class RoleController extends Controller
{
    
    public function addRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:roles|max:50',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $data = $request->only(['title', 'descr']);
        $data['status'] = 1; //active
        $role = Role::create($data);
        if($role){
            $result['response'] = 'success';
            $result['message'] = 'Role created successfully';
       }else{
           $result['response'] = 'error';
           $result['message'] = 'Role create failed. Try again';
       }
       return response()->json($result);
    }

    
}
