<?php
namespace app\index\controller;

use app\index\model\Cominfo;
use app\index\model\Contact;

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
        $this->assign('modeout', true);
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
        if (empty($keyword)) {
            $this->success('关键词不能为空', '/');
        }
        $query = ['query' => ['keyword' => $keyword]];
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
        if (APP_ENV == 'product') {
            $field = $cfiled = '*';
        } else {
            $cfiled = 'comname,CAST(contacts as CHAR) as contacts';
            $field  = 'id, hashid, creditno,regno,econkind,termstart,termend,belongorg,startdate,comname,status ,CAST(contactinfo as CHAR) as contactinfo, address, opername, registcapi, scope,CAST(employs as CHAR) as employs,CAST(partners as CHAR) as partners,CAST(branches as CHAR) as branches,CAST(changerecord as CHAR) as changerecord';
        }
        //获取企业数据
        $company = Cominfo::where('hashid', $hashid)->field($field)->find();
        if (empty($company)) {
            abort(404, '404 Not Found');
        }
        //获取联系方式信息
        $contact = new Contact();
        $contact = $contact->where('comname', $company->comname)->field($cfiled)->find();
        $this->assign('company', $company);
        $this->assign('contact', $contact);
        return view('detail');
    }

    public function about()
    {
        return view('about');
    }
}
