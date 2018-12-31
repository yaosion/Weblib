<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
use app\index\model\MdContent as MdModel;

class mdcontent extends Controller
{
    public function mdcontent($moretype_id)
    {	
    	$contentTypeLi='';
    	//文章主题内容
    	$data = Db::name('md')->where('md_typeid',$moretype_id)->find();
    	//文章所属分类的同级类ID
        $typeId = Db::name('moretype')->where('moretype_id',$data['md_typeid'])->value('type_id');
        //同级所有的文章
        $sameType = Db::name('moretype')->where('type_id',$typeId)->select();
        $casemd = Db::name('casemd')->where('md_belongsmd',$data['md_id'])->select();
        $skillmd = Db::name('skillmd')->where('md_belongsmd',$data['md_id'])->select();
        foreach ($sameType as $sameType){
            $contentTypeLi .= '<li class="sidebar-nav-item"><a class="js-scroll-trigger" href="/index/md_content/mdcontent/moretype_id/'.$sameType['moretype_id'].'">'.$sameType['moretype_name'].'</a></li>';
        };
        $_userId = '';
        $_userInfo = '';
        if(Session::get('userInfo')){
            $_userInfo = Session::get('userInfo');
            $_userId = $_userInfo['id'];
        }else{
            $_userId = -1;
        }
        $mdAssign =[
            'data' => $data,
           'contentTypeLi'=> $contentTypeLi,
            'casemd' => $casemd,
            'skillmd' => $skillmd,
            'userId' => $_userId,
            'userInfo' => $_userInfo
        ];
    	$this->assign($mdAssign);
    	return $this->fetch('mdcontent/mdcontent');
    }

    public function deleteCase()
    {
        if(request()->isAjax()){
            $md_id = input('md_id');
            $_model = new MdModel;
            $result = $_model->deleteCase($md_id);
            return $result;
        }
    }
    public function deleteSkill()
    {
        if(request()->isAjax()){
            $md_id = input('md_id');
            $_model = new MdModel;
            $result = $_model->deleteSkill($md_id);
            return $result;
        }
    }
}
