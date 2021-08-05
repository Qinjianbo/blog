<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Collection;
use Validator;
use Log;

class XcxController extends Controller
{
    public function login(Request $request) {
        $code = $request->input('code');
        Log::info('code:' . $code);
        if (!$code) {
            return $this->result(collect(), 'code传入错误', 100);
        }

        $appId = Config('app.xcx.app_id');
        $appSecret = Config('app.xcx.app_secret');
        if (!$appId || !$appSecret) {
            Log::info('appId或appSecret错误' . $appId . ':' . $appSecret);
            return $this->result(collect(), 'appId或appSecret配置错误', 101);
        }
        // 调用小程序接口，进行登录验证
        $url = sprintf(
            'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',
            $appId,
            $appSecret,
            $code
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $returnData = curl_exec($ch);
        if (curl_errno($ch)) {
            //error message
            $returnData = curl_error($ch);
            Log::error('请求验证接口错误'.$returnData);
            curl_close($ch);
            return $this->result(collect(), '验证接口请求错误', 102);
        }
        curl_close($ch);
        Log::info('登录验证结果'. json_encode($returnData));
        
    }
}
