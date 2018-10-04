<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/9/13
 * Time: 15:22
 */

namespace app\admin\controller;


use think\Controller;
use think\Validate;

class Manager extends Common
{
    // 管理员列表
    public function index(){
        $res = db('manager')->paginate(1); // 查询整个数据库内符合条件的所有数据
        $this->assign('manager',$res);
        return view('list');
    }
    // 管理员添加
    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            $validate = Validate('Manager');  // 定义验证器
            if (!$validate->scene('add')->check($data)){
                $this->error($validate->getError(),'add','','1');
                return;
            }
            unset($data['rePassword']); // 确认密码不用写入数据库，用unset()函数将其销毁
            $data['password'] = md5($data['password']); // md5加密
            if (db('manager')->insert($data)){
                $this->success("管理员添加成功",'index','','1');
            }else{
                $this->error('数据添加异常','index','','1');
            }
            return;
        }
        return view();
    }
    // 管理员编辑
    public function edit($id){
        if (request()->isPost()){
            $data = input('post.');
            if (isset($data['userName'])){
                unset($data['userName']);
            }
            if ($id == 1 && $data['state'] == 0){
                $this->error('超级管理员不允许锁定','index','','1');
            }
            $str_id = "";
            $str_id = $str_id.session('loginID','','admin');

            $managerPWD = db('manager')->where('id',$str_id)->field('password')->find();
            if ($str_id != 1 && md5($data['password']) != $managerPWD['password']){
                $this->error('非超级管理员请输入正确密码','index','','2');
            }
//            $data['state'] = $data['state']*1;
//            dump($result);die;
            if (!db('manager')->where('id',$id)->update($data)){
                $this->error('管理员修改失败!!!','index','','1');
            }
            $this->success('操作成功!!!','index','','1');
            return;
        }
        $res = db('manager')->where('id',$id)->field('userName,state')->find();
//        dump($res);die;
        $this->assign('manager',$res);
        return view();
    }
    // 管理员删除
    public function del($id){
        if ($id == 1){
            $this->error('超级管理员不允许删除!!!','manager/index');
        }
        $res = db('manager')->where('id',$id)->delete();
        if ($res){
            $this->success('删除管理员成功!!!','manager/index','','2');
        }else{
            $this->error('删除失败!!!','manager/index','','2');
        }
    }

    // 修改管理员密码
    public function reset(){
        if (request()->isPost()){
            $data = input('post.');
            $str_id = "";
            $str_id = $str_id.session('loginID','','admin');
            $oldPassword = db('manager')->where('id',$str_id)->field('password')->find();
            if (md5($data['oldPassword']) != $oldPassword['password']){
                $this->error('管理员密码不正确!!!','','','2');
            }
            unset($data['oldPassword']);
            $validate = Validate('manager');
            if (!$validate->scene('edit')->check($data)){
                $this->error($validate->getError(),'','','2');
            }
            unset($data['rePassword']);
            $result = db('manager')->where('id',$str_id)->update($data);
            if (!$result){
                $this->error('操作异常','','','2');
            }
            $this->success('密码修改成功!','index/index','','2');
            return;
        }
        $id = session('loginID','','admin');
        $res = db('manager')->where('id',$id)->field('userName')->find();
        $this->assign('manager',$res);
        return view();
    }
}