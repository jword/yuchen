<?php
namespace app\index\controller;

use app\index\model\Cominfo;

class Index extends \think\Controller
{
    public function index()
    {
        if (APP_ENV == 'product') {
            $field = 'id, hashid, startdate,comname,status ,contactinfo, address, opername, registcapi, scope';
        } else {
            $field = 'id, hashid, startdate,comname,status ,CAST(contactinfo as CHAR) as contactinfo, address, opername, registcapi, scope';
        }
        $cominfo = new Cominfo();
        $coms    = $cominfo->where('state', 1)
            ->limit(10)
            ->order('id', 'desc')
            ->field($field)
            ->select();
        $this->assign('coms', $coms);
        return view('home');
    }

    public function search()
    {
        if (APP_ENV == 'product') {
            $field = 'id, hashid, startdate,comname,status ,contactinfo, address, opername, registcapi, scope';
        } else {
            $field = 'id, hashid, startdate,comname,status ,CAST(contactinfo as CHAR) as contactinfo, address, opername, registcapi, scope';
        }
        $keyword = request()->param('keyword');
        $keyword = '北京中慧';
        // 查询状态为1的用户数据 并且每页显示10条数据
        $list = Cominfo::where('state', 1)->whereLike('comname', $keyword . '%')->field($field)->paginate(10);
        // 模板变量赋值
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function detail()
    {
        return view('detail');
    }

    public function about()
    {
        return view('about');
    }
}
