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
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {
	//网站首页
    public function index($cid = 0 ){
        
        //企业愿景
        $himg1 = D('HomeImg')->where(array(
            array('cid' => $cid),
            array('type' => 1)
        ))->find();
        $this->assign('himg1' , $himg1);
        //生产设备
        $himg2 = D('HomeImg')->where(array(
            array('cid' => $cid),
            array('type' => 2)
        ))->find();
        $this->assign('himg2' , $himg2);
        //质检及仓储
        $himg3 = D('HomeImg')->where(array(
            array('cid' => $cid),
            array('type' => 3)
        ))->find();
        $this->assign('himg3' , $himg3);
        //企业资质
        $himg4 = D('HomeImg')->where(array(
            array('cid' => $cid),
            array('type' => 4)
        ))->find();
        $this->assign('himg4' , $himg4);

        $this->display();

    }
    //库存现货
    public function stock($type = 1,$cid = 0){
        $map['cid'] = $cid;
        $info = D('Xianhuo')->getMap($map)->getXinahuo($type);
        $lists = $info['lists'];
        $totalCount = $info['count'];
        $this->assign('lists' , $lists);
        $this->assign('totalCount',$totalCount);
        
        $this->display();
    }
    //企业简介
    public function about($cid = 0){
        $this->display();
    }
    //企业资质
    public function qualified($cid = 0){
        //企业资质
        $himg4 = D('HomeImg')->where(array(
            array('cid' => $cid),
            array('type' => 4)
        ))->find();
        $this->assign('himg4' , $himg4);
        $this->display();
    }
    //联系方式
    public function contact(){
        $this->display();
    }
    //招聘
    public function recruit($cid = 0){
        $this->display();
    }
}