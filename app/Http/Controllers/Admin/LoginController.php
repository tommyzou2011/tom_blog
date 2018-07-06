<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\Object_;

class LoginController extends CommonController
{
    //后台登陆界面
    public function login()
    {
        return view('admin.login');
    }

    public function quit()
    {
        Session::put('user',null);
        return view('admin.login');
    }


}
