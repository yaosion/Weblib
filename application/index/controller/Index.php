<?php
namespace app\index\controller;
use app\index\model\Index as IndexModel;
use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {   
    	$typeLi = "";
        $TypeName = Db::name('type')->select();
        foreach ($TypeName as $typename) {
        	$typeLi .= '<li class="sidebar-nav-item"><a class="js-scroll-trigger" href="/index/value_list/valuelist/type_id/'.$typename['type_id'].'">'.$typename['type_name'].'</a></li>';
        };
        $indexAssign = [
           'typeLi' => $typeLi,
        ];
        $this->assign($indexAssign);
        return $this->fetch();
    }

    public function search()
    {
        if(request()->isAjax()){
            $data = [
                'searchValue' => input('searchValue'),
            ];
            $_model = new IndexModel;
            $result = $_model->search($data);
            return $result;
        }     
    }
    
}


