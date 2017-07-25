<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\User;
use Illuminate\Support\Collection;

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
    /**
     * signin 
     * 
     * @param Request $request 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function signin(Request $request) : Collection
    {
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();    

            return collect($errors);
        }

        $user = new User();
        $user = $user->where('username', $request->get('username'))
                ->where('password', md5($request->get('password')))
                ->first();
        if ($user) {
            $user->online = 1;
            $user->save();

            return collect($user)->only(['id', 'username', 'intro', 'avatar_url']);
        } else {
            return collect();    
        }
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
