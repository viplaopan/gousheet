<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html lang="zh-CN">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />  
<script src="../../../shangxing/js/jquery.js"></script>
<title>js���ư�ť��ʽ�л�</title>  
  
<link href="css/my.css" rel="stylesheet">  
<style>
.btn1{  
  border:none;  
  height:3.5em;  
  background-color:#000000;  
  color:white;  
  font-size:1.2em;  
  margin-top:0.5em;  
  width:100%;  
  border-radius:1em;  
}  
.btn2{  
  border:none;  
  height:3.5em;  
  background-color:#3E8CD0;  
  color:white;  
  font-size:1.2em;  
  margin-top:0.5em;  
  width:100%;  
  border-radius:1em;  
} 
</style>
  <script type="text/javascript">  
//��߰�ť�ĵ���¼�  
    window.onload = function(){  
        var arr = document.getElementsByTagName('button');  
        for(var i = 0;i<arr.length;i++){  
            arr[i].onclick = function(){      
                //this�ǵ�ǰ����İ�ť�����������д��Ӧ�Ĳ���    
                if(this.className == 'btn1'){  
                    this.className = 'btn2';  
                    var name = this.id;  
                    var btn = document.getElementsByClassName('btn2');  
                    for(var j=0;j<btn.length;j++){  
                        if(btn[j].id!=name){  
                            btn[j].className = 'btn1';  
                        }  
                    }     
                }  
             }   
         }  
     }  
</script>  
  
 
              <div style="width:20%"><button id = "1" type = "button" class = "btn2"> ��ť1</button></div>  
              <div style="width:20%"><button  id = "2" type = "button" class = "btn1"> ��ť2</button></div>  
              <div style="width:20%"><button id = "3" type = "button" class = "btn1"> ��ť3</button></div>  
              <div style="width:20%"><button id = "4" type ="button" class = "btn1"> ��ť4</button></div>  

            
  
  
</html>  