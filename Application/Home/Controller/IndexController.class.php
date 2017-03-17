<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {

	//网站首页
    public function index(){
        //推荐公司
        $companies = D('ReCompany')->limit(5)->where(array(
            array('status'=>1)
        ))->select();
        $this->assign('companies', $companies);

    	//热文要闻
    	$hot = D('Document')->limit(5)->order('update_time desc')->position(4);

    	$this->assign('hot', $hot);

    	//市场快讯
    	$shichang = D('Document')->limit(9)->lists(39);
    	$this->assign('shichang', $shichang);

        //原料行情
        $yuanliao = D('Document')->limit(8)->lists(41);
        $this->assign('yuanliao', $yuanliao);

        //管件行情
        $guanjian = D('Document')->limit(8)->lists(42);
        $this->assign('guanjian', $guanjian);
        
        //泵阀行情
        $bengfa = D('Document')->limit(8)->lists(43);
        $this->assign('bengfa', $bengfa);

        //会议会展
        $huiyi = D('Document')->limit(8)->lists(2);
        $this->assign('huiyi', $huiyi);

        //企业风采
        $qiye = D('Document')->limit(8)->lists(40);
        $this->assign('qiye', $qiye);

        //网站动态
        $wangzhan = D('Document')->limit(8)->lists(44);
        $this->assign('wangzhan', $wangzhan);

        //Banner
        $adm['status'] = 1;
        $adm['pos_id'] = 2;
        $banners = D('Adv')->where($adm)->order('sort desc')->select();
        $this->assign('banners',$banners);
       
        $this->display();
    }
    public function detail($cid = 0){
        $company = D("Company")->where('id = ' . $cid)->find();
        $company['descsm'] = strip_tags($company['desc']);
        $this->assign('company' , $company);
        $contact = D('contact')->where('cid = ' . $cid)->find();
         $this->assign('contact' , $contact);
        //企业愿景
        $himg1 = D('HomeImg')->where(array(
            array('cid' => $cid),
            array('type' => 0)
        ))->find();
        $this->assign('himg1' , $himg1);
        $this->display();
    }
    public function zx(){
        $this->display();
    }
    public function swhz(){
        $this->display();
    }
}