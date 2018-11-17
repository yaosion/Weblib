<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;

class ValueList extends Controller
{
    public function valuelist($type_id)
    {	
    	$moreTypeLi = '';
    	$list = Db::name('moretype')->where('type_id',$type_id)->select();
        foreach ($list as $list) {
        	$moreTypeLi .= '<li class="sidebar-nav-item"><a class="js-scroll-trigger" href="/index/md_content/mdcontent/moretype_id/'.$list['moretype_id'].'">'.$list['moretype_name'].'</a></li>';
        };
    	$this->assign('moreTypeLi',$moreTypeLi);
    	return $this->fetch('ValueList/valuelist');
    }
    
}
