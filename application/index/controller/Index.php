<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    public function index()
    {
    	$typeLi = "";
        $TypeName = Db::name('type')->select();
        foreach ($TypeName as $typename) {
        	$typeLi .= '<li class="sidebar-nav-item"><a class="js-scroll-trigger" href="/index/value_list/valuelist.html">'.$typename['type_name'].'</a></li>';
        };
        $this->assign('typeLi',$typeLi);
        return $this->fetch();
    }
}


