<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
<style type="text/css">
body{
    background-color: #444;
}
.test{
    width: 15px;
    height: 30px;
    box-sizing:border-box;
    border-top: 15px solid #f5f5f5;
    border-bottom: 15px solid #f5f5f5;
    /*border-left: 20px solid #0f0;*/
    border-right: 15px solid transparent;
   /* border-top-right-radius: 4px;
    border-radius: 12px;*/
}
.csspic{
    width: 200px;
    height: 400px;
    margin:50px auto;
    background:  url(images/5.jpg) -15px top no-repeat;
    -webkit-background-size: cover;
    background-size: cover;
    border-radius: 10px;
    position: relative;
    border: 15px solid #f5f5f5;
    -moz-background-clip: border;
    -webkit-background-clip: border-box;
    -o-background-clip: border-box;
    background-clip: border-box;
}
.img{    
    overflow: hidden;
    width: 260px;
    height: 400px;
}
.sjx{
    position: absolute;
    top:30px;
    left: -15px;
    background:  url(images/5.jpg) left -30px no-repeat;
    -webkit-background-size: 500px;
    background-size: 500px;
    z-index: 9999;
}
.csspic img{
    height: 100%;
} 
</style>
</head>
<body>
    
    
    <div class="csspic">
        <div class="sjx">
            <div class="test"></div>
        </div>
        <div class="img"><!-- <img src="images/5.jpg"> --></div>
        
    </div>
</body>
</html>