<?php 
	function url2abs($srcurl,$baseurl){

	  $srcinfo = parse_url($srcurl); 
	  //print_r($srcinfo); 
	  if(isset($srcinfo['scheme'])) {  
		return $srcurl;  
	  }

	  $baseinfo = parse_url($baseurl);  
	  $url = $baseinfo['scheme'].'://'.$baseinfo['host'];  
	  if(substr($srcinfo['path'], 0, 1) == '/') {  
		$path = $srcinfo['path'];  
	  }else{  
		$path = dirname($baseinfo['path']).'/'.$srcinfo['path'];  
	  }  
	  $rst = array();  
	  $path_array = explode('/', $path);  
	  if(!$path_array[0]) {  
		$rst[] = '';  
	  }
	  foreach ($path_array AS $key => $dir) {  
		if ($dir == '..') {  
		  if (end($rst) == '..') {  
			$rst[] = '..';  
		  }elseif(!array_pop($rst)) {  
			$rst[] = '..';  
		  }  
		}elseif($dir && $dir != '.') {  
		  $rst[] = $dir;  
		}  
	   }  
	  if(!end($path_array)) {  
		$rst[] = '';  
	  }  
	  $url .= implode('/', $rst);
	  if( !empty($srcinfo['query']) ) $url .= '?'.$srcinfo['query'];
	  return str_replace('\\', '/', $url);
	}
	$url1= "http://www.smzdm.com/p/6392454/a.htm";
	$url2= "./images/a.jpg";


	echo url2abs($url2,$url1);
?>