<?php

namespace app\index\controller;
use app\index\model\Admin as AdminModel;
use think\Controller;
use think\Db;
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
}
