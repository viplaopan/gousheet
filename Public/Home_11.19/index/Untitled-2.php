<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网页特效-文本特效-非常不错的逐行新闻滚动效果</title>
<FCK:meta http-equiv="content-type" content="text/html;charset=gb2312" />
<!--把下面代码加到<head>与</head>之间-->
<style type="text/css">
a{
display:block;
font-size:12px;
line-height:18px;
text-decoration:none;
color:#333;
font-family:Arial;
}
.shell{
background:url(/effectimages/xml.gif) no-repeat 4px 5px;
border:1px solid #aaa;
width:400px;
padding:3px 2px 2px 20px;
}
#div1{
height:18px;
overflow:hidden;
}
</style>

<div class="shell">
<div id="div1">
<a href="javascript:" _fcksavedurl="javascript:">请教高手帮我看下这段代码：FLASH显示不了</a>
<a href="javascript:" _fcksavedurl="javascript:">请教在UTF-8编辑下的符号显示问题</a>
<a href="javascript:" _fcksavedurl="javascript:">jquery做的一个滑动效果，不知如何增加延迟，现在太灵敏了</a>
<a href="javascript:" _fcksavedurl="javascript:">技术研究：QQ2009版按钮渐显渐隐的由来</a>
<a href="javascript:" _fcksavedurl="javascript:">Javascript读取Json数据并分页显示，支持键盘和滚轮翻页</a>
<a href="javascript:" _fcksavedurl="javascript:">奇怪的PNG文件，拜师以求解惑</a>
<a href="javascript:" _fcksavedurl="javascript:">更新lhgdialog-ver2.0.1弹出窗口组件</a>
</div>
</div>
<script language="javascript">
var box=document.getElementById("div1"),can=true;
box.innerHTML+=box.innerHTML;
box.onmouseover=function(){can=false};
box.onmouseout=function(){can=true};
new function (){
	var stop=box.scrollTop%18==0&&!can;
	if(!stop)box.scrollTop==parseInt(box.scrollHeight/2)?box.scrollTop=0:box.scrollTop++;
	setTimeout(arguments.callee,box.scrollTop%18?10:1500);
};
</script>
</body>
</html>