<?php

namespace app\index\model;

use think\Model;
use think\Db;
use think\Session;
class Editor extends Model
{
    public function add($data){
        $validate = \think\Loader::validate('Editor');
        if(!$validate->check($data)){
            return $validate->getError();
        }
        //文章分类添加数据
        $tdata = [
            'moretype_name' => $data['md_typename'],
            'type_id' => $data['typeid']
        ];
        if(Db::name('moretype')->insert($tdata,true)){
            $_userInfo = Session::get('userInfo');
            $_userId = $_userInfo['id'];
            $moreTypeId = Db::name('moretype')->where('moretype_name',$data['md_typename'])->value('moretype_id');
            $mdata = [
                'md_content' => $data['md_content'],
                'md_mdcontent' => $data['md_mdcontent'],
                'md_time' => $data['md_time'],
                'md_title' => $data['md_title'],
                'md_typeid' => $moreTypeId,
                'md_typename' => $data['md_typename'],
                'md_belongs' => $_userId,
            ];
            $result =  Db::name('md')->insert($mdata,true);
            if($result){
                return 1;
            }else{
                return '添加失败';
            }
        }else{
            return '添加失败';
        }
    }

    public function cosAdd($cosData)
    {
        $validate = \think\Loader::validate('COSEditor');
        if(!$validate->check($cosData)){
            return $validate->getError();
        }
        $_userInfo = Session::get('userInfo');
        $_userId = $_userInfo['id'];
        if($cosData['getType'] == 0){
            unset($cosData['getType']);
            $cosData['md_belongs'] = $_userId;
            $caseResult =  Db::name('casemd')->insert($cosData,true);
            if($caseResult){
                return 1;
            }else{
                return '添加失败';
            }
        }else if($cosData['getType'] == 1){
            unset($cosData['getType']);
            $cosData['md_belongs'] = $_userId;
            $skillResult =  Db::name('skillmd')->insert($cosData,true);
            if($skillResult){
                return 1;
            }else{
                return '添加失败';
            }
        }
    }
}
