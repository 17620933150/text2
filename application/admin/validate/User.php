<?php 
namespace app\admin\validate;
use think\Validate;
class User extends Validate{
	//验证规则
	protected $rule = [
		//表单name名称 => 规则1|规则2
		'username' => 'require|unique:user',
		'password' => 'require|min:6|max:16',
		'repassword' => 'require|confirm:password'
	];
	//验证不通过的提示信息
	protected $message = [
		//表单name名称,规则名 => '规则提示信息'
		'username.require' => '用户名必填',
		'username.unique' => '用户名重复',
		'password.require' => '密码必填',
		'repassword.require' => '重复密码必填',
		'password.max' => '密码必须小于16位',
		'password.min' => '密码必须大于6位',
		'repassword.confirm' => '两次密码不一致'
	];
	//验证场景
	protected $scene = [
		//场景名 => [元素=>规则1|规则2]
		//场景名 => [元素] 验证元素的所有规则
		'add' => ['username','password','repassword'],
		'onlyUsername' => ['username'],
		'UsernamePassword' => ['username','password','repassword'],
		'login' => ['username'=>'require','password'],
	];
}




 ?>