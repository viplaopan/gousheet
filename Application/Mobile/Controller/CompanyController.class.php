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
class CompanyController extends Controller {
    public function detail($id = 0,$p=1){
        $map['id']= $id;
        switch ($p) {
            case 'Sactuals':
                $info = D("xhGangguan")->where($map)->find();
                $this->assign('info',$info);
            break;
            case 'profile':
                $info = D("xhXingcai")->where($map)->find();
                $this->assign('info',$info);
            break;
            case 'frenchay':
                $info = D("xhFalan")->where($map)->find();
                $this->assign('info',$info);
            break;
            case 'frenchay':
                $info = D("xhFamen")->where($map)->find();
                $this->assign('info',$info);
            break;
            case 'molding_three':
                $info = D("xhGuanjianWt")->where($map)->find();
                $this->assign('info',$info);
            break;
            case 'molding_two':
                $info = D("xhGuanjianSst")->where($map)->find();
                $this->assign('info',$info);
            break;
            case 'molding_one':
                $info = D("xhGuanjianFt")->where($map)->find();
                $this->assign('info',$info);
            break;
            case 'plank':
                $info = D("xhBancai")->where($map)->find();
                $this->assign('info',$info);
            break;
            case 'sheet':
                $info = D("xhBancai")->where($map)->find();
                $this->assign('info',$info);
            break;
            default:
                $info = D("xhJuancai")->where($map)->find();
        $this->assign('info',$info);
                break;
        }
        
        $cid = $info['cid'];
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
}