<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Collection;
use App\Models\User\User;
use Cache;
use Carbon\Carbon;
use Validator;
use App\Services\WxBizDataCryptService;
use Bqrd\WeAppSdk\Facades\WeApp;

/**
 * WxaController
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
class WxaController extends BaseController
{
    /**
     * 去微信换取openid 和 session_key
     *
     * @param Request $request
     *
     * @return Illuminate\Support\Collection
     */
    public function code2Session(Request $request): Collection
    {
        if (!($code = $request->get('code'))) {
            info('code2Session:code is empty!');
            return '';
        }

        $session = WeApp::getSessionKey($code);

        $cacheKey = sprintf('%u', crc32(sprintf('%s_%s', $session['openid'], $session['session_key'])));
        $cacheValue = sprintf('%s_%s', $session['openid'], $session['session_key']);

        Cache::put($cacheKey, $cacheValue, 10);

        return $this->result(collect(['sessionId' => $cacheKey]), '微信登录成功');
    }

    /**
     * 检测微信登录是否过期
     *
     * @param Request $request
     *
     * @return Illuminate\Support\Collection
     */
    public function check(Request $request)
    {
        $session = Cache::get($request->get('sessionId'));
        if (!$session) {
            return $this->result(collect(), 'session失效，请重新登录', 10001);
        }
        
        return $this->result(collect(['sessionId' => $request->get('sessionId')]), 'session有效');
    }

    public function analyzeUser(Request $request)
    {
        $session = Cache::get($request->get('sessionId'));
        if (!$session) {
            return $this->result(collect(), '登录超时', 10001);
        }
        $sessionKey = explode('_', $session)[1];
        $res = $request->get('res');
        $rawData = $res['rawData'];
        $encryptedData = $res['encryptedData'];
        $iv = $res['iv'];
        $encriptyService = (new WxBizDataCryptService(config('app.wxa.appId'), $sessionKey));
        $error = $encriptyService->decryptData($encryptedData, $iv, $data);
        if ($error) {
            info('analyzeUser error:'.$error);
        } else {
            print_r($data);
        }
    }
}
