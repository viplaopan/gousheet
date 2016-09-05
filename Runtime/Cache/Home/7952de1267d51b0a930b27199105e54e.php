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
             <div class="right1">管理库存</div>
             	 <div class="manage">
                 	 <div class="ma">当前您有<span >514</span> 条库存信息</div>
<!--上传库存-->                       
              		<div class="h1">
                    <input  type="button" value="上传库存" onclick="showdiv1();"  
                    style=" width:160px; height:40px;border:#cccccc 1px solid; color:#0e6eb8; background-color:#eee"/>                    
					<div id="bg1"></div>
					<div id="show1">
                    <div class="sckc">
					<label class="L_1">上传库存</label>
 					<input  type="button" value="X" onclick="hidediv1();" class="x1"/>
					</div>
  						<div class="clear"></div>                  
					<div class="LL">
						<div class="ehdel_upload_show1">
							<input id="ehdel_upload_text1" type="text" name="txt" value="未选择任何文件"/>
							<input id="ehdel_upload_btn1"  value="选择文件"/>
						</div>
					<div class="clear"></div>
							<input type="file" onchange="ehdel_upload_text1.value=this.value" class="ehdel_upload1"   dir="ltr"/>	 
                    </div>
                    <div class="an_list">
                    	<div class="minlit">
                        	<input name="" type="submit"  value="确定"  class="btleft"/>
                        	<input name="" type="button" value="取消"  onclick="hidediv1();" class="btlright"/>
                        </div>	
                    </div>           
					</div>  
                    </div>                  


<!--更新时间-->                 
                    <div class="h2">
                    <input  type="button" value="更新时间" onclick="showdiv2();"  
                    style=" width:160px; height:40px; border:#cccccc 1px solid; color:#0e6eb8;background-color:#eee"/>
                    
					<div id="bg2"></div>
					<div id="show2">
                     	<div class="sckc">
							<label class="L_1">更新时间</label>
 							<input  type="button" value="X" onclick="hidediv2();" class="x1"/>
						</div>
                        <div class="update">
                            	<div class="k">
                                	<div class="wenhao"></div>
                                    <div class="juzi">您确定要更新库存日期吗？</div>
                                </div>
 								<div class="minlit">
                        	<input name="" type="submit"  value="确定"  class="btleft"/>
                        	<input name="" type="button" value="取消"  onclick="hidediv2();" class="btlright"/>
                        </div>	                         	
                        </div>
                    	
                    </div>
                    </div>
                    
<!--删除库存-->
              		<div class="h3">
                    <input  type="button" value="删除库存" onclick="showdiv3();"  
                    style=" width:160px; height:40px; border:#cccccc 1px solid;color:#0e6eb8;background-color:#eee"/>
                    
					<div id="bg3"></div>
                    
					<div id="show3">
					<div class="sckc">
					<label class="L_1">删除库存</label>
 					<input  type="button" value="X" onclick="hidediv3();" class="x1"/>
					</div>
                   		<div class="del">
                    			<div class="k">
                                	<div class="wenhao"></div>
                                    <div class="juzi">您确定要删除全部库存吗？</div>
                                </div>
                                <div class="minlit">
                        			<input name="" type="submit"  value="确定"  class="btleft"/>
                        			<input name="" type="button" value="取消"  onclick="hidediv3();" class="btlright"/>
                        		</div>	    
                    	</div>
					</div>
                    </div>     
<!--导出库存-->
                    <div class="h4">
                    <input  type="button" value="导出库存" onclick="showdiv4();"  
                    style=" width:160px; height:40px; border:#cccccc 1px solid;color:#0e6eb8;background-color:#eee"/>
					<div id="bg4"></div>
					<div id="show4">
					<div class="sckc">
					<label class="L_1">导出库存</label>
 					<input  type="button" value="X" onclick="hidediv4();" class="x1"/>
					</div>
                    <div class="clear"></div>
                    	<ul class="daochu">
                        	<li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">钢管库存样表</div>
                                    <a class="exp3">导出</a>
                            </li>
                            <li class="x2"></li>
                            <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">钢件库存样表</div>
                                    <a class="exp3">导出</a>
                            </li>
                            <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">法兰库存样表</div>
                                    <a class="exp3">导出</a>
                            </li>
                            <li class="x2"></li>
                            <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">圆管库存样表</div>
                                    <a class="exp3">导出</a>
                            </li>
                            <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">阀门库存样表</div>
                                    <a class="exp3">导出</a>
                            </li>
                            <li class="x2"></li>
                            <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">板卷库存样表</div>
                                    <a class="exp3">导出</a>
                            </li>
                            <li class="x3">
                            	<input name="" type="button" class="bt_colse" onclick="hidediv4();" value="取消" />
                            </li> 
                        </ul>
					</div>
                    </div>
<!--下载样表-->                  
                    <div class="h5">
                    <input  type="button" value="下载样表" onclick="showdiv5();"  
                    style=" width:160px; height:40px;  border:#cccccc 1px solid;color:#0e6eb8;background-color:#eee"/>
					<div id="bg5"></div>
                    
					<div id="show5">
					<div class="sckc">
					<label class="L_1">下载样表</label>
 					<input  type="button" value="X" onclick="hidediv5();" class="x1"/>
					</div>
                    <div class="clear"></div>
                   	<ul class="donw">
                    <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">钢管库存样表</div>
                                    <a class="exp3">下载</a>
                            </li>
                            <li class="x2"></li>
                            <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">钢件库存样表</div>
                                    <a class="exp3">下载</a>
                            </li>
                            <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">法兰库存样表</div>
                                    <a class="exp3">下载</a>
                            </li>
                            <li class="x2"></li>
                            <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">圆管库存样表</div>
                                    <a class="exp3">下载</a>
                            </li>
                            <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">阀门库存样表</div>
                                    <a class="exp3">下载</a>
                            </li>
                            <li class="x2"></li>
                            <li class="x1">
                            		<div class="exp1"><img src="images/xz_ico.png" /></div>
                                    <div class="exp2">板卷库存样表</div>
                                    <a class="exp3">下载</a>
                            </li>
                            <li class="x3">
                            	<input name="" type="button" class="bt_colse" onclick="hidediv5();" value="取消" />
                            </li> 
                    </ul>
					</div>
                    </div>
                    <div class="clear"></div>
                    <div class="gaiz">
                		<div class="dd1" style="display:block">尊敬的会员：</div>
                        <div class="dd2">为了给广大不锈钢行业用户一个良好的平台环境，请不要发布虚假的库存信息。即日起，本网工作人员将不定期的监督抽查所有会员的库存，若经本站工作人员提醒后仍不改正，将封号处理！</div>
                         <div class="clear"></div>
                	</div>
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