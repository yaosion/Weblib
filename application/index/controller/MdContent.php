<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;

class MdContent extends Controller
{
    public function mdcontent($moretype_id,$type_id)
    {	
    	$contentTypeLi='';
    	$list = Db::name('moretype')->where('type_id',$type_id)->select();
    	$data = Db::name('md')->where('md_id',$moretype_id)->find();
    	foreach ($list as $list) {
        	$contentTypeLi .= '<li class="sidebar-nav-item"><a class="js-scroll-trigger" href="/index/md_content/mdcontent/moretype_id/'.$list['moretype_id'].'/type_id/'.$type_id.'">'.$list['moretype_name'].'</a></li>';
        };

    	$this->assign('data',$data);
    	$this->assign('contentTypeLi',$contentTypeLi);
    	return $this->fetch('MdContent/mdcontent');
    }
    
}
