<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class GuandaoController extends HomeController {

	//网站首页
    public function Sactuals($page = 1,$pinzhong = '', $caizhi = '', $guige = ''){
    	//检测仓库地区
		$uid = is_login();
		if(cookie('warehouse') != 0)$map['warehouse'] = cookie('warehouse');
		
		//搜索条件
		if($pinzhong !=1 || $caizhi != '' || $guige!= ''){
			//搜索现货开始
			if($pinzhong != '')$map['pinzhong'] = $pinzhong;
			if($caizhi != '')$map['caizhi'] = $caizhi;
			//规格
			$guiges = explode('*',$guige);
			$guige_zhijing = $guiges[0];
			$guige_bihou = $guiges[1];
			$guige_changdu = $guiges[2];
			//壁厚搜索条件
			if($guige_bihou>=5 and $guige_bihou<10){
				if($guige_bihou != '')$map['guige_bihou'] = array(array('egt',$guige_bihou-0.5),array('elt',$guige_bihou+0.5));
				if($order){
					$order.=",guige_bihou asc,guige_bihou=$guige_bihou desc";
				}else{
					$order.="guige_bihou=$guige_bihou desc";
				}
			}elseif($guige_bihou>=10){
				if($guige_bihou != '')$map['guige_bihou'] = array(array('egt',$guige_bihou-1),array('elt',$guige_bihou+1));
				if($order){
					$order.=",guige_bihou asc,guige_bihou=$guige_bihou desc";
				}else{
					$order.="guige_bihou=$guige_bihou desc";
				}				
			}else{
				if($guige_bihou != '')$map['guige_bihou'] = $guige_bihou;
			}
			if($guige_zhijing){
				if($guige_zhijing != '')$map['guige_zhijing'] = array(array('egt',$guige_zhijing-1),array('elt',$guige_zhijing+1));
				if($order){
					$order.=",guige_zhijing asc,guige_bihou=$guige_zhijing desc";
				}else{
					$order.="guige_zhijing=$guige_zhijing desc";
				}
			}
			
			
			//if($guige_zhijing != '')$map['guige_zhijing'] = $guige_zhijing;
			
			if($guige_changdu != '')$map['guige_changdu'] = array('like',$guige_changdu.'%');
		}
		if($order){
			$order.=",create_time desc";
		}else{
			$order.="create_time desc";
		}
		//获取每页显示数量
		$page_nums = C('PAGE_NUM');
		
		$lists = D("xhGangguan")->where($map)->order($order)->page($page, 20)->select();
		$totalCount = D('xhGangguan')->where($map)->count();
		
		$main_business = C('COMPANY_TYPE');
        $this->assign('totalPageCount', $totalCount);
        $this->assign('page_num', $page_nums['钢管']);			
		
		$warehouse = C('WAREHOUSE');
		
		foreach($lists as &$val){
			$company = D("Company")->where('id = ' . $val['cid'])->find();
			$val['company'] = $company;
			$val['name'] = $company['name'];
			$val['qq'] = $company['qq'];
			$val['business'] = doBusiness($company['business']);
			$val['com_address'] = $company['com_address'];
			
			$info = D("ucenter_member")->find($company['uid']);
			$val['mobile'] = $info['mobile'];
			
			$contact = D('contact')->where('uid = ' . $company['uid'])->find();
			$val['mobile2'] = $contact['mobile'];
			$val['fax'] = $contact['fax'];
			
			$bus = explode(',',$company['main_business']);
			$bstr = '';
			foreach($bus as $bs){
				$val['main_business'] = $bs;
				$bstr .= $main_business[$bs] . ',';
			}
			$bstr = substr($bstr,0,strlen($bstr)-1); 
			$val['main_business'] = $bstr;
			
			$val['jian'] = $company['a_company'];
			$val['warehouse'] = $warehouse[$val['warehouse']];
		}
		
		unset($val);
		$this->assign('lists',$lists);	
		
		
		
		
        $this->display();
    }

	//现货法兰
    public function profile($page = 1,$search =1, $pinzhong = '', $caizhi = '', $guige = '', $gongsi = ''){
		//检测仓库地区
		$uid = is_login();
		if(cookie('warehouse') != 0)$map['warehouse'] = cookie('warehouse');//搜索条件
		if($search ==1){
			//搜索现货开始 
			if($pinzhong != '')$map['pinzhong'] = $pinzhong;
			if($caizhi != '')$map['caizhi'] = $caizhi;
			//规格
			$map['guige'] = array('like','%'.$guige.'%');

		}else{
			//搜索公司
			$cmap['company'] = array('like','%'.$gongsi.'%');
			$cmap['a_company'] = array('like','%'.$gongsi.'%');
			$cmap['_logic'] = 'OR';		
			$cid = D("Company")->where($cmap)->getField('id',true);
			if($cid){
				$map['cid']  = array('in',implode(",",$cid));
			}else{
				$map['cid']  = 0;
			}
		}
		if($order){
			$order.=",create_time desc";
		}else{
			$order.="create_time desc";
		}
		//获取每页显示数量
		$page_nums = C('PAGE_NUM');
		
		$lists = D("xhXingcai")->where($map)->order($order)->page($page, $page_nums['型材'])->select();
		$totalCount = D('xhXingcai')->where($map)->count();
		
        $this->assign('totalPageCount', $totalCount);
        $this->assign('page_num', $page_nums['型材']);			

		$main_business = C('COMPANY_TYPE');
		foreach($lists as &$val){
			$company = D("Company")->where('id = ' . $val['cid'])->find();
			$val['company'] = $company;
			$val['name'] = $company['name'];
			$val['qq'] = $company['qq'];
			$val['business'] = doBusiness($company['business']);
			$val['com_address'] = $company['com_address'];
			
			$info = D("ucenter_member")->find($company['uid']);
			$val['mobile'] = $info['mobile'];
			
			$contact = D('contact')->where('uid = ' . $company['uid'])->find();
			$val['mobile2'] = $contact['mobile'];
			$val['fax'] = $contact['fax'];
			
			$bus = explode(',',$company['main_business']);
			$bstr = '';
			foreach($bus as $bs){
				$val['main_business'] = $bs;
				$bstr .= $main_business[$bs] . ',';
			}
			$bstr = substr($bstr,0,strlen($bstr)-1); 
			$val['main_business'] = $bstr;
			
			$val['jian'] = $company['a_company'];
			$val['warehouse'] = $warehouse[$val['warehouse']];
		}
		
		unset($val);
		$this->assign('lists',$lists);
		

		
        $this->display();
    }
    //翻边
	public function molding_one($page = 1, $search = 1, $pinzhong = '', $caizhi = '', $gongyi = '', $guige = '', $rzhi = '', $biaomian = '', $gongsi = ''){
		//检测仓库地区
		$uid = is_login();
		if(cookie('warehouse') != 0)$map['warehouse'] = cookie('warehouse');//搜索条件
		if($search ==1){
			//搜索现货开始
			if($pinzhong != '')$map['pinzhong'] = $pinzhong;
			if($caizhi != '')$map['caizhi'] = $caizhi;
			if($rzhi != '')$map['rzhi'] = $rzhi;
			if($gongyi != '')$map['gongyi'] = $gongyi;
			if($biaomian != '')$map['biaomian'] = $biaomian;


			//规格
			$guiges = explode('*',$guige);
			$guige_waijing = $guiges[0];
			$guige_bihou = $guiges[1];

			//壁厚搜索条件
			if($guige_bihou>=5 and $guige_bihou<10){
				if($guige_bihou != '')$map['guige_bihou'] = array(array('egt',$guige_bihou-0.5),array('elt',$guige_bihou+0.5));
				if($order){
					$order.=",guige_bihou asc,guige_bihou=$guige_bihou desc";
				}else{
					$order.="guige_bihou=$guige_bihou desc";
				}
			}elseif($guige_bihou>=10){
				if($guige_bihou != '')$map['guige_bihou'] = array(array('egt',$guige_bihou-1),array('elt',$guige_bihou+1));
				if($order){
					$order.=",guige_bihou asc,guige_bihou=$guige_bihou desc";
				}else{
					$order.="guige_bihou=$guige_bihou desc";
				}
			}else{
				if($guige_bihou != '')$map['guige_bihou'] = $guige_bihou;
			}
			if($guige_waijing){
				if($guige_waijing != '')$map['guige_waijing'] = array(array('egt',$guige_waijing-1),array('elt',$guige_waijing+1));
				if($order){
					$order.=",guige_waijing asc,guige_bihou=$guige_waijing desc";
				}else{
					$order.="guige_waijing=$guige_waijing desc";
				}
			}

			//if($guige_waijing != '')$map['guige_waijing'] = array('like','%'.$guige_waijing.'%');
			//if($guige_bihou != '')$map['guige_bihou'] = array('like','%'.$guige_bihou.'%');
		}else{
			//搜索公司
			$cmap['company'] = array('like','%'.$gongsi.'%');
			$cmap['a_company'] = array('like','%'.$gongsi.'%');
			$cmap['_logic'] = 'OR';
			$cid = D("Company")->where($cmap)->getField('id',true);
			if($cid){
				$map['cid']  = array('in',implode(",",$cid));
			}else{
				$map['cid']  = 0;
			}
		}
		if($order){
			$order.=",create_time desc";
		}else{
			$order.="create_time desc";
		}
		//获取每页显示数量
		$page_nums = C('PAGE_NUM');

		$lists = D("xhGuanjianWt")->where($map)->order($order)->page($page, $page_nums['弯头'])->select();
		$totalCount = D('xhGuanjianWt')->where($map)->count();

        $this->assign('totalPageCount', $totalCount);
        $this->assign('page_num', $page_nums['弯头']);

		$main_business = C('COMPANY_TYPE');
		$warehouse = C('WAREHOUSE');
		foreach($lists as &$val){
			$company = D("Company")->where('id = ' . $val['cid'])->find();
			$val['company'] = $company;
			$val['name'] = $company['name'];
			$val['qq'] = $company['qq'];
			$val['business'] = doBusiness($company['business']);
			$val['com_address'] = $company['com_address'];

			$info = D("ucenter_member")->find($company['uid']);
			$val['mobile'] = $info['mobile'];

			$contact = D('contact')->where('uid = ' . $company['uid'])->find();
			$val['mobile2'] = $contact['mobile'];
			$val['fax'] = $contact['fax'];

			$bus = explode(',',$company['main_business']);
			$bstr = '';
			foreach($bus as $bs){
				$val['main_business'] = $bs;
				$bstr .= $main_business[$bs] . ',';
			}
			$bstr = substr($bstr,0,strlen($bstr)-1);
			$val['main_business'] = $bstr;

			$val['jian'] = $company['a_company'];
			$val['warehouse'] = $warehouse[$val['warehouse']];
		}

		unset($val);
		$this->assign('lists',$lists);
        $this->display();
	}
    public function molding_three($page = 1, $search = 1, $pinzhong = '', $caizhi = '', $gongyi = '', $guige = '', $rzhi = '', $biaomian = '', $gongsi = ''){
        //检测仓库地区
        $uid = is_login();
        if(cookie('warehouse') != 0)$map['warehouse'] = cookie('warehouse');//搜索条件
        if($search ==1){
            //搜索现货开始
            if($pinzhong != '')$map['pinzhong'] = $pinzhong;
            if($caizhi != '')$map['caizhi'] = $caizhi;
            if($rzhi != '')$map['rzhi'] = $rzhi;
            if($gongyi != '')$map['gongyi'] = $gongyi;
            if($biaomian != '')$map['biaomian'] = $biaomian;


            //规格
            $guiges = explode('*',$guige);
            $guige_waijing = $guiges[0];
            $guige_bihou = $guiges[1];

            //壁厚搜索条件
            if($guige_bihou>=5 and $guige_bihou<10){
                if($guige_bihou != '')$map['guige_bihou'] = array(array('egt',$guige_bihou-0.5),array('elt',$guige_bihou+0.5));
                if($order){
                    $order.=",guige_bihou asc,guige_bihou=$guige_bihou desc";
                }else{
                    $order.="guige_bihou=$guige_bihou desc";
                }
            }elseif($guige_bihou>=10){
                if($guige_bihou != '')$map['guige_bihou'] = array(array('egt',$guige_bihou-1),array('elt',$guige_bihou+1));
                if($order){
                    $order.=",guige_bihou asc,guige_bihou=$guige_bihou desc";
                }else{
                    $order.="guige_bihou=$guige_bihou desc";
                }
            }else{
                if($guige_bihou != '')$map['guige_bihou'] = $guige_bihou;
            }
            if($guige_waijing){
                if($guige_waijing != '')$map['guige_waijing'] = array(array('egt',$guige_waijing-1),array('elt',$guige_waijing+1));
                if($order){
                    $order.=",guige_waijing asc,guige_bihou=$guige_waijing desc";
                }else{
                    $order.="guige_waijing=$guige_waijing desc";
                }
            }

            //if($guige_waijing != '')$map['guige_waijing'] = array('like','%'.$guige_waijing.'%');
            //if($guige_bihou != '')$map['guige_bihou'] = array('like','%'.$guige_bihou.'%');
        }else{
            //搜索公司
            $cmap['company'] = array('like','%'.$gongsi.'%');
            $cmap['a_company'] = array('like','%'.$gongsi.'%');
            $cmap['_logic'] = 'OR';
            $cid = D("Company")->where($cmap)->getField('id',true);
            if($cid){
                $map['cid']  = array('in',implode(",",$cid));
            }else{
                $map['cid']  = 0;
            }
        }
        if($order){
            $order.=",create_time desc";
        }else{
            $order.="create_time desc";
        }
        //获取每页显示数量
        $page_nums = C('PAGE_NUM');

        $lists = D("xhGuanjianWt")->where($map)->order($order)->page($page, $page_nums['弯头'])->select();
        $totalCount = D('xhGuanjianWt')->where($map)->count();

        $this->assign('totalPageCount', $totalCount);
        $this->assign('page_num', $page_nums['弯头']);

        $main_business = C('COMPANY_TYPE');
        $warehouse = C('WAREHOUSE');
        foreach($lists as &$val){
            $company = D("Company")->where('id = ' . $val['cid'])->find();
            $val['company'] = $company;
            $val['name'] = $company['name'];
            $val['qq'] = $company['qq'];
            $val['business'] = doBusiness($company['business']);
            $val['com_address'] = $company['com_address'];

            $info = D("ucenter_member")->find($company['uid']);
            $val['mobile'] = $info['mobile'];

            $contact = D('contact')->where('uid = ' . $company['uid'])->find();
            $val['mobile2'] = $contact['mobile'];
            $val['fax'] = $contact['fax'];

            $bus = explode(',',$company['main_business']);
            $bstr = '';
            foreach($bus as $bs){
                $val['main_business'] = $bs;
                $bstr .= $main_business[$bs] . ',';
            }
            $bstr = substr($bstr,0,strlen($bstr)-1);
            $val['main_business'] = $bstr;

            $val['jian'] = $company['a_company'];
            $val['warehouse'] = $warehouse[$val['warehouse']];
        }

        unset($val);
        $this->assign('lists',$lists);

        $this->display();
    }
}