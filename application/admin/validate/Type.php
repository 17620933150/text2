<?php 
namespace app\admin\validate;
use think\Validate;
class Type extends Validate{
	//验证规则
	protected $rule = [
		//表单name名称 => 规则1|规则2
		'type_name' => 'require|unique:type',
	];
	//验证不通过的提示信息
	protected $message = [
		//表单name名称,规则名 => '规则提示信息'
		'type_name.require' => '商品类型名必填',
		'type_name.unique' => '商品类型名重复',
	];
	//验证场景
	protected $scene = [
		//场景名 => [元素=>规则1|规则2]
		//场景名 => [元素] 验证元素的所有规则
		'add' => ['auth_name'],
        'upd' => ['auth_name'],
	];
}




 ?>