<script type="text/javascript">
$(function(){
		   //
		   $(".nav_bg .nav .s1").hover(function(){
												   //鼠标放上去时执行
												 $(this).addClass("s2").removeClass(".s1");  
												   },function(){
												//鼠标移开后执行
												$(this).addClass(".s1").removeClass("s2");  	   
												})
		   })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".nav_bg .nav .s1 a").each(function() {
            $this = $(this);
            if ($this[0].href == String(window.location)) {
                $this.addClass("s2");
            }
        });
    });
</script>
<div class="top_1">
	<div class="head_1">
    <span class="head_1_1">您好，欢迎来到购钢现货网！</span>
    <a class="blue" href="index.php">返回首页</a><span> | </span>
    <a class="blue" href="#">登陆</a><span> | </span>
    <a class="blue" href="#">注册</a><span> | </span>
    <a class="blue" href="#">加入收藏</a>
    </div>
</div>
<div class="top_2">
	<div class="head_2">
    	<div class="h1"><a href="index.php"></a></div>
    </div>
</div>
<div class="nav_bg">
	<ul class="nav">
    	<li class="s1"><a href="index.php">首页</a></li>
        <li class="s1"><a href="about.php">企业简介</a></li>
        <li class="s1"><a href="qualified.php">企业资质</a></li>
        <li class="s1"><a href="stock.php">现货库存</a></li>
        <li class="s1"><a href="recruit.php">企业招聘</a></li>
        <li class="s1"><a href="contact.php">联系方式</a></li>
    </ul>
</div>

