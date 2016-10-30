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
class IssueController extends Controller {
    public function index($page = 1){
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
        $this->assign('lists', $lists);
        $this->display();
    }
    public function edit($id = 0){
        $isEdit = $id?1:0;
        if(IS_POST){
            /* 检测验证码 */
            $verify = I('post.verify');
            if(!check_verify($verify)){
                $this->error('验证码输入错误！');
            }
            $data = D('Issue')->create();
            if($isEdit){
                $data['id'] = $id;
                $res = D('Issue')->save($data);
            }else{
                $data['create_time'] = time();
                $res = D('Issue')->add($data);
            }
            if($res){
                $this->success('提交成功');
            }else{
                $this->error('提交失败');
            }
        }else{
            $this->display();
        }
        
    }
}