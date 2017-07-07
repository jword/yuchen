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
        $this->assign('title', '专业的法人信息检索平台');
        $this->assign('keywords', '法人堂，法人，企业法人，工商信息查询，企业联系方式');
        $this->assign('description', '法人堂是一个专业的企业法人信息检索平台，致力于提供简单、可靠、真实的法人信息检索查询服务。');
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
        $this->assign('title', $keyword);
        $this->assign('keywords', $keyword);
        $this->assign('description', '法人堂是一个专业的企业法人信息检索平台，致力于提供简单、可靠、真实的法人信息检索服务。');
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
        $this->assign('title', $company->comname);
        $this->assign('keywords', $company->comname . '联系方式，' . $company->opername . '联系方式，' . $company->comname . '怎么样，' . $company->comname . '工商信息');
        $this->assign('description', '法人堂为您提供最新、最全的' . $company->comname . '工商信息、信用信息、联系方式、专利信息、诉讼信息、股东信息、法人信息、企业新闻等。');
        $this->assign('company', $company);
        $this->assign('contact', $contact);
        return view('detail');
    }

    public function about()
    {
        $this->assign('title', '关于法人堂');
        $this->assign('keywords', '法人堂，法人堂团队，法人堂联系方式，法人堂地址，河南斯沃琪网络科技有限公司');
        $this->assign('description', '法人堂是一个专业的企业法人信息检索平台，致力于提供简单、可靠、真实的法人信息检索查询服务。');
        return view('about');
    }
}
