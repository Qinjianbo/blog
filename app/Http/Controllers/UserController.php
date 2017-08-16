<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Collection;
use App\Models\User\User;
use Cache;
use Carbon\Carbon;
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
     * @return Illuminate\Support\Collection
     */
    public function signin(Request $request) : Collection
    {
        $rules = [
            'username' => 'required|alpha_dash|between:6,20',
            'password' => 'required|string',
            'device'   => 'required|string|in:pc,android,ios',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return $this->result(collect(), collect($errors), 101);
        }

        $user = (new User())->signin($request->get('username'), $request->get('password'));
        if ($user->isNotEmpty()) {
            $idMd5 = md5($user['id']);
            $key = sprintf('user_%s_%s', $idMd5, $request->get('device', 'pc'));
            $expiresAt = Carbon::now()->addMinutes(config(sprintf('app.duration.user.%s', $request->get('device'))));
            $user = $user->only(['username', 'intro', 'avatar_url'])->merge(['id' => $idMd5]);
            Cache::put($key, $user, $expiresAt);

            return $this->result($user, '登录成功');
        }

        return $this->result(collect(), '用户名或密码错误', 100);
    }

    /**
     * signout
     *
     * @param Request $request
     *
     * @access public
     *
     * @return Illuminate\Support\Collection
     */
    public function signout(Request $request, $id, $device) : Collection
    {
        $key = sprintf('user_%s_%s', $id, $device);

        if (!Cache::has($key)) {
            $this->result(collect(), '注销失败', 100);
        }

        Cache::forget($key);
        
        return $this->result(collect(), '注销成功');
    }

    /**
     * signup
     *
     * @param Request $request
     *
     * @access public
     *
     * @return Illuminate\Support\Collection
     */
    public function signup(Request $request) : Collection
    {
        $rules = [
            'username' => 'required|alpha_dash|between:6,20',
            'password' => 'required|string',
            'device'   => 'required|string|in:pc,android,ios',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();

            return $this->result(collect(), collect($errors), 101);
        }

        if ($user = (new User())->signup(
                    $request->get('username'),
                    $request->get('password'),
                    $request->get('device')
                )
            ) {
            return $this->result(collect($user)->only(['id', 'username']), '注册成功');
        }

        return $this->result(collect(), '注册失败', 100);
    }

    /**
     * isSignin 
     * 
     * @param Request $request 
     * 
     * @access public
     * 
     * @return Illuminate\Support\Collection
     */
    public function isSignin(Request $request, $id, $device) : Collection
    {
        $key = sprintf('user_%s_%s', $id, $device);

        if (Cache::has($key) && ($user = $Cache::get($key))->isNotEmpty()) {
            return $this->result($user, '已登录');
        }
        
        return $this->result(collect(), '登录超时或未登录', 100);
    }
}
