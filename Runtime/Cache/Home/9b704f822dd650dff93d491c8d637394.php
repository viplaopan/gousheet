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
		<div class="nright">欢迎注册</div>
	</div>
</div>
	<!-- /头部 -->
	
	<!-- 主体 -->
	

	<div class="content">
		<div class="con">
			<form action="<?php echo U('User/register');?>" id="registerForm">
				<ul class="conleft">
					<!--手机号-->
					<li>
						<div> <span class="sp1">手机号</span > <span class="sp1"><img src="/Public/Home/images/xh.jpg" /></span> </div>
						<input name="mobile" type="text" value="" placeholder="请输入11位手机号" class="iput_phone" />
						<div class="messages"></div>
					</li>
					<li>
						<div><span class="sp1">短信验证码</span> <span class="sp1"><img src="/Public/Home/images/xh.jpg" /></span> </div>
						<input name="code" style="padding-left: 10px;    width: 128px;" type="text" class="iput_code" />
						<button class="code" id="codeId" type="button" onClick="get_mobile_code();">获取短信验证码</button>
						<div class="messages"></div>
					</li>
					<!--设置密码-->
					<li>
						<div> <span class="sp1">设置密码</span> <span class="sp1"><img src="/Public/Home/images/xh.jpg" /></span> </div>
						<input name="password" id="password" type="password" value="" placeholder="请输入密码" class="iput_pwd" />
						<div class="messages"></div>
					</li>
					<!--确认密码-->
					<li>
						<div> <span class="sp1">确认密码</span> <span class="sp1"><img src="/Public/Home/images/xh.jpg" /></span> </div>
						<input name="repassword" type="password" value="" placeholder="请重新输入密码" class="iput_pwd" />
						<div class="messages"></div>
					</li>
					<!--公司名称-->
					<li>
						<div> <span class="sp1">公司名称</span> <span class="sp1"><img src="/Public/Home/images/xh.jpg" /></span> </div>
						<input name="company" type="text" value="" placeholder="请输入公司名称" class="iput_name" />
					    <div class="messages"></div>
					</li>
					<!--姓名-->
					<li>
						<div> <span class="sp1">姓名</span> <span class="sp1"><img src="/Public/Home/images/xh.jpg" /></span> </div>
						<input name="realname" type="text" value="" placeholder="请输入姓名" class="iput_name" />
					    <div class="messages"></div>
					</li>
					<li>
						<input name="" type="checkbox" value="" class="xz" />
						<div class="xy">我已同意或阅读<span>《购钢现货网会员服务协议》</span></div>
					</li>
					<li>
						<input type="submit" class="bt" value="提交注册" />
					</li>
				</ul>
			</form>
			<div class="coright">
				<ul class="r-up">
					<li class="h1">已有购钢现货网账号？</li>
					<li class="h2">登录购钢现货网，即可免费查看或在线购买全国便宜、实惠 的钢材资源，也可以将您的现货资源发布到购钢现货网。 </li>
					<li class="h3"> <a>登录</a> </li>
				</ul>
				<ul class="r-up">
					<li class="h1">有任何问题请联系客服!</li>
					<li class="h2">客服热线：0577-89881176</li>
					<li class="h4">
						<a></a>
					</li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>


	<!-- /主体 -->

	<!-- 底部 -->
	
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

<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "", //当前网站地址
		"APP"    : "/index.php?s=", //当前项目地址
		"PUBLIC" : "/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>

	    <script src="/Public/Home/js/jquery.validate.js"></script>
		<script type="text/javascript">
			$(function() {
				// 在键盘按下并释放及提交后验证提交表单
				$("#registerForm").validate({
					valid : true,
					
					rules : {
						mobile : {
							required : true,
							isMobile : true,
							remote : {
				               type:"POST",
				               url:'<?php echo U("User/checkMobile");?>',
				               data:{
				                   mobile:function(){return $("input[name='mobile']") .val();}
				               } 
				            } 
				        },
			        	password : {
					        required: true,
					        minlength: 6
					    },
					    repassword : {
					        required: true,
					        minlength: 6,
					        equalTo: "#password"
					    },
					    company : {
					        required: true,
					    },
					    realname : {
					        required: true,
					    },
					    code : {
					        required: true,
					        digits:true,
							minlength:5,
							maxlength:5,
					    },
					},
					messages : {
						mobile : {
							required: "<i class='error'></i>必填",
							remote:"<i class='error'></i>手机号已经存在",
						},
						password : {
						    required: "<i class='error'></i>必填",
						    minlength: "<i class='error'></i>最少5个字符"
						},
						repassword : {
						    required: "<i class='error'></i>必填",
						    minlength: "<i class='error'></i>最少5个字符",
						    equalTo: "<i class='error'></i>两次输入的密码不一样"
						},
						company : {
							required: "<i class='error'></i>必填",
						},
						realname : {
							required : "<i class='error'></i>必填",
						},
						code : {
							required : "<i class='error'></i>必填",
							digits : "<i class='error'></i>请输入5位数字",
							minlength : "<i class='error'></i>请输入5位数字",
							maxlength : "<i class='error'></i>请输入5位数字",
						},
					},
					errorPlacement:function(error,element) {  
						error.appendTo(element.parent().find(".messages"));
				    },
				    success: function(label) {
					    // set &nbsp; as text for IE
					    label.html("<i class='success'></i>");
					}
				});
				// 手机号码验证 
			    jQuery.validator.addMethod("isMobile", function(value, element) { 
			      var length = value.length; 
			      var mobile = /^1[3|4|5|7|8]\d{9}$/; 
			      return this.optional(element) || (length == 11 && mobile.test(value)); 
			    }, "<i class='error'></i>请正确填写您的手机号码"); 
			})

			function get_mobile_code(){

		        $.post('<?php echo U("Sms/getSms");?>', {mobile:jQuery.trim($("input[name='mobile']").val()),send_code:<?php echo $_SESSION['send_code'];?>}, function(msg) {
		            if(!msg.status){
		            	alert(msg.info);
		            }
					RemainTime();
		        },'json');
			};
			var iTime = 59;
			var Account;
			function RemainTime(){
				document.getElementById('codeId').disabled = true;
				var iSecond,sSecond="",sTime="";
				if (iTime >= 0){
					iSecond = parseInt(iTime%60);
					iMinute = parseInt(iTime/60)
					if (iSecond >= 0){
						if(iMinute>0){
							sSecond = iMinute + "分" + iSecond + "秒";
						}else{
							sSecond = iSecond + "秒";
						}
					}
					sTime=sSecond;
					if(iTime==0){
						clearTimeout(Account);
						sTime='获取手机验证码';
						iTime = 59;
						document.getElementById('codeId').disabled = false;
					}else{
						Account = setTimeout("RemainTime()",1000);
						iTime=iTime-1;
					}
				}else{
					sTime='没有倒计时';
				}
				document.getElementById('codeId').innerHTML = sTime;
			}	
	</script>
	<script type="text/javascript">
		$(document)
			.ajaxStart(function() {
				$("button:submit").addClass("log-in").attr("disabled", true);
			})
			.ajaxStop(function() {
				$("button:submit").removeClass("log-in").attr("disabled", false);
			});

		$("form").submit(function() {
			var self = $(this);
			
			$.post(self.attr("action"), self.serialize(), success, "json");
			return false;

			function success(data) {
				if (data.status) {
					window.location.href = data.url;
				} else {
					self.find(".Validform_checktip").text(data.info);
					//刷新验证码
					$(".reloadverify").click();
				}
			}
		});

		$(function() {
			var verifyimg = $(".verifyimg").attr("src");
			$(".reloadverify").click(function() {
				if (verifyimg.indexOf('?') > 0) {
					$(".verifyimg").attr("src", verifyimg + '&random=' + Math.random());
				} else {
					$(".verifyimg").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
				}
			});
		});
	</script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>