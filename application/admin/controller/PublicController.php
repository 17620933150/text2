<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
class PublicController extends Controller {
	//用户登录
	public function login() {
		//1.判断post请求
        if (request()->isPost()) {
        	$userModel = new User();
        	//2.接收post参数
        	$postData = input('post.');
        	//3.验证其验证
        	$result = $this->validate($postData,'User.login',[],true);
        	if ($result!==true) {
        		$this->error( implode(',', $result) );
        	}
        	//4.编辑update或添加入库save
        	//给密码Password字段进行加密(在模型时间里面操作)
        	if ($userModel->checkUser($postData['username'],$postData['password'])) {
        		//登录成功,到后台首页去
        		$this->redirect('/admin');
        	}else{
        		$this->error('用户名或密码失败');
        	}
        }
        return $this->fetch('/public/login');
        die;
	}
	//用户退出
	public function logout() {
		//清除登录成功保存的session信息
		session('user_id',null);
		session('username',null);
		//重定向到登录页
		$this->redirect('/public/login');
                
	}


}




 ?>