<?php

namespace app\index\model;

use think\Model;
use think\Db;
class SearchList extends Model
{
    public function find($_key){
        $_value = Db::table('md')
            ->where('md_typename|md_title','like','%'.$_key.'%')
            ->select();
        if($_value != ''){
            return $_value;
        }else{
            return 0;
        }
    }
}
