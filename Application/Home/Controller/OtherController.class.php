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
 * 其他页面控制器
 * 主要获取首页聚合数据
 */
class OtherController extends Controller {
    public function Contact(){
        $this->display();
    }
    public function About(){
        $this->display();
    }
    public function Legal(){
        $this->display();
    }
    public function Recruitment(){
        $this->display();
    }
    public function Investment(){
        $this->display();
    }
    public function Remittance(){
        $this->display();
    }
}