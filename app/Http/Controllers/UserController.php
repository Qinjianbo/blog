<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function signin(Request $request)
    {
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
