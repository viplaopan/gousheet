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
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class UserController extends HomeController {

	/* 用户中心首页 */
	public function index(){
		
	}
	public function sms(){
		$target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";

		$mobile = $_POST['mobile'];
		$send_code = $_POST['send_code'];

		$mobile_code = random(4,1);
		if(empty($mobile)){
			exit('手机号码不能为空');
		}

		if(empty($_SESSION['send_code']) or $send_code!=$_SESSION['send_code']){
			//防用户恶意请求
			exit('请求超时，请刷新页面后重试');
		}

		$post_data = "account=cf_vippdf&password=Pa123456&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");
		//查看密码请登录用户中心->验证码、通知短信->帐户及签名设置->APIKEY
		$gets =  xml_to_array(Post($post_data, $target));
		if($gets['SubmitResult']['code']==2){
			$_SESSION['mobile'] = $mobile;
			$_SESSION['mobile_code'] = $mobile_code;
		}
		echo $gets['SubmitResult']['msg'];
	}
	/* 注册页面 */
	public function register($username = NULL, $password = '', $repassword = '', $email = '', $verify = '', $mobile = ''){
        if(!C('USER_ALLOW_REGISTER')){
            $this->error('注册已关闭');
        }
		if(IS_POST){ //注册用户

			/* 检测验证码 */
//			if(!check_verify($verify)){
//				$this->error('验证码输入错误！');
//			}

			/* 检测密码 */
			if($password != $repassword){
				$this->error('密码和重复密码不一致！');
			}			

			/* 调用注册接口注册用户 */
            $User = new UserApi;
			$uid = $User->register($username, $password, $email, $mobile);
			if(0 < $uid){ //注册成功
				$cdata['uid'] = $uid;
				$cdata['name']  = I('post.company');
				$cid = D('Company')->add($cdata);
				$ctdata['cid'] = $cid;
				$ctdata['name'] = I('post.realname');
				D('Contact')->add($ctdata);
				//TODO: 发送验证邮件
				$this->success('注册成功！',U('login'));
			} else { //注册失败，显示错误信息
				$this->error($this->showRegError($uid));
			}

		} else { //显示注册表单
		    $_SESSION['send_code'] = random(6,1);
			$this->display();
		}
	}
	
	/* 登录页面 */
	public function login($username = '', $password = '', $verify = ''){
		if(IS_POST){ //登录验证
			/* 检测验证码 */
//			if(!check_verify($verify)){
//				$this->error('验证码输入错误！');
//			}
			
			/* 调用UC登录接口登录 */
			$user = new UserApi;
			if(preg_match('/^1[3|4|5|7|8]\d{9}$/', $username)){
			//这里有无限想象
				$uid = $user->login($username, $password,3);
			}else{
				$uid = $user->login($username, $password);
			}
			
			if(0 < $uid){ //UC登录成功
				/* 登录用户 */
				$Member = D('Member');
				if($Member->login($uid)){ //登录用户
					//TODO:跳转到登录前页面
					$this->success('登录成功！',U('Member/index'));
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
        if ( IS_POST ) {
			if($_POST['mobile']!=$_SESSION['mobile'] or $_POST['mobile_code']!=$_SESSION['mobile_code'] or empty($_POST['mobile']) or empty($_POST['mobile_code'])){
				$this->error('手机验证码输入错误。');
			}else{
				// $_SESSION['mobile'] = '';
				// $_SESSION['mobile_code'] = '';	
				$info = D("UcenterMember")->where('mobile = ' . $_POST['mobile'])->find();
				if(empty($info)){
					$this->error('该用号不存在！');
				}
			}

        	
            //获取参数
            $uid        =   $info[id];
           
            
            $data['password'] = I('post.password');
            
            empty($data['password']) && $this->error('请输入新密码');
          

            $Api = new UserApi();
            $res = $Api->updateInfo2($uid, $data);
            if($res['status']){
                $this->success('修改密码成功！');
            }else{
                $this->error($res['info']);
            }
        }else{
            $this->display();
        }
    }

}
