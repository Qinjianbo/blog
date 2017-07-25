<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use App\Models\User\User;
use Cache;
use Validator;

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
        $user = (new User())->signin($request->get('username'), $request->get('password'));
        if ($user) {
            $key = sprintf('user_%d_%s_%s', $user['id'], $user['username'], $request->get('device', 'pc'));
            $expiresAt = Carbon::now()->addMinutes(config(sprintf('app.duration.user.%s', $request->get('device'))));
            Cache::put($key, $user, $expiresAt);

            return collect($user)->only(['id', 'username', 'intro', 'avatar_url']);
        }

        return collect();
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
