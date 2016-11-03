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

class LinkController extends AdminController
{
	//广告页面
    public function index($page = 1, $r = 20)
    {
    	//读取广告位
        $map = array('status' => array('EGT', 0));
		$Model = D('Link');
       
        $lists = $Model->where($map)->page($page, $r)->order('uid desc')->select();
        $totalCount = $Model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $builder->title('用户')
            ->setStatusUrl(U('setSatus'))
            ->buttonNew(U('edit'))
            ->keyId()
            ->keyText('title', '标题')
            ->keyText('url', '链接')
            ->keyStatus()
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
    }
    public function setSatus($ids, $status)
    {
        $builder = new AdminListBuilder();
        $builder->doSetStatus('Link', $ids, $status);
    }
    public function edit($id = 0){
        $isEdit = $id?1:0;
        if(IS_POST){
            if($isEdit){

            }
        }else{
            $builder = new AdminConfigBuilder();
            $builder->title($isEdit ? '编辑规则' : '添加规则')
                    ->keyId()
                    ->keyText('title', '标题')
                    ->keyText('url', '链接')
                    ->keyStatus();
        }

    }
}