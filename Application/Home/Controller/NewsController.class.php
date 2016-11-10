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
class NewsController extends Controller {
    public function index(){
        //热文要闻
        $hot = D('Document')->limit(5)->position(4);
        $this->assign('hot', $hot);

        //市场快讯
        $shichang = D('Document')->limit(3)->lists(39);
        $this->assign('shichang', $shichang);

        //原材行情
        $yuancai = D('Document')->limit(4)->lists(41);
        $this->assign('yuancai', $yuancai);

        //管件行情
        $guanjian = D('Document')->limit(4)->lists(42);
        $this->assign('guanjian', $guanjian);

        //泵阀行情
        $shuifa = D('Document')->limit(4)->lists(43);
        $this->assign('shuifa', $shuifa);

        //推荐公司
        $companies = D('ReCompany')->where(array(
            array('status'=>1)
        ))->select();
        $this->assign('companies', $companies);

        //Banner
        $adm['status'] = 1;
        $adm['pos_id'] = 3;
        $banners = D('Adv')->where($adm)->order('sort desc')->select();
        $this->assign('banners',$banners);
        $this->display();
    }
    public function lists($category = 0,$page = 1){
        //推荐公司
        $companies = D('ReCompany')->where(array(
            array('status'=>1)
        ))->select();
        $this->assign('companies', $companies);

        $lists = D('Document')->page($page, 20)->lists($category);
        $totalCount = D('Document')->listCount();
        $this->assign('totalCount',$totalCount);
        $this->assign('lists',$lists);
        $this->display();
    }
    public function detail($id = 0){
        $info = D('Document')->detail($id);       
        $this->assign('info', $info);

        //原材行情
        $cates = D('Document')->lists($info['category']);
        $this->assign('cates', $cates);
        $this->display();
    }
}