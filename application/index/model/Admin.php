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

    public function changeUserInfo($data)
    {
        $validate = \think\Loader::validate('Modify');
        if(!$validate->check($data)){
            return $validate->getError();
        };
        if($data['username'] == ''){
            unset($data['username']);
        }else if(Db::name('user')->where('username',$data['username'])->select()){
            return '该名已被注册';
        };
        if($data['password'] == ''){
            $data['password'] = '123';
        }
        $_userInfo = Session::get('userInfo');
        $_userId = $_userInfo['id'];
        $_email = Db::name('user')->where('id',$_userId)->value('email');
        unset($data['email']);
        if(Db::name('user')->where('email', $_email)->update($data)){
            $result = session(null);
            if ($result){
                return '修改失败';
            }else{
                return 1;
            }
        }else{
            return '修改失败，请注销再登陆操作';
        }
    }

    public function deleteUser($id){
        $_userInfo = Session::get('userInfo');
        $_userId = $_userInfo['id'];
        if($_userId != $id){
            if(Db::name('user')->where('id',$id)->find()){
                Db::name('casemd')->where('md_belongs',$id)->delete();
                Db::name('skillmd')->where('md_belongs',$id)->delete();
                $mdTypeId = Db::name('md')->where('md_belongs',$id)->value('md_typeid');
                Db::name('moretype')->where('moretype_id',$mdTypeId)->delete();
                Db::name('md')->where('md_belongs',$id)->delete();
                Db::name('user')->where('id',$id)->delete();
                return 1;
            }else{
                return '没有该用户';
            }
        }else if($_userId == $id){
            return '不能删除admin';
        }else{
            return '未知异常';
        }
    }

    public function fogetPassWord($_forget)
    {
        $validate = \think\Loader::validate('ForgetPWD');
        if(!$validate->check($_forget)){
            return $validate->getError();
        };
        $_email = Db::name('user')->where('username',$_forget['username'])->value('email');
        if($_email === $_forget['email']){
            $userData = Db::name('user')->where('email',$_forget['email'])->field('id,ip,username')->find();
            Session::set('userInfo',$userData);
            return 1;
        }else {
            return 0;
        }
    }
}
