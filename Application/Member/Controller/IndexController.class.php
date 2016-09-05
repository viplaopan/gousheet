<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Member\Controller;
use User\Api\UserApi;

/**
 * 用户中心控制器
 */
class IndexController extends BaseController {
	//用户中心首页
	public function index(){
		$lastIP = D('UcenterMember')->where('id = ' . UID )->getField('last_login_ip');
		$this->assign('lastIP',$lastIP);
		
		$loginTimes = D('Member')->where('uid = ' . UID )->getField('login');
		$this->assign('loginTimes',$loginTimes);
		$this->display();
	}
	
	public function basics(){
		if(IS_POST){
			//获取公司信息
			$cinfo = D('Company')->where('uid = ' . UID )->find();
			$isEdit = $cinfo?1:0;
			$data = D('Company')->create();
			//主营业务
			$data['business'] = implode(',', I('post.business'));
			
			if(!$data){
				$this->error('数据错误');
			}
			if($isEdit){
				$res = D('Company')->where('uid = ' . UID)->save($data);
			}else{
				$res = D('Company')->add($data);
			}
			if($res){
				$this->success('提交成功');
			}else{
				$this->error('数据错误');
			}
			
			
		}else{
			//读取城市地区
			$prov = D('region')->where('region_type = 1')->order('region_id desc')->select();
			$area = D('region')->where('region_type = 3')->order('region_id desc')->select();
			$city = D('region')->where('region_type = 2 ')->order('region_id desc')->select();
			$this->assign('prov',json_encode($prov));
			$this->assign('city',json_encode($city));
			$this->assign('area',json_encode($area));
			
			$info = D('Member')->where('uid = ' . UID )->find();
			$this->assign('info',$info);
			
			$cinfo = D('Company')->where('uid = ' . UID )->find();
			$this->assign('cinfo',$cinfo);
			$this->display();
		}
		
	}
	
	public function contact(){
		if(IS_POST){			
			//获取公司信息
			$contact = D('Contact')->where('uid = ' . UID )->find();
			$isEdit = $contact?1:0;
			$data = D('Contact')->create();
			
			if(!$data){
				$this->error('数据错误');
			}
			if($isEdit){
				$res = D('Contact')->where('uid = ' . UID)->save($data);
			}else{
				$res = D('Contact')->add($data);
			}
			if($res){
				$this->success('提交成功');
			}else{
				$this->error('数据错误');
			}
		}else{
			$contact = D('Contact')->where('uid = ' . UID )->find();
			$this->assign('contact',$contact);
			$this->display();
		}
		
	}
	
	public function field(){
		if(IS_POST){
			//获取公司信息
			$field = D('Field')->where('uid = ' . UID )->find();
			$isEdit = $field?1:0;
			$data = D('Field')->create();
			
			if(!$data){
				$this->error('数据错误');
			}
			if($isEdit){
				$res = D('Field')->where('uid = ' . UID)->save($data);
			}else{
				$res = D('Field')->add($data);
			}
			if($res){
				$this->success('提交成功');
			}else{
				$this->error('数据错误');
			}
		}else{
			$field = D('Field')->where('uid = ' . UID )->find();
			$this->assign('field',$field);
			$this->display();
		}
	}
	
	public function homeImage(){
		$this->display();
	}
	
	public function manage(){
		$this->display();
	}
	public function recruit(){
		$recruits = D('Recruit')->where('uid = ' . UID) -> select();
		$this->assign('recruits',$recruits);
		$this->display();
	}
	public function cpwd(){
		$this->display();
	}
	public function recruitEdit($id = 0){
		//
		$isEdit = $id?1:0;
		if(IS_POST){
			
			$data = D('Recruit')->create();
           
			if($isEdit){
				$res = D('Recruit')->where(array('id' => $id))->save($data);
				
			}else{
				$res = D('Recruit')->add($data);
			}

			if($res){
				$this->success('提交成功');
			}else{
				$this->error('数据错误');
			}
			
		}else{
			if($isEdit){
				$recruit = D('Recruit')->where('id = ' . $id) -> find();
			}
			
			$this->assign('recruit',$recruit);
			$this->display();
		}
	}
	
	public function uploadExcel(){
		/* 调用文件上传组件上传文件 */
		$File = D('File');
		$file_driver = C('DOWNLOAD_UPLOAD_DRIVER');
		$info = $File->upload(
			$_FILES,
			C('DOWNLOAD_UPLOAD'),
			C('DOWNLOAD_UPLOAD_DRIVER'),
			C("UPLOAD_{$file_driver}_CONFIG")
		);

		$excel_path = $info['file']['path'];

		//获取数据
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.IOFactory");
        import("Org.Util.PHPExcel.Reader.Excel5");
        import("Org.Util.PHPExcel.Reader.Excel2007");
        $objPHPExcel = new \PHPExcel();
        $objReader = \PHPExcel_IOFactory::createReader('Excel5'); //use excel2007 for 2007 format
        $objPHPExcel = $objReader->load('.' . $excel_path);
       
		
		$result = D('Xianhuo')->addXianhuo($objPHPExcel);
		$this->ajaxReturn($result,'json');
	}
	public function update(){
		$company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
		D('xhGangguan')->where('cid = '.$cid)->save(array('create_time'=>time()));
		D('xhFalan')->where('cid = '.$cid)->save(array('create_time'=>time()));
		D('xhFamen')->where('cid = '.$cid)->save(array('create_time'=>time()));
		D('xhXingcai')->where('cid = '.$cid)->save(array('create_time'=>time()));
		D('xhBancai')->where('cid = '.$cid)->save(array('create_time'=>time()));
		D('xhJuancai')->where('cid = '.$cid)->save(array('create_time'=>time()));
		D('xhDaicai')->where('cid = '.$cid)->save(array('create_time'=>time()));
		D('xhGuanjianWt')->where('cid = '.$cid)->save(array('create_time'=>time()));
		D('xhGuanjianSst')->where('cid = '.$cid)->save(array('create_time'=>time()));
		D('xhGuanjianFt')->where('cid = '.$cid)->save(array('create_time'=>time()));
		$this->success();
	}
	public function del(){
		$company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
		D('xhGangguan')->where('cid = '.$cid)->delete();
		D('xhFalan')->where('cid = '.$cid)->delete();
		D('xhFamen')->where('cid = '.$cid)->delete();
		D('xhXingcai')->where('cid = '.$cid)->delete();
		D('xhBancai')->where('cid = '.$cid)->delete();
		D('xhJuancai')->where('cid = '.$cid)->delete();
		D('xhDaicai')->where('cid = '.$cid)->delete();
		D('xhGuanjianWt')->where('cid = '.$cid)->delete();
		D('xhGuanjianSst')->where('cid = '.$cid)->delete();
		D('xhGuanjianFt')->where('cid = '.$cid)->delete();
		$this->success();
	}
}
