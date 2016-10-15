// JavaScript Document


function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}

var xmlHttp;
function loadnews(a)
{ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
 {
alert ("Browser does not support HTTP Request")
 return
 }
var url="loadnews.php"
url=url+"?a="+encodeURI(a);
xmlHttp.onreadystatechange=stateChanged
function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 {
$(".left_bt").css("display","none"); 
$(".left_nr").css("display","none"); 
$(".nns").css("display","block").html(xmlHttp.responseText);
 
 } 
}
xmlHttp.open("post",url,true)
xmlHttp.send(null)
}