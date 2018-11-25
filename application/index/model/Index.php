<?php
namespace app\index\model;
use think\Model;
use think\Db;

class Index extends Model
{
    public function search($data){
        if($data.searchValue != ''){
            return $data;
        }
    }

}


