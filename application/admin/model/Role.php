<?php

namespace app\admin\model;

use think\Model;


class Role extends Model
{
    protected $pk = 'role_id';
    //时间戳自动写入
    protected $autoWriteTimestamp = true;

    protected static function init() {
       //入库前的事件
       Role::event('before_insert',function($role){
            //把权限数组形成变为字符串进行入库
            //防止没有分配权没有auth_ids_list属性导致报错,所以isset判断下
            if(isset($role['auth_ids_list'])) {
                $role['auth_ids_list'] = implode(',', $role['auth_ids_list']);
            }
       });
    }
    
}

