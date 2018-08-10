<?php

namespace app\admin\model;

use think\Model;

class User extends Model
{
    //表的主键字段
    protected $pk = "user_id";
    //时间戳自动写入
    protected $autoWriteTimestamp = true;

    //事件的处理方法
    protected static function init() {
    	//入库前的时间before_insert
    	User::event('before_insert',function($user) {
    		$user['password'] = md5($user['password'].config('password_salt'));
    	});
    }

    //检出用户名和密码是否匹配
    public function checkUser($username,$password) {
    	$where = [
    		'username'=>$username,
    		'password'=>md5($password.config('password_salt')),
    	];
    	$userInfo = $this->where($where)->find();
    	if ($userInfo) {
    		//用户名和密码匹配,把用户信息写入到session中去
            session('user_id',$userInfo['user_id']);
            session('username',$userInfo['username']);
            //通过用户的角色role_id,把当前的权限写入到session中去
            $this->getAuthWriteSeesion($userInfo['role_id']);
            return true;
    	}else{
    		return false;
    	}
    }

    //把权限控制的控制器名和方法名写入到session中
    function getAuthWriteSeesion($role_id) {
        //获取角色表中的suth_ids_list字段的值
        $auth_ids_list = Role::where('role_id','=',$role_id)->value('auth_ids_list');
        //如果是超级管理员 $auth_ids_list== *
        if($auth_ids_list== '*' ) {
            //超级管理员拥有权限表所有数据
            $oldAuths = Auth::select()->toArray();
        }else{
            //如果是非超级管理员只能取出已有的权限 $auth_ids_list => 1,2,3,4
            $oldAuths = Auth::where("auth_id",'in',$auth_ids_list)->select()->toArray();
        }
        //两个技巧取出数据
        //1.每个数组的auth_id为二维数组的下标
        $auths = [];
        foreach($oldAuths as $v) {
            $auths[$v['auth_id']] = $v;
        }
        //通过pid进行分组
        $children = [];
        foreach($oldAuths as $vv) {
            $children[$vv['pid']][] = $vv['auth_id'];
        }
        //写入到session中去
        session('auths',$auths);
        session('children',$children);
        //写入管理员可访问的权限到session中去,用于后面的防翻墙
        if($auth_ids_list == '*') {
            //超级管理员
            session('visitorAuth','*');
        }else{
            //非超级管理员[auth/add,auth/index,....]
            $visitorAuth = [];
            foreach ($oldAuths as $v ) {
                $visitorAuth[] = strtolower($v['auth_c'].'/'.$v['auth_a']);
            }
            session('visitorAuth',$visitorAuth);
        }

    }
    


}
