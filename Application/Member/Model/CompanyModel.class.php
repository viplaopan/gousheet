<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Member\Model;
use Think\Model;

/**
 * 分类模型
 */
class CompanyModel extends Model{

     protected $_auto = array(
        array('uid', 'is_login', self::MODEL_INSERT, 'function', 1),
    
    );

}
