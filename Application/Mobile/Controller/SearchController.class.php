<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Mobile\Controller;
use Think\Controller;
/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class SearchController extends Controller {

	//网站资讯
    public function index($page = 1){
        $this->display();
    }

    //钢管
    public function Sactuals($page  = 1){
    	//get接受
    	$pinzhong = I("get.pz"); //品种
    	$caizhi = I("get.cz"); //材质
    	$guige = I("get.gg"); //规格
    	//输出
    	$this->assign('pinzhong',$pinzhong);
    	$this->assign('caizhi',$caizhi);
    	$this->assign('guige',$guige);



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
        echo D("xhGangguan")->getLastSql();
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
			$pattern = C('PATTERN');
			$val['business'] = $pattern[$company['pattern']];
			$val['com_address'] = $company['com_address'];
			
			//获取仓库
			$region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
			$val['ware_city'] = $region_name;

			$info = D("ucenter_member")->find($company['uid']);
			$val['mobile'] = $info['mobile'];
			
			$contact = D('contact')->where('cid = ' . $val['cid'])->find();
			$val['contact'] = $contact;

			$bus = explode(',',$company['main_business']);
			$bstr = '';
			foreach($bus as $bs){
				$val['main_business'] = $bs;
				$bstr .= $main_business[$bs] . ',';
			}
			$bstr = substr($bstr,0,strlen($bstr)-1); 
			$val['main_business'] = $bstr;
			$val['url'] = U('Company/detail',array('p'=>'Sactuals','id'=>$val['id']));
			$val['jian'] = $company['a_company'];
			$val['warehouse'] = $warehouse[$val['warehouse']];
		}
		
		unset($val);

		if(IS_POST){
    		if($lists){
    			$data['status'] = 1;
    			$data['content'] = $lists;
    			$this->ajaxReturn($data,'json');
    		}else{
    			$this->error();
    		}
    		
    	}else{
    		$this->assign('lists',$lists);
        	$this->display();
    	}
		
    }

    public function profile($page = 1){
        //get接受
    	$pinzhong = I("get.pz"); //品种
    	$caizhi = I("get.cz"); //材质
    	$guige = I("get.gg"); //规格
    	//输出
    	$this->assign('pinzhong',$pinzhong);
    	$this->assign('caizhi',$caizhi);
    	$this->assign('guige',$guige);
    	//检测仓库地区
		$uid = is_login();
		if(cookie('warehouse') != 0)$map['warehouse'] = cookie('warehouse');//搜索条件

		//搜索现货开始 
		if($pinzhong != '')$map['pinzhong'] = $pinzhong;
		if($caizhi != '')$map['caizhi'] = $caizhi;
		//规格
		$map['guige'] = array('like','%'.$guige.'%');

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

			//获取仓库
			$region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
			$val['ware_city'] = $region_name;

			$val['qq'] = $company['qq'];
			$pattern = C('PATTERN');
			$val['business'] = $pattern[$company['pattern']];
			$val['com_address'] = $company['com_address'];
			
			$info = D("ucenter_member")->find($company['uid']);
			$val['mobile'] = $info['mobile'];
			
			$contact = D('contact')->where('cid = ' . $val['cid'])->find();
			$val['contact'] = $contact;
			
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
		
			$val['url'] = U('Company/detail',array('p'=>'profile','id'=>$val['id']));
		}
		
		unset($val);
		if(IS_POST){
    		if($lists){
    			$data['status'] = 1;
    			$data['content'] = $lists;
    			$this->ajaxReturn($data,'json');
    		}else{
    			$this->error();
    		}
    		
    	}else{
    		$this->assign('lists',$lists);
        	$this->display();
    	}
    }
    public function frenchay($page = 1){
    	//get接受
    	$pinzhong = I("get.pz"); //品种
    	$caizhi = I("get.cz"); //材质
    	$guige = I("get.gg"); //规格
    	//输出
    	$this->assign('pinzhong',$pinzhong);
    	$this->assign('caizhi',$caizhi);
    	$this->assign('guige',$guige);

    	//搜索现货开始
		if($pinzhong != '')$map['pinzhong'] = $pinzhong;
		if($caizhi != '')$map['caizhi'] = $caizhi;
		//规格
		$guiges = explode('*',$guige);
		$guige_koujing = $guiges[0];
		$guige_yali = $guiges[1];
		if($guige_koujing != '')$map['guige_koujing'] = array('like','%'.$guige_koujing.'%');
		if($guige_yali != '')$map['guige_yali'] = array('like','%'.$guige_yali.'%');
		if($order){
			$order.=",create_time desc";
		}else{
			$order.="create_time desc";
		}
		//获取每页显示数量
		$page_nums = C('PAGE_NUM');
		
		$lists = D("xhFalan")->where($map)->order($order)->page($p, 20)->select();
		$totalCount = D('xhFalan')->where($map)->count();
		
        $this->assign('totalPageCount', $totalCount);
        $this->assign('page_num', $page_nums['法兰']);			
		
		$warehouse = C('WAREHOUSE');
		$main_business = C('COMPANY_TYPE');		
		foreach($lists as &$val){
			$company = D("Company")->where('id = ' . $val['cid'])->find();
            $val['company'] = $company;
            $val['name'] = $company['name'];
            $val['qq'] = $company['qq'];
            $pattern = C('PATTERN');
			$val['business'] = $pattern[$company['pattern']];
            $val['com_address'] = $company['com_address'];

            //获取仓库
			$region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
			$val['ware_city'] = $region_name;
			
            $info = D("ucenter_member")->find($company['uid']);
            $val['mobile'] = $info['mobile'];

            $contact = D('contact')->where('cid = ' . $val['cid'])->find();
			$val['contact'] = $contact;

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
			
			$val['url'] = U('Company/detail',array('p'=>'frenchay','id'=>$val['id']));
		}
		
		unset($val);
		if(IS_POST){
    		if($lists){
    			$data['status'] = 1;
    			$data['content'] = $lists;
    			$this->ajaxReturn($data,'json');
    		}else{
    			$this->error();
    		}
    		
    	}else{
    		$this->assign('lists',$lists);
        	$this->display();
    	}
    }
    public function valve($page = 1){
    	//get接受
    	$pinzhong = I("get.pz"); //品种
    	$caizhi = I("get.cz"); //材质
    	$guige = I("get.gg"); //规格
    	//输出
    	$this->assign('pinzhong',$pinzhong);
    	$this->assign('caizhi',$caizhi);
    	$this->assign('guige',$guige);

    	//搜索现货开始
		if($pinzhong != '')$map['pinzhong'] = $pinzhong;
		if($caizhi != '')$map['caizhi'] = $caizhi;
		//规格
		$guiges = explode('*',$guige);
		$guige_koujing = $guiges[0];
		$guige_yali = $guiges[1];
		if($guige_koujing != '')$map['guige_koujing'] = array('like','%'.$guige_koujing.'%');
		if($guige_yali != '')$map['guige_yali'] = array('like','%'.$guige_yali.'%');

		if($order){
			$order.=",create_time desc";
		}else{
			$order.="create_time desc";
		}
		//获取每页显示数量
		$page_nums = C('PAGE_NUM');
		
		$lists = D("xhFamen")->where($map)->order($order)->page($p, $page_nums['阀门'])->select();
		$totalCount = D('xhFamen')->where($map)->count();
		
        $this->assign('totalPageCount', $totalCount);
        $this->assign('page_num', $page_nums['阀门']);			
		
		foreach($lists as &$val){
			$company = D("Company")->where('id = ' . $val['cid'])->find();
            $val['company'] = $company;
            $val['name'] = $company['name'];
            $val['qq'] = $company['qq'];
            $pattern = C('PATTERN');
			$val['business'] = $pattern[$company['pattern']];
            $val['com_address'] = $company['com_address'];

            //获取仓库
			$region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
			$val['ware_city'] = $region_name;
			
            $info = D("ucenter_member")->find($company['uid']);
            $val['mobile'] = $info['mobile'];

            $contact = D('contact')->where('cid = ' . $val['cid'])->find();
			$val['contact'] = $contact;

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
			
			$val['url'] = U('Company/detail',array('p'=>'valve','id'=>$val['id']));
		}
		
		unset($val);
		if(IS_POST){
    		if($lists){
    			$data['status'] = 1;
    			$data['content'] = $lists;
    			$this->ajaxReturn($data,'json');
    		}else{
    			$this->error();
    		}
    		
    	}else{
    		$this->assign('lists',$lists);
        	$this->display();
    	}

    }
    public function molding_three($page = 1){
		$pinzhong = I("get.pz"); //品种
		$caizhi = I("get.cz"); //材质
		$gongyi = I("get.wtgy"); //材质
		$guige = I("get.gg"); //规格
		$rzhi = I("get.wtrz"); //规格
		$biaomian = I("get.wtbm");
    	//输出
    	$this->assign('pinzhong',$pinzhong);
    	$this->assign('caizhi',$caizhi);
    	$this->assign('gongyi',$gongyi);
    	$this->assign('guige',$guige);
    	$this->assign('rzhi',$rzhi);
    	$this->assign('biaomian',$biaomian);

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
        if($order){
            $order.=",create_time desc";
        }else{
            $order.="create_time desc";
        }
        //获取每页显示数量
        $page_nums = C('PAGE_NUM');

        $lists = D("xhGuanjianWt")->where($map)->order($order)->page($page, 20)->select();

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
            $pattern = C('PATTERN');

			$val['business'] = $pattern[$company['pattern']];
            $val['com_address'] = $company['com_address'];

            //获取仓库
			$region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
			$val['ware_city'] = $region_name;

            $info = D("ucenter_member")->find($company['uid']);
            $val['mobile'] = $info['mobile'];

            $contact = D('contact')->where('cid = ' . $val['cid'])->find();
			$val['contact'] = $contact;

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
       		$val['url'] = U('Company/detail',array('p'=>'molding_three','id'=>$val['id']));
		}
		
		unset($val);
		if(IS_POST){
    		if($lists){
    			$data['status'] = 1;
    			$data['content'] = $lists;
    			$this->ajaxReturn($data,'json');
    		}else{
    			$this->error();
    		}
    		
    	}else{
    		$this->assign('lists',$lists);
        	$this->display();
    	}

    }
    public function molding_two($page =1){
        $pinzhong = I("get.pz");
        $caizhi = I("get.cz");
        $guige = I("get.gg");
        $biaomian = I("get.stbm");
        $gongyi = I("get.stgy");
        //输出
        $this->assign('pinzhong',$pinzhong);
        $this->assign('caizhi',$caizhi);
        $this->assign('guige',$guige);
        $this->assign('gongyi',$gongyi);
        $this->assign('biaomian',$biaomian);


        //搜索现货开始
        if($pinzhong != '')$map['pinzhong'] = $pinzhong;
        if($caizhi != '')$map['caizhi'] = $caizhi;
        if($gongyi != '')$map['gongyi'] = $gongyi;          
        if($biaomian != '')$map['biaomian'] = $biaomian;            
        if($guige != '')$map['guige'] = array('like','%'.$guige.'%');

        if($order){
            $order.=",create_time desc";
        }else{
            $order.="create_time desc";
        }
        //获取每页显示数量 
        $page_nums = C('PAGE_NUM');
        
        $lists = D("xhGuanjianSst")->where($map)->order($order)->page($p, $page_nums['三通'])->select();
        $totalCount = D('xhGuanjianSst')->where($map)->count();
        
        $this->assign('totalPageCount', $totalCount);
        $this->assign('page_num', $page_nums['三通']);            
        
        $main_business = C('COMPANY_TYPE');
        $warehouse = C('WAREHOUSE');
        foreach($lists as &$val){
            $company = D("Company")->where('id = ' . $val['cid'])->find();
            $val['company'] = $company;
            $val['name'] = $company['name'];
            $val['qq'] = $company['qq'];
            $pattern = C('PATTERN');
            $val['business'] = $pattern[$company['pattern']];
            $val['com_address'] = $company['com_address'];

            //获取仓库
            $region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
            $val['ware_city'] = $region_name;
            
            $info = D("ucenter_member")->find($company['uid']);
            $val['mobile'] = $info['mobile'];

            $contact = D('contact')->where('cid = ' . $val['cid'])->find();
            $val['contact'] = $contact;

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
            $val['url'] = U('Company/detail',array('p'=>'molding_two','id'=>$val['id']));
        }
        
        unset($val);
        if(IS_POST){
            if($lists){
                $data['status'] = 1;
                $data['content'] = $lists;
                $this->ajaxReturn($data,'json');
            }else{
                $this->error();
            }
            
        }else{
            $this->assign('lists',$lists);
            $this->display();
        }
    }
    public function molding_one(){
        $pinzhong = I("get.pz");
        $caizhi = I("get.cz");
        $guige = I("get.gg");
        $biaomian = I("get.ftbm");

        //输出
        $this->assign('pinzhong',$pinzhong);
        $this->assign('caizhi',$caizhi);
        $this->assign('guige',$guige);
        $this->assign('biaomian',$biaomian);

        //搜索现货开始
        if($pinzhong != '')$map['pinzhong'] = $pinzhong;
        if($caizhi != '')$map['caizhi'] = $caizhi;
        if($biaomian != '')$map['biaomian'] = $biaomian;            
        //规格
        $guiges = explode('*',$guige);
        $guige_waijing = $guiges[0];
        $guige_bihou = $guiges[1];
        if($guige_waijing != '')$map['guige_waijing'] = array('like','%'.$guige_waijing.'%');
        if($guige_bihou != '')$map['guige_bihou'] = array('like','%'.$guige_bihou.'%');     

        if($order){
            $order.=",create_time desc";
        }else{
            $order.="create_time desc";
        }
        //获取每页显示数量 
        $page_nums = C('PAGE_NUM');
        
        $lists = D("xhGuanjianFt")->where($map)->order($order)->page($p, $page_nums['封头'])->select();
        $totalCount = D('xhGuanjianFt')->where($map)->count();
        
        $this->assign('totalPageCount', $totalCount);
        $this->assign('page_num', $page_nums['封头']);            
        
        $main_business = C('COMPANY_TYPE');
        $warehouse = C('WAREHOUSE');
        foreach($lists as &$val){
            $company = D("Company")->where('id = ' . $val['cid'])->find();
            $val['company'] = $company;
            $val['name'] = $company['name'];
            $val['qq'] = $company['qq'];
            $pattern = C('PATTERN');
            $val['business'] = $pattern[$company['pattern']];
            $val['com_address'] = $company['com_address'];

            //获取仓库
            $region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
            $val['ware_city'] = $region_name;


            $info = D("ucenter_member")->find($company['uid']);
            $val['mobile'] = $info['mobile'];

            $contact = D('contact')->where('cid = ' . $val['cid'])->find();
            $val['contact'] = $contact;

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
            $val['url'] = U('Company/detail',array('p'=>'molding_one','id'=>$val['id']));
        }
        
        unset($val);
        if(IS_POST){
            if($lists){
                $data['status'] = 1;
                $data['content'] = $lists;
                $this->ajaxReturn($data,'json');
            }else{
                $this->error();
            }
            
        }else{
            $this->assign('lists',$lists);
            $this->display();
        }
    }
    public function plank($page = 1){
        $pinzhong = I("get.pz");
        $guige = I("get.gg");
        $biaomian = I("get.bcbm");
        $changjia = I("get.bccj");
        $city = I("get.bccs");

        //搜索现货开始
        if($biaomian != '')$map['biaomian'] = $biaomian;
        if($caizhi != '')$map['caizhi'] = $caizhi;
        if($changjia != '')$map['changjia'] = array('like',$changjia.'%');
        
        //规格
        $guiges = explode('*',$guige);
        $guige_houdu = $guiges[0];
        $guige_kuan = $guiges[1];
        $guige_chang = $guiges[2];
        if($guige_houdu != '')$map['guige_houdu'] = array('like','%'.$guige_houdu.'%');
        if($guige_kuan != '')$map['guige_kuan'] = array('like','%'.$guige_kuan.'%');
        if($guige_chang != '')$map['guige_chang'] = array('like','%'.$guige_chang.'%');
        if($order){
            $order.=",create_time desc";
        }else{
            $order.="create_time desc";
        }
        //获取每页显示数量
        $page_nums = C('PAGE_NUM');
        
        $lists = D("xhBancai")->where($map)->order($order)->page($p, $page_nums['钢管'])->select();
        $totalCount = D('xhBancai')->where($map)->count();
        $this->assign('totalPageCount', $totalCount);
        $this->assign('page_num', $page_nums['钢管']);            
        
        $main_business = C('COMPANY_TYPE');
        
        foreach($lists as &$val){
            $company = D("Company")->where('id = ' . $val['cid'])->find();
            $val['company'] = $company;
            $val['name'] = $company['name'];
            $val['qq'] = $company['qq'];
            $pattern = C('PATTERN');
            $val['business'] = $pattern[$company['pattern']];
            $val['com_address'] = $company['com_address'];

            //获取仓库
            $region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
            $val['ware_city'] = $region_name;
            
            $info = D("ucenter_member")->find($company['uid']);
            $val['mobile'] = $info['mobile'];

            $contact = D('contact')->where('cid = ' . $val['cid'])->find();
            $val['contact'] = $contact;

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
            $val['url'] = U('Company/detail',array('p'=>'plank','id'=>$val['id']));
        }
        
        unset($val);
        if(IS_POST){
            if($lists){
                $data['status'] = 1;
                $data['content'] = $lists;
                $this->ajaxReturn($data,'json');
            }else{
                $this->error();
            }
            
        }else{
            $this->assign('lists',$lists);
            $this->display();
        }
    }
    public function sheet($page = 1){
        $pinzhong = I("get.pz");
        $guige = I("get.gg");
        $biaomian = I("get.jcbm");
        $changjia = I("get.jccj");
        $city = I("get.bccs");
        //搜索现货开始
        if($biaomian != '')$map['biaomian'] = $biaomian;
        if($caizhi != '')$map['caizhi'] = $caizhi;
        if($changjia != '')$map['changjia'] = array('like',$changjia.'%');
        
        //规格
        $guiges = explode('*',$guige);
        $guige_houdu = $guiges[0];
        $guige_kuan = $guiges[1];
        $guige_chang = $guiges[2];
        if($guige_houdu != '')$map['guige_houdu'] = array('like','%'.$guige_houdu.'%');
        if($guige_kuan != '')$map['guige_kuan'] = array('like','%'.$guige_kuan.'%');
        if($guige_chang != '')$map['guige_chang'] = array('like','%'.$guige_chang.'%');
   
    if($order){
            $order.=",create_time desc";
        }else{
            $order.="create_time desc";
        }
        //获取每页显示数量
        $page_nums = C('PAGE_NUM');
        
        $lists = D("xhJuancai")->where($map)->order($order)->page($p, 20)->select();
        $totalCount = D('xhJuancai')->where($map)->count();
        
        $this->assign('totalPageCount', $totalCount);
        $this->assign('page_num', $page_nums['钢管']);            
        
        $main_business = C('COMPANY_TYPE');
        $warehouse = C('WAREHOUSE');
        foreach($lists as &$val){
            $company = D("Company")->where('id = ' . $val['cid'])->find();
            $val['company'] = $company;
            $val['name'] = $company['name'];
            $val['qq'] = $company['qq'];
            $pattern = C('PATTERN');
            $val['business'] = $pattern[$company['pattern']];
            $val['com_address'] = $company['com_address'];

            //获取仓库
            $region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
            $val['ware_city'] = $region_name;
            
            $info = D("ucenter_member")->find($company['uid']);
            $val['mobile'] = $info['mobile'];

            $contact = D('contact')->where('cid = ' . $val['cid'])->find();
            $val['contact'] = $contact;

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
            $val['url'] = U('Company/detail',array('p'=>'sheet','id'=>$val['id']));
        }
        
        unset($val);
        if(IS_POST){
            if($lists){
                $data['status'] = 1;
                $data['content'] = $lists;
                $this->ajaxReturn($data,'json');
            }else{
                $this->error();
            }
            
        }else{
            $this->assign('lists',$lists);
            $this->display();
        }
    }
}























