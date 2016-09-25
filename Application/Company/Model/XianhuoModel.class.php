<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Company\Model;
use Think\Model;

/**
 * 公司商城现货模板
 */
class XianhuoModel{
    private $pagesize = 20;
    private $map = array();
    public function getXinahuo($type){
        if(empty($type)){
            return false;
        }

        $funstr = 'getXianhuo_'.$type;
        
        return $this->$funstr();
    }
    //钢管
    private function getXianhuo_1(){
        $lists = D('XhGangguan')->where($this->map)->page($page, $this->pagesize)->select();
        $info['lists'] = $this->doLists($lists);
        $info['count'] = D('XhGangguan')->where($this->map)->count();
        return $info;
    }
    //型材
    private function getXianhuo_2(){
        $lists = D('xhXingcai')->where($this->map)->page($page, $this->pagesize)->select();
        $info['lists'] = $this->doLists($lists);
        $info['count'] = D('xhXingcai')->where($this->map)->count();
        return $info;
    }
    //管件弯头
    private function getXianhuo_31(){
        $lists = D('xh_guanjian_wt')->where($this->map)->page($page, $this->pagesize)->select();
        $info['lists'] = $this->doLists($lists);
        $info['count'] = D('xh_guanjian_wt')->where($this->map)->count();
        return $info;
    }
    //管件三通
    private function getXianhuo_32(){
        $lists = D('xh_guanjian_sst')->where($this->map)->page($page, $this->pagesize)->select();
        $info['lists'] = $this->doLists($lists);
        $info['count'] = D('xh_guanjian_sst')->where($this->map)->count();
        return $info;
    }
    //翻遍
    private function getXianhuo_33(){
        $lists = D('xh_guanjian_ft')->where($this->map)->page($page, $this->pagesize)->select();
        $info['lists'] = $this->doLists($lists);
        $info['count'] = D('xh_guanjian_ft')->where($this->map)->count();
        return $info;
    }
    //法兰
    private function getXianhuo_4(){
        $lists = D('xh_falan')->where($this->map)->page($page, $this->pagesize)->select();
        $info['lists'] = $this->doLists($lists);
        $info['count'] = D('xh_falan')->where($this->map)->count();
        return $info;
    }
    //阀门
    private function getXianhuo_5(){
        $lists = D('xh_famen')->where($this->map)->page($page, $this->pagesize)->select();
        $info['lists'] = $this->doLists($lists);
        $info['count'] = D('xh_famen')->where($this->map)->count();
        return $info;
    }
    //板材
    private function getXianhuo_6(){
        $lists = D('xh_bancai')->where($this->map)->page($page, $this->pagesize)->select();
        $info['lists'] = $this->doLists($lists);
        $info['count'] = D('xh_bancai')->where($this->map)->count();
        return $info;
    }
    //板材
    private function getXianhuo_7(){
        $lists = D('xh_juancai')->where($this->map)->page($page, $this->pagesize)->select();
        $info['lists'] = $this->doLists($lists);
        $info['count'] = D('xh_juancai')->where($this->map)->count();
        return $info;
    }
    private function doLists($lists){
        foreach($lists as &$val){
            $company = D("Company")->where('id = ' . $val['cid'])->find();
            $val['company'] = $company;
            $val['name'] = $company['name'];
            $val['qq'] = $company['qq'];
            
            $val['com_address'] = $company['com_address'];
            
            //获取仓库
            $region_name = D('Region')->where('region_id = ' . $company['ware_city'])->getField('region_name');
            $val['ware_city'] = $region_name;

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
        return $lists;
    }

    public function getMap($arr){
        $this->map = $arr;
        return $this;
    }
}
