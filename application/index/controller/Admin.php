<?php

namespace app\index\controller;
use app\index\model\Admin as AdminModel;
use think\Controller;
use think\Db;
use think\Request;
class Admin extends Controller
{
    public function login()
    {
        return  $this->fetch();
    }
    public function register()
    {
        return  $this->fetch();
    }
    public function modify()
    {
        return  $this->fetch();
    }

    public function getLoginInfo()
    {
        if(request()->isAjax()){
            $data = [
              'username' => input('username'),
              'password' => input('password')
            ];
            $_model = new AdminModel;
            $result = $_model->getLoginInfo($data);
            if($result == 1){
                return 1;
            }else{
                return $result;
            }
        }
    }
    public function saveUserInfo()
    {
        if(request()->isAjax()){
            $request = Request::instance();
            $data = [
                'username' => input('username'),
                'password' => input('password'),
                'email' => input('email'),
                'createtime' => $request->time(),
                'ip' => $request->ip(),
            ];
            $_model = new AdminModel;
            $result = $_model->saveUserInfo($data);
            if($result == 1){
                return 1;
            }else{
                return $result;
            }
        }
    }
    public function changeUserInfo()
    {
        if(request()->isAjax()){
            $data = [
                'username' => input('username'),
                'password' => input('password'),
                'email' => input('email'),
            ];
            $_model = new AdminModel;
            $result = $_model->changeUserInfo($data);
            if($result == 1){
                return 1;
            }else{
                return $result;
            }
        }
    }
}
