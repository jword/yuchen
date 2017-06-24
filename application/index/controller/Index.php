<?php
namespace app\index\controller;

use app\index\model\Cominfo;

class Index extends \think\Controller
{
    public function index()
    {
        //CAST(contactinfo as CHAR) as contactinfo
        $cominfo = new Cominfo();
        $coms    = $cominfo->where('state', 1)
            ->limit(10)
            ->order('id', 'desc')
            ->field('id, hashid, startdate,comname,status ,contactinfo, address, opername, registcapi, scope')
            ->select();
        $this->assign('coms', $coms);
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
