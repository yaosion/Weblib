<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

class SearchList extends Controller
{
    public function searchlist($searchValue)
    {
        $_key = $searchValue;
        $_searchValue = '';
        $_value = Db::table('md')
            ->where('md_typename|md_title','like','%'.$_key.'%')
            ->select();
        if($_value != ''){
            foreach ($_value as $_value) {
                $_searchValue .=  '<div class="col-lg-3">
		        						<a class="portfolio-item" href="/index/md_content/mdcontent/moretype_name/'.$_value['md_typename'].'">
			        	              		<span class="caption">
			        	                	<span class="caption-content">
			        	                  	<h2>'.$_value['md_typename'].'</h2>
			        	                  	<p class="mb-0"></p>
			        	                	</span>
			        	              		</span>
			        	              		<img class="img-fluid" src="/static/images/listbg.jpg" alt="">
		        	            		</a>
		        	            	</div>';
            };
        }else{
            return ;
        };
        $this->assign('searchValue',$_searchValue);
        return $this->fetch('SearchList/searchlist');
    }
}
