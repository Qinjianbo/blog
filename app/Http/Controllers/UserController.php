<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function signin()
    {
        return 'signin';
    }

    public function signout()
    {
        return 'signout';    
    }

    public function signup()
    {
        return 'signup';    
    }
}
