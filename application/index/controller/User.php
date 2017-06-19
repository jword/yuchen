<?php
namespace app\index\controller;

class User
{
    public function login()
    {
        return view('home', ['name' => 'thinkphp']);
    }

    public function register()
    {
        return view('register', ['name' => 'thinkphp']);
    }

    public function detail()
    {
        return view('detail', ['name' => 'thinkphp']);
    }

    public function forget()
    {
        return view('forget', ['name' => 'thinkphp']);
    }
}
