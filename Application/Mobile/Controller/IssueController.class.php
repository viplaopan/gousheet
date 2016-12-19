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
class IssueController extends Controller {

	//网站资讯
    public function index($page = 1){
        //求购
        $map['status'] = 1;
        $lists = D('Issue')->where($map)->order('create_time desc')->page($page, 20)->select();
        $totalCount = D('Issue')->where($map)->count();
        $this->assign('totalPageCount', $totalCount);
        
        foreach($lists as &$val){
            //获取公司信息
            $ti = time() - $val['create_time'];
            $day = $ti/86400;

            if($day < $val['day_type']){
                $t1 = $val['day_type'] * 86400 - $ti;
                switch($t1){
                    case $t1 < 86400:
                        $hour = floor($t1/3600);
                        $min = floor(($t1-$hour*3600)/60);
                        $val['time'] = '还剩' .$hour. '小时 '.$min.'分钟';;
                        break;
                    default:
                      $sday = floor($t1/86400);
                      $hour = floor(($t1-$sday*86400)/3600);
                      $min = floor(($t1-$sday*86400-$hour*3600)/60);
                      $val['time'] = "还剩$sday天 $hour小时 $min分钟";
                      break; 
                }
            }else{
                $val['time'] = 0;
            }
            
        }
        unset($val);

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
            $this->assign('lists', $lists);
            $this->display();
        }

        
    	
        
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