<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\Object_;

class UserController extends CommonController
{
    //用户信息首页
    public function index()
    {
        dd("user->index");
    }

    //登陆 ajax 接收
    public function login(Request $request)
    {
        $code = $request->get('code');
        //先判断验证码是不是对
        if ((json_decode(Session::get('milkcaptcha')) == json_decode($code) && !empty($code))) {

            $username = $request->get('username');
            $password = $request->get('password');

            if (!isset($username) || !isset($password)) {
                echo json_encode("用户名，密码不能为空");
                return;
            }

            //用户输入验证码正确,处理登陆
            $user = User::where('user_name', $request->get('username'))->first();

            if (count($user) > 0) {
                //对比密码
                if (Crypt::decrypt($user->user_pass) == $password) {

                    //登陆成功
                    session(['user' => $user]);
                    session(['milkcaptcha' => null]);
                    echo 1;
                } else {
                    echo json_encode("用户名，密码不正确");
                }
            } else {
                echo json_encode("用户不存在");
            }
        } else {

            session(['user' => null]);
            //用户输入验证码错误
            echo json_encode("验证码错误");
        }
    }
}
