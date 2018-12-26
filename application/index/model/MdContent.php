<?php

namespace app\index\model;

use think\Model;
use think\Db;
class MdContent extends Model
{
    public function deleteCase($md_id){
        if(Db::name('casemd')->where('md_id',$md_id)->find()){
            Db::name('casemd')->where('md_id',$md_id)->delete();
            return 1;
        }else{
            return '该案例已删除';
        }
    }

    public function deleteSkill($md_id){
        if(Db::name('skillmd')->where('md_id',$md_id)->find()){
            Db::name('skillmd')->where('md_id',$md_id)->delete();
            return 1;
        }else{
            return '该技巧已删除';
        }
    }
}
