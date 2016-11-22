
    window.onload = function(){  
	
        var arrs = document.getElementsByTagName('input');  
        for(var i = 0;i<arrs.length;i++){  
		
            arrs[i].onclick = function(){ 
			     
                //this是当前激活的按钮，在这里可以写对应的操作    
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
