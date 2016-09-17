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

class DatacenterController extends AdminController
{
	/**
	 * User: laopan
	 * Date: 16-9-17
	 * Time: AM7:45
	 * page:推荐公司
	 */
	public function company(){
		$map['status'] = array('gt',0);
		$lists = D('ReCompany')->where($map)->select();
		//显示页面
        $builder = new AdminListBuilder();
        $builder->title('商圈列表')
            ->buttonNew(U('editCompany'))
            ->buttonDelete()
            ->setStatusUrl(U('setStatus'))
            ->buttonEnable()
            ->buttonDisable()
            ->keyId()
            ->keyText('company_name', '公司名称')
            ->keyText('sort', '排序')
            ->keyStatus()->keyDoActionEdit('editCompany?id=###')
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
		$this->display();
	}
	/**
	 * User: laopan
	 * Date: 16-9-17
	 * Time: AM7:45
	 * page:编辑/添加推荐公司
	 */
	public function editCompany($id = 0){
		//判断是否为编辑模式
        $isEdit = $id ? true : false;
		if(IS_POST){
			if ($isEdit) {
				$data = D('ReCompany')->create();
	            $res = D('ReCompany')->save($data);
	        } else {
	            $data = D('ReCompany')->create();
				$res = D('ReCompany')->add($data);
	        }
			if(!$res){
				$this->error($isEdit ? '编辑失败' : '创建失败');
			}
			//显示成功信息，并返回规则列表
            $this->success($isEdit ? '编辑成功' : '创建成功', U('index'));
		}else{
			//读取商圈内容
	        if ($isEdit) {
	            $data = M('ReCompany')->where(array('id' => $id))->find();
	        }else{
	        	$data['status'] = 1;
	        }
	        //显示页面
	        $builder = new AdminConfigBuilder();
	        $builder->title($isEdit ? '编辑规则' : '添加规则')
            ->keyId()
            ->keyText('company_name', '公司名称','')
			->keyText('url', '链接地址','填写完整的URL')
            ->keyText('sort','排序','必须填写数字')
            ->keyTextArea('desc','描述','')
            ->keyStatus()
            ->data($data)
            ->buttonSubmit(U('editCompany'))->buttonBack()
            ->display();
			
		}
	}
	//状态
	public function setStatus($ids, $status,$database = ''){
		$builder = new AdminListBuilder();
        $builder->doSetStatus('Sd', $ids, $status);
	}
}