<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登入页面
    public  function index()
    {
        return view('login.index');
    }

    //登入行为
    public  function login()
    {
        //验证

        $this->validate(request(),[
            'email'=>'required|email',
            'password' => 'required|min:5|max:10',
            'is_remember' => 'integer'
        ]);

        $user = request(['email','password']);
        $is_remember = boolval(request('is_remember'));
        if (\Auth::attempt($user,$is_remember)){
            return redirect('/posts');
        }

        return \Redirect::back()->withErrors("邮箱密码不匹配");
    }

    //登出
    public  function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}
