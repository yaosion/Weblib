<?php
namespace app\index\controller;
// use app\admin\model\Index as IndexModel;
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
        	$typeLi .= '<li class="sidebar-nav-item"><a class="js-scroll-trigger" href="/index/value_list/valuelist/type_id/'.$typename['type_id'].'">'.$typename['type_name'].'</a></li>';
        };
        $this->assign('typeLi',$typeLi);
        return $this->fetch();
    }

    public function search()
    {
            if(request()->isPost()){
                $data = [
                    'searchValue' => input('searchValue'),
                ];
                print_r($data);
                // $validate = \think\Loader::validate('Index');
                // $validate->scene('search')->check($data);
            }
            return ;
    }
    
}


