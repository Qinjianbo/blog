<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use App

class UserController extends BaseController
{
    public function signin(Request $request)
    {
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();    

            return $errors;
        }
        
        return 'signin';
    }

    public function signout(Request $request)
    {
        return 'signout';    
    }

    public function signup(Request $request)
    {
        return 'signup';    
    }
}
