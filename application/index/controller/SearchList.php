<?php

namespace app\index\controller;
use app\index\model\SearchList as SearchListModel;
use app\index\model\Index as IndexModel;
use think\Controller;

class searchlist extends Controller
{
    public function searchlist($searchValue)
    {
        $_key = $searchValue;
        $_searchValue = '';
        $_model = new SearchListModel;
        $_value = $_model->find($_key);
        if($_value){
            foreach ($_value as $_value) {
                $_searchValue .=  '<div class="col-lg-3">
		        						<a class="portfolio-item" href="/index/md_content/mdcontent/moretype_id/'.$_value['md_typeid'].'">
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
            $_searchValue = 0;
        }
        $searchAssign = [
            'searchValue' => $_searchValue,
        ];
        $this->assign($searchAssign);
        return $this->fetch('searchlist/searchlist');
    }

    public function getSearch(){
        if(request()->isAjax()){
            $data = [
                'searchValue' => input('searchValue'),
            ];
            $_model = new IndexModel;
            $result = $_model->search($data);
            if($result == 1){
                return 1;
            }else{
                return $result;
            }
        }
    }
}
