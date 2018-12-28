<?php

namespace app\index\model;

use think\Model;
use think\Db;

class ReEditor extends Model
{
    public function updateMd($data){
        $validate = \think\Loader::validate('ReEditor');
        if(!$validate->check($data)){
            return $validate->getError();
        }
        if(Db::name('md')->where('md_id',$data['md_id'])->find()){
            $tdata = [
                'moretype_name' => $data['md_typename'],
                'type_id' => $data['typeid']
            ];
            //所属子类ID
            $moreTypeId = Db::name('md')->where('md_id',$data['md_id'])->value('md_typeid');
            Db::name('moretype')
                ->where('moretype_id', $moreTypeId)
                ->update($tdata);
            $mdata = [
                'md_content' => $data['md_content'],
                'md_mdcontent' => $data['md_mdcontent'],
                'md_modtime' => $data['md_modtime'],
                'md_title' => $data['md_title'],
                'md_typename' => $data['md_typename'],
            ];
            $result=Db::name('md')
                ->where('md_id', $data['md_id'])
                ->update($mdata);
            if($result != 0){
                return 1;
            }else{
                return '修改失败，该文可能已删除，请刷新页面';
            }
        }
    }
}