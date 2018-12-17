<?php

namespace app\index\model;

use think\Model;
use think\Db;
use think\Session;
class Admin extends Model
{
    public function getLoginInfo($data)
    {
        $validate = \think\Loader::validate('Admin');
        if(!$validate->check($data)){
            return $validate->getError();
        };
        if(!Db::name('user')->where('username',$data['username'])->find()){
            return '无该账号';
        }
        $_pwd = Db::name('user')->where('username',$data['username'])->value('password');
        $_userId = Db::name('user')->where('username',$data['username'])->value('id');
        if($_pwd == $data['password']) {
            $userData = Db::name('user')->where('id',$_userId)->field('id,ip,username')->find();
            Session::set('userInfo',$userData);
            return 1;
        }else{
            return '密码不对，请检查密码';
        }
    }

    public function saveUserInfo($data)
    {
        $validate = \think\Loader::validate('Register');
        if(!$validate->check($data)){
            return $validate->getError();
        };
        if(Db::name('user')->where('username',$data['username'])->find()){
            return '该账号已被注册';
        }else if(Db::name('user')->where('email',$data['email'])->find()){
            return '该邮箱已被绑定';
        }
        $result =  Db::name('user')->insert($data,true);
            if($result){
                return 1;
            }else{
                return '注册异常';
            }
    }
}
