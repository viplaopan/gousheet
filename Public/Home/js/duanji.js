// JavaScript Document
    window.onload = function(){
        var d1= document.getElementById("dd1");
		var d2= document.getElementById("dd2"); 
		var d3= document.getElementById("dd3");
		var d4= document.getElementById("dd4");
		
        var d5= document.getElementById("dd5");
		var d6= document.getElementById("dd6");
		var d7= document.getElementById("dd7");
		var d8= document.getElementById("dd8");
		
        d1.onmouseover = function(){
            dd5.style.display = "block";
			dd6.style.display = "none";
			dd7.style.display = "none";
			dd8.style.display = "none";
			
			
        };
		 d1.onmouseout = function(){
			 dd5.style.display = "block";
			dd6.style.display = "none";
			dd7.style.display = "none";
			dd8.style.display = "none"; 
 		};
		
        d2.onmouseover = function(){
			dd5.style.display = "none";
			dd6.style.display = "block";
			dd7.style.display = "none";
			dd8.style.display = "none";
			
        };
		
		d2.onmouseout = function(){
			dd5.style.display = "none";
			dd6.style.display = "block";
			dd7.style.display = "none";
			dd8.style.display = "none"; 
 		};
		
		
		d3.onmouseover = function(){
            dd5.style.display = "none";
			dd6.style.display = "none";
			dd7.style.display = "block";
			dd8.style.display = "none";
			
        };
		d3.onmouseout = function(){
			dd5.style.display = "none";
			dd6.style.display = "none";
			dd7.style.display = "block";
			dd8.style.display = "none"; 
 		};
		
		
        d4.onmouseover = function(){
            dd5.style.display = "none";
			dd6.style.display = "none";
			dd7.style.display = "none";
			dd8.style.display = "block";
        };
		d4.onmouseout = function(){
			dd5.style.display = "none";
			dd6.style.display = "none";
			dd7.style.display = "none";
			dd8.style.display = "block"; 
 		};
		
			
	 };	
