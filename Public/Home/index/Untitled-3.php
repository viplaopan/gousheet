<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

    <title></title>
    <script>
        function Test() {
            if (document.getElementById("bgImg").style.backgroundImage.indexOf('Jellyfish.jpg') > 0) {
                document.getElementById("bgImg").style.backgroundImage = "url('bg_img.jpg')";
            }
            else {
                document.getElementById("bgImg").style.backgroundImage = "url('Jellyfish.jpg')";
            }
 
        }
    </script>

<a id="bgImg" >
 
    <form id="form1" runat="server">
    <div>
    <input type="button" id="btn" onclick="javascript:Test();" value="更换" />
    </div>
    </form>

</a>

</html>