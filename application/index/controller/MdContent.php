<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;

class MdContent extends Controller
{
    public function mdcontent($moretype_id)
    {
    	$data = Db::name('md')->where('md_id',$moretype_id)->find();
    	$this->assign('data',$data);
    	return $this->fetch('MdContent/mdcontent');
    }
    
}
