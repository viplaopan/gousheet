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
       
        $lists = $Model->where($map)->page($page, $r)->select();
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
            $data = D('Link')->create();
            if ($isEdit) {
                $res = D('Link')->save($data);
            } else {
                $res = D('Link')->add($data);
            }
            if(!$res){
                $this->error($isEdit ? '编辑失败' : '创建失败');
            }
        }else{
            if ($isEdit) {
                $data = M('Link')->where(array('id' => $id))->find();

            } else {
                $data['status'] = 1;
            }
            $builder = new AdminConfigBuilder();
            $builder->title($isEdit ? '编辑规则' : '添加规则')
                    ->keyId()
                    ->keyText('title', '标题')
                    ->keyText('url', '链接')
                    ->keyStatus()
                    ->data($data)
                    ->buttonSubmit(U('edit'))
                    ->buttonBack()
                    ->display();
        }

    }
}