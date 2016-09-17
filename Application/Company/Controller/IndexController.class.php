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
class IndexController extends Controller {

	//网站首页
    public function index(){
        //推荐公司
        $companies = D('ReCompany')->where(array(
            array('status'=>1)
        ))->select();
        $this->assign('companies', $companies);

    	//热文要闻
    	$hot = D('Document')->position(8);
    	$this->assign('hot', $hot);

    	//市场快讯
    	$shichang = D('Document')->lists('shichang');
    	$this->assign('shichang', $shichang);

        //原料行情
        $yuanliao = D('Document')->lists('yuanliao');
        $this->assign('yuanliao', $yuanliao);

        //管型行情
        $guanxing = D('Document')->lists('guanxing');
        $this->assign('guanxing', $guanxing);
        
        //泵阀行情
        $bengfa = D('Document')->lists('bengfa');
        $this->assign('bengfa', $bengfa);

        //会议会展
        $huiyi = D('Document')->lists('huiyi');
        $this->assign('huiyi', $huiyi);

        //企业风采
        $qiye = D('Document')->lists('qiye');
        $this->assign('qiye', $qiye);

        //网站动态
        $wangzhan = D('Document')->lists('wangzhan');
        $this->assign('wangzhan', $wangzhan);



        $this->display();
    }

}