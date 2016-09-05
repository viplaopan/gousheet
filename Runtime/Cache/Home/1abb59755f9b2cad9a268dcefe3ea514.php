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
	<link rel="stylesheet" href="/Public/Home/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="/Public/Home/kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="/Public/Home/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="/Public/Home/kindeditor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="/Public/Home/kindeditor/plugins/code/prettify.js"></script>

	<script charset="utf-8" src="/Public/Home/js/jquery.cityselect.js"></script>
	<script>
		//城市验证
		$(function() {
			var cityjson = jQuery.parseJSON('<?php echo ($city); ?>');
			var areajson = jQuery.parseJSON('<?php echo ($area); ?>');
			var prov = jQuery.parseJSON('<?php echo ($prov); ?>');

			$("#address").citySelect({
				city_json: cityjson,
				area_json: areajson,
				prov_json: prov,
			});
			$("#caddress").citySelect({
				city_json: cityjson,
				area_json: areajson,
				prov_json: prov,
			});
		})

		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="desc"]', {
				cssPath: '/Public/Homekindeditor/plugins/code/prettify.css',
				uploadJson: '/Public/Homekindeditor/php/upload_json.php',
				fileManagerJson: '/Public/Homekindeditor/php/file_manager_json.php',
				allowFileManager: true,
				afterCreate: function() {
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
					<div class="right1">基本资料</div>
					<form action="/index.php?s=/Home/Member/basics.html" method="post">
						<ul class="box_r">
							<li class="ii">
								<div>
									<a href="<?php echo U('Member/basics');?>">公司信息</a>
									<a href="<?php echo U('Member/contact');?>">联系方式</a>
									<a href="<?php echo U('Member/homeImage');?>">主页图片</a>
									<div class="clear"></div>
								</div>
							</li>
							<li class="ii">
								<label>用户名</label><input name="" type="text" class="input" value="<?php echo ($info["nickname"]); ?>" readonly="readonly" /><span class="panduan" ></span>
							</li>
							<li class="ii">
								<label>公司全称</label><input name="name" type="text" value="<?php echo ($cinfo["name"]); ?>" class="input" /><span class="panduan" ></span>
							</li>
							<li class="ii">
								<label>公司简称</label><input name="small_name" type="text" class="input" value="<?php echo ($cinfo["small_name"]); ?>" /><span class="panduan" ></span>
							</li>
							
							<li class="ii">
								<label>仓库区</label>
								<div id="caddress">
									<select name="ware_prov" class="select prov" value="<?php echo ($cinfo["ware_prov"]); ?>">
										
									</select>
									<select name="ware_city" class="select city" value="<?php echo ($cinfo["ware_city"]); ?>">
										
									</select>
									<span class="panduan"></span>
								</div>
							</li>
							<li class="ii">
								<label>仓库地址</label><input name="ware_address" type="text" class="input" value="<?php echo ($cinfo["ware_address"]); ?>" /><span class="panduan" ></span>
							</li>
							<li class="ii">
								<label>经营模式</label>
								<div class="box_list">
									<?php $_result=C('PATTERN');if(is_array($_result)): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><input name="pattern" id="p<?php echo ($k); ?>" type="radio" value="<?php echo ($k); ?>" class="radio">
										<label class="p" style="text-align: left; width: auto;" for="p<?php echo ($k); ?>"><?php echo ($vo); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
									<script>
										$("input[name='pattern'][value='<?php echo ($cinfo["pattern"]); ?>']").attr('checked',true);
									</script>
								</div>
							</li>
							<li class="ii">
			                	<label>主营业务</label>
			                    <div class="box_list">
			                    	<?php $_result=C('BUSINESS');if(is_array($_result)): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><input name="business[]" type="checkbox" class="checkbox" id="b<?php echo ($k); ?>" value="<?php echo ($k); ?>">
					                    <label class="p" style="text-align: left; width: auto;" for="b<?php echo ($k); ?>"><?php echo ($vo); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
			                    	
			                		<script>
			                		    <?php $_result=explode(',', $cinfo['business']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>$("input[name='business[]'][value='<?php echo ($vo); ?>']").attr('checked',true);<?php endforeach; endif; else: echo "" ;endif; ?>
			                		</script>
									
			                    </div>
			                </li>
							<li class="ii">
								<label>公司所在地</label>
								<div id="address">
									<select name="com_prov" value="<?php echo ($cinfo["com_prov"]); ?>" class="select prov">
										
									</select>
									<select name="com_city" value="<?php echo ($cinfo["com_city"]); ?>" class="select city">
										<option value="">请选择</option>
									</select>
									<span class="panduan"></span>
								</div>
							</li>
							<li class="ii">
								<label>详细地址</label><input name="com_address" type="text" value="<?php echo ($cinfo["com_address"]); ?>" class="input" />
								<span class="panduan"></span>
							</li>
							<li class="ii">
								<label>公司网站</label><input name="website" type="text" value="<?php echo ($cinfo["website"]); ?>" class="input" />
							</li>
							<li class="ii">
								<label>公司简介</label><textarea name="desc" id="newscontent" class="txt_con" style="width:650px; min-height:220px;"><?php echo ($cinfo["desc"]); ?></textarea>
							</li>
							<li class="tishi">
								<p>最多1000字，您还可以输入<span>781</span>字</p>
							</li>
							<li class="ii">
								<label></label><input name="" type="submit" value="提交信息" class="bt" />
							</li>
	
						</ul>
					</form>
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
				valid: true,

				rules: {
					name: {
						required: true,
					},
					small_name: {
						required: true,
					},

					ware_city: {
						required: true,
					},
					com_city: {
						required: true,
					},
					ware_address: {
						required: true,
					},
					com_address: {
						required: true,
					},
				},
				messages: {
					name: {
						required: "请填写公司全称！",
					},
					small_name: {
						required: "请填写公司简称!",
					},

					ware_city: {
						required: "请选择仓库区!",
					},
					com_city: {
						required: "请填写公司所在地!",
					},
					ware_address: {
						required: "请填写仓库地址!",
					},
					com_address: {
						required: "请填写详细地址!",
					},
		
				},
				errorElement:'span',
				errorPlacement: function(error, element) {					
					error.appendTo(element.next());
				},
				success: function(label) {
					// set &nbsp; as text for IE
					
				},
				submitHandler: function(form) {
					var self = $('form');
					$.post(self.attr("action"), self.serialize(), success, "json");
					return false;

					function success(data) {
						if (data.status) {
							alert('提交成功')
						} else {
							alert('提交失败')
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
			// 手机号码验证 
			jQuery.validator.addMethod("isEmail", function(value, element) {
				var length = value.length;
				var mobile = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
				return this.optional(element) || (length == 11 && mobile.test(value));
			}, "请正确填写您的手机号码");

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