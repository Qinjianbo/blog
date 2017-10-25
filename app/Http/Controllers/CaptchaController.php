<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Validator;

class CaptchaController extends Controller
{
    /**
     * check
     *
     * @param Illuminate\Http\Request $request
     *
     * @access public
     *
     * @return Illuminate\Support\Collection
     */
    public function check(Request $request)
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->result(collect(), '验证码输入错误', 100);
        }
        
        return $this->result(collect(), '验证码输入正确');
    }
}
