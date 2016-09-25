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

	/**
	 * User: laopan
	 * Date: 16-9-17
	 * Time: AM7:45
	 * page:物流管理
	 */
	public function logistics(){
		$map['status'] = array('gt',0);
		$lists = D('logistics')->where($map)->select();
		//显示页面
        $builder = new AdminListBuilder();
        $builder->title('商圈列表')
            ->buttonNew(U('editLogistics'))
            ->buttonDelete()
            ->setStatusUrl(U('setStatus'))
            ->buttonEnable()
            ->buttonDisable()
            ->keyId()
            ->keyText('name', '物流名称')
            ->keyText('from', '起始','输入一个起始城市')
            ->keyText('to', '途径','可上传多个地区分号结尾，例如:上海,温州')
            ->keyStatus()->keyDoActionEdit('editLogistics?id=###')
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
	public function editLogistics($id = 0){
		//判断是否为编辑模式
        $isEdit = $id ? true : false;
		if(IS_POST){
			if ($isEdit) {
				$data = D('logistics')->create();
	            $res = D('logistics')->save($data);
	        } else {
	            $data = D('logistics')->create();
				$res = D('logistics')->add($data);
	        }
			if(!$res){
				$this->error($isEdit ? '编辑失败' : '创建失败');
			}
			//显示成功信息，并返回规则列表
            $this->success($isEdit ? '编辑成功' : '创建成功', U('logistics'));
		}else{
			//读取商圈内容
	        if ($isEdit) {
	            $data = M('logistics')->where(array('id' => $id))->find();
	        }else{
	        	$data['status'] = 1;
	        }
	        //显示页面
	        $builder = new AdminConfigBuilder();
	        $builder->title($isEdit ? '编辑规则' : '添加规则')
            ->keyId()
            ->keyText('name', '物流名称','')
            ->keyText('lists', '线路描述', '')
			->keyText('from', '起始地址','只能写一个地区')
            ->keyText('to', '途径地区', '可上传多个地区分号结尾，例如:上海,温州')
            ->keyText('address', '地址', '')
            ->keyText('mobile', '手机号码', '可多选')           
            ->keyText('fax', '传真', '')
             ->keyText('contact', '联系人', '可多选')
             ->keyImage('cover', 'logo图片')
            ->keyStatus()
            ->data($data)
            ->buttonSubmit(U('editLogistics'))->buttonBack()
            ->display();
			
		}
	}
	/**
	 * User: laopan
	 * Date: 16-9-17
	 * Time: AM7:45
	 * page:加工定制
	 */
	public function process(){
		$map['status'] = array('gt',0);
		$lists = D('process')->where($map)->select();
		//显示页面
        $builder = new AdminListBuilder();
        $builder->title('商圈列表')
            ->buttonNew(U('editProcess'))
            ->buttonDelete()
            ->setStatusUrl(U('setStatus'))
            ->buttonEnable()
            ->buttonDisable()
            ->keyId()
            ->keyText('name', '标题','')
            ->keyText('business', '主营业务')
            
            ->keyStatus()->keyDoActionEdit('editProcess?id=###')
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
		$this->display();
	}
	public function editProcess($id = 0){
		//判断是否为编辑模式
        $isEdit = $id ? true : false;
		if(IS_POST){
			if ($isEdit) {
				$data = D('process')->create();
	            $res = D('process')->save($data);
	        } else {
	            $data = D('process')->create();
				$res = D('process')->add($data);
	        }
			if(!$res){
				$this->error($isEdit ? '编辑失败' : '创建失败');
			}
			//显示成功信息，并返回规则列表
            $this->success($isEdit ? '编辑成功' : '创建成功', U('process'));
		}else{
			//读取商圈内容
	        if ($isEdit) {
	            $data = M('process')->where(array('id' => $id))->find();
	        }else{
	        	$data['status'] = 1;
	        }

	        $options = array();
	        $map['status'] = array('eq',1);
	        $map['pid'] = array('neq',0);
	        $cagegory = D('ProcessCategory')->where($map)->order('pid desc')->select();
	        foreach($cagegory as $val){
	        	$options[$val['id']] = $val['name'];
	        }

	        //显示页面
	        $builder = new AdminConfigBuilder();
	        $builder->title($isEdit ? '编辑规则' : '添加规则')
            ->keyId()
            ->keyText('name', '标题','')
            ->keySelect('category', '分类','',$options)
            ->keyText('business', '主营业务','')
            ->keyText('address', '地址', '')
            ->keyText('mobile', '手机号码', '可多选')           
            ->keyText('fax', '传真', '')
             ->keyText('contact', '联系人', '可多选')
             ->keyImage('cover', 'logo图片')
            ->keyStatus()
            ->data($data)
            ->buttonSubmit(U('editProcess'))->buttonBack()
            ->display();
			
		}
	}
	/**
	 * User: laopan
	 * Date: 16-9-17
	 * Time: AM7:45
	 * page:加工定制分类
	 */
	public function process_category(){
		$map['status'] = array('gt',0);
		$map['pid'] = 0;
		$lists = D('ProcessCategory')->where($map)->select();
		foreach($lists as &$val){
			$val['html'] = '<a href="' .U('process_category_small',array('pid' => $val['id'])). '">子分类列表</a>';
		}
		unset($val);
		//显示页面
        $builder = new AdminListBuilder();
        $builder->title('商圈列表')
            ->buttonNew(U('editProcessCategory'))
            ->buttonDelete()
            ->setStatusUrl(U('setStatus'))
            ->buttonEnable()
            ->buttonDisable()
            ->keyId()
            ->keyText('name', '分类名称')
           	->keyDoActionEdit('editProcessCategory?id=###')
           	->keyHtml('html','添加子分类')
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
		$this->display();
	}

	/**
	 * User: laopan
	 * Date: 16-9-17
	 * Time: AM7:45
	 * page:编辑/添加加工定制分类
	 */
	public function editProcessCategory($id = 0,$pid = 0){
		//判断是否为编辑模式
        $isEdit = $id ? true : false;
		if(IS_POST){
			if ($isEdit) {
				$data = D('ProcessCategory')->create();
	            $res = D('ProcessCategory')->save($data);
	        } else {
	            $data = D('ProcessCategory')->create();
				$res = D('ProcessCategory')->add($data);
	        }
			if(!$res){
				$this->error($isEdit ? '编辑失败' : '创建失败');
			}
			//显示成功信息，并返回规则列表
            $this->success($isEdit ? '编辑成功' : '创建成功', U('process_category'));
		}else{
			//读取商圈内容
	        if ($isEdit) {
	            $data = M('ProcessCategory')->where(array('id' => $id))->find();
	        }else{
	        	$data['status'] = 1;
	        	$data['pid'] = $pid;
	        }
	        //显示页面
	        $builder = new AdminConfigBuilder();
	        $builder->title($isEdit ? '编辑规则' : '添加规则')
            ->keyId()
            ->keyText('name', '分类名称','')
            ->keyText('pid', '分类名称','')
            ->keyStatus()
            ->data($data)
            ->buttonSubmit(U('editProcessCategory'))->buttonBack()
            ->display();
			
		}
	}
	public function process_category_small($pid = 0){
		$map['status'] = array('gt',0);
		$map['pid'] = $pid;
		$lists = D('ProcessCategory')->where($map)->select();
		
		//显示页面
        $builder = new AdminListBuilder();
        $builder->title('商圈列表')
            ->buttonNew(U('editProcessCategory',array('pid'=>$pid)))
            ->buttonDelete()
            ->setStatusUrl(U('setStatus'))
            ->buttonEnable()
            ->buttonDisable()
            ->keyId()
            ->keyText('name', '分类名称')
           	->keyDoActionEdit('editProcessCategory?id=###')
           	
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
		$this->display();
	}
}