<?php

namespace app\admin\controller;

use think\Request;
use app\admin\model\Type;

class TypeController extends CommonController
{

    public function index()
    {
        $types = Type::select();
        return $this->fetch('type/index', ['types' => $types]);
    }

    public function add()
    {
        //1.判断post请求
        if (request()->isPost()) {
            $userModel = new Type();
            //2.接收post参数
            $postData = input('post.');
            var_dump($postData);
            //3.验证其验证
            $result = $this->validate($postData, 'Type.add', [], true);
            if ($result !== true) {
                $this->error(implode(',', $result));
            }
            //4.编辑update或添加入库save
            //给密码Password字段进行加密(在模型时间里面操作)
            if ($userModel->allowfield(true)->save($postData)) {
                $this->success('添加成功', url('/type/index'));
            } else {
                $this->error('添加失败');
            }
        }
        return $this->fetch('type/add');
        die;
    }
        //类型编辑
    public function upd()
    {
        //1.判断post请求
        if (request()->isPost()) {
            $userModel = new Type();
            //2.接收post参数
            $postData = input('post.');
            var_dump($postData);
            //3.验证其验证
            $result = $this->validate($postData, 'Type.upd', [], true);
            if ($result !== true) {
                $this->error(implode(',', $result));
            }
            //4.编辑update或添加入库save
            //给密码Password字段进行加密(在模型时间里面操作)
            if ($userModel->update($postData)) {
                $this->success('编辑成功', url('/type/index'));
            } else {
                $this->error('编辑失败');
            }
        }
        $type_id = input('typd_id');
        $type = Type::find($type_id);
        return $this->fetch('type/upd',['type'=>$type]);
        die;
    }
    //商品类型的删除
    public function del() {
        $type_id = input('type_id');
        if (Type::destroy($type_id)) {
            $this->success("删除成功",url("/type/index"));
        }else{
            $this->error('删除失败');
        }
    }

}


