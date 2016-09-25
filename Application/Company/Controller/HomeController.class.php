<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Company\Controller;
use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class HomeController extends Controller {

	/* 空操作，用于输出404页面 */
	public function _empty(){
		$this->redirect('Index/index');
	}


    protected function _initialize(){
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置

        if(!C('WEB_SITE_CLOSE')){
            $this->error('站点已经关闭，请稍后访问~');
        }
        $cid = I('get.cid');
        if($cid<=0){
            $this->error('访问的公司不存在');
        }

        //公司logo
        $himg0 = D('HomeImg')->where(array(
            array('cid' => $cid),
            array('type' => 0)
        ))->find();
        $this->assign('himg0' , $himg0);
        //公司信息
        
        $company = D('Company')->find($cid);
        //主营业务
        $main_business = C('BUSINESS');        
        $bus = explode(',',$company['business']);
        $bstr = '';
        foreach($bus as $bs){
            $bstr .= $main_business[$bs] . ',';
        }
        $bstr = substr($bstr,0,strlen($bstr)-1); 
        $company['main_business'] = $bstr;
        //经营模式
        $patterns = C('PATTERN');        
        $company['pattern'] = $patterns[$company['pattern']];

        //获取仓库
        $region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
        $company['ware_city'] = $region_name;

        $this->assign('company' , $company);

        //联系人信息
        $contact = D('Contact')->where('uid = ' . $company['uid'])->find();
        $this->assign('contact' , $contact);

    }

	/* 用户登录检测 */
	protected function login(){
		/* 用户登录检测 */
		is_login() || $this->error('您还没有登录，请先登录！', U('User/login'));
	}

}
