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
        return $this->fetch('Super/super');
    }

    public function getMd(){
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
            $count=Db::name("md")->count("md_id");
            $allMd = Db::name('md')->limit($start,$limit)->order('md_id desc')->select();
            $list["msg"]="";
            $list["code"]=0;
            $list["count"]=$count;
            $list["data"]=$allMd;
            if(empty($cate_list)){
                $list["msg"]="暂无数据";
            }
            //将对象转换json返回
            return json($list);
        }else{
            //分页查询
            $count=Db::name("md")->count("md_id");
            $allMd = Db::name('md')->where('md_belongs',$_userId)->limit($start,$limit)->order('md_id desc')->select();
            $list["msg"]="";
            $list["code"]=0;
            $list["count"]=$count;
            $list["data"]=$allMd;
            if(empty($cate_list)){
                $list["msg"]="暂无数据";
            }
            //将对象转换json返回
            return json($list);
        }
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
