<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    public function index()
    {
        $data = Db::name('md')->find();
        $TypeName = Db::name('type')->select();
        $this->assign('data',$data);
        $this->assign('TypeName',$TypeName);
        echo "<pre>";print_r($this);
        return $this->fetch();
    }
}


