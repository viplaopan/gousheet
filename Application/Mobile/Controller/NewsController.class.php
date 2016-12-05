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
class NewsController extends Controller {

	//网站资讯
    public function index($page = 1){
        //今日头条
        $lists = D('Document')->page($page,20)->lists();
        if(IS_POST){
            $html = "";
            foreach($lists as $vo){
                $url = U('Mobile/News/detail',array('id'=>$vo['id']));
                $title = $vo['title'];
                $date = date("Y-m-d",$vo['create_time']);
                if($vo['cover_id'] == 0){
                    $html .= '<li class="am-g am-list-item-desced">'.
                        '<div class="am-list-main">'.
                          '<h3 class="am-list-item-hd">'.
                            '<a href="'.$url.'">'.$title.'</a>'.
                          '</h3>'.
                          '<span class="am-list-date">'.$date.'</span>'.
                        '</div>'.
                    '</li>';
                }else{
                    $get_cover = get_cover($vo['cover_id'],'path');
                    $html .= '<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-right">'.
                        '<div class=" am-u-sm-8 am-list-main">'.
                            '<h3 class="am-list-item-hd"><a href="'.$url.'" class="">'.$title.'</a></h3>'.
                            '<span class="am-list-date">'.$date.'</span>'.
                        '</div>'.
                          '<div class="am-u-sm-4 am-list-thumb">'.
                            '<a href="'.$url.'" class="">'.
                              '<img src="'.$get_cover.'" />'.
                            '</a>'.
                          '</div>'.
                      '</li>';
                }
                
            }
            echo $html;
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