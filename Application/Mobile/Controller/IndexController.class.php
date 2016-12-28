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
class IndexController extends Controller {

	//网站首页
    public function index(){
    	$issue = D('Issue')->where($map)->order('create_time desc')->limit(4)->select();
    	$this->assign('issue',$issue);

    	//今日头条
        $hot = D('Document')->limit(4)->position(4);
        $this->assign('hot', $hot);

        //Banner
        $adm['status'] = 1;
        $adm['pos_id'] = 10;
        $banners = D('Adv')->where($adm)->order('sort desc')->select();
        $this->assign('banners',$banners);
       
        $this->display();
    }

    public function calculator(){
        $this->display();
    }

    public function aboutme(){
        $this->display();
    }

    public function feedback(){
        $this->display();
    }

    
}