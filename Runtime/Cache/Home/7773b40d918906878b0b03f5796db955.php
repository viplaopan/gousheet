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

	<link rel="stylesheet" type="text/css" href="/Public/Home/css/overall.css"/>
	<link rel="stylesheet" href="/Public/Home/kindeditor/themes/default/default.css" />
		<link rel="stylesheet" href="/Public/Home/kindeditor/plugins/code/prettify.css" />
		<script charset="utf-8" src="/Public/Home/kindeditor/kindeditor.js"></script>
		<script charset="utf-8" src="/Public/Home/kindeditor/lang/zh_CN.js"></script>
		<script charset="utf-8" src="/Public/Home/kindeditor/plugins/code/prettify.js"></script>
		<script>
			KindEditor.ready(function(K) {
				var editor1 = K.create('textarea[name="newscontent"]', {
					cssPath : '/Public/Homekindeditor/plugins/code/prettify.css',
					uploadJson : '/Public/Homekindeditor/php/upload_json.php',
					fileManagerJson : '/Public/Homekindeditor/php/file_manager_json.php',
					allowFileManager : true,
					afterCreate : function() {
						var self = this;
						K.ctrl(document, 13, function() {
							self.sync();
							K('form[name=example]')[0].submit();
						});
						K.ctrl(self.edit.doc, 13, function() {
							self.sync();
							K('form[name=example]')[0].submit();
						});
					}
				});
				prettyPrint();
			});
		</script>


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
		
	<div class="nright">会员中心</div>

	</div>
</div>
	<!-- /头部 -->
	
	<!-- 主体 -->
	

	<div class="content">
  <div class="content_1">
  	<div class="content_1c">
        <div class="left">
            <ul>
             <li><a>会员中心首页</a></li>
              <li><a>基本资料</a></li>
              <li><a>实地认证</a></li>
              <li><a>管理库存</a></li>
              <li><a>人才招聘</a></li>
              <li><a>我的商铺</a></li>
              <li><a>修改密码</a></li>
              <li><a>退出登录</a></li>
            </ul>
        </div> 
        <div class="right">
            <div class="right1">基本资料</div>
           <ul class="box_r">
            	<li class="ii">
                	<div>
                    	<a href="<?php echo U('Member/basics');?>">公司信息</a>
               			<a href="<?php echo U('Member/contact');?>">联系方式</a>
                		<a href="<?php echo U('Member/homeImage');?>">主页图片</a>
                        <div class="clear"></div>
                    </div>
                </li>
                <li class="iii">
                	<span>当前头像</span> 
                </li>
              	<li class="iii">
                	<img src="images/tp1.png" />
                </li>
                <li class="iii">
                	<span style="margin-top:15px;">上传新主图</span> 
                </li>
                <li class="iii">
<form method="post" action="" enctype="multipart/form-data" style="margin-left:15px;">
<div class="ehdel_upload_show">
<input id="ehdel_upload_text" type="text" name="txt" 
value="选择一个文件上传&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..." />
<input id="ehdel_upload_btn" value="上传" />
</div>
<div class="clear"></div>
<input type="file" onchange="ehdel_upload_text.value=this.value" class="ehdel_upload" style="background:none" />
</form>
                </li>
                <li class="iii"><span class="upd">支持jpg/gif/png格式图片，文件需小于1M,建议尺寸370*230</span></li>
            </ul>
        </div>
         <div class="clear">
    </div>
  </div>
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
						if (data.status) {
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
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>