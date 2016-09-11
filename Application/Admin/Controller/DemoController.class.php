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

class DemoController extends AdminController
{
	/* 钢管 */
	public function sactuals($page = 1, $r = 20)
    {
    	$cate = 1;
        $map['cate'] = array('eq', $cate);
        $model = M('XhMessage');
        $lists = $model->where($map)->page($page, $r)->order('id desc')->select();
        $totalCount = $model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $builder->title('钢管消息列表')
            ->buttonNew(U('doMessage',array('cate'=>$cate)))
            ->buttonDelete()
            ->setStatusUrl(U('setMessageStatus'))
            ->keyId()
            ->keyText('title', '消息标题')
            ->keyStatus()->keyDoActionEdit('doMessage?id=###')
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
    }
    /* 型材 */
	public function profile($page = 1, $r = 20)
    {
    	$cate = 2;
        $map['cate'] = array('eq', $cate);
        $model = M('XhMessage');
        $lists = $model->where($map)->page($page, $r)->order('id desc')->select();
        $totalCount = $model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $builder->title('钢管消息列表')
            ->buttonNew(U('doMessage',array('cate'=>$cate)))
            ->buttonDelete()
            ->setStatusUrl(U('setMessageStatus'))
            ->keyId()
            ->keyText('title', '消息标题')
            ->keyStatus()->keyDoActionEdit('doMessage?id=###')
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
    }
	//商圈状态
	public function setMessageStatus($ids, $status){
		$builder = new AdminListBuilder();
        $builder->doSetStatus('XhMessage', $ids, $status);
	}
	//编辑商圈
	public function doMessage($id = 0){
		//判断是否为编辑模式
        $isEdit = $id ? true : false;
		if(IS_POST){
			if ($isEdit) {
				$data = D('XhMessage')->create();
	            $res = D('XhMessage')->save($data);
	        } else {
	            $data = D('XhMessage')->create();
				$res = D('XhMessage')->add($data);
	        }
			if(!$res){
				$this->error($isEdit ? '编辑失败' : '创建失败');
			}
			//显示成功信息
            $this->success($isEdit ? '编辑成功' : '创建成功', U('index'));
		}else{ 
			$cate = I('get.cate');
			//读取楼宇内容
	        if ($isEdit) {
	            $data = M('XhMessage')->where(array('id' => $id))->find();

	        } else {
	            $data['status'] = 1;
	        }
			
			
			//显示页面
	        $builder = new AdminConfigBuilder();
	        $builder->title($isEdit ? '编辑规则' : '添加规则')
	            ->keyId()
                ->keyText('title', '消息标题','显示列表也的消息')
				->keyText('url', '链接地址','填写完整的URL')
                ->keyHidden('cate', $cate)
	            ->keyStatus()
	            ->data($data)
	            ->buttonSubmit(U('doMessage'))->buttonBack()
	            ->display();
			
		}
	}
	
}