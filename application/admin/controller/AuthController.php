<?php 
namespace app\admin\controller;
use app\admin\model\Auth;

class AuthController extends CommonController {

	//权限展示列表
	public function index() {
		//实例化auth模型, 取出数据,分配到模板,输出模板
		$auths = Auth::field('t1.*,t2.auth_name p_name')
		->alias('t1')
		->join("sh_auth t2",'t1.pid = t2.auth_id','left')
		->select();
		$authModel = new Auth();
		$auths = $authModel->getSonsAuth($auths);
		return $this->fetch('auth/index',['auths'=>$auths]);

	}
	//权限添加
	public function add() {
		 //1.判断post请求
        if (request()->isPost()) {
        	$userModel = new Auth();
        	//2.接收post参数
        	$postData = input('post.');
        	//3.验证其验证
        	//判断是否是顶级权限 顶级权限验证onlyAuthName
        	if ($postData['pid']==0) {
        		$result = $this->validate($postData,'Auth.onlyAuthName',[],true);
        	}else{
        		$result = $this->validate($postData,'Auth.add',[],true);
        	}
        	if ($result!==true) {
        		$this->error( implode(',', $result) );
        	}
        	//4.编辑update或添加入库save
        	//给密码Password字段进行加密(在模型时间里面操作)
        	if ($userModel->save($postData)) {
        		$this->success('入库成功',url('/auth/index'));
        	}else{
        		$this->error('入库失败');
        	}
        }
        //获取所有的权限分配到模板中
        $authModel = new Auth;
        // halt($authModel->select());
        $auths = $authModel->getSonsAuth( $authModel->select() );
        return $this->fetch('auth/add',['auths'=>$auths]);
        die;
	}

	public function upd() {
			//1.判断post请求
		if (request()->isPost()) {
        	$userModel = new Auth();
        	//2.接收post参数
        	$postData = input('post.');
        	//3.验证其验证
        	//判断是否是顶级权限 顶级权限验证onlyAuthName
        	if ($postData['pid']==0) {
        		$result = $this->validate($postData,'Auth.onlyAuthName',[],true);
        	}else{
        		$result = $this->validate($postData,'Auth.add',[],true);
        	}
        	if ($result!==true) {
        		$this->error( implode(',', $result) );
        	}
        	//4.编辑update或添加入库save
        	//给密码Password字段进行加密(在模型时间里面操作)
        	if ($userModel->update($postData)) {
        		$this->success('编辑成功',url('/auth/index'));
        	}else{
        		$this->error('编辑失败');
        	}
		}
		//获取当前权限的数据,分配到模板中,输出模板
        	$auth_id = input('auth_id');
        	$auth = Auth::find($auth_id);
        	//取出所有的无限级分类的权限
        	$authModel = new Auth();
        	$auths = $authModel->getSonsAuth( $authModel->select() );
        	return $this->fetch('auth/upd',[
        		'auth' => $auth,
        		'auths' => $auths
        	]);
	}

}


 ?>