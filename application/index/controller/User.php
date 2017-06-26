<?php
namespace app\index\controller;

class User extends \think\Controller
{
    public function login()
    {
        $this->assign('title', '登录');
        return view('login');
    }

    public function register()
    {
        $this->assign('title', '注册');
        return view('register', ['name' => 'thinkphp']);
    }

    public function forget()
    {
        $this->assign('title', '忘记密码');
        return view('forget', ['name' => 'thinkphp']);
    }
}
