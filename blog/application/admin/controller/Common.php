<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/9/13
 * Time: 15:32
 */

namespace app\admin\controller;


use think\Controller;

class Common extends Controller
{
    protected function _initialize(){
        parent::_initialize();  // 继承父类的初始化方法
        session_start();
        if (!session('loginName','','admin') || !session('loginID','','admin')){
            $validate = request()->controller();  // 获取当前控制器
            $action = request()->action();  // 获取当前方法
            if($validate === 'Index' && $action === 'index'){
                $this->redirect('login/index');
            }
            $this->error('未登录，不允许访问！','login/index');
        }
        $manager = session('loginName','','admin');
        $this->assign('manager',$manager);
    }

    // 图片上传
    public function uploadpic(){
        $file = request()->file('picfile');
        if ($file){
            $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
            $imgPath = "uploads\\".$info->getSaveName(); // 获取图片地址
            return json(['code'=>1,'msg'=>"上传成功!",'imgPath'=>$imgPath]);
        }else{
            return json(['code'=>0,'msg'=>$file->getError()]);
        }
    }
    // 删除栏目图片
//    public function delimg($url=""){
//
//    }
}