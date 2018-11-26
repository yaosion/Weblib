<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

class SearchList extends Controller
{
    public function searchlist($searchValue)
    {
        $value = $searchValue;
        $this->assign('value',$value);
        return $this->fetch('SearchList/searchlist');
    }
}
