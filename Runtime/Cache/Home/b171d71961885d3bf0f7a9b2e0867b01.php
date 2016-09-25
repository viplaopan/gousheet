<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<?php $map['b.status'] = 1; $map['b.type'] = 1; $map['b.path'] = MODULE_NAME."/".CONTROLLER_NAME."/".ACTION_NAME; $advs = D("Adv")->join('__ADV_POS__ as b ON __ADV__.pos_id = b.id','LEFT')->where($map)->select(); $advlist = array(); foreach($advs as $v){ $advlist[$v['name']] = $v; } ?>
<meta charset="UTF-8">
<?php if(!$oneplus_seo_meta){ $oneplus_seo_meta = get_seo_meta($vars,$seo); } ?>
<?php if($oneplus_seo_meta['title']): ?><title><?php echo ($oneplus_seo_meta['title']); ?></title>
    <?php else: ?>
    <title><?php echo C('WEB_SITE_TITLE');?></title><?php endif; ?>
<?php if($oneplus_seo_meta['keywords']): ?><meta name="keywords" content="<?php echo ($oneplus_seo_meta['keywords']); ?>"/><?php endif; ?>
<?php if($oneplus_seo_meta['description']): ?><meta name="description" content="<?php echo ($oneplus_seo_meta['description']); ?>"/><?php endif; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="/Public/Home/js/jquery-1.11.3.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/register.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/layer.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/top.css" />
	<script type="text/javascript" src="/Public/Home/js/resgin.js"></script>
	<script type="text/javascript" src="/Public/Home/js/layer.js"></script>

<?php echo hook('pageHeader');?>

</head>
<body>
	<!-- 头部 -->
	<div class="top">
	<div class="nav">
		<ul>
			<li><a href="#">首页</a></li>
			<li>
				<a href="#">
					<div style=" float:left">搜索现货</div>
					<div class="span" style="float:left"><img src="/Public/Home/images/sanjiao.png" /></div>
				</a>
			</li>
			<li>
				<a href="#">
					<div style=" float:left">资讯行情</div>
					<div class="span" style="float:left"><img src="/Public/Home/images/sanjiao.png" /></div>
				</a>
			</li>
			<li><a href="#">加工定做</a></li>
			<li><a href="#">求购信息</a></li>
			<li><a href="#">人才招聘</a></li>
			<li><a href="#">货运物流</a></li>
			<li><a href="#">商务合作</a></li>
			</li>
			<li class="reg">
				<div class="login">登录</div>
				<div>|</div>
				<div class="register">免费注册</div>
			</li>
		</ul>
	</div>
	<div class="navdown">
		<div class="nleft"><img src="/Public/Home/images/gs_login.png" /></div>
		
	<div class="nright">欢迎登录</div>

	</div>
</div>
	<!-- /头部 -->
	
	<!-- 主体 -->
	

<div class="navdown">
	<div class="nleft"><img src="images/gs_login.png"></div>
    <div class="nright">欢迎注册</div>
</div>
	<div class="content">
		
		<div class="login">
			<div class="in">
				<div class="box">
					<form action="" id="loginForm">
						<ul>
							<li>
								<div class="mz">购钢现货网会员</div>
								<div class="md"><img src="/Public/Home/images/L-IEC.png" />
									<a href="<?php echo U('Home/User/register');?>">立即注册</a>
								</div>
							</li>
							<li><input name="username" type="text" placeholder="请输入11位手机号" value="" class="usname" /></li>
							<li><input name="password" type="password" placeholder="密码" value="" class="uspwd" /></li>
							<li>
								<div class="messages" style="color: red;"></div>
							</li>
							<li>
								<div class="che"><input name="" type="checkbox" value="" class="zd" checked="checked" />自动登录</div>

								<div class="h8">
									<input type="button" value="忘记密码" onclick="showdiv8();" style=" height:40px;background-color:#FFF; float:right; color:#0e6eb8;cursor:pointer" />

									
								</div>

							</li>
							<li><input name="" type="submit" class="btlogin" value="登录" /></li>
						</ul>
						</form>
				</div>
			</div>
		</div>
		<div class="clear"></div>
<div id="bg8"></div>

									<div id="show8">
										<div class="sckc">
											<label class="L_1">找回密码</label>
											<input type="button" value="X" onclick="hidediv8();" class="x1" />
										</div>
										<div class="box_xg">
											<div class=" la_box">输入手机号码：</div>
											<input name="" type="text" class="la_inp" />
											<span class="la_ts">获取手机验证码</span>
										</div>
										<div class="box_xg1">
											<div class=" la_box">手机验证码：</div>
											<input name="" type="text" class="la_inp" />
											<span class="la_ts"></span>
										</div>
										<div class="box_xg1">
											<div class=" la_box">设置新密码：</div>
											<input name="" type="text" class="la_inp" />
											<span class="la_ts"></span>
										</div>
										<div class="box_xg2">
											<div class=" la_box"></div>
											<input name="" type="button" class="la_inp" value="提交" />
										</div>
									</div>

	<!-- /主体 -->

	<!-- 底部 -->
	<div class="content">	
			<div class="foot">
				<div class="f">
					<div class="fleft">
						<div class="fup">
							<div class="s1"><img src="/Public/Home/images/dh_ice.png" /></div>
							<div class="s2">客服热线<span>(08:30-17:30)</span></div>
						</div>
						<div class="fdonw">0577-89881176</div>
					</div>
					<div class="fright">
						<ul class="r1">
							<li><a>关于我们</a>
								<div>|</div>
							</li>
							<li><a>法律声明</a>
								<div>|</div>
							</li>
							<li><a>人才招聘</a>
								<div>|</div>
							</li>
							<li><a>投资洽谈</a>
								<div>|</div>
							</li>
							<li><a>联系我们</a>
								<div>|</div>
							</li>
							<li><a>常见问题</a></li>
						</ul>
						<div class="r2">
							<div class="p">Copyright © 2013 - 2019 gousteel.com</div>
							<div class="p">购钢现货网版权所有</div>
							<div class="p">浙ICP备12008543号-2</div>
						</div>
						<div class="r3"> <img src="/Public/Home/images/110.png" class="img1" /> <img src="/Public/Home/images/kxwz.png" class="img1" /> </div>
					</div>
				</div>
			</div>
		</div>
		
	<script src="/Public/Home/js/jquery.validate.js"></script>
	<script type="text/javascript">
		$(function() {
			// 在键盘按下并释放及提交后验证提交表单
			$("#loginForm").validate({
				valid: true,

				rules: {
					username: {
						required: true,
						isMobile: true,
					},
					password: {
						required: true,
						minlength: 6
					},
				},
				messages: {
					username: {
						required: "请输入手机号码",
						remote: "手机号已经存在",
					},
					password: {
						required: "请输入密码",
						minlength: "密码最少6个字符"
					},

				},
				errorPlacement: function(error, element) {
					$(".messages").html('')
					error.appendTo($(".messages"));
				},
				success: function(label) {
					// set &nbsp; as text for IE
					label.html("<i class='success'></i>");
				},
				submitHandler: function(form) {
					var self = $('#loginForm');
					$.post(self.attr("action"), self.serialize(), success, "json");
					return false;

					function success(data) {
						if(data.status) {
							window.location.href = data.url;
						} else {
							$(".messages").html(data.info)
						}
					}
				},
			});
			// 手机号码验证 
			jQuery.validator.addMethod("isMobile", function(value, element) {
				var length = value.length;
				var mobile = /^1[3|4|5|7|8]\d{9}$/;
				return this.optional(element) || (length == 11 && mobile.test(value));
			}, "请正确填写您的手机号码");

		})
		$(document)
			.ajaxStart(function() {
				$("button:submit").addClass("log-in").attr("disabled", true);
			})
			.ajaxStop(function() {
				$("button:submit").removeClass("log-in").attr("disabled", false);
			});
	</script>

	<!-- /底部 -->
</body>
</html>