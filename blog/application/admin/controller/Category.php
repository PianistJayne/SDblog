<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/9/22
 * Time: 13:11
 */

namespace app\admin\controller;


class Category extends Common
{
    public function index(){
        $cate = db('cate')->paginate(1);
        $this->assign('cate',$cate);
        return view();
    }

    // 栏目添加
    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            dump($data);die;
        }
        return view();
    }

    // 栏目编辑
    public function edit(){
        return view();
    }
}