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
	
	/* 显示指定分类的同级分类或子分类列表 */
	public function Issue(){
		$map['status'] = 1;
        $lists = D('Issue')->where($map)->limit(6)->select();
		$this->assign('lists', $lists);
		$this->display('Widget/issue');
	}
	
}
