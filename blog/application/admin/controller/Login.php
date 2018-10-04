<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/9/14
 * Time: 15:53
 */

namespace app\admin\controller;


use think\Controller;
use think\Validate;

class Login extends Controller
{
    public function index(){
        if (request()->isPost()){
            $data = input('post.');
            $res = $this->loginCheck($data);
            if (isset($res['msg']) && isset($res['mid'])){
                $dataLog = [
                    'mid' => $res['mid'],
                    'loginIP' => request()->ip(),
                    'loginTime' => time(),
                    'loginMSG' => $res['msg'],
                ];
                // 获取日志表的记录数量
                $log_rows = db('loginlog')->count();
                if ($log_rows == 30){
                    $log_min = db('loginlog')->min('loginTime'); // 获取日志中记录时间最晚的的记录
                    db('loginlog')->where('loginTime', $log_min)->delete(); // 删除日志表中最晚的的记录
                }
                db('loginlog')->insert($dataLog);
            }
            // 当code=1
            if($res['code'] == 1){
               return json("1");
            }else{
            	return json("2");
            }
        }
        // 用session判断登录状态，防止未登录就能进入网站后台
        if (session('loginName','','admin') && session('loginID','','admin')){
            $this->redirect('login/index');
        }
        return view();
    }
    // 管理员登录验证
    public function loginCheck($data){
//         $validate = Validate('manager');
//         if ($validate->scene('login')->check($data)){
//             return ['code'=>0, 'msg'=>$validate->getError()];
//         }
        $result = db('manager')->where('userName',$data['userName'])->find();
        if (!$result){
            return ['code'=>2,'msg'=>'管理员不存在'];
        }
        if (md5($data['password']) != $result['password']){
            return ['code'=>3,'msg'=>'管理员密码不正确','mid'=>$result['id']];
        }
        if ($result['state'] == 0){
            return ['code'=>4,'msg'=>'管理员状态被锁定,不允许登录','mid'=>$result['id']];
        }

        // 保存登录信息到session，登录成功！
        session('loginName',$result['userName'], 'admin');  // prefix:'admin'是指作用域是admin部分，防止同一台电脑同时登录前后台时发生错误
        session('loginID', $result['id'], 'admin');
        return ['code'=>1,'msg'=>'管理员登录成功!!!','mid'=>$result['id']];
    }

    // 退出登录
    public function logout(){
        session(null,'admin'); // 删除保存在session中的值
        $this->success('退出成功！','login/index');
    }
}