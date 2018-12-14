<?php
namespace app\index\controller;
use app\index\model\Index as IndexModel;
use think\Controller;
use think\Db;
use think\Session;


class Index extends Controller
{
    public function index()
    {   
    	$typeLi = "";
    	$_userInfo = "";
        $TypeName = Db::name('type')->select();
        foreach ($TypeName as $typename) {
        	$typeLi .= '<li class="sidebar-nav-item"><a class="js-scroll-trigger" href="/index/value_list/valuelist/type_id/'.$typename['type_id'].'">'.$typename['type_name'].'</a></li>';
        };
        if(Session::get('userInfo')){
            $_userInfo = Session::get('userInfo');
        }
        $indexAssign = [
           'typeLi' => $typeLi,
            'userInfo' => $_userInfo,
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

    public function userCance()
    {
        if(request()->isAjax()){
            $data = [
                'getOut' => input('getOut'),
            ];
            if($data['getOut'] == 1) {
                $result = session(null);
                if ($result) {
                    return 1;
                } else {
                    return '已注销，请重新登陆';
                }
            }
        }
    }
    
}


