<?php

namespace app\admin\controller;
use think\Request;
use app\admin\model\Role;
use app\admin\model\User;

class UserController extends CommonController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //1.获取数据
        $users = User::alias('t1')
            ->field('t1.*,t2.role_name')
            ->join("sh_role t2",'t1.role_id = t2.role_id','left')
            ->paginate(2);
        //2.输出模板
        return $this->fetch('user/index',['users'=>$users]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        //1.判断post请求
        if (request()->isPost()) {
        	$userModel = new User();
        	//2.接收post参数
        	$postData = input('post.');
        	var_dump($postData);
        	//3.验证其验证
        	$result = $this->validate($postData,'User.add',[],true);
        	if ($result!==true) {
        		$this->error( implode(',', $result) );
        	}
        	//4.编辑update或添加入库save
        	//给密码Password字段进行加密(在模型时间里面操作)
        	if ($userModel->allowfield(true)->save($postData)) {
        		$this->success('入库成功',url('/admin/user/index'));
        	}else{
        		$this->error('入库失败');
        	}
        }
        //取出所有的角色数据,分配到模板中
        $reles = Role::select();
        return $this->fetch('user/add',['roles'=>$reles]);
        die;
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function upd()
    {
        //1.判断是否是post请求
        if (request()->isPost()) {
        	$userModel = new User();
        	//2.接收post参数
        	$postData = input('post.');
        	//3.验证器进行验证
        	//当前密码和确认密码都为空的时候,只验证username,保留密码
        	if ($postData['password'] == '' && $postData['repassword'] == '') {
        		$result = $this->validate($postData,'User.onlyUsername',[],true);
        		if ($result!==true) {
        			$this->error(implode(',',$result));
        		}
        	}else{
        		//说明其中有一个密码是不为空,则进行UsernamePassword场景的验证
        		$result = $this->validate($postData,'User.UsernamePassword',[],true);
        		if ($result!==true) {
        			$this->error(implode(',',$result));
        	}
        }
	        //4.判断编辑是否成功
	        if ($userModel->allowfield(true)->isUpdate(true)->save($postData)) {
	        	$this->success('编辑成功',url('/user/index'));
	        }else{
	        	$this->error('编辑失败');
	        }
    	}

    	//获取数据,回显到模板中
    		$user_id = input('user_id');
    		$userData = User::find($user_id);
    		return $this->fetch('user/upd',['userData'=>$userData]);
    }




    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        //1.接收参数
        $user_id = input('user_id');
        //2.判断删除是否成功
        if (User::destroy($user_id)) {
        	$this->success('删除成功',url('/user/index'));
        }else{
        	$this->error('删除成功');
        }
    }
}
