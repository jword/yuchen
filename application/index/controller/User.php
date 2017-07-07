<?php
namespace app\index\controller;

class User extends \think\Controller
{
    public function login()
    {
        $this->assign('title', '登录');
        $this->assign('keywords', '法人堂登录，法人堂会员登录，法人堂会员');
        $this->assign('description', '法人堂会员登录。法人堂是一个专业的企业法人信息检索平台，致力于提供简单、可靠、真实的法人信息检索查询服务。');
        return view('login');
    }

    public function register()
    {
        $this->assign('title', '注册');
        $this->assign('keywords', '法人堂注册，法人堂账号注册，法人堂会员');
        $this->assign('description', '法人堂账号注册。法人堂是一个专业的企业法人信息检索平台，致力于提供简单、可靠、真实的法人信息检索查询服务。');
        return view('register', ['name' => 'thinkphp']);
    }

    public function forget()
    {
        $this->assign('title', '忘记密码');
        $this->assign('keywords', '忘记密码，法人堂忘记密码');
        $this->assign('description', '忘记密码法人堂账号、密码？法人堂是一个专业的企业法人信息检索平台，致力于提供简单、可靠、真实的法人信息检索查询服务。');
        return view('forget', ['name' => 'thinkphp']);
    }
}
