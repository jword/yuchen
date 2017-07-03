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
        $query   = ['query' => ['keyword' => $keyword]];
        // 查询状态为1的用户数据 并且每页显示10条数据
        $list = Cominfo::whereLike('comname', $keyword . '%')->field($field)->paginate(10, false, $query);
        // 模板变量赋值
        $this->assign('keyword', $keyword);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function detail()
    {
        $hashid = request()->param('hashid');
        //获取企业数据
        $cominfo = new Cominfo();
        $company = $cominfo->where('hashid', $hashid)->find();
        //获取联系方式信息
        $contact = new Contact();
        $contact = $contact->where('comname', $company->comname)->find();
        $this->assign('company', $company);
        $this->assign('contact', $contact);
        return view('detail');
    }

    public function about()
    {
        return view('about');
    }
}
