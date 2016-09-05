<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/7
 * Time: 21:04
 */
namespace Home\Controller;
use Think\Controller;


class OfficesController extends Controller {
    /*办公室列表页面*/
    public function index (){
    	//获取选中的地区
		$se_region = session('region');
		if(!$se_region){
			$se_region = 321;//默认上海
			session('region',$se_region);
		}

		//读取数据
		$lists = D('Resources')->lists($se_region);
		echo D('Resources')->getLastSql();
        $this->display();
    }

    /*办公室详情页面*/
    public function detail (){
        $this->display();
    }
}