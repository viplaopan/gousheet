<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Mobile\Controller;
use Think\Controller;
/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class SearchcompanyController extends Controller {
    public function index($page = 1){
    	$map['status'] = 1;
    	$word = I('get.word');
    	if($word){
    		$map['name'] = array('like',"%$word%");
    	}
    	$lists = D("Company")->order('id desc')->where($map)->page($page, 20)->select();
    	foreach($lists as &$val){
    		$contact = D('contact')->where('cid = ' . $val['id'])->find();
			$val['contact'] = $contact;
			//$val['url'] = U('Company/detail',array('p'=>'Sactuals','id'=>$val['uid']));
    	}

    	if(IS_POST){
    		if($lists){
                foreach($lists as &$val){
                   $val['create_time'] = date('Y-m-d',$val['create_time']);
                }
                unset($val);
                $data['lists'] = $lists;
                $data['status'] = 1;
                $this->ajaxReturn($data,'json');
            }else{
                $this->error('没有数据');
            }
    	}else{
    		$this->assign('lists',$lists);
    		$this->display();
    	}
    }
}