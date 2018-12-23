<?php

namespace app\index\controller;

use app\index\model\Super as SuperModel;
use think\Controller;
use think\Db;
use think\Session;

class Super extends Controller
{
    public function super()
    {
        //判断Session是否有账号
        //@userInfo 返回‘10’ 没有登陆账号
        $_userId = '';
        if(!Session::get('userInfo')){
            $this->redirect('admin/login');
        }else{
            $_userInfo = Session::get('userInfo');
            $_userId = $_userInfo['id'];
        };
        if($_userId == 1){
            $allMd = Db::name('md')->select();
        }else{
            $allMd = Db::name('md')->where('md_belongs',$_userId)->select();
        }
        $valueAssign =[
            'allMd' => $allMd,
        ];
        $this->assign($valueAssign);
        return $this->fetch('Super/super');
    }
    public function mdDelete()
    {
        if(request()->isAjax()){
            $md_id = input('md_id');
            $_model = new SuperModel;
            $result = $_model->mdDelete($md_id);
            return $result;
        }
    }
}
