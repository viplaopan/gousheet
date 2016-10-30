<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Widget;
use Think\Controller;

/**
 * 分类widget
 * 用于动态调用分类信息
 */

class HomeWidget extends Controller{
	
	/* 求购信息 */
	public function Issue(){
		$map['status'] = 1;
        $lists = D('Issue')->where($map)->limit(6)->select();
		$this->assign('lists', $lists);
		$this->display('Widget/issue');
	}
	public function ad($adId,$w,$h){
		//Banner
        $adm['status'] = 1;
        $adm['id'] = $adId;
        $ad = D('Adv')->where($adm)->find();
		$this->assign('ad', $ad);
		$this->assign('w', $w);
		$this->assign('h', $h);
		$this->display('Widget/ad');
	}
	public function huoyue(){
		$companies = D("NewCompany")->order('id desc')->limit(11)->select();
                    
        $clists = array();
        foreach($companies as $key=>$vo){

            $company = D('Company')->where('id = ' . $vo['cid'])->find();
            $clists[$key]['title'] = $company['name'];
        }
        $this->assign('clists', $clists);
		$this->display('Widget/huoyue');
	}
}
