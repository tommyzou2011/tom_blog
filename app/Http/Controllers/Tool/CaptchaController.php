<?php

namespace App\Http\Controllers\Tool;

use Illuminate\Support\Facades\Session;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//工具类
class CaptchaController extends Controller
{
    //生成验证码
    public function captcha($tmp = 1)
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 150, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::put('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }


}
