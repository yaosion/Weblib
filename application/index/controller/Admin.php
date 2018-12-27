<?php

namespace app\index\controller;
use app\index\model\Admin as AdminModel;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
class admin extends Controller
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
    public function maintain()
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
    public function getUser()
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
        //获取分页page和limit参数
        $page=input("get.page")?input("get.page"):1;
        $page=intval($page);
        $limit=input("get.limit")?input("get.limit"):1;
        $limit=intval($limit);
        $start=$limit*($page-1);
        //分页查询
        if($_userId == 1){
            //分页查询
            $count=Db::name("user")->count("id");
            $allUser = Db::name('user')->limit($start,$limit)->order('id desc')->select();
            $list["msg"]="";
            $list["code"]=0;
            $list["count"]=$count;
            $list["data"]=$allUser;
            if(empty($allUser)){
                $list["msg"]="暂无数据";
            }
            //将对象转换json返回
            return json($list);
        }
    }

    public function deleteUser()
    {
        if(request()->isAjax()){
            $id = input('id');
            $_model = new AdminModel;
            $result = $_model->deleteUser($id);
            return $result;
        }
    }
}
