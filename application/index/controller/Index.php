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
        $this->assign('data',$data);
        return $this->fetch();
    }
}
