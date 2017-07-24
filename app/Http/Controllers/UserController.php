<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\User;

/**
 * UserController 
 * 
 * @uses BaseController
 * PHP version 7
 * 
 * @package   App\Http\Controllers
 * @author    Qinjianbo <279250819@qq.com> 
 * @copyright 2016-2019 boboidea Co. All Rights Reserved.
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   GIT:<git_id>
 * @link      https://www.boboidea.com
 */
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
