<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class MdContent extends Controller
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
        $casemd = Db::name('casemd')->where('md_belongsmd',$data['md_id'])->find();
        $skillmd = Db::name('skillmd')->where('md_belongsmd',$data['md_id'])->find();
        foreach ($sameType as $sameType){
            $contentTypeLi .= '<li class="sidebar-nav-item"><a class="js-scroll-trigger" href="/index/md_content/mdcontent/moretype_id/'.$sameType['moretype_id'].'">'.$sameType['moretype_name'].'</a></li>';
        };
        $mdAssign =[
            'data' => $data,
           'contentTypeLi'=> $contentTypeLi,
            'casemd' => $casemd,
            'skillmd' => $skillmd,
        ];
    	$this->assign($mdAssign);
    	return $this->fetch('MdContent/mdcontent');
    }
    
}
