<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return view('home', ['name' => 'thinkphp']);
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
