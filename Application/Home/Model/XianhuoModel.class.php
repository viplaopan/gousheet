<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: laopan <laopan@vip.qq.com> <http://laopan.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Model;


/**
 * 文档基础模型
 */
class XianhuoModel{
	public function addXianhuo($objPHPExcel){
		$xls = $objPHPExcel->getsheet(0)->toArray();
		//添加钢管数据
		if (op_e($xls[0][0]) == '品种(下拉菜单选择)' && op_e($xls[0][1]) == '材质' && op_e($xls[0][2]) == '规格（外径*壁厚）' && op_e($xls[0][3]) == '支数' && op_e($xls[0][4]) == '重量（kg）' && op_e($xls[0][5]) == '备注(限15个字，可不填)') {
			return $this->addGangguan($xls);
		}
		//添加法兰
		if (op_e($xls[0][0]) == '品种(下拉菜单选择)' && op_e($xls[0][1]) == '材质' && op_e($xls[0][2]) == '规格（口径*压力）' && op_e($xls[0][3]) == '片数' && op_e($xls[0][4]) == '备注(限30个字符，可不填)') {			
			return $this->addFalan($xls);
		}
		//阀门
		if (op_e($xls[0][0]) == '品种(下拉菜单选择)' && op_e($xls[0][1]) == '材质' && op_e($xls[0][2]) == '规格（口径*压力）' && op_e($xls[0][3]) == '数量' && op_e($xls[0][4]) == '备注(限30个字符，可不填)') {
			return $this->addFamen($xls);
		}
		//型材
		if (op_e($xls[0][0]) == '品种(下拉菜单选择)' && op_e($xls[0][1]) == '材质' && op_e($xls[0][2]) == '规格' && op_e($xls[0][3]) == '重量（kg）' && op_e($xls[0][4]) == '备注(限30个字符，可不填)') {
			return $this->addXingcai($xls);
		}
		
		//板卷
		if (op_e($xls[0][0]) == '品种(下拉菜单选择)' && op_e($xls[0][1]) == '材质' && op_e($xls[0][2]) == '表面' && op_e($xls[0][3]) == '规格' && op_e($xls[0][4]) == '参厚' && op_e($xls[0][5]) == '等级' && op_e($xls[0][6]) == '件数' && op_e($xls[0][7]) == '总重（kg)' && op_e($xls[0][8]) == '生产厂家' && op_e($xls[0][9]) == '价格（元/吨）' && op_e($xls[0][10]) == '备注(限30个字符，可不填)') {
			$xls = $objPHPExcel->getsheet(0)->toArray();	
			$bancai =  $this->addBancai($xls);
			
			$xls = $objPHPExcel->getsheet(1)->toArray();	
			$juancai =  $this->addJuancai($xls);
			
			$xls = $objPHPExcel->getsheet(2)->toArray();	
			$daicai =  $this->addDaicai($xls);
			
			return array('category' => '板卷','bancai'=>$bancai,'juancai'=>$juancai,'daicai'=>$daicai);
		}
		//管件弯头
		if (op_e($xls[0][0]) == '品种(下拉菜单选择)' && op_e($xls[0][1]) == '工艺(下拉菜单选择)' && op_e($xls[0][2]) == 'R值' && op_e($xls[0][3]) == '表面(下拉菜单选择)' && op_e($xls[0][4]) == '材质' && op_e($xls[0][5]) == '规格' && op_e($xls[0][6]) == '数量（个）' && op_e($xls[0][7]) == '备注(限30个字符，可不填)') {
			$xls = $objPHPExcel->getsheet(0)->toArray();
			
			$wantou =  $this->addGuanjianwt($xls);
			
			$xls = $objPHPExcel->getsheet(1)->toArray();	
			$santong =  $this->addGuanjianst($xls);
			
			$xls = $objPHPExcel->getsheet(2)->toArray();	
			$fengtou =  $this->addGuanjianff($xls);
			
			return array('category' => '管件','wantou'=>$wantou,'santong'=>$santong,'fengtou'=>$fengtou);
		}
        
	}
	private function addGangguan($xls){
		array_shift($xls);
        $key = 0;
		$create_time = NOW_TIME;
		//判断用户的仓库区
        $company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
        $warehouse = $company['ware_city'] == 0 ? 1 : $company['ware_city'];
		
        foreach ($xls as $k => $val) {
            //获取EXCEL 字段
            $pinzhong = op_t($val[0]);
            $caizhi = op_t($val[1]);
            $guige = op_t($val[2]);
            $zhishu = op_t($val[3]);
            $zhongliang = op_t($val[4]);
            $beizhu = op_t($val[5]);
            //过滤掉空的数据
            if ($pinzhong == '' or $caizhi == '') {
                continue;
            }
            if (($zhishu == '' and $zhongliang == '') or ($zhishu == 0 and $zhongliang == 0) or ($zhishu == 0 and $zhongliang == '') or ($zhishu == '' and $zhongliang == 0)) {
                continue;
            }
            $data[$key]['cid'] = $cid;
            $data[$key]['warehouse'] = $warehouse;
            $data[$key]['pinzhong'] = $pinzhong ? $pinzhong : "";
            $data[$key]['caizhi'] = $caizhi ? $caizhi : "";
            $guigearr = explode('*', $guige);
            $data[$key]['guige'] = $guige ? $guige : "";
            $data[$key]['guige_zhijing'] = $guigearr[0];
            $data[$key]['guige_bihou'] = $guigearr[1] ? $guigearr[1] : "";
            $data[$key]['guige_changdu'] = $guigearr[2] ? $guigearr[2] : "";
            $data[$key]['zhishu'] = sprintf("%.2f", $zhishu ? $zhishu : "");
            $data[$key]['zhongliang'] = $zhongliang ? $zhongliang : "";
            $data[$key]['beizhu'] = $beizhu ? $beizhu : "";
            $data[$key]['create_time'] = $create_time;
            $data[$key]['status'] = 1;
            $key++;
        }

        //累加表格中重复的数据
        $ar = array();
        foreach ($data as $v2) {
            if (!$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']]) $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']] = $v2;
            else {
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']]['zhongliang']+= $v2['zhongliang'];
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']]['zhishu']+= $v2['zhishu'];
            }
        }
        $newdata = array_values($ar);
		
        if (D('xhGangguan')->addAll($newdata)) {
            //删除时间小于当前数据的数据
            D('xhGangguan')->where('create_time<' . $create_time . ' AND cid = ' . $cid)->delete();
            $arr = array(
                'category' => '钢管',
                'count' => count($newdata) ,
            );
            return $arr;
        }else{
        	$this->error('发布错误！');
        }
        exit;
	}

	//添加法兰
	private function addFalan($xls){
		$create_time = NOW_TIME;
		//判断用户的仓库区
        $company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
        $warehouse = $company['ware_city'] == 0 ? 1 : $company['ware_city'];
		array_shift($xls);
        $key = 0;
        foreach ($xls as $k => $val) {
            //获取EXCEL 字段
            $pinzhong = op_t($val[0]);
            $caizhi = op_t($val[1]);
            $guige = op_t($val[2]);
            $pianshu = op_t($val[3]);
            $beizhu = op_t($val[4]);
            //过滤掉空的数据
            if ($pinzhong == '' or $caizhi == '' or $guige == '') {
                continue;
            }
            //过滤掉空的数据
            if ($pianshu == '' or $pianshu == 0) {
                continue;
            }
            $data[$key]['cid'] = $cid;
            $data[$key]['warehouse'] = $warehouse;
            $data[$key]['pinzhong'] = $pinzhong ? $pinzhong : "";
            $data[$key]['caizhi'] = $caizhi ? $caizhi : "";
            $guigearr = explode('*', $guige);
            $data[$key]['guige'] = $guige ? $guige : "";
            $data[$key]['guige_koujing'] = $guigearr[0] ? $guigearr[0] : "";
            $data[$key]['guige_yali'] = $guigearr[1] ? $guigearr[1] : "";
            $data[$key]['pianshu'] = $pianshu ? $pianshu : "";
            $data[$key]['beizhu'] = $beizhu ? $beizhu : "";
            $data[$key]['create_time'] = $create_time;
            $data[$key]['status'] = 1;
            $key++;
        }
        //累加表格中重复的数据
        $ar = array();
        foreach ($data as $v2) {
            if (!$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']]) $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']] = $v2;
            else {
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']]['pianshu']+= $v2['pianshu'];
            }
        }
        $newdata = array_values($ar);
        if (D('xhFalan')->addAll($newdata)) {
            //删除时间小于当前数据的数据
            D('xhFalan')->where('create_time<' . $create_time . ' AND cid = ' . $cid)->delete();
            $arr = array(
                'category' => '法兰',
                'count' => count($newdata) ,
            );
            return $arr;
        }else{
        	$this->error('发布错误！');
        }
	}

	//添加法兰
	private function addFamen($xls){
		$create_time = NOW_TIME;
		//判断用户的仓库区
        $company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
        $warehouse = $company['ware_city'] == 0 ? 1 : $company['ware_city'];
		array_shift($xls);
        $key = 0;
        foreach ($xls as $k => $val) {
            //获取EXCEL 字段
            $pinzhong = op_t($val[0]);
            $caizhi = op_t($val[1]);
            $guige = op_t($val[2]);
            $shuliang = op_t($val[3]);
            $beizhu = op_t($val[4]);
            //过滤掉空的数据
            if ($pinzhong == '' or $caizhi == '' or $guige == '') {
                continue;
            }
            //过滤掉空的数据
            if ($shuliang == '' or $shuliang == 0) {
                continue;
            }
            $data[$key]['cid'] = $cid;
            $data[$key]['warehouse'] = $warehouse;
            $data[$key]['pinzhong'] = $pinzhong ? $pinzhong : '';
            $data[$key]['caizhi'] = $caizhi ? $caizhi : '';
            $data[$key]['guige'] = $guige ? $guige : '';
            $guigearr = explode('*', $guige);
            $data[$key]['guige_koujing'] = $guigearr[0] ? $guigearr[0] : '';
            $data[$key]['guige_yali'] = $guigearr[1] ? $guigearr[1] : '';
            $data[$key]['shuliang'] = $shuliang ? $shuliang : '';
            $data[$key]['beizhu'] = $beizhu ? $beizhu : '';
            $data[$key]['create_time'] = $create_time;
            $data[$key]['status'] = 1;
            $key++;
        }
        //累加表格中重复的数据
        $ar = array();
        foreach ($data as $v2) {
            if (!$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']]) $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']] = $v2;
            else {
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']]['shuliang']+= $v2['shuliang'];
            }
        }
        $newdata = array_values($ar);

        if (D('xhFamen')->addAll($newdata)) {
            //删除时间小于当前数据的数据
            D('xhFamen')->where('create_time<' . $create_time . ' AND cid = ' . $cid)->delete();
            $arr = array(
                'category' => '阀门',
                'count' => count($newdata) ,
            );
            return $arr;
        }else{
        	$this->error('发布错误！');
        }
        exit;
	}
	//添加法兰
	private function addXingcai($xls){
		$create_time = NOW_TIME;
		//判断用户的仓库区
        $company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
        $warehouse = $company['ware_city'] == 0 ? 1 : $company['ware_city'];
		array_shift($xls);
        $key = 0;
        foreach ($xls as $k => $val) {
            //获取EXCEL 字段
            $pinzhong = op_t($val[0]);
            $caizhi = op_t($val[1]);
            $guige = op_t($val[2]);
            $zhongliang = op_t($val[3]);
            $beizhu = op_t($val[4]);
            //过滤掉空的数据
            if ($pinzhong == '' or $caizhi == '' or $guige == '') {
                continue;
            }
            //过滤掉空的数据
            if ($zhongliang == '' or $zhongliang == 0) {
                continue;
            }
            $data[$key]['cid'] = $cid;
            $data[$key]['warehouse'] = $warehouse;
            $data[$key]['pinzhong'] = $pinzhong ? $pinzhong : '';
            $data[$key]['caizhi'] = $caizhi ? $caizhi : '';
            $data[$key]['guige'] = $guige ? $guige : '';
            $data[$key]['zhongliang'] = $zhongliang ? $zhongliang : '';
            $data[$key]['beizhu'] = $beizhu ? $beizhu : '';
            $data[$key]['create_time'] = $create_time;
            $data[$key]['status'] = 1;
            $key++;
        }
        //累加表格中重复的数据
        $ar = array();
        foreach ($data as $v2) {
            if (!$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']]) $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']] = $v2;
            else {
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige']]['pianshu']+= $v2['pianshu'];
            }
        }
        $newdata = array_values($ar);
        if (D('xhXingcai')->addAll($newdata)) {
            //删除时间小于当前数据的数据
            D('xhXingcai')->where('create_time<' . $create_time . ' AND cid = ' . $cid)->delete();
            $arr = array(
                'category' => '型材',
                'count' => count($newdata) ,
                'path' => $pic_path,
			    'info' => ''
            );
            return $arr;
        }else{
        	$this->error('发布错误！');
        }
	}
	//添加板卷-板材
	public function addBancai($xls){
		$create_time = NOW_TIME;
		//判断用户的仓库区
        $company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
        $warehouse = $company['ware_city'] == 0 ? 1 : $company['ware_city'];
		array_shift($xls);
        $key = 0;
        foreach ($xls as $k => $val) {
            //获取EXCEL 字段
            $pinzhong = op_t($val[0]);
            $caizhi = op_t($val[1]);
            $biaomian = op_t($val[2]);
            $guige = op_t($val[3]);
            $canhou = op_t($val[4]);
            $dengji = op_t($val[5]);
            $jianshu = op_t($val[6]);
            $zhongliang = op_t($val[7]);
            $changjia = op_t($val[8]);
            $jiage = op_t($val[9]);
            $beizhu = op_t($val[10]);
			
            //过滤掉空的数据
            if ($pinzhong == '' or $caizhi == '' or $guige == '' or $biaomian == '') {
                continue;
            }
            //过滤掉空的数据
            if (($jianshu == '' or $jianshu == 0) and ($zhongliang == '' or $zhongliang == 0)) {
                continue;
            }
            $data[$key]['cid'] = $cid;
            $data[$key]['warehouse'] = $warehouse;
            $data[$key]['pinzhong'] = $pinzhong ? $pinzhong : '';
            $data[$key]['caizhi'] = $caizhi ? $caizhi : '';
            $data[$key]['biaomian'] = $biaomian ? $biaomian : '';
            $data[$key]['guige'] = $guige ? $guige : '';
            $guigearr = explode('*', $guige);
            $data[$key]['guige_houdu'] = $guigearr[0] ? $guigearr[0] : '';
            $data[$key]['guige_kuan'] = $guigearr[1] ? $guigearr[1] : '';
            $data[$key]['guige_chang'] = $guigearr[2] ? $guigearr[2] : '';
            $data[$key]['canhou'] = $canhou ? $canhou : '';
            $data[$key]['dengji'] = $dengji ? $dengji : '';
            $data[$key]['jianshu'] = $jianshu ? $jianshu : '';
            $data[$key]['zhongliang'] = $zhongliang ? $zhongliang : '';
            $data[$key]['changjia'] = $changjia ? $changjia : '';						
            $data[$key]['jiage'] = $jiage ? $jiage : '';
            $data[$key]['beizhu'] = $beizhu ? $beizhu : '';
            $data[$key]['create_time'] = $create_time;
            $data[$key]['status'] = 1;
            $key++;
        }
        //累加表格中重复的数据
        $ar = array();
        foreach ($data as $v2) {
            if (!$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']]) $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']] = $v2;
            else {
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']]['jianshu']+= $v2['jianshu'];
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']]['zhongliang']+= $v2['zhongliang'];
            }
        }
        $newdata = array_values($ar);
        if (D('xhBancai')->addAll($newdata)) {
            //删除时间小于当前数据的数据
            D('xhBancai')->where('create_time<' . $create_time . ' AND cid = ' . $cid)->delete();
			$arr = array(
                'category' => '板材',
                'count' => count($newdata) ,
            );
			return $arr;
        }else{
        	$arr = array(
                'category' => '板材',
                'count' => 0 ,
            );
			return $arr;
        }
    }
	//添加板卷-卷材
	public function addJuancai($xls){
		$create_time = NOW_TIME;
		//判断用户的仓库区
        $company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
        $warehouse = $company['ware_city'] == 0 ? 1 : $company['ware_city'];
		array_shift($xls);
        $key = 0;
		$data = array();
        foreach ($xls as $k => $val) {
            //获取EXCEL 字段
            $pinzhong = op_t($val[0]);
            $caizhi = op_t($val[1]);
            $biaomian = op_t($val[2]);
            $guige = op_t($val[3]);
            $canhou = op_t($val[4]);
            $bianbu = op_t($val[5]);
            $dengji = op_t($val[6]);
            $shuliang = op_t($val[7]);
            $zhongliang = op_t($val[8]);
            $changjia = op_t($val[9]);
            $jiage = op_t($val[10]);
            $beizhu = op_t($val[11]);
			
            //过滤掉空的数据
            if ($pinzhong == '' or $caizhi == '' or $guige == '' or $biaomian == '') {
                continue;
            }
            //过滤掉空的数据
            if (($shuliang == '' or $shuliang == 0) and ($zhongliang == '' or $zhongliang == 0)) {
                continue;
            }
            $data[$key]['cid'] = $cid;
            $data[$key]['warehouse'] = $warehouse;
            $data[$key]['pinzhong'] = $pinzhong ? $pinzhong : '';
            $data[$key]['caizhi'] = $caizhi ? $caizhi : '';
            $data[$key]['biaomian'] = $biaomian ? $biaomian : '';
            $data[$key]['guige'] = $guige ? $guige : '';
            $guigearr = explode('*', $guige);
            $data[$key]['guige_houdu'] = $guigearr[0] ? $guigearr[0] : '';
            $data[$key]['guige_kuan'] = $guigearr[1] ? $guigearr[1] : '';
            $data[$key]['guige_chang'] = $guigearr[2] ? $guigearr[2] : '';
            $data[$key]['canhou'] = $canhou ? $canhou : '';
            $data[$key]['bianbu'] = $bianbu ? $bianbu : '';
            $data[$key]['dengji'] = $dengji ? $dengji : '';
            $data[$key]['shuliang'] = $shuliang ? $shuliang : '';
            $data[$key]['zhongliang'] = $zhongliang ? $zhongliang : '';
            $data[$key]['changjia'] = $changjia ? $changjia : '';						
            $data[$key]['jiage'] = $jiage ? $jiage : '';
            $data[$key]['beizhu'] = $beizhu ? $beizhu : '';
            $data[$key]['create_time'] = $create_time;
            $data[$key]['status'] = 1;
            $key++;
		}
        //累加表格中重复的数据
        $ar = array();
        foreach ($data as $v2) {
            if (!$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou']. '_' . $v2['bianbu'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']]) $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou']. '_' . $v2['bianbu'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']] = $v2;
            else {
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou']. '_' . $v2['bianbu'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']]['shuliang']+= $v2['shuliang'];
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou']. '_' . $v2['bianbu'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']]['zhongliang']+= $v2['zhongliang'];
            }
        }
		$newdata = array_values($ar);
		if (D('xhJuancai')->addAll($newdata)) {
			//删除时间小于当前数据的数据
			D('xhJuancai')->where('create_time<' . $create_time . ' AND cid = ' . $cid)->delete();
			$arr = array(
                'category' => '卷材',
                'count' => count($newdata) ,
            );
			return $arr;
		}else{
			$arr = array(
                'category' => '卷材',
                'count' => 0 ,
            );
			return $arr;
		}
    }
	//添加板卷-带材
	private function addDaicai($xls){
		$create_time = NOW_TIME;
		//判断用户的仓库区
        $company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
        $warehouse = $company['ware_city'] == 0 ? 1 : $company['ware_city'];
		array_shift($xls);
        $key = 0;
		$data = array();
        foreach ($xls as $k => $val) {
            //获取EXCEL 字段
            $pinzhong = op_t($val[0]);
            $caizhi = op_t($val[1]);
            $biaomian = op_t($val[2]);
            $guige = op_t($val[3]);
            $canhou = op_t($val[4]);
            $dengji = op_t($val[5]);
            $shuliang = op_t($val[6]);
            $zhongliang = op_t($val[7]);
            $changjia = op_t($val[8]);
            $jiage = op_t($val[9]);
            $beizhu = op_t($val[10]);
			
            //过滤掉空的数据
            if ($pinzhong == '' or $caizhi == '' or $guige == '' or $biaomian == '') {
                continue;
            }
            //过滤掉空的数据
            if (($shuliang == '' or $shuliang == 0) and ($zhongliang == '' or $zhongliang == 0)) {
                continue;
            }
            $data[$key]['cid'] = $cid;
            $data[$key]['warehouse'] = $warehouse;
            $data[$key]['pinzhong'] = $pinzhong ? $pinzhong : '';
            $data[$key]['caizhi'] = $caizhi ? $caizhi : '';
            $data[$key]['biaomian'] = $biaomian ? $biaomian : '';
            $data[$key]['guige'] = $guige ? $guige : '';
            $guigearr = explode('*', $guige);
            $data[$key]['guige_houdu'] = $guigearr[0] ? $guigearr[0] : '';
            $data[$key]['guige_kuan'] = $guigearr[1] ? $guigearr[1] : '';
            $data[$key]['guige_chang'] = $guigearr[2] ? $guigearr[2] : '';
            $data[$key]['canhou'] = $canhou ? $canhou : '';
            $data[$key]['dengji'] = $dengji ? $dengji : '';
            $data[$key]['shuliang'] = $shuliang ? $shuliang : '';
            $data[$key]['zhongliang'] = $zhongliang ? $zhongliang : '';
            $data[$key]['changjia'] = $changjia ? $changjia : '';						
            $data[$key]['jiage'] = $jiage ? $jiage : '';
            $data[$key]['beizhu'] = $beizhu ? $beizhu : '';
            $data[$key]['create_time'] = $create_time;
            $data[$key]['status'] = 1;
            $key++;
		}
        //累加表格中重复的数据
        $ar = array();
        foreach ($data as $v2) {
            if (!$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']]) $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']] = $v2;
            else {
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']]['shuliang']+= $v2['shuliang'];
                $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['canhou'] . '_' . $v2['dengji'] . '_' . $v2['changjia'] . '_' . $v2['jiage']. '_' . $v2['beizhu']]['zhongliang']+= $v2['zhongliang'];
            }
        }
		$newdata = array_values($ar);
		if (D('xhDaicai')->addAll($newdata)) {
			//删除时间小于当前数据的数据
			D('xhDaicai')->where('create_time<' . $create_time . ' AND cid = ' . $cid)->delete();
			$arr = array(
                'category' => '带材',
                'count' => count($newdata) ,
            );
			return $arr;
		}else{
			$arr = array(
                'category' => '带材',
                'count' => 0 ,
            );
			return $arr;
		}

	}

	private function addGuanjianwt($xls){
		$create_time = NOW_TIME;
		//判断用户的仓库区
        $company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
        $warehouse = $company['ware_city'] == 0 ? 1 : $company['ware_city'];
		array_shift($xls);
        $key = 0;
		$data = array();
	    foreach ($xls as $k => $val) {
	        //获取EXCEL 字段
	        $pinzhong = op_t($val[0]);
	        $gongyi = op_t($val[1]);
	        $rzhi = op_t($val[2]);
	        $biaomian = op_t($val[3]);
	        $caizhi = op_t($val[4]);
	        $guige = op_t($val[5]);
	        $shuliang = op_t($val[6]);
	        $beizhu = op_t($val[7]);
	        //过滤掉空的数据
	        if ($pinzhong == '' or $caizhi == '' or $guige == '') {
	            continue;
	        }
	        //过滤掉空的数据
	        if ($shuliang == '' or $shuliang == 0) {
	            continue;
	        }
	       
	            $data[$key]['cid'] = $cid;
	            $data[$key]['warehouse'] = $warehouse;
	            $data[$key]['pinzhong'] = $pinzhong ? $pinzhong : '';
	            $data[$key]['gongyi'] = $gongyi ? $gongyi : '';
	            $data[$key]['biaomian'] = $biaomian ? $biaomian : '';
	            $data[$key]['caizhi'] = $caizhi ? $caizhi : '';
	            $data[$key]['rzhi'] = $rzhi ? $rzhi : '';
	            $guigearr = explode('*', $guige);
	            $data[$key]['guige'] = $guige ? $guige : '';
	            $data[$key]['guige_waijing'] = $guigearr[0] ? $guigearr[0] : '';
	            $data[$key]['guige_bihou'] = $guigearr[1] ? $guigearr[1] : '';
	            $data[$key]['shuliang'] = $shuliang ? $shuliang : '';
	            $data[$key]['beizhu'] = $beizhu ? $beizhu : '';
	            $data[$key]['create_time'] = $create_time;
	            $data[$key]['status'] = 1;
	            $key++;
	    }
	    //累加表格中重复的数据
	    $ar = array();
	    foreach ($data as $v2) {
	        if (!$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['rzhi'] . '_' . $v2['gongyi']]) $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['rzhi'] . '_' . $v2['gongyi']] = $v2;
	        else {
	            $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian'] . '_' . $v2['rzhi'] . '_' . $v2['gongyi']]['shuliang']+= $v2['shuliang'];
	        }
	    }
	    $newdata = array_values($ar);
	    if (D('xhGuanjianWt')->addAll($newdata)) {
	        //删除时间小于当前数据的数据
	        D('xhGuanjianWt')->where('create_time<' . $create_time . ' AND cid = ' . $cid)->delete();
			$arr = array(
		        'category' => '弯头',
		        'count' => count($newdata) ,
		    );
			return $arr;
			
	    }else{
	    	$arr = array(
		        'category' => '弯头',
		        'count' => 0 ,
		    );
			return $arr;
	    }
	}

	private function addGuanjianst($xls){
		$create_time = NOW_TIME;
		//判断用户的仓库区
        $company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
        $warehouse = $company['ware_city'] == 0 ? 1 : $company['ware_city'];
		array_shift($xls);
        $key = 0;
		$data = array();
        foreach ($xlsst as $k => $val) {
			//获取EXCEL 字段
			$pinzhong = op_t($val[0]);
			$gongyi = op_t($val[1]);
			$biaomian = op_t($val[2]);
			$caizhi = op_t($val[3]);
			$guige = op_t($val[4]);
			$shuliang = op_t($val[5]);
			$beizhu = op_t($val[6]);
			//过滤掉空的数据
			if ($pinzhong == '' or $caizhi == '' or $guige == '') {
				continue;
			}
			//过滤掉空的数据
			if ($shuliang == '' or $shuliang == 0) {
				continue;
			}
			$data[$key]['cid'] = $cid;
			$data[$key]['warehouse'] = $warehouse;
			$data[$key]['pinzhong'] = $pinzhong ? $pinzhong : '';
			$data[$key]['gongyi'] = $gongyi ? $gongyi : '';
			$data[$key]['biaomian'] = $biaomian ? $biaomian : '';
			$data[$key]['caizhi'] = $caizhi ? $caizhi : '';
			$guigearr = explode('*', $guige);
			$data[$key]['guige'] = $guige ? $guige : '';
			$data[$key]['guige_waijing'] = $guigearr[0] ? $guigearr[0] : '';
			$data[$key]['guige_bihou'] = $guigearr[1] ? $guigearr[1] : '';
			$data[$key]['shuliang'] = $shuliang ? $shuliang : '';
			$data[$key]['beizhu'] = $beizhu ? $beizhu : '';
			$data[$key]['create_time'] = $create_time;
			$data[$key]['status'] = 1;
			$key++;
		}
		//累加表格中重复的数据
		$ar = array();
		foreach ($data as $v2) {
			if (!$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['gongyi'] . '_' . $v2['biaomian']]) $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['gongyi'] . '_' . $v2['biaomian']] = $v2;
			else {
				$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['gongyi'] . '_' . $v2['biaomian']]['shuliang']+= $v2['shuliang'];
			}
		}
		$newdata = array_values($ar);
		if (D('xhGuanjianSst')->addAll($newdata)) {
			//删除时间小于当前数据的数据
			D('xhGuanjianSst')->where('create_time<' . $create_time . ' AND cid = ' . $cid)->delete();
			$arr = array(
		        'category' => '三通',
		        'count' => count($newdata) ,
		    );
			return $arr;
		}else{
			$arr = array(
		        'category' => '三通',
		        'count' => 0 ,
		    );
			return $arr;
		}
	}

	private function addGuanjianff($xls){
		$create_time = NOW_TIME;
		//判断用户的仓库区
        $company = D('Company')->where('uid = ' . UID)->find();
        $cid = $company['id'];
        $warehouse = $company['ware_city'] == 0 ? 1 : $company['ware_city'];
		array_shift($xls);
        $key = 0;
		$data = array();
        foreach ($xlsfb as $k => $val) {
			//获取EXCEL 字段
			$pinzhong = op_t($val[0]);
			$biaomian = op_t($val[1]);
			$caizhi = op_t($val[2]);
			$guige = op_t($val[3]);
			$shuliang = op_t($val[4]);
			$beizhu = op_t($val[5]);
			//过滤掉空的数据
			if ($pinzhong == '' or $caizhi == '' or $guige == '') {
				continue;
			}
			//过滤掉空的数据
			if ($shuliang == '' or $shuliang == 0) {
				continue;
			}

			$data[$key]['cid'] = $cid;
			$data[$key]['warehouse'] = $warehouse;
			$data[$key]['pinzhong'] = $pinzhong ? $pinzhong : '';
			$data[$key]['biaomian'] = $biaomian ? $biaomian : '';
			$data[$key]['caizhi'] = $caizhi ? $caizhi : '';
			$guigearr = explode('*', $guige);
			$data[$key]['guige'] = $guige ? $guige : '';
			$data[$key]['shuliang'] = $shuliang ? $shuliang : '';
			$data[$key]['beizhu'] = $beizhu ? $beizhu : '';
			$data[$key]['create_time'] = $create_time;
			$data[$key]['status'] = 1;
			$key++;
		}
		//累加表格中重复的数据
		$ar = array();
		foreach ($data as $v2) {
			if (!$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian']]) $ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian']] = $v2;
			else {
				$ar[$v2['pinzhong'] . '_' . $v2['caizhi'] . '_' . $v2['guige'] . '_' . $v2['biaomian']]['shuliang']+= $v2['shuliang'];
			}
		}
		$newdata = array_values($ar);
		if (D('xhGuanjianFt')->addAll($newdata)) {
			//删除时间小于当前数据的数据
			D('xhGuanjianFt')->where('create_time<' . $create_time . ' AND cid = ' . $cid)->delete();
			$info .= '<em>'.count($newdata)."</em>条封头数据";
			$arr = array(
		        'category' => '封头',
		        'count' => count($newdata) ,
		    );
			return $arr;
		}else{
			$arr = array(
		        'category' => '封头',
		        'count' => 0 ,
		    );
			return $arr;
		}
		
	}
}
