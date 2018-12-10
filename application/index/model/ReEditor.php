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
            $result=Db::name('md')
                ->where('md_id', $data['md_id'])
                ->update(['md_content' => $data['md_content']],['md_mdcontent' => $data['md_mdcontent']],['md_time' => $data['md_time']],['md_title' => $data['md_title']],['md_typeid' => $data['md_typeid']],['md_typename' => $data['md_typename']]);
            if($result){
                return 1;
            }else{
                return '修改失败';
            }
        }
    }
}