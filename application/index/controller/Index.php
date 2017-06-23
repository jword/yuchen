<?php
namespace app\index\controller;

class Index extends \think\Controller
{
    public function index()
    {
        $this->assign('data', array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
        return view('home');
    }

    public function search()
    {
        return view('search');
    }

    public function detail()
    {
        return view('detail');
    }
}
