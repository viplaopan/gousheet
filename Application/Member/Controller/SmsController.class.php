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
 * 文件控制器
 * 主要用于下载模型的文件上传和下载
 */

class SmsController extends HomeController {
	public function getSms(){
		$target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
		
		$mobile = $_POST['mobile'];
		$send_code = $_POST['send_code'];
		
		$User = new UserApi;
		$res = $User->checkMobile($mobile);
		dump($res);
		die;
		if($res>0){
			$this->error('用户已经存在');
		}

		$mobile_code = random(4,1);
		if(empty($mobile)){

			$this->error(1);
		}
		
		if(empty($_SESSION['send_code']) or $send_code!=$_SESSION['send_code']){
			//防用户恶意请求
			$this->error('请求超时，请刷新页面后重试');
		}
		
        $post_data = "account=cf_buluo&password=tYC9aD&mobile=" . $mobile . "&content=" . rawurlencode("您的验证码是：" . $mobile_code . "。请不要把验证码泄露给其他人。");
		
		//密码可以使用明文密码或使用32位MD5加密
		$gets =  xml_to_array(Post($post_data, $target));
		if($gets['SubmitResult']['code']==2){
			$_SESSION['mobile'] = $mobile;
			$_SESSION['mobile_code'] = $mobile_code;
		}
		if($gets['SubmitResult']['msg'] == '提交成功'){
			$this->success('提交成功');
		}else{
			$this->error($gets['SubmitResult']['msg']);
		}
	}
}
