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

	<link rel="stylesheet" type="text/css" href="/Public/Home/css/overall.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/layer.css"/>
	<script language="javascript" src="/Public/Home/js/layer.js"></script>


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
		<li><a href="<?php echo U('Member/index');?>">会员中心首页</a></li>
		<li><a href="<?php echo U('Member/basics');?>">基本资料</a></li>
		<li><a href="<?php echo U('Member/field');?>">实地认证</a></li>
		<li><a href="<?php echo U('Member/manage');?>">管理库存</a></li>
		<li><a href="<?php echo U('Member/recruit');?>">人才招聘</a></li>
		<li><a>我的商铺</a></li>
		<li><a href="<?php echo U('Member/cpwd');?>">修改密码</a></li>
		<li><a>退出登录</a></li>
	</ul>
</div>
				<div class="right">
             <div class="right1">人才招聘</div>
             	 <div class="manage">
<!--上传库存-->                       
              		<div class="h6">
                    <input  type="button" value="添增招聘信息"  onclick="document.location='<?php echo U('Member/recruitEdit');?>';" 
                    style=" width:160px; height:40px;border:#cccccc 1px solid; color:#0e6eb8; background-color:#eee;cursor:pointer "/> 
                    </div>                  
					<div class="h7">严禁发布不相关信息，严重者封号，谢谢合作！</div>
		  </div>
          <div class="clear"></div>
<table  border="1"  cellspacing="0"  border="">
  <tr>
    <td class="d1" style="font-weight:bold">#</td>
    <td class="d2" style="font-weight:bold">标题</td>
    <td class="d3" style="font-weight:bold">内容</td>
    <td class="d4" style="font-weight:bold">创建时间</td>
    <td class="d5" style="font-weight:bold">操作</td>
  </tr>
  <?php if(is_array($recruits)): $key = 0; $__LIST__ = $recruits;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><tr>
	    <td class="d1"><?php echo ($key); ?></td>
	    <td class="d2"><?php echo ($vo["title"]); ?></td>
	    <td class="d3"><?php echo ($vo["content"]); ?></td>
	    <td class="d4"><?php echo (date("Y-m-d",$vo["create_time"])); ?></td>
	    <td class="d5"><a href="<?php echo U('Member/recruitEdit',array('id'=>$vo['id']));?>">编辑</a><a href="<?php echo U('Member/recruitEdit',array('id'=>$vo['id']));?>">删除</a></td>
	  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
 
</table>
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
			$("form").validate({
				valid: false,

				rules: {
					company_name: {
						required: true,
					},
					name: {
						required: true,
					},
					address: {
						required: true,
					},
					mobile: {
						required: true,
						isMobile: true
					},	
					
					
					
									
				},
				messages: {
					company_name: {
						required: "请填写公司名称！",
					},
					name: {
						required: "请输入座机号码!",
					},
					address: {
						required: "请输入QQ号码!",
					},
					mobile: {
						required: "请输入手机号码!",
						isMobile: "错误的手机格式！"
					},
					
					
					
										
				},
				errorElement: 'span',
				errorPlacement: function(error, element) {
					$('#errorSpan').html('')
					error.appendTo($('#errorSpan'));
					return false;
					
				},
				success: function(label) {
					// set &nbsp; as text for IE

				},
				submitHandler: function(form) {
					ajaxForm();

					return false;
				},
			});
			// 手机号码验证 
			jQuery.validator.addMethod("isMobile", function(value, element) {
				var length = value.length;
				var mobile = /^1[3|4|5|7|8]\d{9}$/;
				return this.optional(element) || (length == 11 && mobile.test(value));
			}, "请正确填写您的手机号码");
			// 手机号码验证 
			jQuery.validator.addMethod("isEmail", function(value, element) {
				var length = value.length;
				var mobile = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
				return this.optional(element) || (length == 11 && mobile.test(value));
			}, "请正确填写您的手机号码");
			
			function ajaxForm(){
				var self = $('form');

				$.post(self.attr("action"), self.serialize(), success, "json");
				return false;
				
				function success(data) {
					if(data.status) {
						alert('提交成功');
						window.location.href=''
					} else {
						alert('提交失败')
					}
				}
			}
			
		})
	</script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>