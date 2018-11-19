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
    	$listValue = '';
    	$list = Db::name('moretype')->where('type_id',$type_id)->select();
    	$typeName = Db::table('type')->where('type_id',$type_id)->find();
        foreach ($list as $list) {
        	$moreTypeLi .= '<li class="sidebar-nav-item"><a class="js-scroll-trigger" href="/index/md_content/mdcontent/moretype_name/'.$list['moretype_name'].'">'.$list['moretype_name'].'</a></li>';
        	$listValue .=  '<div class="col-lg-3">
        						<a class="portfolio-item" href="/index/md_content/mdcontent/moretype_name/'.$list['moretype_name'].'">
	        	              		<span class="caption">
	        	                	<span class="caption-content">
	        	                  	<h2>'.$list['moretype_name'].'</h2>
	        	                  	<p class="mb-0"></p>
	        	                	</span>
	        	              		</span>
	        	              		<img class="img-fluid" src="/static/images/listbg.jpg" alt="">
        	            		</a>
        	            	</div>';
        };
        $this->assign('typeName',$typeName);
    	$this->assign('moreTypeLi',$moreTypeLi);
    	$this->assign('listValue',$listValue);
    	return $this->fetch('ValueList/valuelist');
    }
    
}
