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
					<div class="right1">会员信息</div>
					<ul class="right2">
						<li><span class="s1"><?php echo get_nickname();?></span> 您好：</li>
						<li>欢迎访问中国不锈钢现货网，在您浏览本网过程中，有任何问题或者建议，请随时跟我们联系。</li>
						<li><img src="images/未标题-1.png" width="7" height="9" style="margin-right:5px;" />会员级别：您是<span class="s1">VIP</span>会员，还有<span class="s1">138</span>天到期</li>
						<li><img src="images/未标题-1.png" width="7" height="9" style="margin-right:5px;" />登录状态：今天您第<span class="s1">1</span>次登录，总共登录<span class="s1"><?php echo ($loginTimes); ?></span>次，上次登录的<span class="s1">IP</span>是 <?php echo long2ip($lastIP);?></li>
					</ul>

					<div class="right3">
						<span>尊敬的会员：</span>
						<p>为了给广大不锈钢行业用户一个良好的平台环境，请不要发布虚假的库存信息。即日起，本网工作人员将不定期的监督抽查所有会员的库存，若经本站工作人员提醒后仍不改正，将封号处理！</p>
					</div>
					<div class="right4">
						<ul class="r1">
							<li>公司名称</li>
							<li style="letter-spacing:8px;">联系人</li>
							<li style="letter-spacing:26px;">电话</li>
							<li style="letter-spacing:26px;">传真</li>
						</ul>
						<ul class="r2">
							<li>温州市龙泰管业有限公司</li>
							<li>王先生</li>
							<li> 18057753538 18057753538 </li>
							<li>057789881156</li>
						</ul>
						<ul class="r1">
							<li>联系地址</li>
							<li style="letter-spacing:26px;">邮编</li>
							<li style="letter-spacing:26px;">网址</li>
							<li style="letter-spacing:26px;">邮箱</li>
						</ul>
						<ul class="r2">
							<li>温州市龙湾区永兴工业区</li>
							<li></li>
							<li></li>
							<li>273336521@qq.com</li>
						</ul>
					</div>
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
	
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>