<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class IndexController extends CommonController
{
    public function index()
    {

        return view('admin.index');
    }

    public function info()
    {

        return view('admin.info');
    }

    /*
     * 修改后台用户密码
     */
    public function pass()
    {

        if ($input = Input::all()) {
            //验证规则

            $rules = [
                'password' => 'required|between:6,20|confirmed',
            ];
            $message = [
                'password.required' => '新密码不能为空',
                'password.between' => '新密码必须在6-20之间',
                'password.confirmed' => '新密码二次确认不一致',
            ];

            //验证表单提交
            $validator = Validator::make($input,$rules,$message);

            if ($validator->passes()) {
                $user = Session::get('user');
                $user_pass = Crypt::decrypt($user->user_pass);

                if ($input['password_o'] == $user_pass) {
                    //修改
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();

                    return redirect('admin/info')->withErrors('密码修改成功');

                } else {
                    //提示原密码错误
                    return back()->withErrors('原密码不匹配，无法修改');
                }
            } else {
                return back()->withErrors($validator);
            }
        } else {
            return view('admin.pass');
        }
    }
}
