<?php
/**
 * Created by PhpStorm.
 * User: caipeichao
 * Date: 14-3-10
 * Time: PM7:40
 */

function getPagination($totalCount, $countPerPage = 10)
{
    $pageKey = 'page';

    //获取当前页码
    $currentPage = intval($_REQUEST[$pageKey]) ? intval($_REQUEST[$pageKey]) : 1;

    //计算总页数
    $pageCount = ceil($totalCount / $countPerPage);

    //如果只有1页，就没必要翻页了
    if ($pageCount <= 1) {
        return '';
    }
//  $Page       = new \Think\Page($totalCount,$countPerPage);// 实例化分页类 传入总记录数和每页显示的记录数
//  return   $Page->show();



    //定义返回结果
    $html = '';

    //添加头部
    $html .= '<div class="xx_xia">';
	
	
	$html .= '<div class="div_buis">' . $totalCount . ' 条记录</div>';
	$html .= '<div class="div_buis">'. $currentPage .'/' . $pageCount . ' 页</div>';

    //添加上一页的按钮
    if ($currentPage > 1) {
        $prevUrl = addUrlParam(getCurrentUrl(), array($pageKey => $currentPage - 1));
		$html .= "<a href=\"{$prevUrl}\" class=\"div_left\"></a>";
    } else {
        //$html .= "<li class=\"disabled\"><a>&laquo;</a></li>";
    }
    
	
	
    //添加各页面按钮
    if($pageCount <= 8){
		for ($i = 1; $i <= $pageCount; $i++) {
	        $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
	        if ($i == $currentPage) {
	            
				$html .= "<a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a>";
	        } else {
	            $html .= "<a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a>";
	        }
	    }
	}else{
		if($currentPage>8){
			$html .= "<a class=\"active div_pag\" href=\"" .addUrlParam(getCurrentUrl(), array($pageKey => 1)). "\">1</a>";
			$html .= "<div class=\"div_pag\">...</div>";
		}
		if($currentPage < $pageCount-4){
			if($currentPage >= 8){
				for ($i = $currentPage-4; $i <= $currentPage+4; $i++) {
			        $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
			        if ($i == $currentPage) {
			           
						$html .= "<a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a>";
			        } else {
			            $html .= "<a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a>";
			        }
			    }
			}else{
				for ($i = 1; $i <= 8; $i++) {
			        $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
			        if ($i == $currentPage) {
						$html .= "<a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a>";
			        } else {
			            $html .= "<a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a>";
			        }
			    }
			}
		}
		else{
			for ($i = $currentPage-8; $i <= $pageCount; $i++) {
		        $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
		        if ($i == $currentPage) {
		           
					$html .= "<a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a>";
		        } else {
		            $html .= "<a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a>";
		        }
		    }
		}
		
	}
    if($currentPage<$pageCount-4){
    	$html .= "<div class=\"div_pag\">...</div>";
		$html .= "<a class=\"active div_pag\" href=\"" .addUrlParam(getCurrentUrl(), array($pageKey => $pageCount)). "\">" . $pageCount . "</a>";
		
	}

    //添加下一页按钮
    if ($currentPage < $pageCount) {
        $nextUrl = addUrlParam(getCurrentUrl(), array($pageKey => $currentPage + 1));
		$html .= "<a class=\"div_right\"  href=\"{$nextUrl}\"></a>";
    } else {
        //$html .= "<li class=\"disabled\"><a>&raquo;</a></li>";
    }
    $html .= '<div class="div_font1">跳转至</div>';
    $html .= '<input name="" type="text" class="div_ipt" />';
    $html .= '<div class="div_font2">页</div>';
    //收尾
    $html .= '</div>';
    return $html;
}

function getPagination2($totalCount, $countPerPage = 10)
{
    $pageKey = 'page';

    //获取当前页码
    $currentPage = intval($_REQUEST[$pageKey]) ? intval($_REQUEST[$pageKey]) : 1;

    //计算总页数
    $pageCount = ceil($totalCount / $countPerPage);

    //如果只有1页，就没必要翻页了
    if ($pageCount <= 1) {
        return '';
    }
//  $Page       = new \Think\Page($totalCount,$countPerPage);// 实例化分页类 传入总记录数和每页显示的记录数
//  return   $Page->show();



    //定义返回结果
    $html = '';

    //添加头部
    $html .= '<div class="xx_xia">';
   
   

    $html .= '<div class="div_buis">' . $totalCount . ' 条记录</div>';
    $html .= '<div class="div_buis">'. $currentPage .'/' . $pageCount . ' 页</div>';

   
    
    
    //添加各页面按钮
    if($pageCount <= 8){
        for ($i = 1; $i <= $pageCount; $i++) {
            $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
            if ($i == $currentPage) {
                
                $html .= "<a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a>";
            } else {
                $html .= "<a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a>";
            }
        }
    }else{
        if($currentPage>8){
            $html .= "<a class=\"active div_pag\" href=\"" .addUrlParam(getCurrentUrl(), array($pageKey => 1)). "\">1</a>";
            $html .= "<div class=\"div_pag\">...</div>";
        }
        if($currentPage < $pageCount-4){
            if($currentPage >= 8){
                for ($i = $currentPage-4; $i <= $currentPage+4; $i++) {
                    $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
                    if ($i == $currentPage) {
                       
                        $html .= "<a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a>";
                    } else {
                        $html .= "<a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a>";
                    }
                }
            }else{
                for ($i = 1; $i <= 8; $i++) {
                    $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
                    if ($i == $currentPage) {
                        $html .= "<a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a>";
                    } else {
                        $html .= "<a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a>";
                    }
                }
            }
        }
        else{
            for ($i = $currentPage-8; $i <= $pageCount; $i++) {
                $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
                if ($i == $currentPage) {
                   
                    $html .= "<a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a>";
                } else {
                    $html .= "<a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a>";
                }
            }
        }
        
    }
    if($currentPage<$pageCount-4){
        $html .= "<div class=\"div_pag\">...</div>";
        $html .= "<a class=\"active div_pag\" href=\"" .addUrlParam(getCurrentUrl(), array($pageKey => $pageCount)). "\">" . $pageCount . "</a>";
        
    }
 //添加上一页的按钮
    if ($currentPage > 1) {
        $prevUrl = addUrlParam(getCurrentUrl(), array($pageKey => $currentPage - 1));
        $html .= "<a href=\"{$prevUrl}\" class=\"div_left\"></a>";
    } else {
        //$html .= "<li class=\"disabled\"><a>&laquo;</a></li>";
    }
    
    //添加下一页按钮
    if ($currentPage < $pageCount) {
        $nextUrl = addUrlParam(getCurrentUrl(), array($pageKey => $currentPage + 1));
        $html .= "<a class=\"div_right\"  href=\"{$nextUrl}\"></a>";
    } else {
        //$html .= "<li class=\"disabled\"><a>&raquo;</a></li>";
    }

    //收尾
     $html .= '<div class="div_font1">跳转至</div>';

     $html .= '<input name="" type="text" class="div_ipt" />';
      $html .= '<div class="div_font2">页</div>';
    $html .= '</div>';
    return $html;
}


function getPaginationCompany($totalCount, $countPerPage = 10)
{
    $pageKey = 'page';

    //获取当前页码
    $currentPage = intval($_REQUEST[$pageKey]) ? intval($_REQUEST[$pageKey]) : 1;

    //计算总页数
    $pageCount = ceil($totalCount / $countPerPage);

    //如果只有1页，就没必要翻页了
    if ($pageCount <= 1) {
        return '';
    }
//  $Page       = new \Think\Page($totalCount,$countPerPage);// 实例化分页类 传入总记录数和每页显示的记录数
//  return   $Page->show();



    //定义返回结果
    $html = '';

    //添加头部
    $html .= '<div class="d1">' . $totalCount . '条记录 '. $currentPage .'/' . $pageCount . '页</div>';
    

    //添加上一页的按钮
    if ($currentPage > 1) {
        $prevUrl = addUrlParam(getCurrentUrl(), array($pageKey => $currentPage - 1));
        $html .= "<div class='d2 d'><a href=\"{$prevUrl}\" class=\"div_left\">上一页</a></div>";
    } else {
        //$html .= "<li class=\"disabled\"><a>&laquo;</a></li>";
    }
    
    
    
    //添加各页面按钮
    if($pageCount <= 8){
        for ($i = 1; $i <= $pageCount; $i++) {
            $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
            if ($i == $currentPage) {
                
                $html .= "<div class=\"d3 d\"><a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a></div>";
            } else {
                $html .= "<div class=\"d3 d\"><a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a></div>";
            }
        }
    }else{
        if($currentPage>8){
            $html .= "<a class=\"active div_pag\" href=\"" .addUrlParam(getCurrentUrl(), array($pageKey => 1)). "\">1</a>";
            $html .= "<div class=\"div_pag\">...</div>";
        }
        if($currentPage < $pageCount-4){
            if($currentPage >= 8){
                for ($i = $currentPage-4; $i <= $currentPage+4; $i++) {
                    $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
                    if ($i == $currentPage) {
                       
                        $html .= "<div class=\"d3 d\"><a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a></div>";
                    } else {
                        $html .= "<div class=\"d3 d\"><a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a></div>";
                    }
                }
            }else{
                for ($i = 1; $i <= 8; $i++) {
                    $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
                    if ($i == $currentPage) {
                        $html .= "<div class=\"d3 d\"><a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a></div>";
                    } else {
                        $html .= "<div class=\"d3 d\"><a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a></div>";
                    }
                }
            }
        }
        else{
            for ($i = $currentPage-8; $i <= $pageCount; $i++) {
                $pageUrl = addUrlParam(getCurrentUrl(), array($pageKey => $i));
                if ($i == $currentPage) {
                   
                    $html .= "<div class=\"d3 d\"><a class=\"active div_pag\" href=\"{$pageUrl}\">{$i}</a></div>";
                } else {
                    $html .= "<div class=\"d3 d\"><a class=\"div_pag\" href=\"{$pageUrl}\">{$i}</a></div>";
                }
            }
        }
        
    }
    if($currentPage<$pageCount-4){
        $html .= "<div class=\"d3 d\">...</div>";
        $html .= "<div class=\"d9 d\"><a class=\"active div_pag\" href=\"" .addUrlParam(getCurrentUrl(), array($pageKey => $pageCount)). "\">最后一页</a></div>";
        
    }

    //添加下一页按钮
    if ($currentPage < $pageCount) {
        $nextUrl = addUrlParam(getCurrentUrl(), array($pageKey => $currentPage + 1));
        $html .= "<div class=\"d8 d\"><a class=\"div_right\"  href=\"{$nextUrl}\">下一页</a></div>";
    } else {
        //$html .= "<li class=\"disabled\"><a>&raquo;</a></li>";
    }

    //收尾
   
    return $html;
}

function getPageHtml($f_name, $totalpage, $data, $nowpage)
{
    if ($totalpage > 1 && $totalpage != null) {
        $str = '';
        foreach ($data as $k => $v) {
            $str = $str . '"' . $v . '"' . ',';
        }
        $pages = '';
        for ($i = 1; $i <= $totalpage; $i++) {
            if ($i == $nowpage) {
                $pages = $pages . "<li class=\"active\"><a href=\"javascript:\" id='page_" . $i . "' class='page active' onclick='" . $f_name . "(" . $str . $i . ")'>" . $i . "</a></li>";
            } else {
                $pages = $pages . "<li><a href=\"javascript:\" id='page_" . $i . "' class='page' onclick='" . $f_name . "(" . $str . $i . ")'>" . $i . "</a></li>";
            }
        }
        if ($nowpage == 1) {
            $a = $nowpage;
            $pre = "<li class=\"disabled\"><a href=\"javascript:\" class='page_pre'  onclick = '" . $f_name . "( " . $str . $a . ")'>" . "&laquo;" . "</a></li>";
        } else {
            $a = $nowpage - 1;
            $pre = "<li><a href=\"javascript:\" class='page_pre'  onclick = '" . $f_name . "( " . $str . $a . ")'>" . "&laquo;" . "</a></li>";
        }
        /*    $pre = "<li class=\"disabled\"><a class='a page_pre'  onclick = '" . $f_name . "( " . $str . $a . ")'>" . "上一页" . "</a></li>";*/

        if ($nowpage == $totalpage) {
            $b = $totalpage;
            $next = "<li class=\"disabled\"><a href=\"javascript:\" class='a page_next'  onclick = '" . $f_name . "( " . $str . $b . ")'>" . "&raquo;" . "</a></li>";
        } else {
            $b = $nowpage + 1;
            $next = "<li><a href=\"javascript:\" class='a page_next'  onclick = '" . $f_name . "( " . $str . $b . ")'>" . "&raquo;" . "</a></li>";
        }

        return $pre . $pages . $next;
    }
}


function getPage($data, $limit, $page)
{
    $offset = ($page - 1) * $limit;
    return array_slice($data, $offset, $limit);
}


function addUrlParam($url, $params)
{
    $app = MODULE_NAME;
    $controller = CONTROLLER_NAME;
    $action = ACTION_NAME;
    $get = array_merge($_GET, $params);
    return U("$app/$controller/$action", $get);
}

function getCurrentUrl()
{
    return $_SERVER['REQUEST_URI'];
}