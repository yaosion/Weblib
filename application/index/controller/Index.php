<?php
namespace app\index\controller;

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
            //验证搜索内容
            $validate = \think\Loader::validate('Index');
            // 不为空赋值data数组
            $data = [
                'searchValue' => input('searchValue'),
            ];
            // 检查，如果为空报错
            if(!$validate -> check($data)){
                return $validate->getError();
            }

            return 1;
        }     
    }
    
}


