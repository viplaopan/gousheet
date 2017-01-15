<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Mobile\Controller;
use User\Api\UserApi;

/**
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class UserController extends HomeController {

	/* 用户中心首页 */
	public function index(){
		
	}

	/* 注册页面 */
	public function register($username = NULL, $password = '', $repassword = '', $email = '', $verify = '', $mobile = ''){
        if(!C('USER_ALLOW_REGISTER')){
            $this->error('注册已关闭');
        }
		if(IS_POST){ //注册用户
			// 验证code
			if($_POST['mobile']!=$_SESSION['mobile'] or $_POST['code']!=$_SESSION['mobile_code'] or empty($_POST['mobile']) or empty($_POST['code'])){
				$this->error('验证码错误');
			}

			/* 检测密码 */
			if($password != $repassword){
				$this->error('密码和重复密码不一致！');
			}			


			/* 调用注册接口注册用户 */
            $User = new UserApi;
			$uid = $User->register($username, $password, $email, $mobile);
			if(0 < $uid){ //注册成功
				$Member = D('Member');
				$Member->login($uid);
				$cdata['uid'] = $uid;
				$cdata['name']  = I('post.company');
				$cid = D('Company')->add($cdata);
				$ctdata['cid'] = $cid;
				$ctdata['name'] = I('post.realname');
				D('Contact')->add($ctdata);
				//TODO: 发送验证邮件
				$this->success('注册成功！',U('register2'));
			} else { //注册失败，显示错误信息
				$this->error($this->showRegError($uid));
			}
		} else { //显示注册表单
		    $_SESSION['send_code'] = random(6,1);
			$this->display();
		}
	}
	public function register2(){
		$cid = D('Company')->where(array('uid'=>UID))->getField('id');
		if(IS_POST){
			//获取公司信息
			$contact = D('Contact')->where('cid = ' . $cid )->find();
			$isEdit = $contact?1:0;
			$data = D('Contact')->create();
			
			if(!$data){
				$this->error('数据错误');
			}
			if($isEdit){
				$res = D('Contact')->where('cid = ' . $cid)->save($data);
			}else{
				$data['cid'] = $cid;
				$res = D('Contact')->add($data);
			}
			if($res){
				$this->success('提交成功',U('register3'));
			}else{
				$this->error('数据错误');
			}
		}else{
			$this->display();
		}
	}
	public function register3(){
		if(IS_POST){
			//获取公司信息
			$cinfo = D('Company')->where('uid = ' . UID )->find();
			$isEdit = $cinfo?1:0;
			$data = D('Company')->create();
			//主营业务
			$data['business'] = I('post.business');
			
			if(!$data){
				$this->error('数据错误');
			}
			if($isEdit){
				$res = D('Company')->where('uid = ' . UID)->save($data);
			}else{
				$res = D('Company')->add($data);
			}
			if($res){
				$this->success('提交成功',U('myinfo'));
			}else{
				$this->error('数据错误');
			}
		}else{
			$this->display();
		}
	}
	public function myinfo(){
		$info = D('Member')->where('uid = ' . UID )->find();
		$this->assign('info',$info);
		
		$cinfo = D('Company')->where('uid = ' . UID )->find();
		$this->assign('cinfo',$cinfo);

		$cont = D('Contact')->where('cid = ' . $cinfo['id'])->find();
		$this->assign('cont',$cont);

		$uinfo = D('UcenterMember')->where('id = ' . UID )->find();
		$this->assign('uinfo',$uinfo);
		$this->display();
	}
	public function myinfocompany(){
		if(IS_POST){
			//获取公司信息
			$cinfo = D('Company')->where('uid = ' . UID )->find();
			$isEdit = $cinfo?1:0;
			$data = D('Company')->create();
			//主营业务
			$data['business'] = I('post.business');
			
			if(!$data){
				$this->error('数据错误');
			}
			if($isEdit){
				$res = D('Company')->where('uid = ' . UID)->save($data);
			}else{
				$res = D('Company')->add($data);
			}
			if($res){
				$this->success('提交成功',U('myinfocompany'));
			}else{
				$this->error('数据错误');
			}
		}else{
			$cinfo = D('Company')->where('uid = ' . UID )->find();
			// $business = explode(',',$cinfo['business']);
			// dump($business);
			$this->assign('cinfo',$cinfo);
			$this->display();
		}

		
	}
	/* 登录页面 */
	public function login($mobile = '', $password = '', $verify = ''){
		if(IS_POST){ //登录验证
			/* 检测验证码 */
//			if(!check_verify($verify)){
//				$this->error('验证码输入错误！');
//			}
			
			/* 调用UC登录接口登录 */
			$user = new UserApi;
			if(preg_match('/^1[3|4|5|7|8]\d{9}$/', $mobile)){
			//这里有无限想象
				$uid = $user->login($mobile, $password,3);
			}else{
				$uid = $user->login($mobile, $password);
			}
			
			if(0 < $uid){ //UC登录成功
				/* 登录用户 */
				$Member = D('Member');
				if($Member->login($uid)){ //登录用户
					//TODO:跳转到登录前页面
					$this->success('登录成功！',U('my'));
				} else {
					$this->error($Member->getError());
				}

			} else { //登录失败
				switch($uid) {
					case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
					case -2: $error = '密码错误！'; break;
					default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
				}
				$this->error($error);
			}

		} else { //显示登录表单
		 	$_SESSION['send_code'] = random(6,1);
			$this->display();
		}
	}
	
	//验证手机号码
	public function checkMobile($mobile = ''){
		$User = new UserApi;
		$res = $User->checkMobile($mobile);//用户名类型 1-用户名，2-用户邮箱，3-用户电话
      
		if($res>0){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	
	/* 退出登录 */
	public function logout(){
		if(is_login()){
			D('Member')->logout();
			$this->success('退出成功！', U('User/login'));
		} else {
			$this->redirect('User/login');
		}
	}

	/* 验证码，用于登录和注册 */
	public function verify(){
		$verify = new \Think\Verify();
		$verify->entry(1);
	}

	/**
	 * 获取用户注册错误信息
	 * @param  integer $code 错误编码
	 * @return string        错误信息
	 */
	private function showRegError($code = 0){
		switch ($code) {
			case -1:  $error = '用户名长度必须在16个字符以内！'; break;
			case -2:  $error = '用户名被禁止注册！'; break;
			case -3:  $error = '用户名被占用！'; break;
			case -4:  $error = '密码长度必须在6-30个字符之间！'; break;
			case -5:  $error = '邮箱格式不正确！'; break;
			case -6:  $error = '邮箱长度必须在1-32个字符之间！'; break;
			case -7:  $error = '邮箱被禁止注册！'; break;
			case -8:  $error = '邮箱被占用！'; break;
			case -9:  $error = '手机格式不正确！'; break;
			case -10: $error = '手机被禁止注册！'; break;
			case -11: $error = '手机号被占用！'; break;
			default:  $error = '未知错误';
		}
		return $error;
	}


    /**
     * 修改密码提交
     * @author huajie <banhuajie@163.com>
     */
    public function profile(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
        if ( IS_POST ) {
            //获取参数
            $uid        =   is_login();
            $password   =   I('post.old');
            $repassword = I('post.repassword');
            $data['password'] = I('post.password');
            empty($password) && $this->error('请输入原密码');
            empty($data['password']) && $this->error('请输入新密码');
            empty($repassword) && $this->error('请输入确认密码');

            if($data['password'] !== $repassword){
                $this->error('您输入的新密码与确认密码不一致');
            }

            $Api = new UserApi();
            $res = $Api->updateInfo($uid, $password, $data);
            if($res['status']){
                $this->success('修改密码成功！');
            }else{
                $this->error($res['info']);
            }
        }else{
            $this->display();
        }
    }
    public function my(){
    	if ( !is_login() ) {
			$this->error( '您还没有登陆',U('User/login'),0,0);
		}
		$info = D('Member')->where('uid = ' . UID )->find();
		$this->assign('info',$info);
		
		$cinfo = D('Company')->where('uid = ' . UID )->find();
		$this->assign('cinfo',$cinfo);

		$cont = D('Contact')->where('cid = ' . $cinfo['id'])->find();
		$this->assign('cont',$cont);

		$uinfo = D('UcenterMember')->where('id = ' . UID )->find();
		$this->assign('uinfo',$uinfo);
    	$this->display();
    }
    public function my_recruit(){
        if ( !is_login() ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		$recruits = D('Recruit')->where(array('cid'=>get_company())) -> select();
		foreach($recruits as &$val){
            //获取公司信息
            $info = D('Company')->where(array('id'=>$val['cid']))->find();
            $val['company'] = $info;
           
            //获取联系信息
            $contact = D('Contact')->where(array('cid'=>$val['cid']))->find();
            $val['contact'] = $contact;
        }
        unset($val);
		$this->assign('recruits',$recruits);
		$this->display();
    }

    public function edit_my_recruit($id = 0){
    	if ( !is_login() ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
    	$isEdit = $id?1:0;
		if(IS_POST){
			
			$data = D('Recruit')->create();
           	
			if($isEdit){
				$res = D('Recruit')->where(array('id' => $id))->save($data);
				
			}else{
				$res = D('Recruit')->add($data);  
			}

			if($res){
				$this->success('提交成功',U('User/my_recruit'));
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

    public function my_stock(){
    	$this->display();
    }
    public function do_xianhuo($do = ''){
    	if ( !is_login() ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
    	if($do == 'update'){
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
			$this->success('更新成功');
    	}
    	if($do == 'delete'){
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
			$this->success('删除成功');
    	}
    	if($do == 'logout'){
    		if(is_login()){
				D('Member')->logout();
				$this->success('退出成功！', U('User/login'));
			} else {
				$this->redirect('User/login');
			}
    	}
    }
}
