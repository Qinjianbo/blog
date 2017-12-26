<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Collection;
use App\Models\User\User;
use Cache;
use Carbon\Carbon;
use Validator;
use JiaweiXS\WeApp\WeApp;

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
     * $weapp
     */
    protected $weapp = null;

    public function __construct()
    {
        $this->weapp = new WeApp(
            config('app.wxa.appId'),
            config('app.wxa.appSecret'),
            config('app.wxa.cachePath')
        );
    }

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
        $session = $this->weapp->getSessionKey($code);
        $session = json_decode($session, true);

        $cacheKey = sprintf('%u', crc32(sprintf('%s_%s', $session['openid'], $session['session_key'])));
        $cacheValue = sprintf('%s_%s', $session['openid'], $session['session_key']);

        Cache::put($cacheKey, $cacheValue, 10);

        return $this->result(collect(['sessionId' => $cacheKey]), '微信登录成功');
    }

    public function analyzeUser(Request $request)
    {
        $res = $request->get('res');
    }
}
