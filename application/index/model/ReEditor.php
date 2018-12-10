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
                ->update($data);
            if($result != 0){
                return 1;
            }else{
                return '修改失败';
            }
        }
    }
}