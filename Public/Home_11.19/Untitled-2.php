<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<title>code.js.cn </title> 
<style> 
a 
{ 
display: block; 
font-size: 15px; 
line-height: 18px; 
text-decoration: none; 
color: #333; 
font-family: Arial; 
font-size: 12px; 
} 
.shell 
{ 
background:no-repeat 4px 5px; 
border: 1px solid #aaa; 
width: 400px; 
padding: 3px 2px 2px 20px; 
} 
#div1 
{ 
height: 36px; 
overflow: hidden; 
} 
</style> 
</head> 
<body> 
<div class="shell"> 
<div id="div1"> 
<a>这是</a> 
<a>我的</a> 
<a>第一篇</a> 
<a>博客</a> 
</div> 
</div> 
</body> 
<script> 
var c, _ = Function; 
with (o = document.getElementById("div1")) { innerHTML += innerHTML; onmouseover = _("c=1"); onmouseout = _("c=0"); } 
(F = _("if(#%18||!c)#++,#%=o.scrollHeight>>1;setTimeout(F,#%18?10:3000);".replace(/#/g, "o.scrollTop")))(); 
</script> 
</html> 