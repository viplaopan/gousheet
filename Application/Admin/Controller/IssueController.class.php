<?php
/**
 * Created by PhpStorm.
 * User: caipeichao
 * Date: 14-3-14
 * Time: AM10:59
 */

namespace Admin\Controller;

use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;
use Admin\Builder\AdminSortBuilder;

class IssueController extends AdminController
{
	//广告页面
    public function index($page = 1, $r = 20)
    {
    	//读取广告位
        $map = array('status' => array('EGT', 0));
		$Model = D('Issue');
       
        $lists = $Model->where($map)->page($page, $r)->select();
        $totalCount = $Model->where($map)->count();
        foreach($lists as &$val){
            

        }
        unset($val);
        //显示页面
        $builder = new AdminListBuilder();
        $builder->title('用户')
            ->setStatusUrl(U('setStatus'))
            ->keyId()
            ->setStatusUrl(U('setStatus'))
            ->keyText('title', '标题')
            ->keyText('lianxi', '联系人')
            ->keyCreateTime()
            ->keyStatus()
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
    }
	public function setStatus($ids, $status)
    {
        $builder = new AdminListBuilder();
        $builder->doSetStatus('Issue', $ids, $status);
    }
}