<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class MdContent extends Controller
{
    public function mdcontent($moretype_name)
    {	
    	$contentTypeLi='';
    	$data = Db::name('md')->where('md_typename',$moretype_name)->find();
    	$list = Db::name('moretype')->where('type_id',$data['md_typeid'])->select();
    	foreach ($list as $list) {
        	$contentTypeLi .= '<li class="sidebar-nav-item"><a class="js-scroll-trigger" href="/index/md_content/mdcontent/moretype_name/'.$list['moretype_name'].'">'.$list['moretype_name'].'</a></li>';
        };

    	$this->assign('data',$data);
    	$this->assign('contentTypeLi',$contentTypeLi);
    	return $this->fetch('MdContent/mdcontent');
    }
    
}
